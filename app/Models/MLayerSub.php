<?php

namespace App\Models;

use CodeIgniter\Model;

class MLayerSub extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'layer_sub';
    protected $primaryKey       = 'LayerSubID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['LayerSubID', 'LayerID', 'ProvinsiID', 'KabupatenID',  'KecamatanID', 'KelurahanID', 'Nama', 'Keterangan', 'WarnaUtama', 'WarnaBatas', 'Gambar', 'Posisi', 'Tinggi', 'Luas', 'Type', 'Coordinat','Panjang','JenisSedimen'];

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

    protected function beforeInsert(array $data)
    {
        $data['data']['UCreate'] = session()->get('s_Nama');
        return $data;
    }
}