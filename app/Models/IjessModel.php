<?php

namespace App\Models;

use CodeIgniter\Model;

class IjessModel extends Model
{
    protected $table = 'ijess';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields = ['volume', 'judul', 'author', 'tanggal', 'status'];

    public function getIjess($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
    public function search($keyword)
    {
        return $this->table('ijess')->like('judul', $keyword)->orLike('volume', $keyword)->orLike('status', $keyword)->orLike('author', $keyword);
    }
}
