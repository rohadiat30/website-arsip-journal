<?php

namespace App\Models;

use CodeIgniter\Model;

class JtepModel extends Model
{
    protected $table = 'jtep';
    protected $allowedFields = ['volume', 'judul', 'author', 'tanggal', 'status'];

    public function getJtep($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
    public function search($keyword)
    {
        return $this->table('jtep')->like('judul', $keyword)->orLike('volume', $keyword)->orLike('status', $keyword)->orLike('author', $keyword);
    }
}
