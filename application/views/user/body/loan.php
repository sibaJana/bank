
<div class="container-fluid py-4">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 style="text-align: center;">Loan Request</h6>
        </div>
        <form id="loanform">
          <div class="card-body px-5 pt-4 pb-3">
            <div class="form-group">
              <label for="income" style="font-weight: bold; color: #333;">Income</label>
              <input type="text" name="income" id="income" class="form-control" placeholder="Your Yearly Income" aria-label="income" aria-describedby="email-addon" style="border-radius: 10px;">
            </div>
            <div class="form-group">
            <label for="occupation" style="font-weight: bold; color: #333;">Occupation</label>
            <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Enter your occupation" aria-label="Occupation" aria-describedby="occupation-addon" style="border-radius: 10px;">
            </div>
            <div class="form-group">
              <label for="amount" style="font-weight: bold; color: #333;">Loan Amount</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">$</span>
                </div>
                <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter loan amount" aria-label="Loan Amount" aria-describedby="amount-addon" style="border-radius: 10px;">
              </div>
            </div>
            <div class="form-group">
              <label for="term" style="font-weight: bold; color: #333;">Loan Term</label>
              <select name="term" id="term" class="form-control" style="border-radius: 10px;">
                <option value="12">12 months</option>
                <option value="24">24 months</option>
                <option value="36">36 months</option>
              </select>
            </div>
            <div class="form-group">
              <label for="loanType" style="font-weight: bold; color: #333;">Loan Type</label>
              <select name="loanType" id="loanType" class="form-control" style="border-radius: 10px;">
                <option value="Education Loan">Education Loan</option>
                <option value="Home Loan">Home Loan</option>
                <option value="Car Loan">Car Loan</option>
              </select>
            </div>
            <input type="button" value="apply" id="loan" class="btn btn-success btn-block mt-3" style="background-color: #008080; border: none; border-radius: 10px;">
  </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!-- include toastr CSS and JS files -->


<script>
    $(document).ready(function(){
        $('#loan').click(function(e){
            e.preventDefault();
            var $btn = $(this);
            var income=$('#income').val();
            var occupation=$('#occupation').val();
            var amount=$('#amount').val();
            var term=$('#term').val();
            var loanType=$('#loanType').val();

            if (income === '') {
      // Display a Toasted alert for the income field
      toastr.error('Please enter your yearly income.', {
        duration: 3000,
        position: 'bottom-right'
      });
      return false;
    }
    if (occupation === '') {
      // Display a Toasted alert for the income field
      toastr.error('Please enter your yearly income.', {
        duration: 3000,
        position: 'bottom-right'
      });
      return false;
    }

    if (amount === '') {
      // Display a toastr alert for the amount field
      toastr.error('Please enter the loan amount.', {
        duration: 3000,
        position: 'bottom-right'
      });
      return false;
    }

    if (term === '') {
      // Display a toastr alert for the term field
      toastr.error('Please select the loan term.', {
        duration: 3000,
        position: 'bottom-right'
      });
      return false;
    }

    if (loanType === '') {
      // Display a toastr alert for the type field
      toastr.error('Please select the loan type.', {
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

      

            // toastr.success('Loan application submitted successfully');
            $.ajax({
                type: "post",
                url: "<?php echo base_url('User/loanApplication');  ?>",
                data: {income:income,occupation:occupation,amount:amount,term:term,loanType:loanType},
                dataType: "json",
                success: function (response) {
                  $('#loanform')[0].reset();
                  $btn.prop('disabled', false);
                  $btn.val('applyed');
                  if(response.status==1){
                    toastr.error(response.msg, {
                  duration: 3000,
                  position: 'bottom-right'
                  });
                  }
                  else if(response.status==2){
                    toastr.success(response.msg, {
                  duration: 3000,
                  position: 'bottom-right'
                  });
                  }
                  else{
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

</script>

    
      
    