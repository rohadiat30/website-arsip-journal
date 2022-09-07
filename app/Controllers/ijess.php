<?php

namespace App\Controllers;

use App\Models\IjessModel;
use EmptyIterator;
use phpDocumentor\Reflection\Types\This;
use TCPDF;

class Ijess extends BaseController
{
    protected $ijessModel;
    public function __construct()
    {
        $this->ijessModel = new ijessModel();
    }
    public function index()
    {
        $ijess = $this->ijessModel->findAll();
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $ijess = $this->ijessModel->search($keyword);
        } else {
            $ijess = $this->ijessModel;
        }

        $data = [
            'title' => 'Journal | IJESS',
            'ijess' => $this->ijessModel->getIjess()
        ];
        echo view('ijess/ijess', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Journal | Form Tambah Data',
            'validation' => \Config\Services::validation()
        ];
        echo view('ijess/create', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'volume' => 'required',
            'judul' => 'required|is_unique[ijess.judul]',
            'author' => 'required',
            'tanggal' => 'required',
            'status' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/ijess/create')->withInput()->with('validation', $validation);
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
        $this->ijessModel->insert($data);
        session()->setFlashdata('message', 'Data Berhasil Disimpan');
        return redirect()->to('/ijess');
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Journal | Form Edit Data',
            'validation' => \Config\Services::validation(),
            'ijess' => $this->ijessModel->getIjess($id)
        ];
        return view('ijess/edit', $data);
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
        $this->ijessModel->save($data);
        session()->setFlashdata('message', 'Data Berhasil Diubah');
        return redirect()->to('/ijess');
    }
    public function delete($id)
    {
        $this->ijessModel->delete($id);
        session()->setFlashdata('message', 'Data Berhasil dihapus');
        return redirect()->to('/ijess');
    }
    public function print()
    {
        $ijess = $this->ijessModel->findAll();
        $data = [
            'ijess' => $this->ijessModel->getIjess(),
        ];
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('');
        $pdf->SetAuthor('Catra Research Institute');
        $pdf->SetTitle('Data Journal IJESS');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $i = 0;
        $html = '<h2 align="center"> Data Journal IJESS</h2>
         <table border="1" cellspacing="1" cellpadding="4">
            <tr style="font-weight: bold;">
                <th width="30">No</th>
                <th width="110">Volume</th>
                <th width="330">Judul</th>
                <th width="150">Author</th>
                <th width="80">Tanggal</th>
                <th width="80">Status</th>
            </tr>';
        foreach ($ijess as $row) {
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
        $pdf->Output('Data IJESS', 'I');
    }
}
