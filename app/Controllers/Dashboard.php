<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {

        $sqlPjg = db_connect()->query('SELECT sum(Panjang) as TotPanjang FROM drainase WHERE DeletedAT IS null');

        // $sqlPjg = db_connect()->table('drainase')->select('sum(Panjang) as TotPanjang')->where($where)->get();

        if ($sqlPjg->getNumRows() > 0) {
            $qPa =  $sqlPjg->getRow();
            # code...
            $TotPanjang = number_format($qPa->TotPanjang, 4);
        } else {
            $TotPanjang = 0;
        }
        $data = [
            'title' => 'WEBGIS DATABASE DRAINASE',
            'panjangDrainase' => $TotPanjang
        ];
        return view('v_dashboard', $data);
    }

    public function getAllCordinat()
    {

        $drainID = $this->request->getPost('idDrainAce');

        $sql = db_connect()->table('drainase');
        $sql->select('*');
        if (!empty($drainID)) {
            $sql->whereIn('DrainaseID', $drainID);
        }

        foreach ($sql->get()->getResultArray() as $key => $val) {

            $data[] =  [
                'type' => 'Feature',
                'properties' => [
                    "DrainaseID" => $val['DrainaseID'],
                    "Nama_Jalan" => $val['NamaJalan'],
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


        $sql1 = db_connect()->table('genangan_air');
        $sql1->select('*');
        foreach ($sql1->get()->getResultArray() as $key => $val) {

            $data1[] =  [
                'type' => 'Feature',
                'properties' => [
                    "DrainaseID" => $val['GenanganID'],
                    "Nama_Jalan" => $val['NamaDaerah'],
                    "Kondisi" => $val['Luas'],
                    "Keterangan" => $val['Keterangan'],
                ],
                'geometry' => [
                    "type" => $val['TypeGeojson'],
                    "coordinates" => json_decode($val['Coordinate'])
                ]
            ];
            # code...
        }

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        return $this->response->setJSON(['cordinat' => $data, 'cordinat1' => $data1]);
    }

    public function map()
    {
    }

    public function getCordinat()
    {

        $DrainaseID = $this->request->getPost('idDrain');
        $sq = $this->drainase->find($DrainaseID);

        $data =  [
            'Nama' => $sq['NamaJalan'],
            'KodeDrain' => $sq['KodeDrain'],
            'Panjang' => number_format($sq['Panjang'], 2),
            'PosisiSaluran' => $sq['PosisiSaluran'],
            'TipeSalur' => $sq['TipeSalur'],
            'Kondisi' => $sq['Kondisi'],
        ];

        return $this->response->setJSON($data);
    }


    public function loadDatalayer()
    {



        $KecamatanID = $this->request->getPost('KecamatanID');
        $KelurahanID = $this->request->getPost('KelurahanID');

        // echo $KecamatanID;
        // echo $KelurahanID;
        // if ($layer == 'wilayahA') {

        // $drainID = $this->request->getPost('idDrainAce');

        $sql = db_connect()->table('drainase');
        $sql->select('*');
        if (!empty($KecamatanID)) {
            $sql->where('KecamatanID', $KecamatanID);
        }

        if (!empty($KelurahanID)) {
            $sql->where('KelurahanID', $KelurahanID);
        }

        $output = '<ul class="gridCheck">';
        $no = 1;
        if ($sql->get()->getNumRows() > 0) {
            # code...
            foreach ($sql->get()->getResultArray() as $key => $va) {
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



        # code...
        // }

        // echo '<pre>';
        // echo print_r($layer);
        // echo '</pre>';
        // if ( $layer == 'wilayahA') {
        //     # code...
        // }

        // $sq = $this->drainase->find($DrainaseID);

        // $data =  [
        //     'Nama' => $sq['NamaJalan'],
        //     'Panjang' => number_format($sq['Panjang'], 2),
        //     'PosisiSaluran' => $sq['PosisiSaluran'],
        //     'TipeSalur' => $sq['TipeSalur'],
        //     'Kondisi' => $sq['Kondisi'],
        // ];

        return $this->response->setJSON(['ulc' => $output]);
    }

    public function loadAllLayer()
    {

        $dataDrain = [];
        $sqDrain = $this->drainase->findAll();
        if ($sqDrain) {
            # code...
            foreach ($sqDrain as $arrDrain) {
                # code...
                $multiArrDrain = isMultiDimensional(json_decode($arrDrain['Coordinate']));

                if ($multiArrDrain == true) {
                    # code...
                    $dataDrain[] =  [
                        'type' => 'Feature',
                        'properties' => [
                            "DrainaseID" => $arrDrain['DrainaseID'],
                            "Nama_Jalan" => $arrDrain['NamaJalan'],
                            "Kondisi" => $arrDrain['Kondisi'],
                            "Keterangan" => $arrDrain['Keterangan'],
                        ],
                        'geometry' => [
                            "type" => $arrDrain['TypeGeojson'],
                            "coordinates" => json_decode($arrDrain['Coordinate'])
                        ]
                    ];
                }
            }
        }
        $dataAir = [];
        $sqAir = $this->air->findAll();

        if ($sqAir) {
            foreach ($sqAir as $arrAir) {
                # code...
                $multiArrAir = isMultiDimensional(json_decode($arrAir['Coordinate']));

                if ($multiArrAir == true) {
                    # code...

                    $dataAir[] =  [
                        'type' => 'Feature',
                        'properties' => [
                            "DrainaseID" => $arrAir['GenanganID'],
                            "Nama_Jalan" => $arrAir['NamaDaerah'],
                            "Kondisi" => $arrAir['Luas'],
                            "Keterangan" => $arrAir['Keterangan'],
                        ],
                        'geometry' => [
                            "type" => $arrAir['TypeGeojson'],
                            "coordinates" => json_decode($arrAir['Coordinate'])
                        ]
                    ];
                }
            }
        }
        $dataBatas = [];
        $sqBatas = $this->batas->findAll();

        if ($sqBatas) {
            foreach ($sqBatas as $arrBatas) {

                $dataBatas[] = [
                    'Ket' => $arrBatas['Keterangan'],
                    'Coord' => $arrBatas['Coordinate'],
                ];
            }
        }

        return $this->response->setJSON(['drain' => $dataDrain, 'air' => $dataAir, 'batas' => $dataBatas]);
    }
}