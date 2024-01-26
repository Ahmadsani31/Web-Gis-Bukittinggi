<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Drainase extends BaseController
{
    public function index()
    {
        //
        return view('administrator/v_drainase');
    }

    public function edit($id)
    {

        $lokasi = 'assets/files/drainase/';
        if ($id != 0) {
            # code...
            $sql = $this->drainase->find($id);
            if (!empty($sql['FileImage1'])) {
                $btn1 = 'info';
                # code...
            } else {
                $btn1 = 'danger';
            }

            if (!empty($sql['FileImage2'])) {
                $btn2 = 'info';
                # code...
            } else {
                $btn2 = 'danger';
            }

            if (!empty($sql['FileImage3'])) {
                $btn3 = 'info';
                # code...
            } else {
                $btn3 = 'danger';
            }
            $data = [
                'Tahun' => $sql['Tahun'],
                'DrainaseID' => $sql['DrainaseID'],
                'NamaJalan' => $sql['NamaJalan'],
                'KodeDrain' => $sql['KodeDrain'],
                'ProvinsiID' => $sql['ProvinsiID'],
                'KecamatanID' => $sql['KecamatanID'],
                'KabupatenID' => $sql['KabupatenID'],
                'KelurahanID' => $sql['KelurahanID'],
                'Kondisi' => $sql['Kondisi'],
                'Konstruksi' => $sql['Konstruksi'],
                'Sediment' => $sql['Sediment'],
                'Panjang' => $sql['Panjang'],
                'Lebar' => $sql['Lebar'],
                'LebarB' => $sql['LebarB'],
                'Tinggi' => $sql['Tinggi'],
                'Penampang' => $sql['Penampang'],
                'PosisiSaluran' => $sql['PosisiSaluran'],
                'JenisSaluran' => $sql['JenisSaluran'],
                'Keterangan' => $sql['Keterangan'],

                'btn1' => $btn1,
                'btn2' => $btn2,
                'btn3' => $btn3,
                'text' => 'Edit Data Drainase',
            ];
        } else {
            $data = [
                'Tahun' => date('Y'),
                'DrainaseID' => '',
                'NamaJalan' => '',
                'KodeDrain' => getKodeDrainaseTerbaru(),
                'ProvinsiID' => '',
                'Penampang' => '',
                'KabupatenID' => '1375',
                'KecamatanID' => '',
                'KelurahanID' => '',
                'Kondisi' => '',
                'Konstruksi' => '',
                'Sediment' => '',
                'Panjang' => '',
                'Lebar' => '',
                'LebarB' => '',
                'Tinggi' => '',
                'PosisiSaluran' => '',
                'JenisSaluran' => '',
                'Image' => '',
                'Keterangan' => '',

                'btn1' => 'danger',
                'btn2' => 'danger',
                'btn3' => 'danger',
                'text' => 'Tambah Data Drainase',

            ];
        }

        return view('administrator/v_drainase-edit', $data);
    }

    public function simpan()
    {
        $post = $this->request->getPost();

        if ($post['DrainaseID'] == 0) {

            $sqCek = $this->drainase->where('KodeDrain', $post['KodeDrain'])->find();
            if ($sqCek) {
                return redirect()->to('admin/drainase/edit/' . $post['DrainaseID'])->with('error', 'Kode Drainase Sudah Terdata,Inputkan yang lain');
            }
        }

        $fileImg = [
            'FileImage1',
            'FileImage2',
            'FileImage3',
        ];

        $fileImgDel = [
            'deleteFileImage1',
            'deleteFileImage2',
            'deleteFileImage3',
        ];


        $data = [
            'Tahun' => $post['Tahun'],
            'NamaJalan' => $post['Nama'],
            'KodeDrain' => $post['KodeDrain'],
            'ProvinsiID' => '13',
            'KabupatenID' => '1375',
            'Penampang' => $post['Penampang'],
            'KecamatanID' => $post['KecamatanID'],
            'KelurahanID' => $post['KelurahanID'],
            'Kondisi' => $post['Kondisi'],
            'Konstruksi' => $post['Konstruksi'],
            'Sediment' => $post['Sediment'],
            'Panjang' => $post['Panjang'],
            'Lebar' => $post['Lebar'],
            'LebarB' => $post['LebarB'],
            'Tinggi' => $post['Tinggi'],
            'PosisiSaluran' => $post['PosisiSaluran'],
            'JenisSaluran' => $post['JenisSaluran'],
            'Keterangan' => $post['Keterangan'],
            // 'Coordinates' => $post['Coordinates'],
            'TypeGeojson' =>  'MultiLineString',
            'Coordinate' =>  $post['Coordinates'],
            'UserID' => session()->get('s_UserID'),
        ];


        $lokasi = 'assets/files/drainase/';
        createDir($lokasi);
        foreach ($fileImg as $fm) {
            $FImg = $this->request->getFile($fm);

            if (file_exists($FImg)) {
                $validationRule = [
                    $fm => [
                        'label' => 'File image',
                        'rules' => [
                            'uploaded[' . $fm . ']',
                            'mime_in[' . $fm . ',image/jpg,image/jpeg,image/png]',
                            // 'ext_in[GeojsonDrainase,geojson]',
                        ],
                    ],
                ];
                if (!$this->validate($validationRule)) {
                    return redirect()->to('admin/drainase/edit/' . $post['DrainaseID'])->with('error', $this->validator->getErrors());
                }
            }
            # code...
        }

        $sq = $this->drainase->find($post['DrainaseID']);

        foreach ($fileImg as $fm1) {
            $FImg1 = $this->request->getFile($fm1);

            if (file_exists($FImg1)) {
                if ($sq) {
                    if (file_exists($lokasi . $sq[$fm1]) && $sq[$fm1]) {
                        unlink($lokasi . $sq[$fm1]);
                    }
                }

                if ($FImg1->isValid() && !$FImg1->hasMoved()) {
                    $newName = 'drainase_' . $FImg1->getRandomName();
                    $newName1 = $newName;

                    $FImg1->move($lokasi, $newName);
                    $data = array_merge($data, [$fm1 => $newName1]);
                }
            }
            # code...
        }


        foreach ($fileImgDel as $fm1del) {
            $flImg = $this->request->getPost($fm1del);
            if (!empty($flImg)) {

                if ($sq) {
                    if (file_exists($lokasi . $sq[$flImg]) && $sq[$flImg]) {
                        unlink($lokasi . $sq[$flImg]);
                    }

                    $data = array_merge($data, [$flImg => null]);
                }
            }
            # code...
        }



        if ($post['DrainaseID'] == 0) {
            $param = $this->drainase->insert($data);

            if ($param > 0) {
                $param = 1;
                $pesan = 'Berhasil Simpan';
            } else {
                $param = 0;
                $pesan = $this->drainase->errors();
            }
        } else {
            $param = $this->drainase->update($post['DrainaseID'], $data);

            if ($param > 0) {
                $param = 1;
                $pesan = 'Update data berhasil';
            } else {
                $param = 0;
                $pesan = $this->drainase->errors();
            }
        }

        if ($param > 0) {
            return redirect()->to('admin/drainase')->with('success', $pesan);
        } else {
            return redirect()->to('admin/drainase/edit/' . $post['DrainaseID'])->with('error', $pesan);
        }
    }

    function getCoordinat()
    {
        $id = $this->request->getPost('DrainaseID');
        $FileJson = $this->request->getFile('FileJson');

        if (file_exists($FileJson)) {
            $validationRule = [
                'FileJson' => [
                    'label' => 'File Geojson',
                    'rules' => [
                        'uploaded[FileJson]',
                        'mime_in[FileJson,application/json,application/geojson]',
                        // 'ext_in[GeojsonDrainase,geojson]',
                    ],
                ],
            ];
            if (!$this->validate($validationRule)) {
                return $this->response->setJSON(['param' => 0, 'pesan' => $this->validator->getErrors()]);
            } else {

                $json = file_get_contents($FileJson);

                $json_data = json_decode($json, true);

                foreach ($json_data['features'] as $key => $value) {
                    $coordinatGjson[] = [
                        'type' => 'Feature',
                        'properties' => [],
                        'geometry' => $value['geometry']
                    ];

                    $coordinat[] = $value['geometry']['coordinates'];
                }
                return $this->response->setJSON(['param' => 1, 'geojson' => $coordinatGjson, 'coordinat' =>  json_encode($coordinat)]);
            }
            # code..e
        } else {

            if (!empty($id)) {
                $sq = $this->drainase->find($id);


                $geojson[] =  [
                    'type' => 'Feature',
                    'properties' => [],
                    'geometry' => [
                        "type" => $sq['TypeGeojson'],
                        "coordinates" => json_decode($sq['Coordinate'])
                    ]
                ];

                return $this->response->setJSON(['param' => 1, 'geojson' => $geojson, 'coordinat' => $sq['Coordinate']]);
            } else {
                return $this->response->setJSON(['param' => 2, 'pesan' => 'tidak ada coordinat']);
            }
        }
    }


    public function imporLayer()
    {

        $param = 0;
        $validationRule = [
            'GeojsonDrainase' => [
                'label' => 'File Geojson',
                'rules' => [
                    'uploaded[GeojsonDrainase]',
                    'mime_in[GeojsonDrainase,application/json]',
                    // 'ext_in[GeojsonDrainase,geojson]',
                ],
            ],
        ];
        if (!$this->validate($validationRule)) {
            return $this->response->setJSON(['param' => 0, 'pesan' => $this->validator->getErrors()]);
        } else {

            $FlGeo = $this->request->getFile('GeojsonDrainase');
            $Tahun = $this->request->getPost('Tahun');

            $json = file_get_contents($FlGeo);

            $json_data = json_decode($json, true);


            foreach ($json_data['features'] as $key => $value) {

                if (isMultiDimensional($value['geometry']['coordinates']) == true) {
                    # code...
                    $nmKec = $value['properties']['Kecamatan'];
                    $nKec =    db_connect()->table('t_kecamatan')->select('nama')->like('nama', $value['properties']['Kecamatan'])->get();
                    if ($nKec->getNumRows() > 0) {
                        $nK = $nKec->getRow();
                        $nmKec = $nK->nama;
                    }
                    $nmKel = $value['properties']['Kelurahan'];
                    $nKel =    db_connect()->table('t_kelurahan')->select('nama')->like('nama', $value['properties']['Kelurahan'])->get();
                    if ($nKel->getNumRows() > 0) {
                        $nL = $nKel->getRow();
                        $nmKel = $nL->nama;
                    }


                    $daInsert[] = [
                        'NamaJalan' =>  $value['properties']['NamaJalan'],
                        'KodeDrain' => 'DRE' . sprintf("%05s", random_string('numeric', 3)),
                        'UserID' =>   session()->get('s_UserID'),
                        'Tahun' =>   $Tahun,
                        'ProvinsiID' => '13',
                        'KabupatenID' => '1375',
                        'KecamatanID' =>  @$nmKec,
                        'KelurahanID' =>  @$nmKel,
                        'Keterangan' =>  @$value['properties']['Keterangan'],
                        'Kondisi' =>  @$value['properties']['Kondisi'],
                        'Penampang' =>  @$value['properties']['Penampang'],
                        'Konstruksi' =>  @$value['properties']['Konstruksi'],
                        'Panjang' =>  @$value['properties']['Panjang'],
                        'Tinggi' => str_replace(",", ".", $value['properties']['Tinggi']),
                        'Lebar' => str_replace(",", ".", $value['properties']['Lebar']),
                        'PosisiSaluran' => @$value['properties']['Posisi'],
                        'JenisSaluran' => @$value['properties']['JenisSaluran'],
                        'X_Akhir' =>  @$value['properties']['X_Akhir'],
                        'X_Awal' =>  @$value['properties']['X_Awal'],
                        'Y_Akhir' =>  @$value['properties']['Y_Akhir'],
                        'Y_Awal' =>  @$value['properties']['Y_Awal'],
                        'TypeGeojson' =>  @$value['geometry']['type'],
                        'Sediment' =>  @$value['geometry']['Sedimen'],
                        'Coordinate' =>  json_encode($value['geometry']['coordinates'])
                    ];
                }

                // $dJson[] = $value;
            }

            $param = $this->drainase->protect(false)->insertBatch($daInsert);
            if ($param > 0) {
                return $this->response->setJSON(['param' => $param, 'pesan' => 'Berhasil import layer']);
            }
            return $this->response->setJSON(['param' => $param, 'pesan' => $this->drain->errors()]);
        }
    }

    public function exportExcel()
    {


        $Tahun = $this->request->getPost('Tahun');
        $KecamatanID = $this->request->getPost('KecamatanID');
        $KelurahanID = $this->request->getPost('KelurahanID');
        $Kondisi = $this->request->getPost('Kondisi');
        $JenisSaluran = $this->request->getPost('JenisSaluran');
        $Konstruksi = $this->request->getPost('Konstruksi');

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

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $sheet->setCellValue('A1', "DATA DRAINASE KOTA BUKITTINGGI"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:Q1'); // Set Merge Cell pada kolom A1 sampai F1
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        $sheet->getStyle('A1')->getFont()->setSize(15);

        $sheet->setCellValue('A3', 'NO');
        $sheet->mergeCells('A3:A4');
        $sheet->setCellValue('B3', 'Nama Saluran');
        $sheet->mergeCells('B3:B4');
        $sheet->setCellValue('C3', 'Panjang (M)');
        $sheet->mergeCells('C3:C4');
        $sheet->setCellValue('D3', 'Kondisi');
        $sheet->mergeCells('D3:D4');
        $sheet->setCellValue('E3', 'Type Saluran');
        $sheet->mergeCells('E3:E4');
        $sheet->setCellValue('F3', 'Konstruksi');
        $sheet->mergeCells('F3:F4');
        $sheet->setCellValue('G3', 'Penampang');
        $sheet->mergeCells('G3:G4');
        $sheet->setCellValue('H3', 'Kecamatan');
        $sheet->mergeCells('H3:H4');
        $sheet->setCellValue('I3', 'Kelurahan');
        $sheet->mergeCells('I3:I4');
        $sheet->setCellValue('J3', 'Posisi Saluran');
        $sheet->mergeCells('J3:J4');
        $sheet->setCellValue('K3', 'Jenis Saluran ');
        $sheet->mergeCells('K3:K4');
        $sheet->setCellValue('L3', 'X_Awal');
        $sheet->mergeCells('L3:L4');
        $sheet->setCellValue('M3', 'X_Akhir');
        $sheet->mergeCells('M3:M4');
        $sheet->setCellValue('N3', 'Y_Awal');
        $sheet->mergeCells('N3:N4');
        $sheet->setCellValue('O3', 'Y_Akhir');
        $sheet->mergeCells('O3:O4');
        $sheet->setCellValue('P3', 'Dimensi (M)');
        $sheet->mergeCells('P3:R3');
        $sheet->setCellValue('P4', 'Lebar (B)');
        $sheet->setCellValue('Q4', 'Lebar (B1)');
        $sheet->setCellValue('R4', 'Tinggi (H)');
        $sheet->setCellValue('S3', 'Keterangan');
        $sheet->mergeCells('S3:S4');
        $sheet->getStyle('A3:S4')->getAlignment()->setHorizontal('center');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);
        $sheet->getColumnDimension('R')->setAutoSize(true);
        $sheet->getColumnDimension('S')->setAutoSize(true);

        $sheet->getStyle('A3:A3')->applyFromArray($style_col);
        $sheet->getStyle('B3:B4')->applyFromArray($style_col);
        $sheet->getStyle('C3:C4')->applyFromArray($style_col);
        $sheet->getStyle('D3:D4')->applyFromArray($style_col);
        $sheet->getStyle('E3:E4')->applyFromArray($style_col);
        $sheet->getStyle('F3:F4')->applyFromArray($style_col);
        $sheet->getStyle('G3:G4')->applyFromArray($style_col);
        $sheet->getStyle('H3:H4')->applyFromArray($style_col);
        $sheet->getStyle('I3:I4')->applyFromArray($style_col);
        $sheet->getStyle('J3:J4')->applyFromArray($style_col);
        $sheet->getStyle('K3:K4')->applyFromArray($style_col);
        $sheet->getStyle('L3:L4')->applyFromArray($style_col);
        $sheet->getStyle('M3:M4')->applyFromArray($style_col);
        $sheet->getStyle('N3:N4')->applyFromArray($style_col);
        $sheet->getStyle('O3:O4')->applyFromArray($style_col);
        $sheet->getStyle('P3:P4')->applyFromArray($style_col);
        $sheet->getStyle('Q3:Q4')->applyFromArray($style_col);
        $sheet->getStyle('R3:R4')->applyFromArray($style_col);
        $sheet->getStyle('S3:S4')->applyFromArray($style_col);

        $builder = $this->drainase;
        $builder->select('*');

        if (!empty($Tahun)) {
            $builder->where('Tahun', $Tahun);
        }
        if (!empty($KecamatanID)) {
            $builder->where('KecamatanID', $KecamatanID);
        }
        if (!empty($KelurahanID)) {
            $builder->where('KelurahanID', $KelurahanID);
        }
        if (!empty($Kondisi)) {
            $builder->where('Kondisi', $Kondisi);
        }
        if (!empty($JenisSaluran)) {
            $builder->where('JenisSaluran', $JenisSaluran);
        }
        if (!empty($Konstruksi)) {
            $builder->where('Konstruksi', $Konstruksi);
        }
        $builder->where('DeletedAT', null);
        $builder->orderBy('NamaJalan', 'ASC');
        $query = $builder->find();

        $column = '5';
        $no = 1;
        if ($query) {
            # code...
            foreach ($query as $va) {
                if (is_numeric($va['KecamatanID'])) {
                    $name1 =  getNamaDaerah('kecamatan', @$va['KecamatanID']);
                } else {
                    $name1 =  $va['KecamatanID'];
                }

                if (is_numeric($va['KelurahanID'])) {
                    $name2 =  getNamaDaerah('kelurahan', @$va['KelurahanID']);
                } else {
                    $name2 =  $va['KelurahanID'];
                }

                // $sheet->getStyle('D' . $column)->getAlignment()->setHorizontal('center');


                $sheet->setCellValue('A' . $column, $no);
                $sheet->setCellValue('B' . $column, $va['NamaJalan']);
                $sheet->setCellValue('C' . $column, $va['Panjang']);
                $sheet->setCellValue('D' . $column, $va['Kondisi']);
                $sheet->setCellValue('E' . $column, $va['JenisSaluran']);
                $sheet->setCellValue('F' . $column, $va['Konstruksi']);
                $sheet->setCellValue('G' . $column, $va['Penampang']);
                $sheet->setCellValue('H' . $column, $name1);
                $sheet->setCellValue('I' . $column, $name2);
                $sheet->setCellValue('J' . $column, $va['PosisiSaluran']);
                $sheet->setCellValue('K' . $column, $va['JenisSaluran']);
                $sheet->setCellValue('L' . $column, $va['X_Awal']);
                $sheet->setCellValue('M' . $column, $va['X_Akhir']);
                $sheet->setCellValue('N' . $column, $va['Y_Awal']);
                $sheet->setCellValue('O' . $column, $va['Y_Akhir']);
                $sheet->setCellValue('P' . $column, $va['Lebar']);
                $sheet->setCellValue('Q' . $column, $va['LebarB']);
                $sheet->setCellValue('R' . $column,  $va['Tinggi']);
                $sheet->setCellValue('S' . $column, $va['Keterangan']);

                $sheet->getStyle('A' . $column)->applyFromArray($style_row);
                $sheet->getStyle('B' . $column)->applyFromArray($style_row);
                $sheet->getStyle('C' . $column)->applyFromArray($style_row);
                $sheet->getStyle('D' . $column)->applyFromArray($style_row);
                $sheet->getStyle('E' . $column)->applyFromArray($style_row);
                $sheet->getStyle('F' . $column)->applyFromArray($style_row);
                $sheet->getStyle('G' . $column)->applyFromArray($style_row);
                $sheet->getStyle('H' . $column)->applyFromArray($style_row);
                $sheet->getStyle('I' . $column)->applyFromArray($style_row);
                $sheet->getStyle('J' . $column)->applyFromArray($style_row);
                $sheet->getStyle('K' . $column)->applyFromArray($style_row);
                $sheet->getStyle('L' . $column)->applyFromArray($style_row);
                $sheet->getStyle('M' . $column)->applyFromArray($style_row);
                $sheet->getStyle('N' . $column)->applyFromArray($style_row);
                $sheet->getStyle('O' . $column)->applyFromArray($style_row);
                $sheet->getStyle('P' . $column)->applyFromArray($style_row);
                $sheet->getStyle('Q' . $column)->applyFromArray($style_row);
                $sheet->getStyle('R' . $column)->applyFromArray($style_row);
                $sheet->getStyle('S' . $column)->applyFromArray($style_row);

                $column++;
                $no++;

                # code...
            }

            helper('download');
            $location = 'assets/files/export-excel/';
            createDir($location);
            $filename = 'export_' . date('YmdHis') . '.xlsx';
            $writer = new Xlsx($spreadsheet);
            $writer->save($location . $filename);
            // $filepath = file_get_contents($location . $filename);
            // force_download($filename, $filepath);
            return $this->response->download($location . $filename, null);
        }
    }
}
