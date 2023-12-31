<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class LGUModel extends Model {
    protected $table = 'users';
    protected $allowedFields = ['name', 'email', 'password', 'updated_at'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
  
  
  
  
    protected function beforeInsert(array $data){
      $data = $this->passwordHash($data);
      $data['data']['created_at'] = date('Y-m-d H:i:s');
  
      return $data;
    }
  
    protected function beforeUpdate(array $data){
      $data = $this->passwordHash($data);
      $data['data']['updated_at'] = date('Y-m-d H:i:s');
      return $data;
    }
  
    protected function passwordHash(array $data){
      if(isset($data['data']['password']))
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
  
      return $data;
    }
  
}
?>
