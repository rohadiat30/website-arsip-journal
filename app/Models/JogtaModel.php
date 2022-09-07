<?php

namespace App\Models;

use CodeIgniter\Model;

class JogtaModel extends Model
{
    protected $table = 'jogta';
    protected $allowedFields = ['volume', 'judul', 'author', 'tanggal', 'status'];

    public function getJogta($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
    public function search($keyword)
    {
        return $this->table('jogta')->like('judul', $keyword)->orLike('volume', $keyword)->orLike('status', $keyword)->orLike('author', $keyword);
    }
}
