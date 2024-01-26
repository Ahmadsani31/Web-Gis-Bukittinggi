<?php

namespace App\Controllers;

use App\Models\MDrainase;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;
    public $drain;
    public function __construct()
    {
        $this->drain = new MDrainase();
    }

    public function index(): string
    {
        $this->data['DA'] = $this->drain->findAll();
        return view('welcome_message', $this->data);
    }

    public function gis_extrak()
    {
        // echo  urlActive('data-gis-extrak');
        // $sql = db_connect()->query('SELECT * FROM drainase');
        // foreach ($sql->getResultArray() as  $a) {

        //     $s = db_connect()->table('drainase_backup')->where('NamaJalan', $a['NamaJalan'])->where('Keterangan', $a['Keterangan'])->where('Kondisi', $a['Kondisi'])->where('Konstruksi', $a['Konstruksi'])->get();
        //     if ($s->getNumRows() > 0) {
        //         $k = $s->getRowArray();
        //         // $this->drainase->update($a['DrainaseID'], ['KecamatanID' => $k['KecamatanID'], 'KelurahanID' => $k['KelurahanID']]);
        //         $dataAda[] = [
        //             'Nama' => $a['NamaJalan'],
        //             'KecamatanID' => $k['KecamatanID'],
        //             'KelurahanID' => $k['KelurahanID'],
        //         ];
        //     } else {
        //         $dataTidakAda[] = [
        //             'Nama' => $a['NamaJalan'],
        //             'KecamatanID' => $a['KecamatanID'],
        //             'KelurahanID' => $a['KelurahanID'],
        //         ];
        //     }


        //     # code...
        // }


        // echo '<pre>';
        // echo print_r($dataAda);
        // echo print_r(@$dataTidakAda);
        // echo '</pre>';
        // exit();
        $json = file_get_contents('assets/geojson/fix.geojson');

        // Decode the JSON file
        $json_data = json_decode($json, true);

$no=11;
        foreach ($json_data['features'] as $key => $isi2) {
// echo '<pre>';
// print_r($isi2['properties']);
// echo '</pre>';
            $daInsert11[] = [
                'UserID' => 1,
                'Tahun' => date('Y'),
                 'NamaJalan' => @$isi2['properties']['Nama_Salur'],
                'KodeDrain' => getKodeDrainaseTerbaru(),
                'ProvinsiID' => '13',
                'Penampang' => @$isi2['properties']['Penampang'],
                'KabupatenID' => '1375',
                'KecamatanID' => '',
                'KelurahanID' => '',
                 'Kondisi' => @$isi2['properties']['Kondisi'],
                'Konstruksi' => @$isi2['properties']['Konstruksi'],
                'Sediment' => '',
                'Panjang' =>  @$isi2['properties']['Panjang_'],
                'Lebar' => @$isi2['properties']['B'],
                'LebarB' => @$isi2['properties']['B2'],
                'Tinggi' => @$isi2['properties']['H'],
                'PosisiSaluran' => @$isi2['properties']['Posisi_1'],
                'JenisSaluran' => @$isi2['properties']['Tipe_Salur'],
                'Keterangan' => @$isi2['properties']['Ket'],
                'Tipe_Salur' => @$isi2['properties']['Tipe_Salur'],
                'X_Akhir' => @$isi2['properties']['X_Akhir'],
                'X_Awal' => @$isi2['properties']['X_Awal'],
                'Y_Akhir' => @$isi2['properties']['Y_Akhir'],
                'Y_Awal' => @$isi2['properties']['Y_Awal'],
                'TypeGeojson' => 'MultiLineString',
                'Coordinate' => json_encode($isi2['geometry']['coordinates'])

            ];
    //   $this->drain->insert($daInsert11);
            // $dJson[] = $value;
        }


        // $this->drain->insertBatch($daInsert11);
        // echo '<pre>';
        // echo print_r($daInsert11);
        // echo '</pre>';
        exit();

        // $sq = $this->drainase->findAll();
        // foreach ($sq as $val) {

        //     foreach (json_decode($val['CoordinatGeojson']) as $i => $u) {
        //         # code...
        //         $dt[] = $u['coordinates'];
        //     }
        //     # code...
        // }
        // echo '<pre>';
        // echo print_r($dt);
        // echo '</pre>';
        exit();


       $json = file_get_contents('assets/geojson/bukitDrainase.geojson');

        // Decode the JSON file
        $json_data = json_decode($json, true);

        $No = 1;
        foreach ($json_data['features'] as $key => $value) {

            // db_connect()->query('UPDATE drainase SET Sediment="' . $value['properties']['Ket'] . '" WHERE NamaJalan="' . $value['properties']['Nama_Jalan'] . '"');

            $daInsert11[] = $value['properties']['Panjang_'];
            // $this->drain->update($No, $daInsert11);
            // $dJson[] = $value;
            $No++;
        }

echo  array_sum($daInsert11);

        // $this->drain->insertBatch($daInsert11);
        echo '<pre>';
        echo print_r($daInsert11);
        echo '</pre>';

        exit();

        // Display data
        $noSatu = 0;
        foreach ($json_data['features'] as $key => $value) {

            // $cordinat[] = $value['geometry']['coordinates'];
            $dataIsi[] = $value['properties'];
            // $cordinat[] = $value;
            // foreach ($value['geometry']['coordinates'] as $a1 => $a2) {

            //     foreach ($a2 as $b1 => $b2) {
            //         # code...
            //         $dCor1[$value['properties']['Name']][$noSatu][$a1][] = [
            //             $b2[1],
            //             $b2[0],
            //         ];
            //     }
            //     # code...
            // }
            // $noSatu++;
        }


        foreach ($dataIsi as $isi1 => $isi2) {
            # code...
            $daInsert11[] = [
                'NamaDaerah' => @$isi2['properties']['Nama_Salur'],
                'Kecamatan' => @$isi2['properties']['Kecamatan'],
                'Kelurahan' => @$isi2['properties']['Kelurahan'],
                'Keterangan' => @$isi2['properties']['Keterangan'],
                'Kondisi' => @$isi2['properties']['Kondisi'],
                'Konstruksi' => @$isi2['properties']['Konstruksi'],
                'Nama_Saluran' => @$isi2['properties']['Nama_Saluran'],
                'JenisSaluran' => @$isi2['properties']['Jaringan_1'],
                'Penampang' => @$isi2['properties']['Jaringa_17'],
                'PosisiSaluran' => @$isi2['properties']['Posisi Saluran'],
                'Tipe_Salur' => @$isi2['properties']['Tipe_Salur'],
                'X_Akhir' => @$isi2['properties']['Jaringan_7'],
                'X_Awal' => @$isi2['properties']['Jaringan_8'],
                'Y_Akhir' => @$isi2['properties']['Jaringan_9'],
                'Y_Awal' => @$isi2['properties']['Jaringa_10'],
                'Coordinates' => json_encode($isi2['geometry']['coordinates'])
            ];
            // $dIsiNew[$isi2['Name']] = $isi2;

            // $dCor2[] = $dCor1[$isi2['Name']][$isi1];
        }


echo '<pre>';
print_r($daInsert11);
echo '</pre>';

        // foreach ($dIsiNew as $nmDaerah => $isiDataDaerah) {
        //     # code...

        //     $dataBaru[] = [
        //         'data' => $isiDataDaerah,
        //         'coordinates' => $dCor1[$nmDaerah]
        //     ];
        // }

        // foreach ($dataBaru as $baru1 => $baru2) {
        //     $daInsert[] = [
        //         'NamaDaerah' => $baru2['data']['Name'],
        //         'Kecamatan' => $baru2['data']['Kecamatan'],
        //         'Kelurahan' => $baru2['data']['Kelurahan'],
        //         'Keterangan' => $baru2['data']['Keterangan'],
        //         'Kondisi' => $baru2['data']['Kondisi'],
        //         'Konstruksi' => $baru2['data']['Konstruksi'],
        //         'Nama_Saluran' => $baru2['data']['Nama_Saluran'],
        //         'Panjang' => $baru2['data']['Panjang_'],
        //         'PosisiSaluran' => $baru2['data']['Posisi Saluran'],
        //         'Tipe_Salur' => $baru2['data']['Tipe_Salur'],
        //         'X_Akhir' => $baru2['data']['X_Akhir'],
        //         'X_Awal' => $baru2['data']['X_Awal'],
        //         'Y_Akhir' => $baru2['data']['Y_Akhir'],
        //         'Y_Awal' => $baru2['data']['Y_Awal'],
        //         'Coordinates' => $baru2['coordinates']
        //     ];
        //     $dataCor[] =  $baru2['coordinates'];
        //     # code...
        // }

        $this->drain->insertBatch($daInsert11);
        echo '<pre>';
        echo (print_r($daInsert11));
        echo '</pre>';


        // foreach ($dataIsi as $isi1 => $isi2) {
        //     # code...
        //     $dIsiNew[] = [
        //         'data' => $isi2,
        //         'coordinates' => json_encode($dCor1[$isi1])
        //     ];
        // }

        // echo '<pre>';
        // echo print_r($cordinat);
        // echo '</pre>';
        // foreach ($cordinat as $key1 => $value1) {

        //     foreach ($value1 as $nK => $value2) {
        //         // echo '<pre>';
        //         // echo print_r($value2);
        //         // echo '</pre>';
        //         foreach ($value2 as $value3) {


        //             # code...

        //             $dCor[$key1][$nK][] = [
        //                 $value3[1],
        //                 $value3[0],
        //             ];
        //         }
        //     }

        // }

        // echo '<pre>';
        // echo (json_encode($dCor));
        // echo '</pre>';


    }

    public function gis_data()
    {
        $json = file_get_contents('assets/geojson/DRAINASE_PERKOTAAN_KOTA_BUKITTINGGI.geojson');

        // Decode the JSON file
        $json_data = json_decode($json, true);

        // Display data
        foreach ($json_data['features'] as $key => $value) {

            $cordinat[] = $value;
        }

        echo '<pre>';
        echo print_r($cordinat);
        echo '</pre>';
    }

    public  function getCoordinat()
    {
        $dCoor = [];
        $drainID = $this->request->getPost('idDrainAce');


        $sql = db_connect()->table('drainase');
        $sql->select('*');
        if (!empty($drainID)) {
            $sql->whereIn('DrainaseID', $drainID);
        }

        foreach ($sql->get()->getResultArray() as $key => $value) {
            # code..

            if ($value['Kondisi'] == 'Baik') {
                $warna = 'blue';
            } elseif ($value['Kondisi'] == 'Dibawah Trotoar') {
                $warna = 'yellow';
            } elseif ($value['Kondisi'] == 'Parit Antang') {
                $warna = 'black';
            } else {
                $warna = 'red';
            }
            $dCoor[] = [
                'kondisi' => $value['Kondisi'],
                'warna' => $warna,
                'coordinat' => json_decode($value['Coordinates'])
            ];
        }


        // echo '<pre>';
        // echo print_r($dCoor);
        // echo '</pre>';


        // echo '<pre>';
        // echo print_r($data);
        // echo '</pre>';
        return  $this->respond($dCoor, 200);
    }
}