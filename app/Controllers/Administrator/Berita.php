<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Berita extends BaseController
{
    public function index()
    {
        return view('administrator/v_berita');
    }

    public function edit($id)
    {
        if ($id != 0) {
            # code...
            $sql = $this->berita->find($id);
            $data = [
                'BeritaID' => $sql['BeritaID'],
                'Judul' => $sql['Judul'],
                'Konten' => $sql['Konten'],
                'TanggalPublish' => $sql['TanggalPublish'],
                'Publish' => $sql['Publish'],
                'ImageBerita' => $sql['ImageBerita'],
                'Headline' => $sql['Headline'],
            ];
        } else {
            $data = [
                'BeritaID' => 0,
                'Judul' => '',
                'Konten' => '',
                'TanggalPublish' => date('Y-m-d'),
                'Publish' => '',
                'ImageBerita' => '',
                'Headline' => '',
            ];
        }

        return view('administrator/v_berita-edit', $data);
    }

    function simpan()
    {
        $post = $this->request->getPost();

        $data = [
            'Judul' => $post['Judul'],
            'Slug' => url_title($post['Judul'], '-', TRUE),
            'Konten' => $post['Konten'],
            'Publish' => $post['Publish'],
            'Headline' => @$post['Headline'],
            'TanggalPublish' => $post['TanggalPublish'],
             'UserID' => session()->get('s_UserID'),
        ];

        $ImageBerita = $this->request->getFile('ImageBerita');

        if (file_exists($ImageBerita)) {
            $validationRule = [
                'ImageBerita' => [
                    'label' => 'File image',
                    'rules' => [
                        'uploaded[ImageBerita]',
                        'mime_in[ImageBerita,image/jpg,image/jpeg,image/png]',
                        // 'ext_in[GeojsonDrainase,geojson]',
                    ],
                ],
            ];
            if (!$this->validate($validationRule)) {
                return redirect()->to('admin/berita/edit/' . $post['BeritaID'])->with('error', $this->validator->getErrors());
            }
            $lokasi = 'assets/files/berita/';
            createDir($lokasi);

            $sql = $this->berita->find($post['BeritaID']);
            if ($sql) {
                if (file_exists($lokasi . $sql['ImageBerita']) && $sql['ImageBerita']) {
                    unlink($lokasi . $sql['ImageBerita']);
                }
            }

            if ($ImageBerita->isValid() && !$ImageBerita->hasMoved()) {
                $newName = 'berita_' . $ImageBerita->getRandomName();
                $ImageBerita->move($lokasi, $newName);
                $data = array_merge($data, ['ImageBerita' => $newName]);
            }
        }

        if ($post['BeritaID'] == 0) {
            $param = $this->berita->insert($data);

            if ($param > 0) {
                $param = 1;
                $pesan = 'Berhasil Simpan';
            } else {
                $param = 0;
                $pesan = $this->berita->errors();
            }
        } else {
            $param = $this->berita->update($post['BeritaID'], $data);

            if ($param > 0) {
                $param = 1;
                $pesan = 'Update data berhasil';
            } else {
                $param = 0;
                $pesan = $this->berita->errors();
            }
        }

        if ($param > 0) {
            return redirect()->to('admin/berita')->with('success', $pesan);
        } else {
            return redirect()->to('admin/berita/edit/' . $post['BeritaID'])->with('error', $pesan);
        }
    }

    public function berita()
    {
        $model = $this->berita->where('Publish="Y" AND CURDATE()>=TanggalPublish');


        if ($model) {
        $data = [
            'title' => 'WEBGIS DATABASE DRAINASE',
            'berita' => $model->paginate(6),
            'pager' => $model->pager
        ];

        return view('v_berita', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

    }


    public function view($slug)
    {
        $sql = $this->berita->where('slug', $slug)->first();
        if ($sql) {
            $this->berita->update($sql['BeritaID'], ['View' => ($sql['View'] + 1)]);

            $this->data['data'] =  $sql;
            $this->data['title'] = 'WEBGIS DATABASE DRAINASE';
            return view('v_berita-detail', $this->data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function viewAdmin($slug)
    {
        $sql = $this->berita->where('slug', $slug)->first();
        if ($sql) {
            $this->data['data'] =  $sql;
            $this->data['title'] = 'WEBGIS DATABASE DRAINASE';
            return view('administrator/v_berita-detail', $this->data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function exportExcel()
    {


        $Tanggal1 = $this->request->getPost('Tanggal1');
        $Tanggal2 = $this->request->getPost('Tanggal2');
        $Publish = $this->request->getPost('Publish');


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

        $sheet->setCellValue('A1', "DATA BERITA"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:D1'); // Set Merge Cell pada kolom A1 sampai F1
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        $sheet->getStyle('A1')->getFont()->setSize(15);

        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Judul');
        $sheet->setCellValue('C2', 'Status');
        $sheet->setCellValue('D2', 'View');

        $sheet->getStyle('A2:D2')->getAlignment()->setHorizontal('center');
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);

        $sheet->getStyle('A2')->applyFromArray($style_col);
        $sheet->getStyle('B2')->applyFromArray($style_col);
        $sheet->getStyle('C2')->applyFromArray($style_col);
        $sheet->getStyle('D2')->applyFromArray($style_col);

        $builder = $this->berita;
        $builder->select('*');



        if (!empty($Tanggal2)) {
            $builder->where('TanggalPublish BETWEEN "' . $Tanggal1 . '" AND "' . $Tanggal2 . '"');
        }
        if (!empty($publish)) {
            $builder->where(['Publish' => $publish]);
        }
      $builder->where('DeletedAT', null);
        $query = $builder->find();

        $column = '3';
        $no = 1;
        if ($query) {
            # code...
            foreach ($query as $va) {
                if ($va['Publish'] == 'Y') {
                    $stt = 'Berita Terpublish';
                } else {
                    $stt = 'Berita Tidak Publish';
                }

                $sheet->setCellValue('A' . $column, $no);
                $sheet->setCellValue('B' . $column, $va['Judul']);
                $sheet->setCellValue('C' . $column, $stt);
                $sheet->setCellValue('D' . $column, $va['View']);

                $sheet->getStyle('A' . $column)->applyFromArray($style_row);
                $sheet->getStyle('B' . $column)->applyFromArray($style_row);
                $sheet->getStyle('C' . $column)->applyFromArray($style_row);
                $sheet->getStyle('D' . $column)->applyFromArray($style_row);

                $column++;
                $no++;

                # code...
            }

            helper('download');
            $location = 'assets/files/export-excel/';
            createDir($location);
            $filename = 'export_berita' . date('His') . '.xlsx';
            $writer = new Xlsx($spreadsheet);
            $writer->save($location . $filename);
            // $filepath = file_get_contents($location . $filename);
            // force_download($filename, $filepath);
            return $this->response->download($location . $filename, null);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
