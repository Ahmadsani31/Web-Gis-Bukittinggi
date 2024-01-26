<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use Kint\Zval\Value;

class Dashboard extends BaseController
{
    public function index()
    {
        // echo '<pre>';
        // echo print_r($uuid4 = $this->uuid->uuid4()->toString());
        // echo '</pre>';
        $this->data['berita'] = $this->berita->countAllResults();
        $this->data['beritaAktif'] = $this->berita->where('Publish', 'Y')->countAllResults();
        $this->data['beritaTidakAktif'] = $this->berita->where('Publish', 'N')->countAllResults();
        $this->data['pengaduan'] = $this->pengaduan->countAllResults();
        $this->data['pengaduanPengajuan'] = $this->pengaduan->where('Status', 'P')->countAllResults();
        $this->data['pengaduanTerima'] = $this->pengaduan->where('Status', 'Y')->countAllResults();
        $this->data['pengaduanTolak'] = $this->pengaduan->where('Status', 'N')->countAllResults();
        $this->data['drainase'] = $this->drainase->countAllResults();
        $this->data['batas'] = $this->layer->countAllResults();
        return view('administrator/v_dashboard', $this->data);
    }

    public function notifPengaduan()
    {
        $sql = $this->pengaduan->orderBy('DCreate', 'DESC')->findAll();
        $output = '';
        $total = 0;
        if ($sql) {
            foreach ($sql as $key => $value) {

                if ($value['Status'] == 'P') {
                    $total = count($value);
                    $bg = 'style="background-color: #afafaf;color:white;"';
                    $cl = 'style="color:white;"';
                } elseif ($value['Status'] == 'N') {
                    $bg = 'style="background-color: #db9198;color:white;"';
                    $cl = 'style="color:white;"';
                } else {
                    $bg = '';
                    $cl = '';
                }
                $output .= '<li   ' . $bg . '>
                <a href="' . base_url('admin/pengaduan') . '">

                <div class="media">
                    <img class="d-flex align-self-center img-radius" src="' . base_url('assets/files/pengaduan/') . $value['ImgPengaduan'] . '" alt="notif image" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="media-body" ' . $cl . '>
                            <h5 class="notification-user">' . $value['Nama'] . '</h5>
                            <p class="notification-msg">' . $value['Keterangan'] . '</p>
                            <span class="notification-time">' . TanggalIndo($value['DCreate']) . '</span>
                        </div>
                    </div>
                    </a>
                </li>';
                # code...
            }
            # code...
        } else {
            $output .= '<li>
                        <div class="media">
                            <img class="d-flex align-self-center img-radius"
                                src="' . base_url("assets/admin/") . 'images/no-pictures.png"
                                alt="Generic placeholder image">
                            <div class="media-body mt-2">
                                <h5 class="notification-user"><i>Tidak Ada Notifications</i></h5>
                            </div>
                        </div>
                    </li>';
        }

        return $this->response->setJSON(['output' => $output, 'count' => $total]);
    }
}
