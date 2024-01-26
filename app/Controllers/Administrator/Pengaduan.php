<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pengaduan extends BaseController
{
    public function index()
    {
        return view('administrator/v_pengaduan');
    }

    public function show()
    {
        //
        $this->data['title'] = 'WEBGIS DATABASE DRAINASE';
        return view('v_pengaduan', $this->data);
    }

    public function simpan()
    {

        $param = 0;
        $post = $this->request->getPost();

        $ImgPengaduan = $this->request->getFile('ImgPengaduan');
        $tglStt = null;
        if (isset($post['Status'])) {
            if ($post['Status'] != 'P') {
                $tglStt = date('Y-m-d');
            }
        }


        $data = [
            'Nama' => $post['Nama'],
            'Email' => $post['Email'],
            'Handphone' => $post['Handphone'],
            'KTP' => $post['KTP'],
            'Lokasi' => $post['Lokasi'],
            'ProvinsiID' => '13',
            'KabupatenID' => '1375',
            'KecamatanID' => $post['KecamatanID'],
            'KelurahanID' => $post['KelurahanID'],
            'Keterangan' => $post['Keterangan'],
            'Tindakan' => @$post['Tindakan'],
            'Tampilkan' => @$post['Tampilkan'],
            'Status' => @$post['Status'] ? $post['Status'] : 'P',
            'TglStatus' => $tglStt,

        ];

        if (file_exists($ImgPengaduan)) {
            # code...
            $validationRule = [
                'ImgPengaduan' => [
                    'label' => 'File Image',
                    'rules' => [
                        'uploaded[ImgPengaduan]',
                        'mime_in[ImgPengaduan,image/jpg,image/jpeg,image/png]',
                        // 'ext_in[GeojsonDrainase,geojson]',
                    ],
                ],
            ];
            if (!$this->validate($validationRule)) {
                return $this->response->setJSON(['param' => 0, 'pesan' => $this->validator->getErrors()]);
            }
            $lokasi = 'assets/files/pengaduan/';
            createDir($lokasi);
            if ($ImgPengaduan->isValid() && !$ImgPengaduan->hasMoved()) {
                $newName = 'penaduan_' . $ImgPengaduan->getRandomName();
                $newName1 = $newName;

                $ImgPengaduan->move($lokasi, $newName);
                $data = array_merge($data, ['ImgPengaduan' => $newName1]);
            }
        }


        if ($post['PengaduanID'] == 0) {
            $param = $this->pengaduan->insert($data);

            if ($param > 0) {
                if (file_exists($ImgPengaduan)) {
                    $ImgPengaduan->move($lokasi, $newName);
                }
                return $this->response->setJSON(['param' => $param, 'pesan' => 'Berhasil simpan']);
                // echo 'OK';
            } else {
                // echo 'gagal';
                return $this->response->setJSON(['param' => $param, 'pesan' => $this->pengaduan->errors()]);
            }
        } else {

            $param = $this->pengaduan->update($post['PengaduanID'], $data);
            if ($param > 0) {
                if (file_exists($ImgPengaduan)) {
                    $ImgPengaduan->move($lokasi, $newName);
                }
                return $this->response->setJSON(['param' => $param, 'pesan' => 'Berhasil update']);
                // echo 'OK';
            } else {
                // echo 'gagal';
                return $this->response->setJSON(['param' => $param, 'pesan' => $this->pengaduan->errors()]);
            }
        }
    }

    public function exportExcel()
    {


        $Tanggal1 = $this->request->getPost('Tanggal1');
        $Tanggal2 = $this->request->getPost('Tanggal2');
        $Status = $this->request->getPost('Status');


        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
                $style_col = [
            'font' => ['bold' => true],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => 'FFC9C9C9')
            ) // Set border left dengan garis tipis
        ];

        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $sheet->setCellValue('A1', "DATA PENGADUAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai F1
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        $sheet->getStyle('A1')->getFont()->setSize(15);

        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama');
        $sheet->setCellValue('C2', 'Email');
        $sheet->setCellValue('D2', 'KTP');
        $sheet->setCellValue('E2', 'Handphone');
        $sheet->setCellValue('F2', 'Kecamatan');
        $sheet->setCellValue('G2', 'Kelurahan');
        $sheet->setCellValue('H2', 'Keterangan');

        $sheet->getStyle('A2:H2')->getAlignment()->setHorizontal('center');
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A2')->applyFromArray($style_col);
        $sheet->getStyle('B2')->applyFromArray($style_col);
        $sheet->getStyle('C2')->applyFromArray($style_col);
        $sheet->getStyle('D2')->applyFromArray($style_col);
        $sheet->getStyle('E2')->applyFromArray($style_col);
        $sheet->getStyle('F2')->applyFromArray($style_col);
        $sheet->getStyle('G2')->applyFromArray($style_col);
        $sheet->getStyle('H2')->applyFromArray($style_col);


        $builder = $this->pengaduan;
        $builder->select('*');

        if (!empty($Tanggal2)) {
            $builder->where('date(DCreate) BETWEEN "' . $Tanggal1 . '" AND "' . $Tanggal2 . '"');
        }
        if (!empty($Status)) {
            $builder->where(['Status' => $Status]);
        }
      $builder->where('DeletedAT', null);
        $query = $builder->find();

        $column = '3';
        $no = 1;
        if ($query) {
            # code...
            foreach ($query as $va) {
                if ($va['Status'] == 'Y') {
                    $stt = 'Pengajuan Diterima';
                } elseif ($va['Status'] == 'P') {
                    $stt = 'Proses Pengajuan';
                } else {
                    $stt = 'Pengajuan Ditolak';
                }

                $KecamatanID =  getNamaDaerah('kecamatan', @$va['KecamatanID']);
                $KelurahanID =  getNamaDaerah('kelurahan', @$va['KelurahanID']);

                $sheet->setCellValue('A' . $column, $no);
                $sheet->setCellValue('B' . $column, $va['Nama']);
                $sheet->setCellValue('C' . $column, $va['Email']);
                $sheet->setCellValue('D' . $column, $va['KTP']);
                $sheet->setCellValue('E' . $column, $va['Handphone']);
                $sheet->setCellValue('F' . $column, $KecamatanID);
                $sheet->setCellValue('G' . $column, $KelurahanID);
                $sheet->setCellValue('H' . $column, $va['Keterangan']);
                // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                $sheet->getStyle('A' . $column)->applyFromArray($style_row);
                $sheet->getStyle('B' . $column)->applyFromArray($style_row);
                $sheet->getStyle('C' . $column)->applyFromArray($style_row);
                $sheet->getStyle('D' . $column)->applyFromArray($style_row);
                $sheet->getStyle('E' . $column)->applyFromArray($style_row);
                $sheet->getStyle('F' . $column)->applyFromArray($style_row);
                $sheet->getStyle('G' . $column)->applyFromArray($style_row);
                $sheet->getStyle('H' . $column)->applyFromArray($style_row);



                $column++;
                $no++;

                # code...
            }

            helper('download');
            $location = 'assets/files/export-excel/';
            createDir($location);
            $filename = 'export_pengaduan' . date('His') . '.xlsx';
            $writer = new Xlsx($spreadsheet);
            $writer->save($location . $filename);
            // $filepath = file_get_contents($location . $filename);
            // force_download($filename, $filepath);
            return $this->response->download($location . $filename, null);
        }
    }
}
