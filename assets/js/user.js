
 $(document).ready(function(){
  display();
  atm_display();
  $('#atm_applay').click(function(e){
    e.preventDefault();
    $.ajax({
      type: "post",
      url: "<?php echo base_url('User/applayAtm'); ?>",
      dataType: "json",
      success: function (response) {
        if(response.status==1){
          toastr.success(response.msg, {
        duration: 3000,
        position: 'bottom-center'
        
      });
      display();
        }else{
          toastr.error(response.msg, {
        duration: 3000,
        position: 'bottom-right'
      });
        }
      }
    });
  });

function display(){
  var userid=$('#userid').val();
  $.ajax({
      type: "post",
      url: "<?php echo base_url('User/atmDisplay'); ?>",
      data:{userid:userid},
      dataType: "json",
      success: function (response) {

        if(response.status==1){
          $('#debitcard').hide();
        }
    



        }
      
    });
}

function atm_display(){
  
    var user_id=$('#user_id').val();
    $.ajax({
        type: "post",
        url: "<?php echo base_url('User/atm_display'); ?>",
        data:{user_id:user_id},
        dataType: "json",
        success: function (response) {
  
          if(response.status==0){
            $('#atm_display').hide();
          }
      
  
  
  
          }
        
      });
  
  
  }
  /* for loan */

  
    
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
    /* money transafer */

    

    
      $('#receiver_account').blur( function() {
            var receiver_account = $(this).val();
            reciverDetails(receiver_account);
            });
        $('#transfer').click(function(e){
            e.preventDefault();
            var $btn = $(this);
            var receiver_account=$('#receiver_account').val();
            var remarks=$('#remarks').val();
            var amount=$('#amount').val();
            var receiver_id=$('#receiver_id').val();
            var receiver_name=$('#receiver_name').val();
    if (receiver_account === '') {
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
                data: {receiver_account:receiver_account,receiver_id:receiver_id,receiver_name:receiver_name,amount:amount,remarks:remarks},
                dataType: "json",
                success: function (response) {
                  $('#transferForm')[0].reset();
                  $('#name').val('');
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
    // });

    function reciverDetails(receiver_account){

  $.ajax({
    url: "<?php echo base_url('User/reciverDetails');  ?>",
    method: 'POST',
    dataType: 'json',
    data: { receiver_account: receiver_account },
    success: function(response) {
      // Display the results on the page
      $('#name').html(response[0].name);
      $('#receiver_id').val(response[0].id);
      $('#receiver_name').val(response[0].name);
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });



    }
    function moveToNext(input) {
  if (input.value.length == 1) {
    $(input).next('input').focus();
  }
}





 }); // ready function


  





  