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
     /* loan application */
     public function loanApplication($data){
        return $this->db->insert('loan',$data);
     }
     public function customer_id_check($id){
        return $this->db->get_where('loan',array('customers_id'=>$id,'status'=>0));
     }

     /* ******************* Reciver Details ******************* */
     public function reciverDetails($receiver_account){
      $this->db->select('*');
      $this->db->from('customers');
      $this->db->join('accounts', 'accounts.customers_id = customers.id');
      $this->db->where('accounts.accountNumber', $receiver_account);
      $query = $this->db->get();
      $results = $query->result();
      return $results;
     }
     /* checking recipient account number */

     public function transfer($data,$accountNumber){

      /* Get sender's account balance  */ 

    $this->db->select('balance');
    $this->db->from('accounts');
    $this->db->where('accountNumber', $accountNumber);
    $query = $this->db->get();
    $sender_balance = $query->row()->balance;

    /* Get recipient's account balance */
    $this->db->select('balance');
    $this->db->from('accounts');
    $this->db->where('accountNumber', $data['receiver_account']);
    $query = $this->db->get();
    $recipient_balance = $query->row()->balance;
    /* Calculate new balances */
   
   if($sender_balance<$data['amount']){
      $this->db->trans_rollback();
      $transaction_faild=array('sender_id'=>$data['sender_id'],'receiver_id'=>$data['receiver_id'],'sender_name'=>$data['sender_name'],
      'receiver_name'=>$data['receiver_name'],'sender_account'=>$data['sender_account'],'receiver_account'=>$data['receiver_account'],
      'amount'=>$data['amount'],'remarks'=>$data['remarks'],'transaction_date'=>$data['transaction_date'],'error_type'=>'Insufficient Balance','type'=>'Transafer','status'=>0);
      $this->db->insert('transaction_table',$transaction_faild);
      return 2;
   }
   $this->db->trans_start();
    $sender_new_balance = $sender_balance - $data['amount'];
    $recipient_new_balance = $recipient_balance + $data['amount'];
    /* Update sender's account balance */
    $this->db->where('accountNumber', $accountNumber);
    $this->db->set('balance', $sender_new_balance);
    $this->db->update('accounts');
      /* Update recipient's account balance */
    $this->db->where('accountNumber', $data['receiver_account']);
    $this->db->set('balance', $recipient_new_balance);
    $this->db->update('accounts');
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
      $transaction_faild=array('sender_id'=>$data['sender_id'],'receiver_id'=>$data['receiver_id'],'sender_name'=>$data['sender_name'],
      'receiver_name'=>$data['receiver_name'],'sender_account'=>$data['sender_account'],'receiver_account'=>$data['receiver_account'],
      'amount'=>$data['amount'],'remarks'=>$data['remarks'],'transaction_date'=>$data['transaction_date'],'error_type'=>'Bank Server Down','type'=>'Transafer','status'=>0);
      $this->db->insert('transaction_table',$transaction_faild);
      return 3;
  } else {
   $transaction=array('sender_id'=>$data['sender_id'],'receiver_id'=>$data['receiver_id'],'sender_name'=>$data['sender_name'],
   'receiver_name'=>$data['receiver_name'],'sender_account'=>$data['sender_account'],'receiver_account'=>$data['receiver_account'],
   'amount'=>$data['amount'],'remarks'=>$data['remarks'],'transaction_date'=>$data['transaction_date'],'type'=>'Transafer','status'=>1);
   $this->db->insert('transaction_table',$transaction);
   return 4;
  
  }
   /* Insert transaction record */
   /*  */

     }
     public function userAccountCheck($userid){
      $this->db->select('*');
      $this->db->from('customers');
      $this->db->join('accounts', 'accounts.customers_id = customers.id');
      $this->db->where('accounts.customers_id', $userid);
      $query = $this->db->get();
      $results = $query->row()->accountNumber;
      return $results;
     }
     /* ******************* Reciver Details ******************* */

     /* public function getCreditDebitTransactions($userid) {
      if (!$userid) {
          return null; // or throw an error
      }
      
      $this->db->select('*');
      $this->db->from('transaction_table');
      $this->db->where("(sender_id = $userid OR receiver_id = $userid)");
      $this->db->order_by('transaction_date', 'desc');
      
      $result = $this->db->get();
      if (!$result) {
          return null; // or throw an error
      }
      
      return $result->result();
  }
  
   */

   public function getCreditDebitTransactions($userid) {
      if (!$userid) {
          return null; // or throw an error
      }
      
      $this->db->select('*');
      $this->db->from('transaction_table');
      $this->db->where("(sender_id = $userid OR receiver_id = $userid)");
  
      // Check if status is equal to 0 and sender_id is equal to 1001
      $this->db->where("(status != 0 OR sender_id = $userid)");
  
      $this->db->order_by('transaction_date', 'desc');
      
      $result = $this->db->get();
      if (!$result) {
          return null; // or throw an error
      }
      
      return $result->result();
  }
  public function atm($userid){
    return $this->db->get_where('atm',array('status'=>1));
  }
  public function atm_applay($id){
    return $this->db->get_where('atm',array('customers_id'=>$id));
  }
 
  public function applayAtm($data){
    return $this->db->insert('atm',$data);
  }
  public function atmDisplay($id){
    $result_set = $this->db->get_where('atm', array('customers_id'=>$id));
    if($result_set->num_rows() > 0){
     return 1;
    } else {
     return 0;
    }
 }
public function atm_display($id){
  $result_set = $this->db->get_where('atm', array('customers_id'=>$id,'status'=>0));
  if($result_set->num_rows() > 0){
   return 1;
  } else {
   return 0;
  }
}
public function debitCardDetails($id){
  return $this->db->get_where('atm',array('customers_id'=>$id))->result();
}
public function balanceDisplay($userid){
  $this->db->select('*');
  $this->db->from('customers');
  $this->db->join('accounts', 'accounts.customers_id = customers.id');
  $this->db->where('accounts.customers_id', $userid);
  $query = $this->db->get();
  $results = $query->row();
  return $results;
 }
}
?>