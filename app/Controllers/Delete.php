<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Delete extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $ID =  $this->request->getPost('id');
        $Table =  $this->request->getPost('table');
        switch ($Table) {
            case 'pengaduan':
                $sql = $this->pengaduan->find($ID);
                $filepath = 'assets/files/pengaduan/';
                if ($found = $this->pengaduan->delete($ID)) {
                    if (file_exists($filepath . $sql['ImgPengaduan']) && $sql['ImgPengaduan']) {
                        unlink($filepath . $sql['ImgPengaduan']);
                    }
                    return $this->respondDeleted($found);
                }
                return $this->fail('Data Gagal Dihapus');
            case 'user':
                if ($ID == session()->get('s_UserID')) {
                    return $this->fail('akses ilegal tidak bisa hapus user', 400);
                }
                if ($found = $this->auth->delete($ID)) {
                    return $this->respondDeleted($found);
                }
                return $this->fail('Data Gagal Dihapus');
                break;
            case 'layer':

                $sql = $this->layer->find($ID);
                $lokasi = 'assets/files/layer/';
                if ($found = $this->layer->delete($ID)) {
                    $this->layerSub->where('LayerID', $ID)->delete();
                    if (file_exists($lokasi . $sql['FileJson']) && $sql['FileJson']) {
                        unlink($lokasi . $sql['FileJson']);
                    }
                    return $this->respondDeleted($found);
                }
                return $this->fail('Data Gagal Dihapus');
                break;
            case 'drainase':
                $sql = $this->drainase->find($ID);
                $filepath = 'assets/files/drainase/';
                if ($found = $this->drainase->delete($ID)) {
                    if (file_exists($filepath . $sql['FileImage1']) && $sql['FileImage1']) {
                        unlink($filepath . $sql['FileImage1']);
                    }
                    if (file_exists($filepath . $sql['FileImage2']) && $sql['FileImage2']) {
                        unlink($filepath . $sql['FileImage2']);
                    }
                    if (file_exists($filepath . $sql['FileImage3']) && $sql['FileImage3']) {
                        unlink($filepath . $sql['FileImage3']);
                    }

                    return $this->respondDeleted($found);
                }
                return $this->fail('Data Gagal Dihapus');
                break;
            case 'air':
                if ($found = $this->air->delete($ID)) {
                    return $this->respondDeleted($found);
                }
                return $this->fail('Data Gagal Dihapus');
                break;

            case 'berita':

                $sql = $this->berita->find($ID);
                $filepath = 'assets/files/berita/';
                if ($found = $this->berita->delete($ID)) {

                    if (file_exists($filepath . $sql['ImageBerita']) && $sql['ImageBerita']) {
                        unlink($filepath . $sql['ImageBerita']);
                    }

                    return $this->respondDeleted($found);
                }
                return $this->fail('Data Gagal Dihapus');
                break;
            case 'layer':
                $sql = $this->layer->find($ID);
                $filepath = 'assets/files/layer/';
                if ($found = $this->layer->delete($ID)) {

                    if (file_exists($filepath . $sql['FileJson']) && $sql['FileJson']) {
                        unlink($filepath . $sql['FileJson']);
                    }

                    return $this->respondDeleted($found);
                }
                return $this->fail('Data Gagal Dihapus');
                break;
            default:
                return $this->fail('Data tidak terdaftar, Gagal Dihapus');
                break;
        }
    }
}
