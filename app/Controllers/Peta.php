<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Peta extends BaseController
{
    public function index()
    {
        $this->data['drain'] = $this->drainase->findAll();
        $this->data['title'] = 'WEBGIS DATABASE DRAINASE';
        return view('v_peta', $this->data);
    }

    public function detailDreainase($Kode)
    {
        $sql =  $this->drainase->where('KodeDrain', $Kode)->first();
        if ($sql) {
            $this->data['drain'] =  $sql;
            $img1 =  '';
            $img2 =  '';
            $img3 =  '';
            if (!empty($sql['FileImage1'])) {
                $img1 = base_url('assets/files/drainase/') . $sql['FileImage1'];
            }
            if (!empty($sql['FileImage2'])) {
                $img2 = base_url('assets/files/drainase/') . $sql['FileImage2'];
            }
            if (!empty($sql['FileImage3'])) {
                $img3 = base_url('assets/files/drainase/') . $sql['FileImage3'];
            }

            $this->data['title'] = 'WEBGIS DATABASE DRAINASE';
            $this->data['Image1'] = $img1;
            $this->data['Image2'] = $img2;
            $this->data['Image3'] = $img3;
            return view('v_peta-detail', $this->data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function detailAir($Kode)
    {
        $sql =  $this->air->where('KodeGenangan', $Kode)->first();
        if ($sql) {
            $this->data['air'] =  $sql;
            return view('v_map-detail-air', $this->data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function getCoordinatByID()
    {

        $post = $this->request->getPost();

        $sql = db_connect()->table('drainase');
        $sql->select('*');

        if (!empty($post['KecamatanID'])) {
            $sql->where('KecamatanID', $post['KecamatanID']);
        }
        if (!empty($post['KelurahanID'])) {
            $sql->where('KelurahanID', $post['KelurahanID']);
        }
        if (!empty($post['Kondisi'])) {
            $sql->where('Kondisi', $post['Kondisi']);
        }
        if (!empty($post['JenisSaluran'])) {
            $sql->where('JenisSaluran', $post['JenisSaluran']);
        }
        if (!empty($post['Konstruksi'])) {
            $sql->where('Konstruksi', $post['Konstruksi']);
        }

        if (!empty($post['DrainaseID'])) {
            $sql->whereIn('DrainaseID', $post['DrainaseID']);
        }
        $sql->where('DeletedAT', null);
        $builder = $sql->get();
        if ($builder->getNumRows() > 0) {
            # code...
            $param = 1;
            foreach ($builder->getResultArray() as $key => $val) {

                $data[] =  [
                    'type' => 'Feature',
                    'properties' => [
                        "DrainaseID" => $val['DrainaseID'],
                        "KodeDrain" => $val['KodeDrain'],
                        "NamaJalan" => $val['NamaJalan'],
                        "Kondisi" => $val['Kondisi'],
                        "Keterangan" => $val['Keterangan'],
                    ],
                    'geometry' => [
                        "type" => $val['TypeGeojson'],
                        "coordinates" => json_decode($val['Coordinate'])
                    ]
                ];
                # code...
            }
        } else {
            $param = 0;
            $data = [];
        }


        return $this->response->setJSON(['cordinat' => $data, 'param' => $param]);
    }

    public function loadSidebar()
    {


        $KecamatanID = $this->request->getPost('KecamatanID');
        $KelurahanID = $this->request->getPost('KelurahanID');
        $Kondisi = $this->request->getPost('Kondisi');
        $JenisSaluran = $this->request->getPost('JenisSaluran');
        $Konstruksi = $this->request->getPost('Konstruksi');

        $builder = $this->drainase;
        if ($KecamatanID != '') {
            $builder->where('KecamatanID', $KecamatanID);
        }
        if ($KelurahanID != '') {
            $builder->where('KelurahanID', $KelurahanID);
        }
        if ($Kondisi != '') {
            $builder->where('Kondisi', $Kondisi);
        }
        if ($JenisSaluran != '') {
            $builder->where('JenisSaluran', $JenisSaluran);
        }
        if ($Konstruksi != '') {
            $builder->where('Konstruksi', $Konstruksi);
        }
        $builder->where('DeletedAT', null);
        $query = $builder->find();
        // $data = [];
        $output = '<ul class="gridCheck">';
        $no = 1;
        if ($query) {
            $param = 1;
            # code...
            foreach ($query as $key => $va) {



                $output .=   '   <li class="cardCheck">
                    <div class="card__content">
                        <b>' . $va['KodeDrain'] . '</b>
                        <p>
                            ' . $va['NamaJalan'] . '
                        <p>
                    </div>
                    <label class="checkbox-control">
                        <input type="checkbox" onclick="onClickProses(' . $va['DrainaseID'] . ')"
                            id="' . $va['DrainaseID'] . '" class="checkbox">
                        <span class="checkbox-control__target">Card Label</span>
                    </label>
              
                </li>';

                $no++;
            }
        } else {
            $param = 0;
            $output .=  '   <li class="cardCheck">
                    <div class="card__content">
                        <b>Tidak ada Data</b>
                    </div>
                    <label class="checkbox-control">
                        <input type="checkbox" class="checkbox">
                        <span class="checkbox-control__target">Card Label</span>
                    </label>
                </li>';
        }

        $output .= '  </ul>';


        return $this->response->setJSON(['ulc' => $output, 'param' => $param]);
    }

    public function loadAllLayer()
    {
        $layer = $this->layer->where('NA', 'N')->orderBy('Position', 'DESC')->findAll();
        $lokasi = 'assets/files/layer/';

        if ($layer) {
            $no = 1;
            foreach ($layer as $la) {

                $sqlSub =   $this->layerSub->where('LayerID', $la['LayerID'])->find();
                foreach ($sqlSub as $key => $value) {
                    if (!empty($value['Gambar'])) {
                        $img = base_url('assets/files/layer/sub/') . $value['Gambar'];
                    } else {
                        $img = '';
                    }
                    $coordinatGjson[$no][] = [
                        'type' => 'Feature',
                        'properties' => [
                            'Nama' => $value['Nama'],
                            'WarnaUtama' => $value['WarnaUtama'],
                            'WarnaBatas' => $value['WarnaBatas'],
                            'Posisi' => $value['Posisi'],
                            'Tinggi' => $value['Tinggi'],
                            'Luas' => $value['Luas'],
                            'Keterangan' => $value['Keterangan'],
                            'Gambar' => $img,
                        ],
                        'geometry' => [
                            'type' => $value['Type'],
                            'coordinates' => json_decode($value['Coordinat'])
                        ]
                    ];
                }

                $dataBatas[] = [
                    'Ket' => $la['Nama'],
                    'Position' => $la['Position'],
                    'Coord' => $coordinatGjson[$no]
                ];

                $no++;
            }


            return $this->response->setJSON(['layer' => $dataBatas]);
        } else {
            return $this->response->setJSON(['layer' => []]);
        }
    }

    public function getCordinat()
    {

        $DrainaseID = $this->request->getPost('idDrain');
        $sq = $this->drainase->find($DrainaseID);
        if ($sq) {
            # code...
            $data =  [
                'Nama' => $sq['NamaJalan'],
                'KodeDrain' => $sq['KodeDrain'],
                'Panjang' => number_format($sq['Panjang'], 2),
                'PosisiSaluran' => $sq['PosisiSaluran'],
                'JenisSaluran' => $sq['JenisSaluran'],
                'Kondisi' => $sq['Kondisi'],
                'Penampang' => $sq['Penampang'],
                'Keterangan' => $sq['Keterangan'],
            ];
        } else {
            $data =  [
                'Nama' => '',
                'KodeDrain' => '',
                'Panjang' => '',
                'PosisiSaluran' => '',
                'JenisSaluran' => '',
                'Kondisi' => '',
                'Penampang' => '',
                'Keterangan' => ''
            ];
        }

        return $this->response->setJSON($data);
    }

    public function dataGrafik()
    {

        $post = $this->request->getPost();

        $where = 'DeletedAT IS null ';
        $where1 = 'DeletedAT IS null ';
        if (!empty($post['KecamatanID'])) {
            $where .= 'AND KecamatanID="' . $post['KecamatanID'] . '"';
            $where1 .= 'AND KecamatanID="' . $post['KecamatanID'] . '"';
        }
        if (!empty($post['KelurahanID'])) {
            $where .= 'AND KelurahanID= "' . $post['KelurahanID'] . '"';
            $where1 .= 'AND KelurahanID= "' . $post['KelurahanID'] . '"';
        }
        if (!empty($post['Kondisi'])) {
            $where .= 'AND Kondisi="' . $post['Kondisi'] . '"';
        }
        if (!empty($post['JenisSaluran'])) {
            $where .= 'AND JenisSaluran="' . $post['JenisSaluran'] . '"';
        }
        if (!empty($post['Konstruksi'])) {
            $where .= 'AND Konstruksi="' . $post['Konstruksi'] . '"';
        }
        $sqlPjg = db_connect()->query('SELECT sum(Panjang) as TotPanjang FROM drainase WHERE ' . $where);

        // $sqlPjg = db_connect()->table('drainase')->select('sum(Panjang) as TotPanjang')->where($where)->get();

        if ($sqlPjg->getNumRows() > 0) {
            $qPa =  $sqlPjg->getRow();
            # code...
            $TotPanjang = number_format($qPa->TotPanjang, 4) . ' Meter';
        } else {
            $TotPanjang = '0 Meter';
        }


        $sql3 = db_connect()->query('SELECT Kondisi,SUM(Panjang) as totKon FROM drainase WHERE ' . $where . ' GROUP BY Kondisi HAVING COUNT(Kondisi)>0');
        if ($sql3->getNumRows() > 0) {
            foreach ($sql3->getResultArray() as $que3) {

                $dataGrafik3[] = [
                    'name' => $que3['Kondisi'],
                    'y' => intval($que3['totKon']),
                ];
            }
        } else {
            $dataGrafik3 = [];
        }

        $sql4 = db_connect()->query('SELECT JenisSaluran,SUM(Panjang) as totKons FROM drainase WHERE ' . $where . '	GROUP BY JenisSaluran HAVING COUNT(JenisSaluran)>0');
        if ($sql4->getNumRows() > 0) {
            foreach ($sql4->getResultArray() as $que4) {

                $dataGrafik4[] = [
                    'name' => $que4['JenisSaluran'],
                    'y' => intval($que4['totKons']),
                ];
            }
        } else {
            $dataGrafik4 = [];
        }

        $sql5 = db_connect()->query('SELECT JenisSedimen,SUM(Panjang) as totSed FROM layer_sub WHERE ' . $where1 . ' AND LayerID="6" AND JenisSedimen!="" GROUP BY JenisSedimen HAVING COUNT(JenisSedimen)>0');
        if ($sql5->getNumRows() > 0) {
            foreach ($sql5->getResultArray() as $que5) {

                $dataGrafik5[] = [
                    'name' => $que5['JenisSedimen'],
                    'y' => $que5['totSed'],
                ];
            }
        } else {
            $dataGrafik5 = [];
        }

        $data = [

            'KondisiGrafik' => $dataGrafik3,
            'KontruksiGrafik' => $dataGrafik4,
            'SedimentGrafik' => $dataGrafik5,
            'TotPanjang' => $TotPanjang,
        ];
        return $this->response->setJSON($data);
    }

    public function loadLegend()
    {


        $dataArr = [];

        $sq = $this->layer->findAll();
        if ($sq) {
            foreach ($sq as $key => $value) {
                if ($value['LegendWarna'] && $value['LegendText']) {
                    $dataArr[] = [
                        'id' => str_replace(" ", "_", $value['Nama']),
                        'name' => $value['Nama'],
                        'field' => explode(",", $value['LegendWarna']),
                        'value' => explode(",", $value['LegendText']),
                    ];
                }
            }
        } else {
            $dataArr = [];
        }

        return $this->response->setJSON($dataArr);
    }
}
