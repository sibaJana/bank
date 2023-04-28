
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
            $data['customers_id']=$this->input->post('id','true');;
            $data['branch_id']=$this->input->post('branch_id','true');
            $data['openaningdate']=date('y-m-d h:i:sa');
            $data['balance']=0;
            $data['type']='Saving';
        //   print_r($data);
            $status=$this->bm->account($data);
            
            if($status){
                $custo_status=$this->bm->cus_status($data['customers_id']);
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

    function deleteBranch(){
        // $data['id']=$this->input->post('id',true);
       $id= $this->input->post('branchId',true);
        $branch=$this->bm->checkBranch($id);
        if($branch){
            $delete_branch=$this->bm->deleteBranch($id);
            if($delete_branch){
                echo json_encode(array('status'=>1,'msg'=>'Branch has been deleted.'));  
            }
            else{
                echo json_encode(array('status'=>2,'msg'=>'Try after Some Time Later'));  
             
            }
        }
        else{
            echo json_encode(array('status'=>3,'msg'=>'Id Not found ')); 
               
        }
    }

    // active inactive branch
    public function updateBranchStatus(){
        $id= $this->input->post('branchId',true); 
        $result=$this->bm->updateBranchStatus($id);
        if($result ==1){
            $inactive=$this->bm->inactive($id);
            if($inactive){
                echo 1;
            }
            else{
                echo 0;
            }
        }
        else{
            $active=$this->bm->active($id);
            if($active){
                echo 1;
            }
            else{
                echo 0;
            }
        }
    }

    public function getBranch(){
        $id= $this->input->post('branchId',true);
        $result=$this->bm->getBranch($id);

        // echo var_dump($result);
        if(count($result)==1){
                echo json_encode($result);
        }
        else{
            echo json_encode(array('status'=>2,'msg'=>'Try after Some Time Later')); 

        }


    }
    /* public function updateBranch(){
      
        // echo var_dump($data);
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required');
        if($this->form_validation->run()==true){
            
            $branchId=$this->input->post('branchId',true);
            $data['name']=$this->input->post('name',true);
            $data['email']=$this->input->post('email',true);
            $data['address']=$this->input->post('address',true);
             
            $dataNameCheck=$this->bm->branchNameCheck($data);
            if($dataNameCheck==1){
                echo json_encode(array('status'=>4,'msg'=>'The requested branch Name already exists'));
            }
            else{
                $dataEmailCheck=$this->bm->branchEmailCheck($data);
                if($dataEmailCheck ==2){
                    echo json_encode(array('status'=>1,'msg'=>'The requested branch Email already exists')); 
                }
                else{
                    $newBranch=$this->bm->updateBranch($branchId,$data);
                if($newBranch){
                    echo json_encode(array('status'=>2,'msg'=>'The updates to the branch have been successfully applied'));   
                }
                else{
                    echo json_encode(array('status'=>3,'msg'=>'Please come back and try again later')); 
                }

                }

            }
            // echo var_dump($datacheck['data']);

        }


    } */


    public function updateBranch() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
    
        if ($this->form_validation->run() == true) {
            $branchId = $this->input->post('branchId', true);
            $data['name'] = $this->input->post('name', true);
            $data['email'] = $this->input->post('email', true);
            $data['address'] = $this->input->post('address', true);
    
            $dataNameCheck = $this->bm->branchNameCheck($data,$branchId);
            $dataEmailCheck = $this->bm->branchEmailCheck($data,$branchId);
    
            if ($dataNameCheck && $dataEmailCheck) {
                // data already exists
                echo json_encode(array('status'=>1,'msg'=>'The requested branch Name and Email already exist'));
            } else if ($dataNameCheck) {
                // name already exists
                echo json_encode(array('status'=>2,'msg'=>'The requested branch Name already exists'));
            } else if ($dataEmailCheck) {
                // email already exists
                echo json_encode(array('status'=>3,'msg'=>'The requested branch Email already exists'));
            } else {
                // data does not exist, update the branch
                $newBranch = $this->bm->updateBranch($branchId, $data);
                if ($newBranch) {
                    echo json_encode(array('status'=>4,'msg'=>'The updates to the branch have been successfully applied'));
                } else {
                    echo json_encode(array('status'=>5,'msg'=>'Please come back and try again later'));
                }
            }
        }
    }
public function userList(){
        $userList=$this->bm->userDetails();
        echo json_encode($userList);
    }
public function showUnconfirmedUser(){
    $data=$this->bm->showUnconfirmedUser();
    echo json_encode($data);
}
function deleteUser(){
   $id= $this->input->post('id',true);
//    echo $id;
//    die();
    $branch=$this->bm->checkUser($id);
    if($branch){
        $delete_branch=$this->bm->deleteData($id);
        if($delete_branch){
            echo json_encode(array('status'=>1,'msg'=>'User has been deleted.'));  
        }
        else{
            echo json_encode(array('status'=>2,'msg'=>'Try after Some Time Later'));  
         
        }
    }
    else{
        echo json_encode(array('status'=>3,'msg'=>'Id Not found ')); 
           
    }
}

public function updateUserStatus(){
    $id= $this->input->post('branchId',true); 
    $result=$this->bm->updateUserStatus($id);
    if($result ==1){
        $inactive=$this->bm->blockUser($id);
        if($inactive){
            echo 1;
        }
        else{
            echo 0;
        }
    }
    else{
        $active=$this->bm->activeUser($id);
        if($active){
            echo 1;
        }
        else{
            echo 0;
        }
    }
}

public function showData(){
    $id= $this->input->post('branchId',true);
    $result=$this->bm->getUser($id);

    // echo var_dump($result);
    if(count($result)==1){
            echo json_encode($result);
    }
    else{
        echo json_encode(array('status'=>2,'msg'=>'Try after Some Time Later')); 

    }


}

public function updateUser() {

    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('phone', 'Address', 'required');

    if ($this->form_validation->run() == true) {
        $userId = $this->input->post('id', true);
        // echo $userId;
        // die();
        $data['name'] = $this->input->post('name', true);
        $data['email'] = $this->input->post('email', true);
        $data['phone'] = $this->input->post('phone', true);

        $userPhoneCheck = $this->bm->userPhoneCheck($data,$userId);
        $userEmailCheck = $this->bm->userEmailCheck($data,$userId);

        if ($userPhoneCheck && $userEmailCheck) {
            // data already exists
            echo json_encode(array('status'=>1,'msg'=>'The requested user Phone and Email already exist'));
        } else if ($userPhoneCheck) {
            // name already exists
            echo json_encode(array('status'=>2,'msg'=>'The requested user phone already exists'));
        } else if ($userEmailCheck) {
            // email already exists
            echo json_encode(array('status'=>3,'msg'=>'The requested user Email already exists'));
        } else {
            // data does not exist, update the branch
            $newuser = $this->bm->updateUser($userId, $data);
            if ($newuser) {
                echo json_encode(array('status'=>4,'msg'=>'The updates to the branch have been successfully applied'));
            } else {
                echo json_encode(array('status'=>5,'msg'=>'Please come back and try again later'));
            }
        }
    }
}
function accounts(){
    $this->load->view('admin/header/header');
    $this->load->view('admin/header/css');
    $this->load->view('admin/header/leftnavbar');
    $this->load->view('admin/header/navbar');
    $this->load->view('admin/body/account');
    $this->load->view('admin/footer/footer');
    $this->load->view('admin/footer/js');
    $this->load->view('admin/footer/end');
}

function searchResult(){
    $query = $this->input->post('data', TRUE);
    
    $results=$this->bm->search($query);
    if($results){
    echo json_encode($results); 
    }else{
        echo json_encode(array('status'=>0,'msg'=>'No result Found'));
    }
}

// *****************Money deposit************************

public function deposit_money() {

    // Set validation rules for the form fields
     $this->form_validation->set_rules('accountNo', 'Account Number', 'required|numeric');
    $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
    $this->form_validation->set_rules('id', 'Customers id', 'required|numeric');
    
    // Run the form validation
    if ($this->form_validation->run() == true) {
        $data['customers_id']=$this->input->post('id',true);
        $data['amount']=$this->input->post('amount',true);
        $data['type']="deposit";
        $data['accountNumber']=$this->input->post('accountNo',true);
        $data['date']=date('y:m:d h:i:sa');
        // echo var_dump($data);
                    // die();
            $updated_balance = $this->bm->deposit_money($data);
            if ($updated_balance !== false) {
                /* email send code  */
                echo json_encode(array('status'=>1,'msg'=>'Money deposited successfully.'));
            } else {
                echo json_encode(array('status'=>0,'msg'=>'Money deposit failed. Please try again later.'));
            }
      

    } else {

       
    }
}

//  *****************Money withdraw************************

public function withdraw_money() {

    // Set validation rules for the form fields
     $this->form_validation->set_rules('accountNo', 'Account Number', 'required|numeric');
    $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
    $this->form_validation->set_rules('id', 'Customers id', 'required|numeric');
    
    // Run the form validation
    if ($this->form_validation->run() == true) {
        $data['customers_id']=$this->input->post('id',true);
        $data['amount']=$this->input->post('amount',true);
        $data['type']="withdraw";
        $data['accountNumber']=$this->input->post('accountNo',true);
        $data['date']=date('y:m:d h:i:sa');
            $updated_balance = $this->bm->withdraw_money($data);
            // echo $updated_balance;
            // die();
            if ($updated_balance == 1) {
                /* email send code  */
                echo json_encode(array('status'=>1,'msg'=>'Money withdraw successfully.'));
            }
            else if($updated_balance==0){
                echo json_encode(array('status'=>0,'msg'=>'Insufficient balance.'));
            }
            else if($updated_balance==2) {
                echo json_encode(array('status'=>2,'msg'=>'Money withdraw failed. Please try again later.'));
            }
         

    } else {

       
    }
}
/* ****************updateBalance******************* */
public function updateBalance(){
    $customers_id=$this->input->post('data',true);
    $updateBalance=$this->bm->updateBalance($customers_id);
    // echo $updateBalance;
    echo json_encode(array('updatebala'=>$updateBalance));

}
}
?>