<div class="container-fluid mt-4">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header bg-success text-white py-3">
          <h5 class="mb-0">Transaction History</h5>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr align="center">
                  <th class="border-top-0">Transaction ID</th>
                  <th class="border-top-0">Sender/Recipient Name</th>
                  <th class="border-top-0">Sender/Recipient Account</th>
                  <th class="border-top-0">Amount</th>
                  <th class="border-top-0">Date</th>
                </tr>
              </thead>
              <tbody id="history">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $.ajax({
    type: "post",
    url: "<?php echo base_url('User/transaction') ?>",
    dataType: "json",
    success: function (response) {
      $.each(response.debit, function (index, transaction) {
        var amount = transaction.amount;
        var type = transaction.type;
        var amountClass = type === 'Transfer' || type === 'withdraw' ? 'text-danger' : '';
        var name = type === 'Transfer' ? transaction.toAccount : transaction.sender;
        var account = type === 'Transfer' ? transaction.toAccount : transaction.accountNumber;
        var html = '<tr align="center">' +
                   '<td>' + transaction.id + '</td>' +
                   '<td>' + name + '</td>' +
                   '<td>' + account + '</td>' +
                   '<td class="' + amountClass + '">'+'<i class="fa-solid fa-indian-rupee-sign" style="color: #b2ad1f;"></i>' + amount + '</td>' +
                   '<td>' + transaction.date + '</td>' +
                   '</tr>';
        $('#history').append(html);
      });
      var creditAccount = response.credit;
      var html = '<tr align="center">' +
                 '<td></td>' +
                 '<td></td>' +
                 '<td>Credit Account</td>' +
                 '<td>'+'<i class="fa-solid fa-indian-rupee-sign" style="color: green;"></i>' + '</td>' +
                 '<td>' + creditAccount + '</td>' +
                 '</tr>';
      $('#history').append(html);
    }
  });
});

</script>

<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="transactionType" id="creditRadio" value="credit">
  <label class="form-check-label" for="creditRadio">Credit</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="transactionType" id="debitRadio" value="debit">
  <label class="form-check-label" for="debitRadio">Debit</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="transactionType" id="bankRadio" value="bank">
  <label class="form-check-label" for="bankRadio">Bank</label>
</div>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card mb-4">
        <div class="card-header">
          <h6>Transaction Details</h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <p><strong>Transaction ID:</strong> TRX00123</p>
              <p><strong>Date:</strong> 2022-05-20 10:15:30</p>
              <p><strong>Amount:</strong> $100.00</p>
            </div>
            <div class="col-md-6">
              <p><strong>Sender Name:</strong> John Doe</p>
              <p><strong>Sender Account Number:</strong> ACC012345</p>
              <p><strong>Receiver Name:</strong> Jane Smith</p>
              <p><strong>Receiver Account Number:</strong> ACC067890</p>
            </div>
          </div>
          <hr>
          <h6>Transaction Status</h6>
          <div class="row">
            <div class="col-md-6">
              <p><strong>Status:</strong> Completed</p>
              <p><strong>Date:</strong> 2022-05-20 10:16:30</p>
            </div>
            <div class="col-md-6">
              <p><strong>Remarks:</strong> Successful transaction</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
