<?php 
include('header.php');
include('connection.php');
unset($_SESSION["data"]);
?>

<div class="container">
<table class="table table-hover">
    <thead>
      <tr>
        <th>Id</th>
        <th>Customer Name</th>    
        <th>Product Name</th>
        <th>Total</th>
        <th>Card No</th>
        <th>Method</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $Query = $dbc->query("SELECT * FROM orders");
      if($Query->num_rows > 0)
      {
       while($row = $Query->fetch_assoc()) 
       { 
        $customer = $row['customerID'];
        $product = $row['proID'];
      ?>
      <tr>
        <td><?php echo $row['orderID']; ?></td>
        <td><?php 
          $Query1 = $dbc->query("SELECT customerName FROM customers WHERE customerID = '$customer' ");
        $r = $Query1->fetch_assoc(); 
        echo $r['customerName'];
        ?></td>
        <td><?php 
      $Query1 = $dbc->query("SELECT proName FROM product WHERE proID = '$product' ");
        $r = $Query1->fetch_assoc(); 
        echo $r['proName'];
        ?></td>
        <td>$<?php echo $row['total']; ?></td>
        <td><?php echo $row['cardNo'] ?></td>
        <td><?php echo $row['method'] ?></td>
        <td><?php echo $row['date']; ?></td>
        
        <td><?php echo $row['status']; ?></td>
        <td> <a href="editOrder.php?ID=<?php echo $row['orderID']; ?>">Edit</a> </td>
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