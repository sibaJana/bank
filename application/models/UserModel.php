<?php
class UserModel extends CI_Model{
    public function usercheck($email){
        return $this->db->get_where('customers',array('email'=>$email));
     }
     public function addUser($data){
         return $this->db->insert('customers',$data);
     }
 
     public function login($data){
         return $this->db->get_where('customers',$data)->result_array();
         
     }
     public function branch(){
        return $this->db->get_where('branches',array('status'=>1))->result();
     }
}
?>