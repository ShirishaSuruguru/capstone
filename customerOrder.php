<?php 

include('header.php');
include('connection.php');
unset($_SESSION["data"]);
?>

<div class="container">
<table class="table table-hover">
    <thead>
      <tr>
        <th>Customer Name</th>    
        <th>Product</th>
        <th>Total</th>
        <th>Method</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $customerId = $_GET['cid'];
      $customerName = $_GET['cname'];
      $Query = $dbc->query("SELECT * FROM orders WHERE customerID = '$customerId' ");
      if($Query->num_rows > 0)
      {
       while($row = $Query->fetch_assoc()) 
       { 
      ?>
      <tr>
        <td><?php echo $customerName; ?></td>
        <td><?php 
        $sb = $row['proID'];
        $Query1 = $dbc->query("SELECT proName FROM product WHERE proID = '$sb' ");
        $row1 = $Query1->fetch_assoc();
        echo $row1['proName'];
        ?></td>
        <td><?php echo $row['total']; ?></td>
        <td><?php echo $row['method']; ?></td>
        <td><?php echo $row['date']; ?></td>      
        <td><?php echo $row['status']; ?></td>
      </tr>
      <?php 
  }
}
      ?>
    </tbody>
  </table>
</div>
<?php 
include('footer.php');
?>