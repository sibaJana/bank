<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid pe-0">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="#">
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
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="#">
                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/profile.html">
                    <i class="fa fa-user opacity-6 text-dark me-1"></i>
                    Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/sign-up.html">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                    Sign Up
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/sign-in.html">
                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                    Sign In
                  </a>
                </li>
              </ul>
           
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                  <p id="display" class="mb-0">Enter your email and password to sign in</p>
                </div>
                <div class="card-body">
                  <form id="myform" role="form">
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" name="email" id="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberme" checked="">
                      <label class="form-check-label"  for="rememberMe">Remember me</label>
                    </div>
                    <div class="text-center">
                      <button type="button" id="login" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="<?php echo base_url('Bank/singup'); ?>" class="text-info text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

 
  <script>


    $(document).ready(function(){
        $('#login').click(function(){
          $("#login").addClass("spinner");
          setTimeout(function(){

          
           var email=$('#email').val(); 
           var password=$('#password').val(); 
           var rememberme=$('#rememberme').val();
           $.ajax({
                    type:"POST",
                    url:"<?php echo base_url('Bank/singin');  ?>",
                    data:{
                        email:email,
                        password:password, 
                        rememberme:rememberme
                    },
                    dataType:"json",
                    cache:false,
                    success:function(response){
                      $("#login").removeClass("spinner");
                      $('#myform')[0].reset();
                    if(response.status==0){
                      $('#display').html('<div class="alert alert-warning" role="alert">'+response.message+'</div>');
                   
                      
                    }
                    else if(response.status==1){
                     
                      $('#display').html('<div class="alert alert-warning" role="alert">'+response.message+'</div>');
                    }
                    else if(response.status==2){
                      
                      $('#display').html('<div class="alert alert-danger" role="alert">'+response.message+'</div>');
                    }

                    else if(response.status==3){
                      
                      $('#display').html('<div class="alert alert-primary" role="alert">'+response.message+'</div>');
                    }
                    else if(response.status==4){
                      window.location.href = '<?php echo base_url("Bank/index");  ?>';
       
                    }
                        
                        
                    },
                    error:function(){

                    }
                    
                    

                });
              },2000);
              
            
            

        });
    });
  </script>
