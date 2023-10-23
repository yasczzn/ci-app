<?php 

namespace App\Models;

use CodeIgniter\Model;

class UserInfoModel extends Model
{
    protected $table = 'user_data';
    protected $allowedFields = ['id', 'first_name', 'last_name', 'email', 'age', 'hired_since', 'image', 'file'];

    public function search($keyword)
    {
        return $this->table('user_data')->like('first_name', $keyword)->orLike('last_name', $keyword)->orLike('age', $keyword)->orLike('hired_since', $keyword)->orLike('email', $keyword);
    }

    public function getUser($id = false)
    {
        if($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
    
}