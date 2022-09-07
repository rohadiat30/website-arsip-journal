<?php

namespace App\Controllers;

use App\Models\JogtaModel;
use TCPDF;

class Jogta extends BaseController
{
    protected $jogtaModel;
    public function __construct()
    {
        $this->jogtaModel = new JogtaModel();
    }
    public function index()
    {
        $jogta = $this->jogtaModel->findAll();
        $jogta = $this->jogtaModel->findAll();
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $jogta = $this->jogtaModel->search($keyword);
        } else {
            $jogta = $this->jogtaModel;
        }
        $data = [
            'title' => 'Journal | JOGTA',
            'jogta' => $this->jogtaModel->getJogta()
        ];
        echo view('jogta/jogta', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Journal | Form Tambah Data',
            'validation' => \Config\Services::validation()
        ];
        echo view('jogta/create', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'volume' => 'required',
            'judul' => 'required|is_unique[jogta.judul]',
            'author' => 'required',
            'tanggal' => 'required',
            'status' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/jogta/create')->withInput()->with('validation', $validation);
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
        $this->jogtaModel->insert($data);
        session()->setFlashdata('message', 'Data Berhasil Disimpan');
        return redirect()->to('/jogta');
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Journal | Form Edit Data',
            'validation' => \Config\Services::validation(),
            'jogta' => $this->jogtaModel->getJogta($id)
        ];
        return view('jogta/edit', $data);
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
        $this->jogtaModel->save($data);
        session()->setFlashdata('message', 'Data Berhasil Diubah');
        return redirect()->to('/jogta');
    }
    public function delete($id)
    {
        $this->jogtaModel->delete($id);
        session()->setFlashdata('message', 'Data Berhasil dihapus');
        return redirect()->to('/jogta');
    }
    public function print()
    {
        $jogta = $this->jogtaModel->findAll();
        $data = [
            'jogta' => $this->jogtaModel->getJogta(),
        ];
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('');
        $pdf->SetAuthor('Catra Research Institute');
        $pdf->SetTitle('Data Journal JOGTA');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $i = 0;
        $html = '<h2 align="center"> Data Journal JOGTA</h2>
         <table border="1" cellspacing="1" cellpadding="4">
            <tr style="font-weight: bold;">
                <th width="30">No</th>
                <th width="110">Volume</th>
                <th width="330">Judul</th>
                <th width="150">Author</th>
                <th width="80">Tanggal</th>
                <th width="80">Status</th>
            </tr>';
        foreach ($jogta as $row) {
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
        $pdf->Output('Data JOGTA', 'I');
    }
}
