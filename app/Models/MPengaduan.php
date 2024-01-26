<?php

namespace App\Models;

use CodeIgniter\Model;

class MPengaduan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pengaduan';
    protected $primaryKey       = 'PengaduanID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Nama', 'Email', 'Handphone', 'KTP', 'Lokasi', 'ProvinsiID', 'KabupatenID',  'KecamatanID', 'KelurahanID', 'Keterangan', 'Status', 'Tindakan', 'Status', 'TglStatus', 'ImgPengaduan', 'Tampilkan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'DCreate';
    protected $updatedField  = 'DEdited';
    protected $deletedField  = 'DeletedAT';

    // Validation
        protected $validationRules      = [
        'Nama'       =>        [
            'label'  => 'Nama',
            'rules' => 'required|min_length[3]',
        ],
        'Email'       =>        [
            'label'  => 'Email',
            'rules' => 'required|max_length[254]|valid_email',
        ],
        'Handphone' => [
            'label'  => 'Nomor Handphone',
            'rules' => 'required|numeric|min_length[8]|max_length[13]'

        ],
        'KTP' => [
            'label'  => 'Nomor KTP',
            'rules' => 'required|numeric|min_length[16]|max_length[18]'
        ],
        'KecamatanID' => [
            'rules' => 'required'
        ],
        'KelurahanID' => [
            'rules' => 'required'
        ],
        'Keterangan' => [
            'rules' => 'required'
        ],
        'ImgPengaduan' => [
            'rules' => 'required'
        ],
    ];
    protected $validationMessages   = [
        'Nama'       =>   [
            'required' => '{field} Harus diisi',
            'min_length' => '{field} minimal 3 huruf',
        ],
        'Email'       =>   [
            'required' => '{field} Harus diisi',
            'valid_email' => 'Cek kembali {field}, {field} tidak valid',
        ],
        'Handphone'       =>   [
            'required' => '{field} Harus diisi',
            'numeric' => '{field} harus gabugan beberapa angka',
            'min_length' => '{field} minimal 8 angka',
            'max_length' => '{field} tidak boleh lebih dari 13 angka',
        ],
        'KTP'       =>   [
            'required' => '{field} Harus diisi',
            'numeric' => '{field} harus gabugan beberapa angka',
            'min_length' => '{field} minimal 16 angka',
            'max_length' => '{field} tidak boleh lebih dari 18 angka',
        ],
        'KecamatanID' => [
            'required' => '{field} Harus diisi',
        ],
        'KelurahanID' => [
            'required' => '{field} Harus diisi',
        ],
        'Keterangan' => [
            'required' => '{field} Harus diisi',
        ],
        'ImgPengaduan' => [
            'required' => '{field} Harus diisi',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function getData($tgl1, $tgl2, $Status, $tampil, $sort)
    {
        $builder = $this->table($this->table)->select('*')->where(['DeletedAT' => null]);

        if (!empty($tgl2)) {
            $builder->where('date(DCreate) BETWEEN "' . $tgl1 . '" AND "' . $tgl2 . '"');
        }
        if (!empty($Status)) {
            $builder->where(['Status' => $Status]);
        }
        if (!empty($tampil)) {
            $builder->where(['Tampilkan' => $tampil]);
        }
        if (!empty($sort)) {
            $builder->orderBy('DCreate', $sort);
        }
        $query   = $builder->get();  // Produces: SELECT * FROM mytable

        return $query;
    }
}
