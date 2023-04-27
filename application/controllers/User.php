<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller{
    
    public function __construct()
        {
            parent::__construct();
            //Do your magic here
            $this->load->model('UserModel','um');
            $this->load->helper('URL');

            

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
    // admin logout
    public function logout(){
        if($this->session->userdata('email')){
            $this->session->unset_userdata('email');
            redirect('User/login');

        }
    }

}
?>