<?php


function OptionDaerah($Table, $Primary, $Selected)
{
    $client = \Config\Services::curlrequest();
    $data = '';
    $obj = [];
    switch ($Table) {
        case 'provinsi':
            $json = $client->get('https://ibnux.github.io/data-indonesia/provinsi.json');
            $obj = json_decode($json->getBody());
            break;
        case 'kabupaten':
            if ($Primary != null) {
                $json = $client->get('https://ibnux.github.io/data-indonesia/kabupaten/' . $Primary . '.json');
                if ($json->getStatusCode() == 200) {
                    $obj = json_decode($json->getBody());
                }
            }

            break;
        case 'kecamatan':
            if ($Primary != null) {
                try {
                    $json = $client->get('https://ibnux.github.io/data-indonesia/kecamatan/' . $Primary . '.json');
                    if ($json->getStatusCode() == 200) {
                        $obj = json_decode($json->getBody());
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            break;
        case 'kelurahan':
            if ($Primary != null) {
                try {
                    $json = $client->get('https://ibnux.github.io/data-indonesia/kelurahan/' . $Primary . '.json');
                    if ($json->getStatusCode() == 200) {
                        $obj = json_decode($json->getBody());
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            break;
    }

    foreach ($obj as $fetch) {
        if ($Selected == $fetch->id) {
            $sel = 'selected';
        } else {
            $sel = '';
        }

        $data .= '<option value="' . $fetch->id . '" ' . $sel . '>' . $fetch->nama . '</option>';
    }

    return $data;
}

function getNamaDaerah($Table, $Primary)
{
    switch ($Table) {
        case 'provinsi':
            if (is_numeric($Primary)) {
                $json = db_connect()->table('t_provinsi')->where('id', $Primary)->get();
                if ($json->getNumRows() > 0) {
                    # code...
                    $sql  = $json->getRow();
                    $Nama = $sql->nama;
                }

                return $Nama;
            } else {
                return $Primary;
            }
            break;
        case 'kabupaten':
            if (is_numeric($Primary)) {
                $json = db_connect()->table('t_kota')->where('id', $Primary)->get();
                if ($json->getNumRows() > 0) {
                    # code...
                    $sql  = $json->getRow();
                    $Nama = $sql->nama;
                }

                return $Nama;
            } else {
                return $Primary;
            }
            break;
        case 'kecamatan':
            if (is_numeric($Primary)) {
                $json = db_connect()->table('t_kecamatan')->where('id', $Primary)->get();
                if ($json->getNumRows() > 0) {
                    # code...
                    $sql  = $json->getRow();
                    $Nama = $sql->nama;
                }

                return $Nama;
            } else {
                return $Primary;
            }
            break;
        case 'kelurahan':
            if (is_numeric($Primary)) {
                $json = db_connect()->table('t_kelurahan')->where('id', $Primary)->get();
                if ($json->getNumRows() > 0) {
                    # code...
                    $sql  = $json->getRow();
                    $Nama = $sql->nama;
                }

                return $Nama;
            } else {
                return $Primary;
            }
            break;
    }
}

function OptCreate($Key, $Name, $Selected)
{
    $data = '';

    $Jumlah = count($Key);

    if ($Jumlah > 0) {
        for ($i = 0; $i < $Jumlah; $i++) {
            $selected = $Key[$i] == $Selected ? 'selected' : '';

            $data .= '<option value ="' . $Key[$i] . '" ' . $selected . '>' . $Name[$i] . '</option>';
        }
    } else {
        $data .= '<option =""></option>';
    }

    return $data;
}

function createDir($path)
{
    if (!file_exists($path)) {
        $old_mask = umask(0);
        mkdir($path, 0777, true);
        umask($old_mask);
    }
}

function TanggalIndo($Date)
{
    if ($Date != '') {
        $Tanggal = substr($Date, 0, 10);
        $Jam = substr($Date, 11, 5);

        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];

        $pecahkan = explode('-', $Tanggal);

        if ($Jam != '') {
            return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0] . ' Jam ' . $Jam;
        } else {
            return @$pecahkan[2] . ' ' . @$bulan[(int) @$pecahkan[1]] . ' ' . @$pecahkan[0];
        }
    }
}


function options($from = '', $primary = '', $selected = '', $field = '', $where = '', $database = 'default')
{
    $options = '';
    $s = '';
    if ($from != '') {
        $db = db_connect($database)->table($from);
        $db->select('*');
        $db->where('DeletedAT IS NULL');
        if ($where != '') {
            $db->where($where);
        }
        $sql = $db->get();
        $j = $sql->getNumRows();
        if ($j > 0) {
            switch ($from) {
                case 'karyawan':
                    break;
                default:
                    if ($field != '') {
                        $name = $field;
                    } else {
                        $name = 'Nama';
                    }
                    foreach ($sql->getResultArray() as $key) {
                        $s = '';
                        if ($key[$primary] == $selected) {
                            $s = 'selected';
                        }


                        $options .= '<option value="' . $key[$primary] . '" ' . $s . '>' . $key[$name] . '</options>';
                    }
                    break;
            }
        }
    }
    return $options;
}

function OptionMultiple($Table, $Primary, $Selected, $Nama, $where = null)
{
    $data = '';
    switch ($Table) {
        case 'group':
            $query = db_connect()->query("SELECT * from $Table where $where order by id ASC");
            break;

        default:
            $query = db_connect()->query("SELECT * from $Table WHERE DeletedAT IS NULL");
            break;
    }
    // $x = explode(",", $Selected);

    foreach ($query->getResultArray() as $fetch) {
        if (in_array($fetch[$Primary], $Selected)) {
            $sel = 'selected';
        } else {
            $sel = '';
        }

        $data .= '<option value="' . $fetch[$Primary] . '" ' . $sel . '>' . $fetch[$Nama] . '</option>';
    }

    return $data;
}

function setToGeoJson($NamaJalan, $Kondisi, $Keterangan, $coordinates)
{
    $coordinatGjson = [
        'type' => 'Feature',
        'properties' => [
            "Nama_Jalan" => $NamaJalan,
            "Kondisi" => $Kondisi,
            "Keterangan" => $Keterangan,
        ],
        'geometry' => [
            "type" => "MultiLineString",
            "coordinates" => $coordinates
        ]
    ];
    return json_encode($coordinatGjson);
}

// function urlActive($segment)
// {
//     $uri = current_url(true);
//     $url = @$uri->getSegment(1) . @$uri->getSegment(2) ? '' : '/' . @$uri->getSegment(2) . @$uri->getSegment(3) ? '' : '/' . @$uri->getSegment(3);
//     echo $url;
//     if ($url == $segment) {
//         return 'active';
//     } else {
//         return '';
//     }
// }

// function urlActive1($segment)
// {
//     $uri = current_url(true);
//     $url = @$uri->getSegment(1) . @$uri->getSegment(2) ? '' : '/' . @$uri->getSegment(2) . @$uri->getSegment(3) ? '' : '/' . @$uri->getSegment(3);
//     if ($url == $segment) {
//         return 'pcoded-trigger complete';
//     } else {
//         return '';
//     }
// }

function isMultiDimensional($array)
{
    foreach ($array as $element) {
        foreach ($element as $inElement) {
            if (is_array($inElement)) {
                return true; // It's multidimensional
            }
        }
    }
    return false; // It's not multidimensional
}


function cekUserAktif()
{

    if (!empty(session()->get('s_UserID'))) {
        $query = db_connect()->table('admin')->where('AdminID', session()->get('s_UserID'))->get();
        if ($query->getNumRows() == 0) {
            session_destroy();
        }
    }
}

function getKodeDrainaseTerbaru()
{
    $drain = db_connect()->table('drainase')->countAllResults();
  
    return cekKodeBaru($drain);
}

function cekKodeBaru($Kode)
{
    if (!empty($Kode)) {
          $kodeBaru =  'DRE' . sprintf("%05s", $Kode);
        $drain = db_connect()->table('drainase')->where('KodeDrain', $kodeBaru)->get();
        if ($drain->getNumRows() == 0) {
            return $kodeBaru;
        } else {
            return cekKodeBaru($Kode+1);
        }
    }
}

function cekKodeBaruNew($Kode)
{
    if (!empty($Kode)) {

         $kodeBaru =  'DRE' . sprintf("%05s", $Kode);
        $drain = db_connect()->table('drainase')->where('KodeDrain', $kodeBaru)->get();
        if ($drain->getNumRows() == 0) {
            return $kodeBaru;
        } else {
            return cekKodeBaru($Kode+1);
        }
    }
}