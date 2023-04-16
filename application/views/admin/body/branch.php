<!-- <main class="main-content  mt-0">
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
                <h5>Branch</h5>
              </div>
              <?php //echo validation_errors(); ?>
              <div class="card-body">
                <form role="form text-left">
                  <div class="mb-3">
                    <input type="text" class="form-control" id="name" placeholder="Name" aria-label="Name" aria-describedby="email-addon">
                  </div>
                  <div class="mb-3">
                    <input type="email" class="form-control" id="email" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                  </div>
                  <div class="mb-3">
                    <input type="address" class="form-control" placeholder="address" id="address" aria-label="address" aria-describedby="password-addon">
                  </div>
                 
                  <div class="text-center">
                    <button type="button" id="branch" class="btn bg-gradient-dark w-100 my-4 mb-2">New Branch</button>
                  </div>
                     </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
     </main>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
     <script>
        $('document').ready(function(){
            $('#branch').click(function(){
                var name=$('#name').val();
                var email=$('#email').val();
                var address=$('#address').val();
                // alert('hi');
                $.ajax({
                    type:"POST",
                    url:"<?php //echo base_url('Bank/branchCreate');  ?>",
                    data:{
                        name:name,
                        email:email, 
                        address:address
                    },
                    dataType:"json",
                    cache:false,
                    success:function(response){
                        console.log(response);
                        if(response.status==1){
                            toastr.warning(response.msg, 'Warning', {
                                "positionClass": "toast-top-right",
                                "timeOut": "5000",
                                "extendedTimeOut": "2000",
                                "closeButton": true,
                                "progressBar": true,
                                "background-color": "orange",
                               
                            });

                        }
                        else if(response.status==2){
                            toastr.success(response.msg, 'success', {
                                "positionClass": "toast-top-right",
                                "timeOut": "5000",
                                "extendedTimeOut": "2000",
                                "closeButton": true,
                                "progressBar": true,
                                
                               
                            });

                        }
                        else if(response.status==3){
                            toastr.warning(response.msg, 'error', {
                                "positionClass": "toast-top-right",
                                "timeOut": "5000",
                                "extendedTimeOut": "2000",
                                "closeButton": true,
                                "progressBar": true,
                                "background-color": "red",
                                
                            });

                        }

                    },error:function(response){

                    }
                });
            });
        });
     </script> -->
     <style>
  .disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
</style>
<div class="container">  
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" require  class="form-control" id="name">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" require class="form-control" id="email">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Address:</label>
            <textarea class="form-control" require id="address"></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="branch" class="btn btn-primary">Send message</button>
      </div>
      </form>
    </div>
  </div>
</div>
<form >
  <input type="hidden" id="branchid">
</form>
<table class="table table-borderless mt-5" id="branchTable">
<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Open New Branch</button>

<tr>

  <th>Branch Id</th>
  <th>Branch Name</th>
  <th>Branch Address</th>
  <th>Action</th>
</tr>
<tbody></tbody>
</table>
</div> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

<script>
  var exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = exampleModal.querySelector('.modal-title')
  var modalBodyInput = exampleModal.querySelector('.modal-body input')

  modalTitle.textContent = 'New message to ' + recipient
  modalBodyInput.value = recipient
})

$(document).ready(function(){
  // branchList();
$('#branch').click(function(){
$('#branch').addClass('disabled');
$('#branch').val('Submitting...');
  var name=$('#name').val();
  var email=$('#email').val();
  var address=$('#address').val();
  
setTimeout(function(){


  $.ajax({
                    type:"POST",
                    url:"<?php echo base_url('Bank/branchCreate');  ?>",
                    data:{
                        name:name,
                        email:email, 
                        address:address
                    },
                    dataType:"json",
                    cache:false,
                    success:function(response){
                      branchList();
                      $('#branch').removeClass('disabled');
                      $('#branch').val('Send message');
                        // console.log(response);
                       if(response.status==1){
                        $.notify(response.msg, "info");
                       }else if(response.status==2){
                        $.notify(response.msg, "success");
                       }else if(response.status==3){
                        $.notify(response.msg, "warn");
                       }
                        }
                       
                        

                    ,error:function(response){
                      $('#branch').removeClass('disabled');
                      $('#branch').val('Submit');
                      $.notify(response.msg, "error");
                    }
                  });
                },2000);





});
// delete id
$('#deleteBranch').click(function(){
  // var id =$('#deleteBranch').val();
  // alert(id);
  $.ajax({
                    type:"POST",
                    url:"<?php echo base_url('Bank/deleteBranch');  ?>",
                    dataType:"json",
                    cache:false,
                    success:function(response){
                      // branchList();
                       if(response.status==1){
                        // alert('hello');

                        $.notify(response.msg, "info");
                       }else if(response.status==2){
                        $.notify(response.msg, "success");
                       }else if(response.status==3){
                        $.notify(response.msg, "warn");
                       }
                        }
                       
                        

                    ,error:function(response){
                      $('#branch').removeClass('disabled');
                      $('#branch').val('Submit');
                      $.notify(response.msg, "error");
                    }
                  });

});

});

function branchList(){

  $.ajax({
                    type:"POST",
                    url:"<?php echo base_url('Bank/branchList');  ?>",
                    async : false,
                    dataType:"json",
                    // cache:false,
                    success:function(response){
                      console.log(response.length);
                 for (var i = 0; i < response.length; i++) {
                  
                $('#branchTable tbody').append('<tr>' +
                    '<td>' + response[i].id + '</td>' +
                    '<td>' + response[i].name + '</td>' +
                    '<td>' + response[i].address + '</td>' +
                    '<td>'+ '<a href="<?php echo base_url('Bank/editBranch/')?>' + response[i].id + '" id="editBranch" data-toggle="modal" data-target="#exampleModalCenter" class="text-secondary btn font-weight-bold text-xs" style="color:red" data-toggle="tooltip" data-original-title="Edit branch">'+
                    '<i class="fa-solid fa-pen-to-square fa-beat fa-lg" style="color: #1a8e31;"></i>'+
                    '</a>' +

                    '<a href="<?php echo base_url('Bank/viewBranch/')?>' + response[i].id + '" id="viewBranch" class="text-secondary btn font-weight-bold text-xs" style="color:red" data-toggle="tooltip" data-original-title="View branch">'+
                    '<i class="fa-brands fa-creative-commons-sa fa-beat fa-lg" style="color: #417ee6;"></i>'+
                    '</a>'+

                    '<a href="<?php echo base_url('Bank/deleteBranch/')?>' + response[i].id + '" id="deleteBranch" class="text-secondary btn font-weight-bold text-xs" style="color:red" data-toggle="tooltip" data-original-title="Delete branch">'+
                    '<i class="fa-regular fa-trash-can fa-beat fa-lg" style="color: #d80e0e;"></i>'+
                    '</a>'+
                    
                    '</td>'+
                    '</tr>');
            }
                                    
                        }
                        ,error:function(response){
                   
                    }
                  });


                  
}
</script>