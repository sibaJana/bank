<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller{
    
    public function __construct()
        {
            parent::__construct();
            //Do your magic here
            $this->load->model('UserModel','um');
            $this->load->helper('URL');
            $this->load->helper('customaction_helper');

            

        }
        
        
    
    function index(){
        if($this->session->userdata('email')){
            $userid['userid']=userId();
            
        $this->load->view('user/header/header');
        $this->load->view('user/header/css');
        $this->load->view('user/header/leftnavbar',$userid);
        $this->load->view('user/header/navbar');
        $this->load->view('user/body/main',$userid);
        $this->load->view('user/footer/footer');
        $this->load->view('user/footer/js');
        $this->load->view('user/footer/end');
    }
    else{
        redirect('User/login');
    }
    }

    // login for user
    public function login(){
        $this->load->view('user/header/header');
        $this->load->view('user/header/css');
        $this->load->view('user/body/login');
        $this->load->view('user/footer/footer');
        $this->load->view('admin/footer/js');
        $this->load->view('user/footer/end');
    }
    // auth for user
    public function singin(){

        $data['email']=$this->input->post('email',true);
        $data['password']=$this->input->post('password',true);
        // $rememberme=$this->input->post('rememberme',true);
        $result=$this->um->login($data);
        if(count($result)==1){
            if($result[0]['status']==0){
                echo json_encode(array('status' => 0, 'message' => 'Your Account Not Verified !'));
            }
            elseif($result[0]['status']==2){
                
                echo json_encode(array('status' => 2, 'message' => 'Your Account block By Admin !'));
  
            }
            elseif($result[0]['status']==1){
               $session= array('id'=>$result[0]['id'],'email'=>$result[0]['email'],'name'=>$result[0]['name']);
               $this->session->set_userdata($session);
               if($this->session->userdata('email')){
                // redirect('Bank/index');
                // $this->index();
                echo json_encode(array('status' => 4));
               }
               else{
               
                echo json_encode(array('status' => 1, 'message' => 'Try After Some Time Later !'));
  
               }
            }
        }
        else{
            echo json_encode(array('status' => 3, 'message' => 'Email Id  Not Found !'));
        }



    }

    // singup for user
    public function singup(){
        
        $branch['data']=$this->um->branch();
        $this->load->view('user/header/header');
        $this->load->view('user/header/css');
        $this->load->view('user/body/singup',$branch);
        $this->load->view('user/footer/footer');
        $this->load->view('admin/footer/js');
        $this->load->view('user/footer/end'); 
    }
    public function registration(){
        $data['name']=$this->input->post('name',true);
        $data['phone']=$this->input->post('phone',true);
        $data['email']=$this->input->post('email',true);
        $data['date']=date('y-m-d h:i:sa');
        $data['branch_id']=$this->input->post('branchId',true);
        $data['password']=$this->input->post('password',true);
        $data['status']=0;
        $result=$this->um->usercheck($data['email']);
        //     echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die(); 
        if($result->num_rows()>0){
            echo json_encode(array('status' => 2, 'message' => 'Email Id Already Preasent !'));      
        }else{// email id not present in the database
            $addResult=$this->um->addUser($data);
            if($addResult){
                //if user register successfully
                echo json_encode(array('status' => 1, 'message' => 'Data inserted successfully!'));
                   
            }
            else{
                // if user have some error
                echo json_encode(array('status' => 3, 'message' => 'Failed to insert data!'));
                    
            }
        }

        
    }
     /* ******************* User Logout ******************* */
     public function logout() {
        if(isSession()){
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('name');
        $this->session->sess_destroy();
        redirect('User/login');
    }
}
    

    /* ******************* loan account ******************* */

    function loan(){
        $userid['userid']=userId();
            $this->load->view('user/header/header');
            $this->load->view('user/header/css');
            $this->load->view('user/header/leftnavbar',$userid);
            $this->load->view('user/header/navbar');
            $this->load->view('user/body/loan');
            $this->load->view('user/footer/footer');
            $this->load->view('admin/footer/js');
            $this->load->view('user/footer/end');
    
    }
    public function loanApplication(){
        $data['customers_id']=$this->session->userdata('id');
        $data['income']=$this->input->post('income',true);
        $data['occupation']=$this->input->post('occupation',true);
        $data['amount']=$this->input->post('amount',true);
        $data['term']=$this->input->post('term',true);
        $data['loanType']=$this->input->post('loanType',true);
        $data['date']=date('y:m:d h:m:sa');
        $data['status']=0;
        $customer_id_check=$this->um->customer_id_check($data['customers_id']);
        
        if($customer_id_check->num_rows()==1){
            echo json_encode(array('status'=>1,'msg'=>'Contact To Your branch'));
        }
        else{
            $loanApplication=$this->um->loanApplication($data);
            if($loanApplication){
                echo json_encode(array('status'=>2,'msg'=>'Loan application submitted successfully.'));  
            }
            else{
                echo json_encode(array('status'=>2,'msg'=>'Please try again later'));  
            }
        }
    }
/* ******************* END ******************* */

/* ******************* MONEY TRANSFER ******************* */

public function moneyTransfer(){
    if(isSession()){
        $userid['userid']=userId();
        $this->load->view('user/header/header');
        $this->load->view('user/header/css');
        $this->load->view('user/header/leftnavbar',$userid);
        $this->load->view('user/header/navbar');
        $this->load->view('user/body/moneyTransfer');
        $this->load->view('user/footer/footer');
        $this->load->view('admin/footer/js');
        $this->load->view('user/footer/end'); 
    } else {
        ?>
        <script>
            toastr.error('You Have To Login First.', {
            duration: 3000,
            position: 'bottom-right'
          });
        </script>
        <?php
        redirect('User/login');
    }
}

    /* reciver details */   
private $result;
public function reciverDetails(){
    $receiver_account=$this->input->post('receiver_account',true);
    $this->result=$this->um->reciverDetails($receiver_account);
    echo json_encode($this->result);
}
public function reciveraccount(){
    $receiver_account=$this->input->post('receiver_account',true);
    $this->result=$this->um->reciverDetails($receiver_account);
    // echo json_encode($this->result);
}
/* fund transfer */

public function transfer(){
    $userid=userId();
    $data['sender_id']=$userid;
    $data['receiver_id']=$this->input->post('receiver_id',true);
    $data['sender_name']=userName();
    $data['receiver_name']=$this->input->post('receiver_name',true);
    $data['sender_account']=$this->um->userAccountCheck($userid);
    $data['receiver_account']=$this->input->post('receiver_account',true);
    $data['amount']=$this->input->post('amount',true);
    $data['remarks']=$this->input->post('remarks',true);
    $data['transaction_date']=date('y:m:d h:m:sa');
    $this->reciveraccount();
    if(empty($this->result)){
        echo json_encode(array('status'=>5,'msg'=>'Wrong Account Number')); 
    }else{
   /* user are not allow to transfer there own account */
   $accountNumber=$this->um->userAccountCheck($userid);   
   if($accountNumber ==$data['receiver_account']){
   echo json_encode(array('status'=>1,'msg'=>'You are not allowed to transfer you own account'));
   }else{
    $status=$this->um->transfer($data,$accountNumber);
    if($status==2){
       echo json_encode(array('status'=>2,'msg'=>'Insufficent Funds'));   
    }
    else if($status==3){
       echo json_encode(array('status'=>3,'msg'=>'Bank Server Down'));
    }
    else if($status==4){
       echo json_encode(array('status'=>4,'msg'=>'Money Transfer Successfull'));
    }
   }
}


}
/* ******************* END ******************* */

/* ******************* transaction Details ******************* */
public function all_transaction(){
    if(isSession()){
        $userid=userId();
        $userid1['userid']=userId();
        $history['data']=$this->um->getCreditDebitTransactions($userid);
        $this->load->view('user/header/header');
        $this->load->view('user/header/css');
        $this->load->view('user/header/leftnavbar',$userid1);
        $this->load->view('user/header/navbar');
        $this->load->view('user/body/hrasation_history',array('data'=>$history,'userid'=>$userid));
        $this->load->view('user/footer/footer');
        $this->load->view('admin/footer/js');
        $this->load->view('user/footer/end'); 
    } else {
        ?>
        <script>
            toastr.error('You Have To Login First.', {
            duration: 3000,
            position: 'bottom-right'
          });
        </script>
        <?php
        redirect('User/login');
    }
}

public function atm(){
    $userid['userid']=userId();
    // $id=userId();
    $debitCardDetails['debitCard']=$this->um->debitCardDetails($userid['userid']);
    $this->load->view('user/header/header');
    $this->load->view('user/header/css');
    $this->load->view('user/header/leftnavbar',$userid);
    $this->load->view('user/header/navbar');
    $this->load->view('user/body/atm',$debitCardDetails);
    $this->load->view('user/footer/footer');
    $this->load->view('admin/footer/js');
    $this->load->view('user/footer/end');
    }
    private $card_number;
    private function atm_number(){
        $unique_id = uniqid();
        $random_number = str_pad(random_int(1, 999999999), 9, '0', STR_PAD_LEFT);
        $this->card_number = substr(preg_replace("/[^0-9]/", "", $unique_id), -7) . $random_number;
        $this->card_number = substr($this->card_number, 0, 16); // truncate to 16 digits if necessary
        
    }
    public function applayAtm(){
        $data['customers_id']=userId();
        $data['customer_name']=userName();
        // $data['expire_date']=date('m:y');
        $data['expire_date']=date('y:m:d', strtotime('+10 years'));
        $this->atm_number();
        $data['atm_number']=$this->card_number;
        $data['cvv']=rand(100,999);
        $data['status']=0;
        $data['pin']=rand(100000,999999);
        $query=$this->um->applayAtm($data);
        if($query){
            echo json_encode(array('status'=>1,'msg'=>'Your Application Successfully Submited'));
        }else{
            echo json_encode(array('status'=>0,'msg'=>'Your Application not Submited'));
        }
        
    }

    public function atmDisplay(){
        // $userid=userId();
        $userid=$this->input->post('userid',true);
        if($this->um->atmDisplay($userid)){
            echo json_encode(array('status'=>1));
        }else{
            echo json_encode(array('status'=>0));
        }
    }
    public function atm_display(){
        $userid=$this->input->post('user_id',true);
        if($this->um->atm_display($userid)){
            echo json_encode(array('status'=>1));
        }else{
            echo json_encode(array('status'=>0));
        }
    }
    public function balanceDisplay(){
        $id=$this->input->post('userid',true);
        $data=$this->um->balanceDisplay($id);
        echo json_encode($data); 
    }
    
}

?>