<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        return view('administrator/v_user');
    }

    public function simpan()
    {
        $post = $this->request->getPost();

        if (strlen($post['Password']) < 6) {
            return $this->response->setJSON(['param' => 0, 'pesan' => 'Panjang Password minimal 6 karakter']);
        }

        if (strpos($post['Username'], ' ') !== false) {
            return $this->response->setJSON(['param' => 0, 'pesan' => 'Tidak boleh ada spasi di username']);
        }

        $data = [
            'Nama' => $post['Nama'],
            'Username' => $post['Username'],
            'Password' => password_hash($post['Password'], PASSWORD_DEFAULT),
            'Level' => $post['Level'],
            'NA' => $post['NA'],
        ];

        if ($post['AdminID'] == 0) {
            if ($param = $this->auth->insert($data)) {
                return $this->response->setJSON(['param' => $param, 'pesan' => 'Berhasil Simpan']);
            }
            return $this->response->setJSON(['param' => $param, 'pesan' => $this->auth->errors()]);
            // return $this->fail($this->model_undangan->errors());
        } else {
            if ($param = $this->auth->update($post['AdminID'], $data)) {
                return $this->response->setJSON(['param' => $param, 'pesan' => 'Berhasil Simpan']);
            }
            return $this->response->setJSON(['param' => $param, 'pesan' => $this->auth->errors()]);
        }
    }
}
