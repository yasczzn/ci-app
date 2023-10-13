<?php 

namespace App\Models;

use CodeIgniter\Model;

class OrangModel extends Model
{
    protected $table = 'user';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'email'];

    public function search($keyword)
    {
        return $this->table('user')->like('name', $keyword)->orLike('email', $keyword);
    }
}