
<div class="container-fluid py-4">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 style="text-align: center;">Money Transfer</h6>
        </div>
        <form id="transferForm">
          <div class="card-body px-5 pt-4 pb-3">
            
            <div class="form-group">
              <label for="toAccount" style="font-weight: bold; color: #333;">To Account</label>
              <input type="text" name="toAccount" id="toAccount" class="form-control" placeholder="Enter recipient account number" aria-label="To Account" aria-describedby="toAccount-addon" style="border-radius: 10px;">
              <span id="name"></span>
            </div>
            <div class="form-group">
              
              <!-- <input type="text" name="toAccount" id="toAccount" class="form-control" placeholder="Enter recipient account number" aria-label="To Account" aria-describedby="toAccount-addon" style="border-radius: 10px;"> -->
            </div>
            <div class="form-group">
              <label for="amount" style="font-weight: bold; color: #333;">Amount</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">$</span>
                </div>
                <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter transfer amount" aria-label="Transfer Amount" aria-describedby="amount-addon" style="border-radius: 10px;">
              </div>
            </div>
            <div class="form-group">
              <label for="remarks" style="font-weight: bold; color: #333;">Remarks</label>
              <input type="text" name="remarks" id="remarks" class="form-control" placeholder="Enter remarks (optional)" aria-label="Remarks" aria-describedby="remarks-addon" style="border-radius: 10px;">
            </div>
            <input type="button" value="transfer" id="transfer" class="btn btn-success btn-block mt-3" style="background-color: #008080; border: none; border-radius: 10px;">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!-- include toastr CSS and JS files -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function(){
      $('#toAccount').blur( function() {
            var toAccount = $(this).val();
            reciverDetails(toAccount);
            });
        $('#transfer').click(function(e){
            e.preventDefault();
            var $btn = $(this);
            var toAccount=$('#toAccount').val();
            var remarks=$('#remarks').val();
            var amount=$('#amount').val();
    if (toAccount === '') {
      // Display a Toasted alert for the income field
      toastr.error('Please enter your Reciver Account.', {
        duration: 3000,
        position: 'bottom-right'
      });
      return false;
    }
    if (amount === '') {
      // Display a toastr alert for the amount field
      toastr.error('Please enter the Transfer amount.', {
        duration: 3000,
        position: 'bottom-right'
      });
      return false;
    }
    // If all form fields are filled out, submit the form
    $(this).submit();

    $btn.prop('disabled', true);
    $btn.val('Processing...');
    setTimeout(function(){
            $.ajax({
                type: "post",
                url: "<?php echo base_url('User/transfer');  ?>",
                data: {toAccount:toAccount,amount:amount,remarks:remarks},
                dataType: "json",
                success: function (response) {
                  $('#transferForm')[0].reset();
                  $btn.prop('disabled', false);
                  $btn.val('Transfer');
                  if(response.status==1){
                    toastr.info(response.msg, {
                  duration: 3000,
                  position: 'bottom-right'
                  });
                  }
                  else if(response.status==2){
                    toastr.info(response.msg, {
                  duration: 3000,
                  position: 'bottom-right'
                  });
                  }
                  else if(response.status==3){
                    toastr.error(response.msg, {
                  duration: 3000,
                  position: 'bottom-right'
                  });
                  }
                  else if(response.status==4){
                    Swal.fire(
                    'successfully!!',
                    status.msg,
                    'success'
                  )
                  }
                  else if(response.status==5){
                    toastr.error(response.msg, {
                  duration: 3000,
                  position: 'bottom-right'
                  });
                  }
                    
                }
            });
          },3000)
           
     
        });
    });

    function reciverDetails(toAccount){

  $.ajax({
    url: "<?php echo base_url('User/reciverDetails');  ?>",
    method: 'POST',
    dataType: 'json',
    data: { toAccount: toAccount },
    success: function(response) {
      // Display the results on the page
      $('#name').html(response[0].name);
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });


    }

</script>

    
      
    