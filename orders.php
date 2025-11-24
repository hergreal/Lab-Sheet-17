<?php
session_start();
$title ='Orders';
include 'functions/orders.php';   // contains getAllOrders() and findOrders()

// Fetch all invoices
if(isset($_POST['search'])){
  $search = $_POST['txtsearch'];
  $orders = findOrders($search);
}else{
  $orders = getAllOrders();
}
?>
<!doctype html>
<html lang="en">
  <?php include 'components/head.php'; ?>
  <body>
  <?php include 'components/nav-bar.php'; ?>

<div class="container-fluid">
  <div class="row">

    <?php include 'components/side-bar.php'; ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Orders</h1>        
      </div>

      <!-- Search form -->
      <form method="post">
        <div class="row">
          <div class="col-6">
              <label for="search">Search Invoice # or Customer</label>
              <input type="text" class="form-control" name="txtsearch">
          </div>
          <div class="col-6 mt-4">
            <input type="submit" name="search" value="Search" class="btn btn-primary">
          </div>
        </div>
      </form>

      <div class="table-responsive mt-4">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Invoice #</th>
              <th>Customer Name</th>
              <th>Date</th>
              <th>Sub Total</th>
              <th>Tax</th>
              <th>Total</th>
            </tr>
          </thead>
          
          <tbody>
          <?php
          foreach($orders as $order){

            // format date (ex: 11 NOV 2025)
            $date = date("d M Y", strtotime($order['inv_date']));

            // format money
            $sub = number_format($order['inv_subtotal'], 2);
            $tax = number_format($order['inv_tax'], 2);
            $total = number_format($order['inv_total'], 2);
          ?>
            <tr>
              <td><?= $order['invoice_id'] ?></td>
              <td><?= $order['customer_name'] ?></td>
              <td><?= $date ?></td>
              <td><?= $sub ?></td>
              <td><?= $tax ?></td>
              <td><?= $total ?></td>
            </tr>
          <?php } ?>           
          </tbody>

        </table>
      </div>

    </main>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<script src="js/dashboard.js"></script>
  </body>
</html>
