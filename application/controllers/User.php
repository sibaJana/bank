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
        $this->load->view('user/header/header');
        $this->load->view('user/header/css');
        $this->load->view('user/header/leftnavbar');
        $this->load->view('user/header/navbar');
        $this->load->view('user/body/main');
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
        if(userId() || userName() || userEmail()){
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('name');
        $this->session->sess_destroy();
        redirect('User/login');
    }
}
    

    /* ******************* loan account ******************* */

    function loan(){
        
            $this->load->view('user/header/header');
            $this->load->view('user/header/css');
            $this->load->view('user/header/leftnavbar');
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
        $this->load->view('user/header/header');
        $this->load->view('user/header/css');
        $this->load->view('user/header/leftnavbar');
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
public function transfer(){
    $userid=userId();
    $data['toAccount']=$this->input->post('toAccount',true);
    $data['amount']=$this->input->post('amount',true);
    $data['remarks']=$this->input->post('remarks',true);
    $data['date']=date('y:m:d h:m:sa');
    $data['customers_id']=$userid;
    
   /* user are not allow to transfer there own account */
   $accountNumber=$this->um->userAccountCheck($userid);
//    echo $accountNumber;
   
   if($accountNumber ==$data['toAccount']){
   echo json_encode(array('status'=>1,'msg'=>'You are not allowed to transfer you own account'));
//     var_dump($data);
//    die();
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
/* ******************* Reciver Details ******************* */

public function reciverDetails(){
    $toAccount=$this->input->post('toAccount',true);
    $result=$this->um->reciverDetails($toAccount);
    // print_r($result);
    echo json_encode($result);
}





}
?>