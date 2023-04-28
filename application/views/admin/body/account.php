<style>
		body {
	background-color: #F5F5F5;
	font-family: Arial, sans-serif;
	margin: 0;
	padding: 0;
}

.container {
	margin: 50px auto;
	max-width: 700px;
	background-color: #fff;
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	border-radius: 10px;
	overflow: hidden;
}

table {
	width: 100%;
	border-collapse: collapse;
}

th, td {
	padding: 10px;
	text-align: center;
	border-bottom: 1px solid #ddd;
}

thead {
	background-color: #2C3E50;
	color: #fff;
	font-weight: bold;
	text-align: center;
	text-transform: uppercase;
}

tbody tr:nth-child(even) {
	background-color: #f2f2f2;
}

        .search-box {
			display: flex;
			align-items: center;
			margin-bottom: 20px;
			width: 100%;
			max-width: 500px;
			margin: 0 auto;
			text-align: center;
		}
		.search-box input[type="text"] {
			padding: 8px;
			border-radius: 5px;
			border: none;
			margin-right: 10px;
			flex-grow: 1;
			font-size: 16px;
		}
		.search-box button {
			padding: 8px;
			border-radius: 5px;
			border: none;
			background-color: #4CAF50;
			color: #fff;
			cursor: pointer;
			font-size: 16px;
		}
		.search-box {
  display: flex;
  flex-direction: row;
  align-items: center;
}




</style>

<div class="search-box mt-3">
		<input type="text" id="search_input" placeholder="Search by name...">
		<!-- <input class="btn btn-success "  style="display: none;" data-bs-toggle="modal" data-bs-target="#exampleModal1" style="margin-top: 15px;" type="button" value="add money"> -->
	</div>

<!-- <input type="button" value="add money" style="display: none;" class="btn btn-success a" data-bs-toggle="modal"  data-bs-target="#exampleModal1"> -->
<!-- <input type="button" value="Withdraw" class="btn btn-success b" style="display: none;" data-bs-toggle="modal"  data-bs-target="#exampleModal"> -->
<div class="container" style="display: none;">
<table id="my-table">
      <thead>
        <tr>
          <th colspan="2">User Information</th>
        </tr>
      </thead>
      <tbody id="data">
        <!-- <tr>
          <td>Name:</td>
          <td>John Smith</td>
        </tr>
        <tr>
          <td>Account Number:</td>
          <td>1234567890</td>
        </tr>
        <tr>
          <td>Bank ID:</td>
          <td>1234</td>
        </tr>
        <tr>
          <td>Email ID:</td>
          <td>example@example.com</td>
        </tr>
        <tr>
          <td>Phone Number:</td>
          <td>+1234567890</td>
        </tr>
        <tr>
          <td>Balance:</td>
          <td>$10,000.00</td>
        </tr>
        <tr>
          <td>Opening Date:</td>
          <td>01/01/2022</td>
        </tr>
        <tr>
          <td>Account Status:</td>
          <td>Blocked</td>
        </tr> -->
      </tbody>
    </table> 
    
</div>



<form id="myform">
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="mb-3">
          <input type="hidden" id="customerId">
          <label for="userName" class="col-form-label">Name:</label>
          <input type="text" class="form-control" id="userName">
          <input type="hidden" class="form-control" id="status">
        </div>
        <div class="mb-3">
          <label for="accountNo" class="col-form-label">Account Number:</label>
          <input type="text" class="form-control" id="accountNo" required>
        </div>
        <div class="mb-3">
          <label for="amount" class="col-form-label">Amount:</label>
          <input type="text" class="form-control" id="amount" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="clearForm" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deposit">Submit</button>
      </div>
    </div>
  </div>
</div>
</form>

  


<form id="myform1">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="mb-3">
          <input type="hidden" id="id">
          <label for="userName" class="col-form-label">Name:</label>
          <input type="text" class="form-control" id="uName">
          <input type="hidden" class="form-control" id="sts">
        </div>
        <div class="mb-3">
          <label for="accountNo" class="col-form-label">Account Number:</label>
          <input type="text" class="form-control" id="acc" required>
        </div>
        <div class="mb-3">
          <label for="amount" class="col-form-label">Amount:</label>
          <input type="text" class="form-control" id="amt" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="clearForm1" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="withdrow">Withdraw</button>
      </div>
    </div>
  </div>
</div>
</form>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script>

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


$(document).ready(function() {
    // Bind a function to the input event of the search input field
   


						
					


$('#deposit').click(function(e){
  e.preventDefault();
  // Unfortunately, it appears that this account is currently unable
              
							var id=$('#customerId').val();
							var accountNo=$('#accountNo').val();
							var amount=$('#amount').val();
              var status=$('#status').val();
							// console.log(id);
              if(status==2){
                alert('Unfortunately, it appears that this account is currently unable');
                return false;
              }
              if (accountNo === '' || amount === ''  || id === '') {
      
              // $.notify("Please fill in all required fields.", "warn");
              alert('Please fill in all required fields.');
              return false;
            }

              $.ajax({
                type: "POST",
                url: "<?php echo base_url('Bank/deposit_money')  ?>",
                data: {id:id,accountNo:accountNo,amount:amount},
                dataType: "json",
                success: function (response) { 
                  
                  // $('#balance').html('<i class="fa-solid fa-indian-rupee-sign" style="color: #c8ba1e;"></i>'+" " +response.balance);
                  
                  if(response.status==1){
                    $('#amount').val('');

                    $('#exampleModal1').modal('hide');
                    updateBalance(id);
                  Swal.fire(
                'Successfull!',
                response.msg,
                'success'
              )
                }else{
                  Swal.fire(
                'Faild!',
                response.msg,
                'error')
                
              }
                  
                }
              });
            

						});


          
});
$('#clearForm').click(function(){
  $('#amount').val('');
           }); 


$('#withdrow').click(function(e){
  e.preventDefault();
  // Unfortunately, it appears that this account is currently unable
              
							var id=$('#id').val();
							var acc=$('#acc').val();
							var amt=$('#amt').val();
              var sts=$('#sts').val();
							// console.log(id);
              if(sts==2){
                alert('Unfortunately, it appears that this account is currently unable');
                return false;
              }
              if (acc === '' || amt === ''  || id === '') {
      
              // $.notify("Please fill in all required fields.", "warn");
              alert('Please fill in all required fields.');
              return false;
            }

              $.ajax({
                type: "POST",
                url: "<?php echo base_url('Bank/withdraw_money')  ?>",
                data: {id:id,accountNo:acc,amount:amt},
                dataType: "json",
                success: function (response) { 
                  if(response.status==1){
                    $('#amt').val('');
                    $('#exampleModal').modal('hide');
                    updateBalance(id);    
                  Swal.fire(
                'Successfull!',
                response.msg,
                'success'
              )
                }
                if(response.status==0){
                 
                  Swal.fire(
                'Faild!',
                response.msg,
                'info')
                
              
                }


                else if(response.status==2){
                  Swal.fire(
                'Faild!',
                response.msg,
                'error')
                
              }
                  
                }
              });
            

});


           $('#clearForm1').click(function(){
            $('#amt').val('');
 
 
 
 
 
 
 
          }); 

				

      $('#search_input').on('input', function() {
        // Get the search query from the input field
        const query = $('#search_input').val();

        // Send an AJAX request to the search endpoint to fetch the results
        $.ajax({
            url: "<?php echo base_url('Bank/searchResult');  ?>",
            type: 'POST',
            data: {data: query},
            dataType: 'json',
            success: function(result) {
                if (result.length > 0) {
                    // set the values of the input fields and disable them
                    const {id,name, accountNumber, branch_id, email, phone, balance, openaningdate, status} = result[0];
                   /* for deposit  */
                    $('#userName').val(name).prop('disabled', true);
                    $('#acc').val(accountNumber).prop('disabled', true);
                    $('#id').val(id);
                    $('#sts').val(status);
                      /* for withdraw */
                    $('#uName').val(name).prop('disabled', true);
                    $('#accountNo').val(accountNumber).prop('disabled', true);
                    $('#customerId').val(id);
                    $('#status').val(status);
                    $('.container').show();
                    $('.a').show();
                    $('.b').show();
                    $('#data').empty();
                    $('#data').append(`<tr><td>Name:</td><td>${name}</td></tr>`);
                    $('#data').append(`<tr><td>Account Number:</td><td>${accountNumber}</td></tr>`);
                    $('#data').append(`<tr><td>Bank ID:</td><td>${branch_id}</td></tr>`);
                    $('#data').append(`<tr><td>Email ID:</td><td>${email}</td></tr>`);
                    $('#data').append(`<tr><td>Phone Number:</td><td>${phone}</td></tr>`);
                    // <i class="fa-regular fa-indian-rupee-sign fa-xl" style="color: #c8ba1e;"></i>
                    $('#data').append(`<tr><td>Balance:</td><td id="balance1"><i class="fa-solid  fa-indian-rupee-sign" style="color: #c8ba1e;"></i> ${balance}</td></tr>`);
                    $('#data').append(`<tr><td>Opening Date:</td><td>${openaningdate}</td></tr>`);
                    const statusText = status == 2 ? 'Block' : 'Active';
                    const statusClass = status == 2 ? 'text-danger' : 'text-success';
                    $('#data').append(`<tr><td>Account Status:</td><td class="${statusClass}">${statusText}</td></tr>`);
                    $('#data').append(`<tr><td><input type="button" value="add money" class="btn btn-success a" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-account-number="${accountNumber}"></td><td><input type="button" value="Withdraw" class="btn btn-success b"  data-bs-toggle="modal" data-bs-target="#exampleModal" data-account-number="${accountNumber}"></td></tr>`);
                    } else {
                    $('#userName').val('').prop('disabled', false);
                    $('#accountNo').val('').prop('disabled', false);
                    $('.container').hide();
              
                    $('.a').hide();
                    $('.b').hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // show an error message if the AJAX request fails
                // console.log(`Error fetching search results: ${textStatus} - ${errorThrown}`);
            }
        });
}); 
  
function updateBalance(id){
  $.ajax({
            url: "<?php echo base_url('Bank/updateBalance');  ?>",
            type: 'POST',
            data: {data: id},
            dataType: 'json',
            success: function(response) {

                  
                // console.log(response[0].updatebala);
                // alert((response[0].updatebala));

              $('#balance1').html('<i class="fa-solid fa-indian-rupee-sign" style="color: #c8ba1e;"></i>'+" " + response.updatebala);
                   
            },
            error: function(jqXHR, textStatus, errorThrown) {

            }
        });
}




   
   
  </script>