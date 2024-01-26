<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \Hermawan\DataTables\DataTable as DT;

class Datatable extends BaseController
{
    public function d()
    {
        $table = $this->request->getVar('datatable');
        if ($table) {
            switch ($table) {
                case 'drainase':
                    $Tahun = $this->request->getVar('tahun');
                    $KecamatanID = $this->request->getVar('kec');
                    $KelurahanID = $this->request->getVar('kel');
                    $Kondisi = $this->request->getVar('kondisi');
                    $TipeSalur = $this->request->getVar('type');
                    $Konstruksi = $this->request->getVar('konst');
                    // $builder = $this->distrik->getData();
                    $builder = db_connect()->table('drainase');
                    $builder->select('DrainaseID,KodeDrain,NamaJalan,Panjang,Lebar,LebarB,Penampang,Tinggi,Keterangan,Konstruksi,Kondisi,ProvinsiID,KabupatenID,KecamatanID,KelurahanID,JenisSaluran,PosisiSaluran,FileImage1');
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
                    if (!empty($TipeSalur)) {
                        $builder->where('JenisSaluran', $TipeSalur);
                    }
                    if (!empty($Konstruksi)) {
                        $builder->where('Konstruksi', $Konstruksi);
                    }

                    $builder->where('DeletedAT', null);

                    return DT::of($builder)
                        ->addNumbering('No')
                        ->add('Drainase', function ($row) {
                            $output = '<ul>
                            <li>Kode : <span class="label label-info m-l-10 f-10">' . $row->KodeDrain . '</span></li>
                            <li>Nama Jalan : ' . $row->NamaJalan . '</li>
                            <li>Kecamatan : ' . getNamaDaerah('kecamatan', @$row->KecamatanID) . '</li>
                            <li>Kelurahan : ' . getNamaDaerah('kelurahan', @$row->KelurahanID) . '</li>
                        </ul>';
                            return $output;
                        })
                        ->add('Informasi', function ($row) {
                            $output = '<ul>
                                            <li>Panjang : ' . number_format($row->Panjang, 2) . ' Meter' . '</li>
                                            <li>Lebar (B) : ' . $row->Lebar . '</li>
                                            <li>Lebar (B1) : ' . $row->LebarB . '</li>
                                            <li>Tinggi (H) : ' . $row->Tinggi . '</li>
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
                            return $row->Lebar . ' X ' . $row->Tinggi . ' Meter';
                        })
                        ->add('Keterangan', function ($row) {
                            return $row->Keterangan;
                        })
                        ->add('Penampang', function ($row) {
                            return $row->Penampang;
                        })
                        ->add('PosisiSaluran', function ($row) {
                            $output = '<ul>
                                            <li>Posisi : ' . $row->PosisiSaluran . '</li>
                                            <li>Type : ' . $row->JenisSaluran . '</li>
                                        </ul>';
                            return $output;
                        })
                        ->add('Kondisi', function ($row) {
                            return @$row->Kondisi;
                        })
                        ->add('Konstruksi', function ($row) {
                            return @$row->Konstruksi;
                        })
                        ->add('Button', function ($row) {
                            $btn = '<a href="' . base_url('peta/detail-drainase/') . $row->KodeDrain . '" class="btn-get-started scrollto btn-sm mr-1 mb-1 p-2"><i class="bx bx-paper-plane"></i> Detail</a>&nbsp;';
                            return $btn;
                        })
                        ->setSearchableColumns(['KodeDrain', 'NamaJalan', 'KecamatanID', 'KelurahanID', 'Konstruksi', 'Kondisi', 'JenisSaluran', 'PosisiSaluran', 'Penampang'])
                        ->toJson(true);
                    break;

                default:
                    return DT::of([]);
                    break;
            }
        }
    }
}