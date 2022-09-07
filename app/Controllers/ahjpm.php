<?php

namespace App\Controllers;

use App\Models\AhjpmModel;
use TCPDF;

class Ahjpm extends BaseController
{
    protected $ahjpmModel;
    public function __construct()
    {
        $this->ahjpmModel = new AhjpmModel();
    }
    public function index()
    {
        $ahjpm = $this->ahjpmModel->findAll();
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $ahjpm = $this->ahjpmModel->search($keyword);
        } else {
            $ahjpm = $this->ahjpmModel;
        }
        $data = [
            'title' => 'Journal | AHJPM',
            'ahjpm' => $this->ahjpmModel->getAhjpm()
        ];
        echo view('ahjpm/ahjpm', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Journal | Form Tambah Data',
            'validation' => \Config\Services::validation()
        ];
        echo view('ahjpm/create', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'volume' => 'required',
            'judul' => 'required|is_unique[ahjpm.judul]',
            'author' => 'required',
            'tanggal' => 'required',
            'status' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/ahjpm/create')->withInput()->with('validation', $validation);
        }
        $volume = $this->request->getVar('volume');
        $judul = $this->request->getVar('judul');
        $author = $this->request->getVar('author');
        $tanggal = $this->request->getVar('tanggal');
        $status = $this->request->getVar('status');

        $data = [
            'volume' => $volume,
            'judul' => $judul,
            'author' => $author,
            'tanggal' => $tanggal,
            'status' => $status
        ];
        $this->ahjpmModel->insert($data);
        session()->setFlashdata('message', 'Data Berhasil Disimpan');
        return redirect()->to('/ahjpm');
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Journal | Form Edit Data',
            'validation' => \Config\Services::validation(),
            'ahjpm' => $this->ahjpmModel->getAhjpm($id)
        ];
        return view('ahjpm/edit', $data);
    }
    public function update($id)
    {
        $volume = $this->request->getVar('volume');
        $judul = $this->request->getVar('judul');
        $author = $this->request->getVar('author');
        $tanggal = $this->request->getVar('tanggal');
        $status = $this->request->getVar('status');

        $data = [
            'id' => $id,
            'volume' => $volume,
            'judul' => $judul,
            'author' => $author,
            'tanggal' => $tanggal,
            'status' => $status
        ];
        $this->ahjpmModel->save($data);
        session()->setFlashdata('message', 'Data Berhasil Diubah');
        return redirect()->to('/ahjpm');
    }
    public function delete($id)
    {
        $this->ahjpmModel->delete($id);
        session()->setFlashdata('message', 'Data Berhasil dihapus');
        return redirect()->to('/ahjpm');
    }
    public function print()
    {
        $ahjpm = $this->ahjpmModel->findAll();
        $data = [
            'ahjpm' => $this->ahjpmModel->getAhjpm(),
        ];
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('');
        $pdf->SetAuthor('Catra Research Institute');
        $pdf->SetTitle('Data Journal AHJPM');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $i = 0;
        $html = '<h2 align="center"> Data Journal AHJPM</h2>
         <table border="1" cellspacing="1" cellpadding="4">
            <tr style="font-weight: bold;">
                <th width="30">No</th>
                <th width="110">Volume</th>
                <th width="330">Judul</th>
                <th width="150">Author</th>
                <th width="80">Tanggal</th>
                <th width="80">Status</th>
            </tr>';
        foreach ($ahjpm as $row) {
            $i++;
            $html .= '<tr>
                    <td width="30">' . $i . '</td>
                    <td>' . $row['volume'] . '</td>
                    <td>' . $row['judul'] . '</td>
                    <td>' . $row['author'] . '</td>
                    <td>' . $row['tanggal'] . '</td>
                    <td>' . $row['status'] . '</td>
                </tr>';
        }
        $html .= '</table>';
        $pdf->writeHTML($html, true, false, true, false, '');
        $this->response->setContentType('application/pdf');
        $pdf->Output('Data AHJPM', 'I');
    }
}
