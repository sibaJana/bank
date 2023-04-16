<?php
class BankModel extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    

    }
    public function usercheck($email){
       return $this->db->get_where('register',array('email'=>$email));
    }
    public function addUser($data){
        return $this->db->insert('register',$data);
    }

    public function login($data){
        return $this->db->get_where('register',array('email'=>$data['email'],'password'=>$data['password']))->result_array();
        
    }
    public function accountActive(){
        return $this->db->get_where('customers',array('status'=>0));

    }
   public function totalcustomer(){
    return $this->db->get_where('customers',array('status'=>0))->num_rows();
   }
   public function getcustomerdata($limit,$offset){
    $this->db->limit($limit,$offset);
    return $this->db->get('customers')->result();
   }
   public function Accountcreate(){
    $number = rand(100000001, 999999999);
    $existing_numbers = $this->db->get_where('accounts',array('accountNumber'=>$number))->result_array(); // store previously generated numbers
    while (in_array($number, $existing_numbers)) {
        $number = rand(100000001, 999999999); // generate a new number
    }
    // $existing_numbers[] = $number; // add the new number to the array
    return $number;
   }
   public function getcustomerid($email){
    return $this->db->get_where('register',array('email'=>$email));
   }
   // checking customer id

   function checkId($id=null){
    return $this->db->get_where('customers',array('id'=>$id));
   }
   public function account($data){
    return $this->db->insert('accounts',$data);
   }
   //update customer account status
   public function cus_status($id){
    $this->db->where('id',$id);
    return $this->db->update('customers',array('status'=>1));
   }
   public function branchCheck($data){
    return $this->db->get_where('branches',array('name'=>$data['name'],'email'=>$data['email']));
   }
   public function newBranch($data){
    return $this->db->insert('branches',$data);
   }
   function branch_list(){
    return $this->db->get('branches')->result();
   }
   function checkBranch($id){
    return $this->db->get_where('branches',array('id'=>$id));
   }
   function deleteBranch($id){
        // return $this->db->delete('branches',$id);
        $this->db->where('id',$id);
        return $this->db->delete('branches');
   }

}
?>