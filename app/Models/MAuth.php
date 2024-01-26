<?php

namespace App\Models;

use CodeIgniter\Model;

class MAuth extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'admin';
    protected $primaryKey       = 'AdminID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Username', 'Password', 'Nama'];

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
        $builder = $this->table($this->table)->select('*')->where(['DeletedAT' => null]);
        $query   = $builder->get();  // Produces: SELECT * FROM mytable

        return $query;
    }


    protected function beforeInsert(array $data)
    {
        $data['data']['UCreate'] = session()->get('s_Nama');
        return $data;
    }
}
