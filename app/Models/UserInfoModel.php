<?php 

namespace App\Models;

use CodeIgniter\Model;

class UserInfoModel extends Model
{
    protected $table = 'user_data';
    protected $allowedFields = ['id', 'name', 'email', 'image', 'file'];

    public function search($keyword)
    {
        return $this->table('user_data')->like('name', $keyword)->orLike('email', $keyword);
    }

    public function getUser($id = false)
    {
        if($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}