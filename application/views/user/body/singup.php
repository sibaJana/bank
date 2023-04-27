<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="../pages/dashboard.html">
        Soft UI Dashboard
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="../pages/dashboard.html">
              <i class="fa fa-chart-pie opacity-6  me-1"></i>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="../pages/profile.html">
              <i class="fa fa-user opacity-6  me-1"></i>
              Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="../pages/sign-up.html">
              <i class="fas fa-user-circle opacity-6  me-1"></i>
              Sign Up
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="../pages/sign-in.html">
              <i class="fas fa-key opacity-6  me-1"></i>
              Sign In
            </a>
          </li>
        </ul>
        
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <section class="min-vh-100 mb-8">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
           
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
          <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
              <div class="card-header text-center pt-4">
                <h5>Register</h5>
              </div>
             
              
              <div class="card-body">
                <form  role="form text-left">
                  
                  <div class="mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-label="Name" aria-describedby="email-addon">
                  </div>
                  <div class="mb-3">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" aria-label="Name" aria-describedby="email-addon">
                  </div>
                  <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                  </div>
                  
                  <div class="mb-3">
                  <select class="custom-select form-control" id="branchId">
                  <option selected>Choose...</option>
                    <?php  
                    foreach($data as $val){
                      echo $val->id;
                      ?>
                    
                    <option value="<?php echo $val->id;  ?>"><?php echo $val->name;  ?></option>
                      <?php
                    }
                    
                    ?>
                  
                   
                  </select>   
                </div>
                  <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                  </div>
                  <div class="form-check form-check-info text-left">
                    <input class="form-check-input" required type="checkbox" value="" id="flexCheckDefault" checked>
                    <label class="form-check-label" for="flexCheckDefault">
                      I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                    </label>
                  </div>
                  <div class="text-center">
                    <button type="button"  id="singup" class="btn bg-gradient-dark w-100 my-4 mb-2">sing up</button>
                  </div>
                  <p class="text-sm mt-3 mb-0">Already have an account? <a href="<?php echo base_url('User/login'); ?>" class="text-dark font-weight-bolder">Sign in</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
 
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <script>
    $(document).ready( function(){
       $('#singup').click(function(){
        $("#singup").addClass("spinner");
          setTimeout(function(){
        var name=$('#name').val();
        var phone=$('#phone').val();
        var email=$('#email').val();
        var branchId=$('#branchId').val();
        var password=$('#password').val();
        
        
            if(name=="" ||phone==""|| email ==""||branchId=="" ||password== "" ){
              $.notify("All fild are required", "warn");
              $("#singup").removeClass("spinner");
                     
            }
            else{
            
              
              

              
                $.ajax({
                    type:"POST",
                    url:"<?php echo base_url('User/registration');  ?>",
                    data:{
                        name:name,
                        phone:phone,
                        email:email,
                        branchId:branchId,
                        password:password,
                        // pwd:pwd
                    },
                    dataType:"json",
                    cache:false,
                    success:function(response){
                      $("#singup").removeClass("spinner");
                      // console.log(response.message);
                        if (response.status == 1) {
                         
                          $.notify(response.message, "success");
                     
                        // displaydata();
                        $('#myForm')[0].reset();
                        }
                        else if(response.status == 2){
                          
                          $.notify(response.message, "info");
                   
                          
                        }
                        
                    },
                    error:function(response){
                      if(response.status == 3){
                        $.notify(response.message, "warn");
                      }

                    }
                    
                    

                });
              
              
            }
          
          },1000);
      

       });

  
      
    });


    



</script>