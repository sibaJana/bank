 <style>
  .disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
</style>
<!-- ********************for create account******************** -->
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
            <input type="text"  class="form-control" id="name">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" required class="form-control" id="email">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Address:</label>
            <textarea class="form-control" required id="address"></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="formClear" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" id="branch" class="btn btn-primary">Send message</button> -->

        <input type="button" class="btn btn-primary" id="branch"  value="Submit">
      </div>
      </form>
    </div>
  </div>
</div>
 

<table class="table table-borderless mt-5" id="branchTable">
<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Open New Branch</button>
<!-- ***************END**************** -->


<table class="table table-borderless mt-5" id="branchTable">
<tr align="center">

  <th>Branch Id</th>
  <th>Branch Name</th>
  <th>Email Address</th>
  <th>Branch Address</th>
  <th>Status</th>
  <th>Action</th>
</tr>
<tbody id="listRecords"></tbody>
</table>
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
            <label for="message-text" class="col-form-label">Address:</label>
            <textarea class="form-control" required id="addressUpdate"></textarea>
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
    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

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
});
// second model 

var exampleModal1 = document.getElementById('exampleModal1')
exampleModal1.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = exampleModal1.querySelector('.modal-title')
  var modalBodyInput = exampleModal1.querySelector('.modal-body input')

  modalTitle.textContent = 'New message to ' + recipient
  modalBodyInput.value = recipient
});

$(document).ready(function(){
  branchList();
  $('#branch').click(function(){

  var name=$('#name').val();
  var email=$('#email').val();
  var address=$('#address').val();
  if (name === '' || email === '' || address === '') {
      
      $.notify("Please fill in all required fields.", "warn");
      return false;
    }
// $('#branch').addClass('disabled');
  $('#branch').val('Submitting...');
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
                      $('#branch').val('Submit');

                    
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
                },5000);





});

//delete branch 
$(document).on('click', '.delete-branch', function(e) {
  e.preventDefault();
  var branchId = $(this).data('id');
  // console.log(branchId);
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
        data:{branchId:branchId},
        url:"<?php echo base_url('Bank/deleteBranch'); ?>",
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
    branchList();


        },
        error:function(response){
          $.notify(response.msg, "error");
        }
      });
    }
  });
});

//active inactive branch

$(document).on('click', '.active-inactive', function(e) {
  e.preventDefault();
  var branchId = $(this).data('id');
  console.log(branchId);
      $.ajax({
        type:"POST",
        data:{branchId:branchId},
        url:"<?php echo base_url('Bank/updateBranchStatus'); ?>",
        dataType:"json",
        cache:false,
        success:function(response){
          branchList();

        },
        error:function(response){
          $.notify(response.msg, "error");
        }
      });
});

// show all  branch details for edit

$(document).on('click', '.editBranch', function(e) {
  e.preventDefault();
  var branchId = $(this).data('id');
  console.log(branchId);
      $.ajax({
        type:"POST",
        data:{branchId:branchId},
        url:"<?php echo base_url('Bank/getBranch'); ?>",
        dataType:"json",
        cache:false,
        success:function(response){
          // branchList();
          // console.log(response.length);
          // console.log(response[0].id);
          $('#branchId').val(response[0].id);
          $('#nameUpdate').val(response[0].name);
          $('#emailUpdate').val(response[0].email);
          $('#addressUpdate').val(response[0].address);
          

        },
        error:function(response){
          $.notify(response.msg, "error");
        }
      });
});

//update branch 
$(document).on('click', '#update', function(e) {
  var branchId=$('#branchId').val();
var name=$('#nameUpdate').val();
var email=$('#emailUpdate').val();
var address=$('#addressUpdate').val();
if (name === '' || email === '' || address === '') {
      
      $.notify("Please fill in all required fields.", "warn");
      return false;
    }
// alert(name);
// $('#branch').addClass('disabled');
$('#update').val('Updatting...');
setTimeout(function(){


$.ajax({
                  type:"POST",
                  url:"<?php echo base_url('Bank/updateBranch');  ?>",
                  data:{
                      branchId:branchId,
                      name:name,
                      email:email, 
                      address:address
                  },
                  dataType:"json",
                  cache:false,
                 
                  success:function(response){
                    branchList();
                    $('#update').removeClass('disabled');
                    $('#update').val('Update');
                    $('form')[0].reset();
                    if(response.status==1){
                        $.notify(response.msg, "info");
                       }else if(response.status==2){
                        $.notify(response.msg, "success");
                       }else if(response.status==3){
                        $.notify(response.msg, "info");
                       }
                       else if(response.status==4){
                        $.notify(response.msg, "success");
                       }else if(response.status==5){
                        $.notify(response.msg, "warn");
                       }
                  
                      }
                     
                      

                  ,error:function(response){
                    $('#update').removeClass('disabled');
                    $('#update').val('Update');
                    $.notify(response.msg, "error");
                    $('form')[0].reset();
                  }
                });
              },5000);





});



// for form clear alfer the cancle button hit
$('#formClear').click(function(e){
e.preventDefault();
$('form')[0].reset();
})

});

function branchList(){
  $.ajax({
    type: "POST",
    url: "<?php echo base_url('Bank/branchList'); ?>",
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
            '<td>' + response[i].address + '</td>' +
            '<td class="btn ' + (response[i].status == 0 ? "text-danger" : "text-success") + '">' + (response[i].status == 0 ? "Inactive" : "Active") + '</td>' +
            
            '<td>'+ 
            
            /* '<a href="<?php //echo base_url('Bank/editBranch/')?>' + response[i].id + '" id="editBranch" data-toggle="modal" data-target="#exampleModalCenter" class="text-secondary btn font-weight-bold text-xs" style="color:red" data-toggle="tooltip" data-original-title="Edit branch">'+
            '<i class="fa-solid fa-pen-to-square fa-beat fa-lg" style="color: #1a8e31;"></i>'+
            '</a>' + */

            '<a href="javascript:void(0);" class="text-secondary btn font-weight-bold text-xs editBranch " data-bs-toggle="modal" data-bs-target="#exampleModal1"   data-id="' + response[i].id + '" style="color:red" data-toggle="tooltip" data-original-title="Delete branch">'+
            '<i class="fa-solid fa-pen-to-square fa-beat fa-lg" style="color: #1a8e31;"></i>'+
            '</a>'+
            


            '<a href="javascript:void(0);" class="text-secondary btn font-weight-bold text-xs active-inactive" data-id="' + response[i].id + '" style="color:red" data-toggle="tooltip" data-original-title="Delete branch">'+
            '<i class="fa-brands fa-creative-commons-sa fa-beat fa-lg" style="color: #417ee6;"></i>'+
            '</a>'+

            '<a href="javascript:void(0);" class="text-secondary btn font-weight-bold text-xs delete-branch" data-id="' + response[i].id + '" style="color:red" data-toggle="tooltip" data-original-title="Delete branch">'+
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