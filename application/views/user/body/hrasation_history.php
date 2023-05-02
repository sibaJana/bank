
<?php //print_r($data);
// echo $userid;
// die();
?>



<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <?php if(empty($data)): ?>
        <div class="alert alert-warning">No data found</div>
      <?php else: ?>
        <?php foreach($data['data'] as $d): ?>
          <div class="card mb-4 transaction-card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <p><strong>Transaction ID:</strong> <?php echo $d->transaction_id; ?></p>
                  <?php  
                  if($d->receiver_id ==$userid){
                    ?>
                    <p><strong>Amount:</strong> <span class="text-success" ><b><?php echo "+". $d->amount; ?></b></span> </p>
                    <?php
                  }
                  else{
                    ?>
                    <p><strong>Amount:</strong> <span class="text-danger" ><b><?php echo "-".$d->amount; ?></b></span> </p>
                    <?php
                  }
                  ?>
                  
                </div>
                <div class="col-md-6">
                  <?php 

                    if($d->receiver_id ==$userid){
                      ?>
                      <p><strong>Received Form:</strong> <?php echo $d->sender_name; ?></p>
                      <p><strong>Sender Account :</strong> <?php echo $d->sender_account; ?></p>
                      <?php

                    }else{
                      ?>
                  <p><strong>Receiver Name:</strong> <?php echo $d->receiver_name; ?></p>
                  <p><strong>Receiver Account :</strong> <?php echo $d->receiver_account; ?></p>
                      <?php
                    }
                  
                  ?>

                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <p><strong>Transaction Status:</strong> <?php if($d->status==0){
                    echo 'Failed';
                  }else{
                    echo 'Successful'; 
                  }  ?></p>
                  <p><strong>Date:</strong> <?php echo $d->transaction_date; ?></p>
                </div>
                <div class="col-md-6">
                  <p><strong>Remarks:</strong> <?php echo $d->remarks; ?></p>
                </div>
              </div>
            </div>
          </div>
          <div style="margin-bottom: 20px;"></div> <!-- Add margin-bottom to create gap -->
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>


<style>
.animate-card {
  opacity: 0;
  transform: translateY(20px);
  transition: all 0.3s ease-out;
}

.animate-card.animate-card-show {
  opacity: 1;
  transform: translateY(0);
}

</style>

<script>
function animateOnScroll() {
  const cards = document.querySelectorAll('.animate-card');

  cards.forEach(card => {
    const rect = card.getBoundingClientRect();
    const windowHeight = window.innerHeight;
    const topOffset = rect.top;

    if (topOffset < windowHeight - 50) {
      card.classList.add('animate-card-show');
    }
  });
}

animateOnScroll(); // Call the function once on page load

window.addEventListener('scroll', animateOnScroll); // Call the function on scroll

</script>



