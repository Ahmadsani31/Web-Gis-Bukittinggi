<?php

namespace App\Models;

use CodeIgniter\Model;

class MBerita extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'berita';
    protected $primaryKey       = 'BeritaID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ImageBerita','UserID', 'Slug', 'Judul', 'Konten', 'Publish', 'TanggalPublish', 'View', 'Headline'];

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

    public function getData($tgl1, $tgl2, $publish)
    {
        $builder = $this->table($this->table)->select('*')->where(['DeletedAT' => null]);

        if (!empty($tgl2)) {
            $builder->where('TanggalPublish BETWEEN "' . $tgl1 . '" AND "' . $tgl2 . '"');
        }
        if (!empty($publish)) {
            $builder->where(['Publish' => $publish]);
        }

        $query   = $builder->get();  // Produces: SELECT * FROM mytable

        return $query;
    }

    protected function beforeInsert(array $data)
    {
        $data['data']['UCreate'] = session()->get('s_Nama');
        return $data;
    }
}
