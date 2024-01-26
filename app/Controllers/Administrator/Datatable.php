<?php

namespace App\Controllers\Administrator;

use \Hermawan\DataTables\DataTable as DT;
use App\Controllers\BaseController;

class Datatable extends BaseController
{
    public function index()
    {
        $tb =  $this->request->getVar('datatable');

        switch ($tb) {
            case 'berita':
                $table = $tb;
                $Tanggal1 = $this->request->getVar('tgl1');
                $Tanggal2 = $this->request->getVar('tgl2');
                $Publish = $this->request->getVar('publish');
                $db = $this->berita->getData($Tanggal1, $Tanggal2, $Publish);
                break;
            case 'drainase':
                $table = $tb;

                $db = $this->drainase->getData();
                break;
            case 'pengaduan':
                $table = $tb;
                $Tanggal1 = $this->request->getVar('tgl1');
                $Tanggal2 = $this->request->getVar('tgl2');
                $Status = $this->request->getVar('status');
                $Tampilkan = $this->request->getVar('tampilkan');
                $db = $this->pengaduan->getData($Tanggal1, $Tanggal2, $Status, $Tampilkan, 'DESC');
                break;
            case 'user':
                $table = $tb;
                $db = $this->auth->getData();
                break;
        }

        if ($db->getNumRows() > 0) {
            switch ($table) {
                case 'berita':
                    foreach ($db->getResultArray() as $info) {

                        if ($info['Publish'] == 'Y') {
                            $stt = '<span class="label bg-c-green m-l-10 f-10">Aktif / Publish</span>';
                        } elseif ($info['Publish'] == 'N') {
                            $stt = '<span class="label bg-c-red m-l-10 f-10">Tidak Aktif / Publish</span>';
                        }

                        $data['data'][] = [
                            "BeritaID"   => $info['BeritaID'],

                            "Judul"  => $info['Judul'],
                            "View"  => 'Dilihat ' . $info['View'] . ' Kali',
                            "Slug"  => $info['Slug'],
                            "Status"  => $stt,

                            "TanggalPublish"  => TanggalIndo($info['TanggalPublish']),
                            "Image"  => '<img src="' . base_url('assets/files/berita/') . $info['ImageBerita'] . '" alt="..." class="img-thumbnail" style="width: 150px !important;height: 150px !important;object-fit: cover !important;">',
                        ];
                    }
                    break;
                case 'drainase':
                    foreach ($db->getResultArray() as $info) {

                        $data['data'][] = [
                            "DrainaseID"   => $info['DrainaseID'],
                            "DistrikID"        => $info['DistrikID'],
                            "Nama"        => $info['NamaDaerah'],
                            "Kecamatan"  => $info['KecamatanID'],
                            "Kelurahan"  => $info['KelurahanID'],
                            "Keterangan"  => $info['Keterangan'],
                            "Kondisi"  => $info['Kondisi'],
                            "Konstruksi"  => $info['Konstruksi'],
                            "Nama_Saluran"  => $info['NamaSaluran'],
                            "KodeDrain"  => $info['KodeDrain'],
                            "Panjang"  => $info['Panjang'],
                            "PosisiSaluran"  => $info['PosisiSaluran'],
                            "Tipe_Salur"  => $info['TipeSalur'],
                            "Image"  => $info['Image'],
                        ];
                    }
                    break;

                case 'pengaduan':
                    foreach ($db->getResultArray() as $info) {

                        if ($info['Status'] == 'Y') {
                            $stt = '<span class="label label-success m-l-10 f-10">Disetujui</span>';
                        } elseif ($info['Status'] == 'N') {
                            $stt = '<span class="label label-danger m-l-10 f-10">Ditolak</span>';
                        } elseif ($info['Status'] == 'P') {
                            $stt = '<span class="label label-info m-l-10 f-10">Pengajuan</span>';
                        }
                        $Nama = '<ul class="square">
                                    <li>' . $info['Nama'] . '</li>
                                    <li>KTP : ' . $info['KTP'] . '</li>
                                    <li>Email : ' .  $info['Email'] . '</li>
                                </ul>';

                        $data['data'][] = [
                            "Nama"   => $Nama,
                            "Status"  => $stt,
                            "PengaduanID"   => $info['PengaduanID'],
                            "Tindakan"   => $info['Tindakan'],
                            "Lokasi"  => getNamaDaerah('kelurahan', @$info['KelurahanID']) . ' / ' . getNamaDaerah('kecamatan', @$info['KecamatanID']),
                            "Keterangan"  => $info['Keterangan'],
                            "Tanggal"  => TanggalIndo($info['DCreate']),
                            "ImgPengaduan"  => '<a href="#" class="modal-open-cre" pengaduanid="' . $info['PengaduanID'] . '" id="pengaduan-image" tooltip="klik untuk lihat gambar" judul="Tampil Gambar"><img src="' . base_url('assets/files/pengaduan/') . $info['ImgPengaduan'] . '" alt="gambar-pengaduan" class="img-thumbnail" style="width: 150px !important;object-fit: cover !important;"></a>',
                        ];
                    }
                    break;
                case 'user':
                    foreach ($db->getResultArray() as $info) {

                        $data['data'][] = [
                            "AdminID"   => $info['AdminID'],
                            "Username"        => $info['Username'],
                            "Password"        => $info['Password'],
                            "Nama"  => $info['Nama'],
                            "Level"  => $info['Level'],
                            "NA"  => $info['NA'],
                            "DCreate"  => $info['DCreate'],
                        ];
                    }
                    break;
            }
            echo json_encode($data);
        } else {
            echo '{"data":""}';
        }
    }

    public function serverSide()
    {
        $table = $this->request->getVar('datatable');
        if ($table) {
            switch ($table) {
                case 'layer':
                    // $builder = $this->distrik->getData();
                    $Tahun = $this->request->getVar('tahun');
                    $builder = db_connect()->table('layer')->select('LayerID,Nama,Keterangan,Position,Tahun,NA')->where('DeletedAT', null);
                    if (!empty($Tahun)) {
                        $builder->where('Tahun', $Tahun);
                    }
                    return DT::of($builder)
                        ->addNumbering('No')
                        ->add('Nama', function ($row) {
                            return $row->Nama;
                        })
                        ->add('Keterangan', function ($row) {
                            return $row->Keterangan;
                        })
                        ->add('Position', function ($row) {
                            if ($row->Position == 'Atas') {
                                return '<span class="label bg-info m-l-10 f-10">Atas Layer Drainase</span>';
                            } else {
                                return '<span class="label bg-info m-l-10 f-10">Bawah Layer Drainase</span>';
                            }
                        })
                        ->add('Tahun', function ($row) {
                            return $row->Tahun;
                        })
                        ->add('Status', function ($row) {
                            if ($row->NA == 'Y') {
                                return '<span class="label bg-danger m-l-10 f-10">Tidak Aktif</span>';
                            } else {
                                return '<span class="label bg-success m-l-10 f-10">Aktif</span>';
                            }
                        })
                        ->add('Button', function ($row) {
                            $btn = '<a href="' . base_url('admin/layer/peta/') . $row->LayerID . '" class="btn btn-sm btn-info mr-1 mb-1 p-2" tooltip="Kelola Sub Layer"><span class="ri-road-map-line ri-lg"></span></a>&nbsp;';
                            $btn .= '<button tooltip="Edit Layer" class="btn btn-sm btn-primary modal-open-cre mr-1 mb-1 p-2" judul="Edit Layer"  id="layer" layerid="' . $row->LayerID . '"><span class="ri-edit-box-fill ri-lg"></span></button>';
                            $btn .= '<button tooltip="Hapus Layer" class="btn btn-sm btn-danger modal-hapus-cre mr-1 mb-1 p-2" id="' . $row->LayerID . '" table="layer"><span class="ri-delete-bin-5-fill ri-lg"></span></button>';
                            return $btn;
                        })
                        ->setSearchableColumns(['Nama', 'Keterangan', 'Tahun'])
                        ->toJson(true);
                    break;

                   case 'drainase':
                    $Tahun = $this->request->getVar('tahun');
                    $KecamatanID = $this->request->getVar('kec');
                    $KelurahanID = $this->request->getVar('kel');
                    $Kondisi = $this->request->getVar('kondisi');
                    $JenisSaluran = $this->request->getVar('type');
                    $Konstruksi = $this->request->getVar('konst');
                    // $builder = $this->distrik->getData();
                    $builder = db_connect()->table('drainase');
                    $builder->select('DrainaseID,KodeDrain,NamaJalan,Panjang,Lebar,LebarB,Tinggi,Penampang,Keterangan,ProvinsiID,KabupatenID,KecamatanID,KelurahanID,JenisSaluran,PosisiSaluran,FileImage1');
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

                    return DT::of($builder)
                        ->addNumbering('No')
                        ->add('NamaJalan', function ($row) {
                            return $row->NamaJalan;
                        })
                        ->add('Daerah', function ($row) {
                            $output = '<ul>
                                            <li>' . getNamaDaerah('kecamatan', @$row->KecamatanID) . '</li>
                                            <li>' . getNamaDaerah('kelurahan', @$row->KelurahanID) . '</li>
                                        </ul>';
                            return $output;
                        })
                        ->add('KodeDrain', function ($row) {
                            return '<span class="label bg-c-green m-l-10 f-10">' . $row->KodeDrain . '</span>';
                        })
                        ->add('Panjang', function ($row) {
                            return number_format($row->Panjang, 2) . ' Meter';
                        })
                        ->add('Lebar', function ($row) {
                            return '(B) '. $row->Lebar . ' Meter<br>(B1) '. $row->LebarB.' Meter';
                        })
                        ->add('Tinggi', function ($row) {
                            return '(H) '. $row->Tinggi . ' Meter';
                        })
                        ->add('Penampang', function ($row) {
                            return $row->Penampang;
                        })
                        ->add('Keterangan', function ($row) {
                            return $row->Keterangan;
                        })
                        ->add('PosisiSaluran', function ($row) {
                            $output = '<ul>
                                            <li>Posisi : ' . $row->PosisiSaluran . '</li>
                                            <li>Type : ' . $row->JenisSaluran . '</li>
                                        </ul>';
                            return $output;
                        })
                        ->add('JenisSaluran', function ($row) {
                            return $row->JenisSaluran;
                        })
                        ->add('Image', function ($row) {

                            if (!empty($row->FileImage1)) {
                                return '<img src="' . base_url('assets/files/drainase/') . $row->FileImage1 . '" alt="..." style="width: 150px !important;height: 150px !important;object-fit: cover !important;">';
                            } else {
                                return '<img src="" alt="img drainase" class="img-thumbnail">';
                            }
                        })
                        ->add('Button', function ($row) {
                            $btn = '<a href="' . base_url('admin/drainase/edit/') . $row->DrainaseID . '" class="btn btn-sm btn-primary mr-1 mb-1 p-2"><span class="ri-edit-box-fill ri-lg"></span></a>&nbsp;';
                            $btn .= '<button title="Hapus Data" class="btn btn-sm btn-danger modal-hapus-cre mr-1 mb-1 p-2" id="' . $row->DrainaseID . '" table="drainase"><span class="ri-delete-bin-5-fill ri-lg"></span></button>';
                            return $btn;
                        })
                        ->setSearchableColumns(['KodeDrain', 'NamaJalan', 'KecamatanID', 'KelurahanID', 'Konstruksi', 'Kondisi', 'JenisSaluran', 'Penampang'])
                        ->toJson(true);
                    break;
                case 'genangan-air':
                    $Tahun = $this->request->getVar('tahun');
                    // $builder = $this->distrik->getData();
                    $builder = db_connect()->table('genangan_air');
                    $builder->select('GenanganID,KodeGenangan,NamaDaerah,Luas,ProvinsiID,KabupatenID,KecamatanID,KelurahanID,Keterangan');
                    if (!empty($Tahun)) {
                        $builder->where('Tahun', $Tahun);
                    }
                    $builder->where('DeletedAT', null);

                    return DT::of($builder)
                        ->addNumbering('No')
                        ->add('Nama', function ($row) {
                            return $row->NamaDaerah;
                        })
                        ->add('Keterangan', function ($row) {
                            return $row->Keterangan;
                        })
                        ->add('Luas', function ($row) {
                            return number_format($row->Luas, 2) . ' Meter';
                        })
                        ->add('Daerah', function ($row) {
                            $output = '<ul>
                                            <li>' . $row->KecamatanID . '</li>
                                            <li>' . $row->KelurahanID . '</li>
                                        </ul>';
                            return $output;
                        })
                        ->add('Button', function ($row) {
                            $btn = '<a href="' . base_url('admin/genangan-air/edit/') . $row->GenanganID . '" class="btn btn-sm btn-primary mr-1 mb-1 p-2"><span class="ri-edit-box-fill ri-lg"></span></a>&nbsp;';
                            $btn .= '<button title="Hapus Data" class="btn btn-sm btn-danger modal-hapus-cre mr-1 mb-1 p-2" id="' . $row->GenanganID . '" table="drainase"><span class="ri-delete-bin-5-fill ri-lg"></span></button>';
                            return $btn;
                        })
                        ->toJson(true);
                    break;
                default:
                    return DT::of([]);
                    break;
            }
        }
    }
}
