<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;

class Layer extends BaseController
{
    public function index()
    {
        //
        return view('administrator/v_layer');
    }

    public function simpan()
    {

        $param = 0;
        $LayerID = $this->request->getPost('LayerID');
        $Tahun = $this->request->getPost('Tahun');
        $Nama = $this->request->getPost('Nama');
        $Keterangan = $this->request->getPost('Keterangan');
        $NA = $this->request->getPost('NA');
        $Position = $this->request->getPost('Position');
        $JenisLayer = $this->request->getPost('JenisLayer');
        // $WarnaBatas = $this->request->getPost('WarnaBatas');
        $FlGeo = $this->request->getFile('FGeojson');

        $data = [
            'Tahun' => $Tahun,
            'Nama' => $Nama,
            'Keterangan' => $Keterangan,
            'Position' => $Position,
            'NA' => $NA,
            'UserID' => session()->get('s_UserID'),
            'JenisLayer' => $JenisLayer,
            // 'WarnaBatas' => $WarnaBatas,
        ];

        if (file_exists($FlGeo)) {
            # code...
            $validationRule = [
                'FGeojson' => [
                    'label' => 'File Geojson',
                    'rules' => [
                        'uploaded[FGeojson]',
                        'mime_in[FGeojson,application/json]',
                        // 'ext_in[GeojsonDrainase,geojson]',
                    ],
                ],
            ];
            if (!$this->validate($validationRule)) {
                return $this->response->setJSON(['param' => 0, 'pesan' => $this->validator->getErrors()]);
            }
            $lokasi = 'assets/files/layer/';
            createDir($lokasi);
            if ($FlGeo->isValid() && !$FlGeo->hasMoved()) {
                $newName = 'layer_' . $FlGeo->getRandomName();
                $newName1 = $newName;

                $FlGeo->move($lokasi, $newName);
                $data = array_merge($data, ['FileJson' => $newName1]);
            }
        }


        if ($LayerID == 0) {
            $param = $this->layer->insert($data);

            if ($param > 0) {
                return $this->response->setJSON(['param' => $param, 'pesan' => 'Berhasil simpan']);
            }
            return $this->response->setJSON(['param' => $param, 'pesan' => $this->layer->errors()]);
        } else {

            $param = $this->layer->update($LayerID, $data);
            if ($param > 0) {
                return $this->response->setJSON(['param' => $param, 'pesan' => 'Berhasil update']);
            }
            return $this->response->setJSON(['param' => $param, 'pesan' => $this->layer->errors()]);
        }
    }

    public function edit($id)
    {
        if ($id != 0) {
            # code...
            $sql = $this->layer->find($id);

            $query = $this->layerSub->where('LayerID', $id)->find();

            if (empty($query)) {
                # code...
                $lokasi = 'assets/files/layer/';
                $FlGeo = FCPATH .  $lokasi . $sql['FileJson'];
                if (file_exists($FlGeo)) {
                    $json = file_get_contents($FlGeo);

                    $json_data = json_decode($json, true);

                    foreach ($json_data['features'] as $key => $value) {

                        $data[] = [
                            'LayerSubID' => $this->uuid->uuid4()->toString(),
                            'Nama' => @$value['properties']['Nama'],
                            'LayerID' => $id,
                            'WarnaUtama' => @$value['properties']['WarnaUtama'] ?? '#000000',
                            'WarnaBatas' => @$value['properties']['WarnaBatas'] ?? '#000000',
                            'Luas' => @$value['properties']['Luas'],
                            'Tinggi' => @$value['properties']['Tinggi'],
                            'Posisi' => @$value['properties']['Posisi'],
                            'Type' => $value['geometry']['type'],
                            'Coordinat' => json_encode($value['geometry']['coordinates'])
                        ];

                        // $dJson[] = $value;
                    }

                    $this->layerSub->insertBatch($data);
                }
            }


            $data = [
                'LayerID' => $sql['LayerID'],
                'Nama' => $sql['Nama'],
            ];
        } else {
            $data = [
                'LayerID' => 0,
                'Nama' => '',
            ];
        }

        return view('administrator/v_layer-edit', $data);
    }

    function getCoordinat()
    {
        $id = $this->request->getPost('LayerID');

        if (!empty($id)) {
            $sq = $this->layer->find($id);



            $sql =   db_connect()->table('layer_sub')->where('LayerID', $id)->get();

            foreach ($sql->getResultArray() as $key => $value) {
                if (!empty($value['Gambar'])) {
                    $img = base_url('assets/files/layer/sub/') . $value['Gambar'];
                } else {
                    $img = '';
                }
                $coordinatGjson[] = [
                    'type' => 'Feature',
                    'properties' => [
                        'Nama' => $value['Nama'],
                        'WarnaUtama' => $value['WarnaUtama'],
                        'WarnaBatas' => $value['WarnaBatas'],
                        'Keterangan' => $value['Keterangan'],
                        'Gambar' => $img,
                    ],
                    'geometry' => [
                        'type' => $value['Type'],
                        'coordinates' => json_decode($value['Coordinat'])
                    ]
                ];
            }

            $legend = [];
            if ($sq['LegendWarna'] && $sq['LegendText']) {
                # code...
                $legend[] = [
                    'id' => str_replace(" ", "_", $sq['Nama']),
                    'name' => $sq['Nama'],
                    'field' => explode(",", $sq['LegendWarna']),
                    'value' => explode(",", $sq['LegendText']),
                ];
            }

            return $this->response->setJSON(['param' => 1, 'geojson' => $coordinatGjson, 'legend' => $legend]);
        } else {
            return $this->response->setJSON(['param' => 0, 'pesan' => 'tidak ada coordinat']);
        }
    }

    function simpanSublayer()
    {
        $Field = $this->request->getPost('Field');
        $Values = $this->request->getPost('Values');
        $LayerID = $this->request->getPost('LayerID');
        $LayerSubID = $this->request->getPost('LayerSubID');

        for ($i = 0; $i < count($Field); $i++) {
            $arrField[$Field[$i]] = '';
        }

        $dInsert = [
            'LayerID' =>  $LayerID,
            'FieldTabel' =>  json_encode($arrField),
        ];


        if ($LayerSubID == 0) {
            if ($param = $this->layerSub->insert($dInsert)) {
                return redirect()->to('admin/layer/peta/' . $LayerID)->with('success', 'Berhasil Tambah Field Layer');
            }
            return redirect()->to('admin/layer/peta/' . $LayerID)->with('success', $this->layerSub->errors());
            // return $this->fail($this->model_undangan->errors());
        } else {
            if ($param = $this->layerSub->update($LayerSubID, $dInsert)) {
                return redirect()->to('admin/layer/peta/' . $LayerID)->with('success', 'Berhasil Update Field Layer');
            }
            return redirect()->to('admin/layer/peta/' . $LayerID)->with('success', $this->layerSub->errors());
        }
    }

    public function showByID($id)
    {


        $sql =   db_connect()->table('layer_sub')->where('LayerSubID', $id)->get()->getRowArray();

        $this->data['cordinat'] = [
            'type' => 'Feature',
            'properties' => [],
            'geometry' => [
                'type' => $sql['Type'],
                'coordinates' => json_decode($sql['Coordinat'])
            ]
        ];

        return $this->response->setJSON($this->data);
    }

    public function updateStyle()
    {
        $post = $this->request->getPost();

        $data = [
            'Nama' => $post['Nama'],
            'Keterangan' => $post['Keterangan'],
            'WarnaUtama' => $post['WarnaUtama'],
            'WarnaBatas' => $post['WarnaBatas'],
            'KecamatanID' => $post['KecamatanID'],
            'KelurahanID' => $post['KelurahanID'],
            'Posisi' => @$post['Posisi'],
            'Tinggi' => @$post['Tinggi'],
            'Luas' => @$post['Luas'],
            'Panjang' => @$post['Panjang'],
            'JenisSedimen' => @$post['JenisSedimen'],
        ];

        $Gambar = $this->request->getFile('Gambar');
        $lokasi = 'assets/files/layer/sub/';
        createDir($lokasi);
        if (file_exists($Gambar)) {
            $validationRule = [
                'Gambar' => [
                    'label' => 'File Gambar',
                    'rules' => [
                        'uploaded[Gambar]',
                        'mime_in[Gambar,image/jpg,image/jpeg,image/png]',
                        // 'ext_in[GeojsonDrainase,geojson]',
                    ],
                ],
            ];
            if (!$this->validate($validationRule)) {
                return $this->response->setJSON(['param' => 0, 'pesan' => $this->validator->getErrors()]);
            }


            $sq = $this->layerSub->find($post['LayerSubID']);
            if ($sq) {
                if (file_exists($lokasi . $sq['Gambar']) && $sq['Gambar']) {
                    unlink($lokasi . $sq['Gambar']);
                }
            }

            if ($Gambar->isValid() && !$Gambar->hasMoved()) {
                $newName = 'berita_' . $Gambar->getRandomName();
                $Gambar->move($lokasi, $newName);
                $data = array_merge($data, ['Gambar' => $newName]);
            }
        }


        $flImg = $this->request->getPost('deleteImg');
        if (!empty($flImg)) {
            $sql = $this->layerSub->find($post['LayerSubID']);
            if ($sql) {
                if (file_exists($lokasi . $sql[$flImg]) && $sql[$flImg]) {
                    unlink($lokasi . $sql[$flImg]);
                }

                $data = array_merge($data, [$flImg => null]);
            }
        }

        $param = $this->layerSub->update($post['LayerSubID'], $data);
        if ($param > 0) {
            return $this->response->setJSON(['param' => $param, 'pesan' => 'Berhasil update']);
        }
        return $this->response->setJSON(['param' => $param, 'pesan' => $this->layerSub->errors()]);
    }

    public function updateLegend()
    {
        $post = $this->request->getPost();


        $A = count(explode(",", $post['LegendWarna']));
        $B = count(explode(",", $post['LegendText']));

        if ($A != $B) {
            return $this->response->setJSON(['param' => 0, 'pesan' => 'Legend HEX warna dan Text Tidak sama banyak']);
        }

        $data = [
            'LegendWarna' => $post['LegendWarna'],
            'LegendText' => $post['LegendText'],
        ];

        $param = $this->layer->update($post['LayerID'], $data);
        if ($param > 0) {
            return $this->response->setJSON(['param' => $param, 'pesan' => 'Berhasil update']);
        }
        return $this->response->setJSON(['param' => $param, 'pesan' => $this->layer->errors()]);
    }
}