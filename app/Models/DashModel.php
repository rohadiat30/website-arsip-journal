<?php

namespace App\Models;

use CodeIgniter\Model;

class DashModel extends Model
{
    public function tot_ijess()
    {
        return $this->db->table('ijess')->countAll();
    }
    public function tot_jtep()
    {
        return $this->db->table('jtep')->countAll();
    }
    public function tot_ahjpm()
    {
        return $this->db->table('ahjpm')->countAll();
    }
    public function tot_jogta()
    {
        return $this->db->table('jogta')->countAll();
    }
}
