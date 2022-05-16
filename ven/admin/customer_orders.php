<?php session_start();

  require_once('../../stripe/config/db.php');
  require_once('../../stripe/lib/pdo_db.php');
  require_once('../../stripe/models/Transaction.php');
  include_once("./templates/top.php");
  include_once("menu.php");
  require_once('../../../vendor/autoload.php');
  $transaction = new Transaction();
  $transactions = $transaction->getTransactions();


  if (isset($_POST['ok'])){
      $stripe= new \Stripe\StripeClient('sk_test_51Ii0CfEDG4YchhiElIYodaBJ4UirEpXTlJR9qxwEfI17u4oRFo39EymQwJ57P0jT8TO66SaMRzK2whYEkAOsm2Kv00Y2yAf1BV');
    rem_orders($_POST['ref']);
  $price=$_POST['price'];
    $ref=$_POST['ref'];

    $refunded = $stripe->refunds->create([
       'charge' => $ref,
       'amount' => $price
     ]);
     header('Location:customer_orders.php');

  }

 ?>



<div class="container-fluid">
  <div class="row">

    <?php include "./templates/sidebar3.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Transactions</h2>
      	</div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Client</th>
              <th>Produit</th>
              <th>Prix</th>
              <th>Date</th>
              <th>Status</th>
              <th>Remboursement</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($transactions as $t): ?>
              <form method="post" action="customer_orders.php" >
              <tr>
                <input type="hidden" name="ref" value="<?=$t->id;?>">
                <input type="hidden" name="price" value="<?=$t->amount;?>">
                <td><?php echo $t->id; ?></td>
                <td><?php echo $t->customer_id; ?></td>
                <td><?php echo $t->product; ?></td>
                <td><?php echo sprintf('%.2f', $t->amount); ?> <?php echo strtoupper($t->currency); ?></td>
                <td><?php echo $t->created_at; ?></td>
                <td><?php echo $t->status; ?></td>
            <?php  if ($t->status=="canceled") {?> <td><button name="ok" class="btn btn-sm btn-success remb-user"><i class="fa-solid fa-check"></i></button></td><?php } ?>
              </tr>

            </form>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>



<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/customers.js"></script>
