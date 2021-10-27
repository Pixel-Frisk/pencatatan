<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_us';
    protected $useTimestamps = true;
    protected $allowedFields = ['role', 'nama', 'noHP', 'email'];

    public function getUser()
    {
        return $this->findAll();
    }
    public function getSpesUser($id_us)
    {
        if ($id_us == false) {
            return $this->findAll();
        }
        return $this->where(['id_us' => $id_us])->first();
    }
    public function build()
    {
        $db = \Config\Database::connect();
        return $builder = $db->table('user');
    }
}
