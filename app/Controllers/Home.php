<?php

namespace App\Controllers;

use App\Models\DashModel;

class Home extends BaseController
{
    public function index()
    {
        $this->DashModel = new DashModel();
        $data = [
            'title' => 'Journal | Home',
            'tot_ijess' => $this->DashModel->tot_ijess(),
            'tot_jtep' => $this->DashModel->tot_jtep(),
            'tot_ahjpm' => $this->DashModel->tot_ahjpm(),
            'tot_jogta' => $this->DashModel->tot_jogta(),
        ];
        echo view('home', $data);
    }
}
