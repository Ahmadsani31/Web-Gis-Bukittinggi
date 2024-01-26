<?php

namespace App\Models;

use CodeIgniter\Model;

class MDrainase extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'drainase';
    protected $primaryKey       = 'DrainaseID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['NamaJalan', 'UserID', 'Tahun', 'DistrikID', 'ProvinsiID', 'KabupatenID',  'KecamatanID', 'KelurahanID', 'Keterangan', 'Kondisi', 'KodeDrain', 'Konstruksi', 'Sediment', 'NamaSaluran', 'Panjang', 'TypeGeojson', 'PosisiSaluran', 'JenisSaluran', 'TipeSalur', 'Tinggi', 'Lebar', 'LebarB', 'Penampang', 'TypeGeojson', 'X_Akhir', 'X_Awal', 'Y_Akhir', 'Y_Awal', 'Coordinate', 'Lebar', 'FileImage1', 'FileImage2', 'FileImage3',];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'DCreate';
    protected $updatedField  = 'DEdited';
    protected $deletedField  = 'DeletedAT';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['beforeInsert'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getData()
    {
        $builder = $this->table($this->table)->where(['DeletedAT' => null])->orderBy('DCreate', 'ASC');
        $query   = $builder->get();  // Produces: SELECT * FROM mytable

        return $query;
    }

    protected function beforeInsert(array $data)
    {
        $data['data']['UCreate'] = session()->get('s_Nama');
        return $data;
    }
}
