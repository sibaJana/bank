
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Inactive Account Tables</h6>
            </div>
            <form action="">
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead >
                    <tr align-item="center">
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User Id</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email Id</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Account Number</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Balance</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody id="listRecords">
                  </tbody>
                </table>
              </div>
            
            </div>
           </form>
          </div>
        </div>
      </div>
    
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Projects table</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr align="center">
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User Id</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email Id</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone Number</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Action</th>
                      <th></th>
                      <form><input type="hidden" id="branchId" value=""></form>
                      
                    </tr>
                  </thead>
                  <tbody id="user">
                    
                   <!--  <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Spotify</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">$2,500</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">working</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">60%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td>
                    </tr> -->
                    <!-- <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="../assets/img/small-logos/logo-invision.svg" class="avatar avatar-sm rounded-circle me-2" alt="invision">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Invision</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">$5,000</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">done</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">100%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td>
                    </tr> -->
                    <!-- <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="../assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm rounded-circle me-2" alt="jira">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Jira</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">$3,400</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">canceled</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">30%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30" style="width: 30%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td>
                    </tr> -->
                    <!-- <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="../assets/img/small-logos/logo-slack.svg" class="avatar avatar-sm rounded-circle me-2" alt="slack">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Slack</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">$1,000</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">canceled</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">0%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: 0%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td>
                    </tr> -->
                    <!-- <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="../assets/img/small-logos/logo-webdev.svg" class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Webdev</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">$14,000</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">working</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">80%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width: 80%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td>
                    </tr> -->
                    <!-- <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm rounded-circle me-2" alt="xd">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Adobe XD</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">$2,300</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">done</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">100%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td>
                    </tr> -->
                  </tbody>
                </table>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer> -->
    </div>
    </main>
    <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <hr class="horizontal dark my-sm-4">
        <!-- <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard">Free Download</a> -->
        <!-- <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View documentation</a> -->
        <div class="w-100 text-center">
          <!-- <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a> -->
          <!-- <h6 class="mt-3">Thank you for sharing!</h6> -->
          <!-- <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank"> -->
            <!-- <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet -->
          <!-- </a> -->
          <!-- <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank"> -->
            <!-- <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share -->
          <!-- </a> -->
        </div>
      </div>
    </div>
  </div>

    
  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" name="branchId" id="branchId">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text"  class="form-control" id="nameUpdate">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" required class="form-control" id="emailUpdate">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Phone:</label>
            <input type="text" required class="form-control" id="phoneUpdate">
          </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="formClear" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" id="branch" class="btn btn-primary">Send message</button> -->

        <input type="button" class="btn btn-primary" id="update"  value="Update">
      </div>
      </form>
    </div>
  </div>
</div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script>

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    $(document).ready(function(){
      userlist();
      alluser();

      // account delete
$(document).on('click', '.deleteUser', function(e) {
  e.preventDefault();
  var id = $(this).data('id');
  console.log(id);
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type:"POST",
        data:{id:id},
        url:"<?php echo base_url('Bank/deleteUser'); ?>",
        dataType:"json",
        cache:false,
        success:function(response){
          $('form')[0].reset();
          if(response.status==1){
            Swal.fire(
      'Deleted!',
      response.msg,
      'success'
    )
          }
          else if(response.status==2){
            Swal.fire(
      'Error!',
      response.msg,
      'error'
    )
          }
          else if(response.status==3){
            Swal.fire(
      'Warning!',
      response.msg,
      'warning'
    )
          }
          userlist();


        },
        error:function(response){
          $.notify(response.msg, "error");
        }
      });
    }
  });
});


// account block by admin

$(document).on('click', '.blockUser', function(e) {
  e.preventDefault();
  var branchId = $(this).data('id');
  console.log(branchId);
      $.ajax({
        type:"POST",
        data:{branchId:branchId},
        url:"<?php echo base_url('Bank/updateUserStatus'); ?>",
        dataType:"json",
        cache:false,
        success:function(response){
          userlist();

        },
        error:function(response){
          $.notify(response.msg, "error");
        }
      });
});


//edit user details

// show all  branch details for edit

$(document).on('click', '.showData', function(e) {
  e.preventDefault();
  var branchId = $(this).data('id');
  console.log(branchId);
      $.ajax({
        type:"POST",
        data:{branchId:branchId},
        url:"<?php echo base_url('Bank/showData'); ?>",
        dataType:"json",
        cache:false,
        success:function(response){
          // branchList();
          // console.log(response.length);
          // console.log(response[0].id);
          $('#branchId').val(response[0].id);
          $('#nameUpdate').val(response[0].name);
          $('#emailUpdate').val(response[0].email);
          $('#phoneUpdate').val(response[0].phone);
          

        },
        error:function(response){
          $.notify(response.msg, "error");
        }
      });
});


// update user details

$(document).on('click', '#update', function(e) {
var id=$('#branchId').val();
var name=$('#nameUpdate').val();
var email=$('#emailUpdate').val();
var phone=$('#phoneUpdate').val();
if (name === '' || email === '' || phone === '') {
      
      $.notify("Please fill in all required fields.", "warn");
      return false;
    }
// alert(name);
// $('#branch').addClass('disabled');
$('#update').val('Updatting...');
setTimeout(function(){


$.ajax({
                  type:"POST",
                  url:"<?php echo base_url('Bank/updateUser');  ?>",
                  data:{
                      id:id,
                      name:name,
                      email:email, 
                      phone:phone
                  },
                  dataType:"json",
                  cache:false,
                 
                  success:function(response){
                    userlist();
                    $('#update').removeClass('disabled');
                    $('#update').val('Update');
                    $('form')[0].reset();
                    if(response.status==1){
                        $.notify(response.msg, "warn");
                       }else if(response.status==2){
                        $.notify(response.msg, "warn");
                       }else if(response.status==3){
                        $.notify(response.msg, "warn");
                       }
                       else if(response.status==4){
                        $.notify(response.msg, "success");
                       }else if(response.status==5){
                        $.notify(response.msg, "error");
                       }
                  
                      }
                     
                      

                  ,error:function(response){
                    $('#update').removeClass('disabled');
                    $('#update').val('Update');
                    $.notify(response.msg, "error");
                    $('form')[0].reset();
                  }
                });
              },2000);





});
    















// all user accout verification and confirm account

  
      // account nuber created
$(document).on('click', '.UnverifiedUser', function(e) {
  e.preventDefault();
  var id = $(this).data('id');
  var branch_id = $('#branchId').val();
  // alert(userId);
  // console.log(branchId);
  Swal.fire({
  title: 'Do you want to approve the account',
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: 'Approve',
  denyButtonText: `Don't approve`,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type:"POST",
        data:{id:id,branch_id:branch_id},
        url:"<?php echo base_url('Bank/UserAccountcreate'); ?>",
        dataType:"json",
        cache:false,
        success:function(response){
          alluser();

          if(response.status==0){
            Swal.fire('Not Save!', '', 'warning');
          }
          else if(response.status==1){
            Swal.fire('Saved!', '', 'success');
          }
          else if(response.status==2){
            Swal.fire('Not Save!', '', 'error'); 
          }
        },
        error:function(response){
          $.notify(response.msg, "error");
        }
      });
    }
  });
});
  });
// function for unverified user

function alluser(){

  $.ajax({
    type: "POST",
    url: "<?php echo base_url('Bank/showUnconfirmedUser'); ?>",
    async: false,
    dataType: "json",
    cache: false,
    success:function(response){
      userlist();
    console.log(response.length);
    $('#user').empty();
    for (var i = 0; i < response.length; i++) {
        // Append the new data
        // $('#branchId').val(response[i].branch_id);
        $('#user').append('<tr align="center">' +
            '<td>' + response[i].id + '</td>' +
            '<td>' + response[i].name + '</td>' +
            '<td>' + response[i].email + '</td>' +
            '<td>' + response[i].phone + '</td>' +
            
            '<td>' + response[i].date+ '</td>' + 
             +$('#branchId').val(response[i].branch_id)  +
            '<td>'+ 
            '<a href="javascript:void(0);" class="text-secondary btn font-weight-bold text-xs UnverifiedUser " data-id="' + response[i].id + '" style="color:red" data-toggle="tooltip" data-original-title="Delete branch">'+
            '<i class="fa-solid fa-check fa-beat-fade fa-xl" style="color: #1cca1e;"></i>'+
            '</a>'+
            '</td>'+
            '</tr>');
    }
  }
  ,
    error: function(response){                   
    }
  });
}


// here all the user account active and deactive happen
function userlist(){
  $.ajax({
    type: "POST",
    url: "<?php echo base_url('Bank/userList'); ?>",
    async: false,
    dataType: "json",
    cache: false,
    success:function(response){
    console.log(response.length);
    // Clear the existing data from the table
    $('#listRecords').empty();
    for (var i = 0; i < response.length; i++) {
        // Append the new data
        $('#listRecords').append('<tr align="center">' +
            '<td>' + response[i].id + '</td>' +
            '<td>' + response[i].name + '</td>' +
            '<td>' + response[i].email + '</td>' +
            '<td>' + response[i].accountNumber + '</td>' +
            '<td>'+'<i class="fa-solid fa-indian-rupee-sign  fa-lg" style="color: #b2ad1f;"></i>'+" " + response[i].balance + '</td>' +
            '<td class=" ' + (response[i].status == 2 ? "text-danger" : "text-success") + '">' + (response[i].status == 2 ? "Block" : "Active") + '</td>' +

            '<td>'+ 
            '<a href="javascript:void(0);" class="text-secondary btn font-weight-bold text-xs showData " data-bs-toggle="modal" data-bs-target="#exampleModal1"   data-id="' + response[i].id + '" style="color:red" data-toggle="tooltip" data-original-title="Delete branch">'+
            '<i class="fa-solid fa-pen-to-square fa-beat fa-lg" style="color: #1a8e31;"></i>'+
            '</a>'+
            '<a href="javascript:void(0);" class="text-secondary btn font-weight-bold text-xs blockUser" data-id="' + response[i].id + '" style="color:red" data-toggle="tooltip" data-original-title="Delete branch">'+
            '<i class="fa-brands fa-creative-commons-sa fa-beat fa-lg" style="color: #417ee6;"></i>'+
            '</a>'+
            '<a href="javascript:void(0);" class="text-secondary btn font-weight-bold text-xs deleteUser" data-id="' + response[i].id + '" style="color:red" data-toggle="tooltip" data-original-title="Delete branch">'+
            '<i class="fa-regular fa-trash-can fa-beat fa-lg" style="color: #d80e0e;"></i>'+
            '</a>'+   
            '</td>'+
            '</tr>');
    }

   
		
							
		
	




  }
  ,
    error: function(response){                   
    }
  });
}
  </script>