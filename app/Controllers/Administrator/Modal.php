<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;

class Modal extends BaseController
{

    public function index()
    {
        $modal = $this->request->uri->getSegment(3);
        return view('_modal/' . $modal);
    }
}
