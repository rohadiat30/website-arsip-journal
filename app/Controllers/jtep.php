<?php

namespace App\Controllers;

use App\Models\JtepModel;
use TCPDF;

class Jtep extends BaseController
{
    protected $jtepModel;
    public function __construct()
    {
        $this->jtepModel = new JtepModel();
    }
    public function index()
    {
        $jtep = $this->jtepModel->findAll();
        $jtep = $this->jtepModel->findAll();
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $jtep = $this->jtepModel->search($keyword);
        } else {
            $jtep = $this->jtepModel;
        }
        $data = [
            'title' => 'Journal | JTEP',
            'jtep' => $this->jtepModel->getJtep()
        ];
        echo view('jtep/jtep', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Journal | Form Tambah Data',
            'validation' => \Config\Services::validation()
        ];
        echo view('jtep/create', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'volume' => 'required',
            'judul' => 'required|is_unique[jtep.judul]',
            'author' => 'required',
            'tanggal' => 'required',
            'status' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/jtep/create')->withInput()->with('validation', $validation);
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
        $this->jtepModel->insert($data);
        session()->setFlashdata('message', 'Data Berhasil Disimpan');
        return redirect()->to('/jtep');
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Journal | Form Edit Data',
            'validation' => \Config\Services::validation(),
            'jtep' => $this->jtepModel->getJtep($id)
        ];
        return view('jtep/edit', $data);
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
        $this->jtepModel->save($data);
        session()->setFlashdata('message', 'Data Berhasil Diubah');
        return redirect()->to('/jtep');
    }
    public function delete($id)
    {
        $this->jtepModel->delete($id);
        session()->setFlashdata('message', 'Data Berhasil dihapus');
        return redirect()->to('/jtep');
    }
    public function print()
    {
        $jtep = $this->jtepModel->findAll();
        $data = [
            'jtep' => $this->jtepModel->getJtep(),
        ];
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('');
        $pdf->SetAuthor('Catra Research Institute');
        $pdf->SetTitle('Data Journal JTEP');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $i = 0;
        $html = '<h2 align="center"> Data Journal JTEP</h2>
         <table border="1" cellspacing="1" cellpadding="4">
            <tr style="font-weight: bold;">
                <th width="30">No</th>
                <th width="110">Volume</th>
                <th width="330">Judul</th>
                <th width="150">Author</th>
                <th width="80">Tanggal</th>
                <th width="80">Status</th>
            </tr>';
        foreach ($jtep as $row) {
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
        $pdf->Output('Data JTEP', 'I');
    }
}
