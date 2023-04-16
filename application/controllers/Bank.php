
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bank extends CI_Controller{
    
    public function __construct()
        {
            parent::__construct();
            //Do your magic here
            $this->load->model('BankModel','bm');
            $this->load->helper('URL');
            $this->load->library('pagination');
            // $this->load->helper("url");


            

        }
        
        
    
    function index(){
        if($this->session->userdata('email')){
        $this->load->view('admin/header/header');
        $this->load->view('admin/header/css');
        $this->load->view('admin/header/leftnavbar');
        $this->load->view('admin/header/navbar');
        $this->load->view('admin/body/main');
        $this->load->view('admin/footer/footer');
        $this->load->view('admin/footer/js');
        $this->load->view('admin/footer/end');
        }else{
            redirect('Bank/login');
        }
    }

    // login for user
    public function login(){
        $this->load->view('admin/header/header');
        $this->load->view('admin/header/css');
        $this->load->view('admin/body/login');
        $this->load->view('admin/footer/footer');
        $this->load->view('admin/footer/js');
        $this->load->view('admin/footer/end');
    }
    // auth for user
    public function singin(){

        $data['email']=$this->input->post('email',true);
        $data['password']=$this->input->post('password',true);
        $rememberme=$this->input->post('rememberme',true);
        $result=$this->bm->login($data);
        // echo var_dump($result);
/*         echo "<pre>";
        print_r($result);
        echo "</pre>";
        die(); */
        if(count($result)==1){
            if($result[0]['status']==0){
                echo json_encode(array('status' => 0, 'message' => 'Your Account Not Verified !'));
            }
            elseif($result[0]['status']==2){
                
                echo json_encode(array('status' => 2, 'message' => 'Your Account block By Admin !'));
  
            }
            elseif($result[0]['status']==1){
               $session= array('id'=>$result[0]['id'],'email'=>$result[0]['email'],'name'=>$result[0]['name']);
               $setsession=$this->session->set_userdata($session);
               if($this->session->userdata('email')){
                // redirect('Bank/index');
                echo json_encode(array('status' => 4, 'message' => 'Try After Some Time Later !'));
  
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
        $this->load->view('admin/header/header');
        $this->load->view('admin/header/css');
        $this->load->view('admin/body/singup');
        $this->load->view('admin/footer/footer');
        $this->load->view('admin/footer/js');
        $this->load->view('admin/footer/end'); 
    }
    public function registration(){
        $data['name']=$this->input->post('name',true);
        $data['email']=$this->input->post('email',true);
        $data['password']=$this->input->post('password',true);
        $result=$this->bm->usercheck($data['email']);
        if($result->num_rows()>0){
            echo json_encode(array('status' => 2, 'message' => 'Email Id Already Preasent !'));      
        }else{// email id not present in the database
            $addResult=$this->bm->addUser($data);
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
            redirect('Bank/login');

        }
    }
    //user all account fetch  for verification to admin
    public function UserAccount(){
        // $data['result']=$this->bm->accountActive();
       
        $config['base_url'] = base_url('Bank/UserAccount');
        $config['total_rows'] = $this->bm->totalcustomer();
        $config['per_page'] = 5;

        //design
    $config['full_tag_open'] = '<ul class="pagination">';        
    $config['full_tag_close'] = '</ul>';        
    $config['first_link'] = 'First';        
    $config['last_link'] = 'Last';        
    $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['first_tag_close'] = '</span></li>';        
    $config['prev_link'] = '&laquo';        
    $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['prev_tag_close'] = '</span></li>';        
    $config['next_link'] = '&raquo';        
    $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['next_tag_close'] = '</span></li>';        
    $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['last_tag_close'] = '</span></li>';        
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
    $config['cur_tag_close'] = '</a></li>';        
    $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['num_tag_close'] = '</span></li>';

        // end design
        
        $this->pagination->initialize($config);
        $result['data']=$this->bm->getcustomerdata($config['per_page'],$this->uri->segment(3));
        
         $result['link']=$this->pagination->create_links();
        

        $this->load->view('admin/header/header');
        $this->load->view('admin/header/css');
        $this->load->view('admin/header/leftnavbar');
        $this->load->view('admin/header/navbar');
        $this->load->view('admin/body/userAccount',$result);
        $this->load->view('admin/footer/footer');
        $this->load->view('admin/footer/js');
        $this->load->view('admin/footer/end');
    }
    function generate_random_number() {
        $number = rand(1, 100);
        $existing_numbers = array(); // store previously generated numbers
        while (in_array($number, $existing_numbers)) {
            $number = rand(1, 100); // generate a new number
        }
        $existing_numbers[] = $number; // add the new number to the array
        return $number;
    }

    public function UserAccountcreate($id=null){
        $customerIdCheck=$this->bm->checkId($id);
        if($customerIdCheck){
            $data['accountNumber']=$this->bm->Accountcreate();
            $data['customers_id']=$id;
            $data['branch_id']=101;
            $data['openaningdate']=date('y-m-d h:i:sa');
            $data['balance']=0;
            $data['type']='Saving';
            $status=$this->bm->account($data);
            
            if($status){
                $custo_status=$this->bm->cus_status($id);
               if($custo_status){
                echo json_encode(array('status'=>1,'message'=>'Account Created Successfully'));
               }
               else{
                echo json_encode(array('status'=>2,'message'=>'Account Not Create'));
              
               }
            }
        }
        else{
            echo json_encode(array('status'=>0,'message'=>'User Id Not Found'));
        }
       
    }
    public function branch(){
        $this->load->view('admin/header/header');
        $this->load->view('admin/header/css');
        $this->load->view('admin/header/leftnavbar');
        $this->load->view('admin/header/navbar');
        $this->load->view('admin/body/branch');
        $this->load->view('admin/footer/footer');
        $this->load->view('admin/footer/js');
        $this->load->view('admin/footer/end');
    }
     public function branchCreate(){
        $this->input->post('name','true');
        $this->input->post('email',true);
        $this->input->post('address',true);
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required');
        if($this->form_validation->run()==true){

            $data['name']=$this->input->post('name','true');
            $data['email']=$this->input->post('email',true);
            $data['address']=$this->input->post('address',true); 
            $datacheck=$this->bm->branchCheck($data);
            if($datacheck->num_rows()==1){
                echo json_encode(array('status'=>1,'msg'=>'Branch is already exits'));
            }
            else{
                $newBranch=$this->bm->newBranch($data);
                if($newBranch){
                    echo json_encode(array('status'=>2,'msg'=>'New Branch Created'));   
                }
                else{
                    echo json_encode(array('status'=>3,'msg'=>'Try after some time latter')); 
                }


            }

        }

    } 

    function branchList(){
        $branchlist=$this->bm->branch_list();

        echo json_encode($branchlist);
    }

    function deleteBranch($id=null){
        // $data['id']=$this->input->post('id',true);
        $branch=$this->bm->checkBranch($id);
        if($branch){
            $delete_branch=$this->bm->deleteBranch($id);
            if($delete_branch){
                echo json_encode(array('status'=>2,'msg'=>'Branch Deleted Successfully'));  
            }
            else{
                echo json_encode(array('status'=>2,'msg'=>'Try after Some Time Later'));  
             
            }
        }
        else{
            echo json_encode(array('status'=>3,'msg'=>'Id Not found ')); 
               
        }
    }


}
?>