<?php

namespace App\Models;

use CodeIgniter\Model;

class AhjpmModel extends Model
{
    protected $table = 'ahjpm';
    protected $allowedFields = ['volume', 'judul', 'author', 'tanggal', 'status'];

    public function getAhjpm($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
    public function search($keyword)
    {
        return $this->table('ahjpm')->like('judul', $keyword)->orLike('volume', $keyword)->orLike('status', $keyword)->orLike('author', $keyword);
    }
}
