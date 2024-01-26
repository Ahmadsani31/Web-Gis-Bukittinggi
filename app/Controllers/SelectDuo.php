<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SelectDuo extends BaseController
{
    public function getprov($searchTerm = "")
    {
        $searchTerm = $this->request->getVar('searchTerm');
        $builder = db_connect()->table('t_provinsi');
        $builder->select('id, nama');
        $builder->where("nama like '%" . $searchTerm . "%' ");
        $builder->orderBy('id', 'asc');
        $fetched_records = $builder->get();
        $dataprov = $fetched_records->getResultArray();
        $data = array();
        foreach ($dataprov as $prov) {
            $data[] = array("id" => $prov['id'], "text" => $prov['nama']);
        }
        return $data;
    }

    public  function getkab($id_prov, $searchTerm = "")
    {
        $searchTerm = $this->request->getVar('searchTerm');
        $builder = db_connect()->table('t_kota');
        $builder->select('id_kab, nama');
        $builder->where('id_prov', $id_prov);
        $builder->where("nama like '%" . $searchTerm . "%' ");
        $builder->orderBy('id_kab', 'asc');
        $fetched_records = $builder->get();
        $datakab = $fetched_records->getResultArray();

        $data = array();
        foreach ($datakab as $kab) {
            $data[] = array("id" => $kab['id_kab'], "text" => $kab['nama']);
        }
        return $data;
    }

    public function getkec($id_kab)
    {
        $searchTerm = $this->request->getPost('searchTerm');

        $builder = db_connect()->table('t_kecamatan');
        $builder->where('SUBSTRING(id,1,4)', $id_kab);
        $builder->where("nama like '%" . $searchTerm . "%' ");
        $builder->orderBy('id', 'asc');
        $fetched_records = $builder->get();
        $datakec = $fetched_records->getResultArray();

        $data = array();
        foreach ($datakec as $kec) {
            $data[] = array("id" => $kec['id'], "text" => $kec['nama']);
        }
        return $this->response->setJSON($data);
    }

    public function getkel($id_kec)
    {
        $searchTerm = $this->request->getPost('searchTerm');
        $builder = db_connect()->table('t_kelurahan');
        $builder->select('id, nama');
        $builder->where('SUBSTRING(id,1,6)', $id_kec);
        $builder->where("nama like '%" . $searchTerm . "%' ");
        $builder->orderBy('id', 'asc');
        $fetched_records = $builder->get();
        $datakel = $fetched_records->getResultArray();

        $data = array();
        foreach ($datakel as $kel) {
            $data[] = array("id" => $kel['id'], "text" => $kel['nama']);
        }
        return $this->response->setJSON($data);
    }
}
