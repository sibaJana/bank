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
     public function reciverDetails($toAccount){
      $this->db->select('*');
      $this->db->from('customers');
      $this->db->join('accounts', 'accounts.customers_id = customers.id');
      $this->db->where('accounts.accountNumber', $toAccount);
      $query = $this->db->get();
      $results = $query->result();
      return $results;
     }
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
    $this->db->where('accountNumber', $data['toAccount']);
    $query = $this->db->get();
    $recipient_balance = $query->row()->balance;
    /* Calculate new balances */
   
   if($sender_balance<$data['amount']){
      $this->db->trans_rollback();
      $transaction_faild=array('amount'=>$data['amount'],'errorType'=>'Insufficient Funds','date'=>$data['date'],'customers_id'=>$data['customers_id'],'remarks'=>$data['remarks'],'toAccount'=>$data['toAccount']);
      $this->db->insert('transaction_failed',$transaction_faild);
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
    $this->db->where('accountNumber', $data['toAccount']);
    $this->db->set('balance', $recipient_new_balance);
    $this->db->update('accounts');
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
      $transaction_faild=array('amount'=>$data['amount'],'errorType'=>'Bank Sarver Down','date'=>$data['date'],'customers_id'=>$data['customers_id'],'remarks'=>$data['remarks'],'toAccount'=>$data['toAccount']);
      $this->db->insert('transaction_failed',$transaction_faild);
      return 3;
  } else {
   $transaction=array('amount'=>$data['amount'],'type'=>'Transfer','date'=>$data['date'],'customers_id'=>$data['customers_id'],'remarks'=>$data['remarks'],'toAccount'=>$data['toAccount'],'accountNumber'=>$accountNumber);
   $this->db->insert('transaction',$transaction);
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
}
?>