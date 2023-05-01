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
    return $this->db->get_where('branches',array('name'=>$data['name'],'email'=>$data['email']))->result();
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
   public function updateBranchStatus($id){
   
    $a=$this->db->get_where('branches',array('id'=>$id))->result_array();
    // echo var_dump($a);
    // echo $a[0]['status'];
    if($a[0]['status']==0){
        return 0;
    }
    else{
        return 1;
    }

}

public function inactive($id){
    $this->db->where('id',$id);
    return $this->db->update('branches',array('status'=>0));
}
public function active($id){
    $this->db->where('id',$id);
    return $this->db->update('branches',array('status'=>1));
}
public function getBranch($id){
    return $this->db->get_where('branches',array('id'=>$id))->result_array();
}
function updateBranch($branchId,$data){
    $this->db->where('id',$branchId);
    return $this->db->update('branches',$data);
}
public function branchNameCheck($data, $branchId){
    $this->db->where('name',$data['name']);
    $this->db->where('id !=',$branchId); // Exclude current branch ID from check
    $query=$this->db->get('branches');
    $rowcount=$query->num_rows();
    return $rowcount;
}
public function branchEmailCheck($data, $branchId){
    $this->db->where('email',$data['email']);
    $this->db->where('id !=',$branchId); // Exclude current branch ID from check
    $query=$this->db->get('branches');
    $rowcount=$query->num_rows();
    return $rowcount;
}

public function userDetails() {
    $this->db->select('*');
    $this->db->from('accounts');
    $this->db->join('customers', 'accounts.customers_id = customers.id');

    $statuses = array(1, 2);
    foreach ($statuses as $status) {
        $this->db->or_where('customers.status', $status);
    }

    return $this->db->get()->result();
}


function showUnconfirmedUser(){
    $this->db->where('status',0);
    return $this->db->get('customers')->result();
}
function checkUser($id){
    return $this->db->get_where('branches',array('id'=>$id));
   }
   public function deleteData($id) {
    $this->db->trans_start();

$this->db->where('customers.id', $id);
$this->db->delete('customers');

$this->db->where('accounts.customers_id', $id);
$this->db->delete('accounts');

$this->db->trans_complete();

if ($this->db->trans_status() === FALSE) {
   return false;
} else {
    // handle success
    return true;
} 
}

public function updateUserStatus($id){
   
    $a=$this->db->get_where('customers',array('id'=>$id))->result_array();
    // echo var_dump($a);
    // echo $a[0]['status'];
    if($a[0]['status']==0){
        return 0;
    }
    else if($a[0]['status']==1){
        return 1;
    }
    else if($a[0]['status']==2){
        return 2;
    }

}

public function blockUser($id){
    $this->db->where('id',$id);
    return $this->db->update('customers',array('status'=>2));
}

public function activeUser($id){
    $this->db->where('id',$id);
    return $this->db->update('customers',array('status'=>1));
}
public function getUser($id){
    return $this->db->get_where('customers',array('id'=>$id))->result_array();
}
function updateUser($branchId,$data){
    $this->db->where('id',$branchId);
    return $this->db->update('customers',$data);
}

public function userEmailCheck($data, $userId){
    $this->db->where('email',$data['email']);
    $this->db->where('id !=',$userId); // Exclude current branch ID from check
    $query=$this->db->get('customers');
    $rowcount=$query->num_rows();
    return $rowcount;
}
public function userPhoneCheck($data, $userId){
    $this->db->where('phone',$data['phone']);
    $this->db->where('id !=',$userId); // Exclude current user ID from check
    $query=$this->db->get('customers');
    $rowcount=$query->num_rows();
    return $rowcount;
}
// *****************SEARCHING************************
public function search($query)
{
$this->db->select('*');
$this->db->from('accounts');
$this->db->join('customers', 'accounts.customers_id = customers.id');
$this->db->where('customers.id', $query);
$this->db->or_where('accounts.accountNumber', $query);
return $this->db->get()->result();

}
/* *****************SEARCHING END************************  */

// *****************Money deposit************************

public function deposit_money($data) {
    $this->db->trans_start();
    // Get the current balance for the account
    $this->db->select('balance');
    $this->db->from('accounts');
    $this->db->where('accountNumber', $data['accountNumber']);
    $query = $this->db->get();
    $row = $query->row();
    $current_balance = $row->balance;
    // Update the account balance with the deposit amount
    $new_balance = $current_balance + $data['amount'];
    $this->db->where('accountNumber', $data['accountNumber']);
    $this->db->update('accounts',array('balance'=>$new_balance));
    $this->db->insert('transaction',$data);
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
        $transaction_faild=array('amount'=>$data['amount'],'errorType'=>'Bank Sarver Down','date'=>$data['date'],'customers_id'=>$data['customers_id']);
        $this->db->insert('transaction_failed',$transaction_faild);

    return false;
    } else {
    // handle success
    return $new_balance;
    } 

}
// *****************Money withdraw************************

public function withdraw_money($data) {
    $this->db->trans_start();

    // Get the current balance for the account
    $this->db->select('balance');
    $this->db->from('accounts');
    $this->db->where('accountNumber', $data['accountNumber']);
    $query = $this->db->get();
    $row = $query->row();
    $current_balance = $row->balance;

    // Check if the withdrawal amount exceeds the available balance
    if ($data['amount'] > $current_balance) {
        $this->db->trans_rollback();
        $transaction_faild=array('amount'=>$data['amount'],'errorType'=>'Insufficient Funds','date'=>$data['date'],'customers_id'=>$data['customers_id']);
        $this->db->insert('transaction_failed',$transaction_faild);
        return 0;
    }

    // Update the account balance with the withdrawal amount
    $new_balance = $current_balance - $data['amount'];
    $this->db->where('accountNumber', $data['accountNumber']);
    $this->db->update('accounts',array('balance'=>$new_balance));

    // Add a new transaction record for the withdrawal
    $this->db->insert('transaction', $data);

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
        $transaction_faild=array('amount'=>$data['amount'],'errorType'=>'Bank Sarver Down','date'=>$data['date'],'customers_id'=>$data['customers_id']);
        $this->db->insert('transaction_failed',$transaction_faild);
        return 2;
    } else {
        // Return the new account balance

        
        return 1;
    } 
}


    /* updateBalance */
    public function updateBalance($customers_id){
        $query= $this->db->get_where('accounts',array('customers_id'=>$customers_id));
         $row=$query->row();
        return $row->balance;
         

    }


}
?>