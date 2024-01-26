<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;

class GenanganAir extends BaseController
{
    public function index()
    {
        //
        return view('administrator/v_genangan-air');
    }


    public function edit($id)
    {
        $lokasi = 'assets/files/genangan-air/';
        if ($id != 0) {
            # code...
            $sql = $this->air->find($id);

            if (!empty($sql['FileImage1'])) {
                $href1 = base_url() . $lokasi . $sql['FileImage1'];
                $btn1 = 'info';
                # code...
            } else {
                $href1 = '#';
                $btn1 = 'danger';
            }

            if (!empty($sql['FileImage2'])) {
                $href2 = base_url() . $lokasi . $sql['FileImage2'];
                $btn2 = 'info';
                # code...
            } else {
                $href2 = '#';
                $btn2 = 'danger';
            }

            if (!empty($sql['FileImage3'])) {
                $href3 = base_url() . $lokasi . $sql['FileImage3'];
                $btn3 = 'info';
                # code...
            } else {
                $href3 = '#';
                $btn3 = 'danger';
            }

            $data = [
                'GenanganID' => $sql['GenanganID'],
                'KodeGenangan' => $sql['KodeGenangan'],
                'Tahun' => $sql['Tahun'],
                'NamaDaerah' => $sql['NamaDaerah'],
                'KecamatanID' => $sql['KecamatanID'],
                'KabupatenID' => $sql['KabupatenID'],
                'KelurahanID' => $sql['KelurahanID'],
                'Luas' => $sql['Luas'],
                'DurasiGenangan' => $sql['DurasiGenangan'],
                'TinggiGenangan' => $sql['TinggiGenangan'],
                'Keterangan' => $sql['Keterangan'],
                'href2' => $href2,
                'href1' => $href1,
                'href3' => $href3,
                'btn1' => $btn1,
                'btn2' => $btn2,
                'btn3' => $btn3,
            ];
        } else {
            $data = [
                'GenanganID' => 0,
                'KodeGenangan' => '',
                'Tahun' =>  '',
                'NamaDaerah' =>  '',
                'ProvinsiID' => '',
                'KabupatenID' => '',
                'KecamatanID' =>  '',
                'KelurahanID' =>  '',
                'Keterangan' =>  '',
                'Luas' =>  '',
                'DurasiGenangan' => '',
                'TinggiGenangan' => '',
                'href2' => '#',
                'href1' => '#',
                'href3' => '#',
                'btn1' => 'danger',
                'btn2' => 'danger',
                'btn3' => 'danger',
            ];
        }

        return view('administrator/v_genangan-air-edit', $data);
    }

    public function simpan()
    {

        $fileImg = [
            'FileImage1',
            'FileImage2',
            'FileImage3',
        ];

        $post = $this->request->getPost();

        $data = [
            'KodeGenangan' => $post['KodeGenangan'],
            'ProvinsiID' => '13',
            'KabupatenID' => '1375',
            'KecamatanID' => $post['KecamatanID'],
            'KelurahanID' => $post['KelurahanID'],
            'NamaDaerah' => $post['NamaDaerah'],
            'Luas' => $post['Luas'],
            'DurasiGenangan' => $post['DurasiGenangan'],
            'TinggiGenangan' => $post['TinggiGenangan'],
            'Keterangan' => $post['Keterangan'],
            'Coordinate' =>  $post['Coordinates'],
        ];


        $lokasi = 'assets/files/genangan-air/';
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
                    return redirect()->to('admin/genangan-air/edit/' . $post['GenanganID'])->with('error', $this->validator->getErrors());
                }
            }
            # code...
        }
        foreach ($fileImg as $fm1) {
            $FImg1 = $this->request->getFile($fm1);

            if (file_exists($FImg1)) {

                if ($FImg1->isValid() && !$FImg1->hasMoved()) {
                    $newName = 'genangan-air_' . $FImg1->getRandomName();
                    $newName1 = $newName;

                    $FImg1->move($lokasi, $newName);
                    $data = array_merge($data, [$fm1 => $newName1]);
                }
            }
            # code...
        }


        if ($post['GenanganID'] == 0) {
            $param = $this->air->insert($data);

            if ($param > 0) {
                $param = 1;
                $pesan = 'Berhasil Simpan';
            } else {
                $param = 0;
                $pesan = $this->air->errors();
            }
        } else {
            $param = $this->air->update($post['GenanganID'], $data);

            if ($param > 0) {
                $param = 1;
                $pesan = 'Update data berhasil';
            } else {
                $param = 0;
                $pesan = $this->air->errors();
            }
        }

        if ($param > 0) {
            return redirect()->to('admin/genangan-air')->with('success', $pesan);
        } else {
            return redirect()->to('admin/genangan-air/edit/' . $post['GenanganID'])->with('error', $pesan);
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

                    $daInsert11[] = [
                        'KodeGenangan' =>  'GNA' . sprintf("%05s", random_string('numeric', 3)),
                        'Tahun' =>  $Tahun,
                        'NamaDaerah' =>  $value['properties']['Nama_Gen'],
                        'ProvinsiID' => '13',
                        'KabupatenID' => '1375',
                        'KecamatanID' =>  $value['properties']['Kecamatan'],
                        'KelurahanID' =>  $value['properties']['Kelurahan'],
                        'Keterangan' =>  '',
                        'Luas' =>  $value['properties']['Luas_Gen'],
                        'DurasiGenangan' => $value['properties']['Lama_Gen'],
                        'TinggiGenangan' => $value['properties']['Tinggi_Gen'],
                        'Cord_X' => $value['properties']['Koor_X'],
                        'Cord_Y' =>  $value['properties']['Koor_Y'],
                        'TypeGeojson' =>  $value['geometry']['type'],
                        'Coordinate' =>  json_encode($value['geometry']['coordinates'])
                    ];
                }
                // $dJson[] = $value;
            }


            $param = $this->air->protect(false)->insertBatch($daInsert11);
            if ($param > 0) {
                return $this->response->setJSON(['param' => $param, 'pesan' => 'Berhasil import layer']);
            }
            return $this->response->setJSON(['param' => $param, 'pesan' => $this->drain->errors()]);
        }
    }

    function getCoordinat()
    {


        $id = $this->request->getPost('GenanganID');
        $FileJson = $this->request->getFile('FileJson');

        if (file_exists($FileJson)) {
            $validationRule = [
                'FileJson' => [
                    'label' => 'File Geojson',
                    'rules' => [
                        'uploaded[FileJson]',
                        'mime_in[FileJson,application/json]',
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
                        'properties' => [
                            "NamaDaerah" => $value['properties']['NamaDaerah'],
                            "Luas" => $value['properties']['Luas'],
                            "Keterangan" => $value['properties']['Keterangan'],
                        ],
                        'geometry' => $value['geometry']
                    ];
                }
                return $this->response->setJSON(['param' => 1, 'geojson' => $coordinatGjson, 'coordinat' =>  json_encode([$value['geometry']['coordinates']])]);
            }
            # code..e
        } else {

            if (!empty($id)) {
                $sq = $this->air->find($id);

                if (!empty($sq['Coordinate'])) {
                    $geojson[] =  [
                        'type' => 'Feature',
                        'properties' => [
                            "GenanganID" => $sq['GenanganID'],
                            "NamaDaerah" => $sq['NamaDaerah'],
                            "Luas" => $sq['Luas'],
                            "Keterangan" => $sq['Keterangan'],
                        ],
                        'geometry' => [
                            "type" => $sq['TypeGeojson'],
                            "coordinates" => json_decode($sq['Coordinate'])
                        ]
                    ];

                    return $this->response->setJSON(['param' => 1, 'geojson' => $geojson, 'coordinat' => $sq['Coordinate']]);
                } else {
                    return $this->response->setJSON(['param' => 2, 'pesan' => 'tidak ada coordinat']);
                }
            } else {
                return $this->response->setJSON(['param' => 2, 'pesan' => 'tidak ada coordinat']);
            }
        }
    }

    public function loadImg()
    {
        $id = $this->request->getPost('id');
        if (!empty($id)) {
            $sq = $this->air->find($id);

            if (!empty($sq['FileImage'])) {

                $dImg = [];
                $lokasi = base_url() . 'assets/files/genangan-air/';
                foreach (explode(',', $sq['FileImage']) as $no => $img) {
                    # code...
                    $dImg[] = [
                        'name' => $no + 1,
                        'url' =>  $lokasi . $img
                    ];
                }

                return $this->response->setJSON(['param' => 1, 'image' => $dImg]);
            } else {
                return $this->response->setJSON(['param' => 0, 'pesan' => 'tidak ada image']);
            }
        } else {
            return $this->response->setJSON(['param' => 0, 'pesan' => 'tidak ada id']);
        }
    }
}
