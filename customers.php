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
        <th>Email</th>
        <th>Gender</th>
        <th>Previous Order</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $Query = $dbc->query("SELECT * FROM customers");
      if($Query->num_rows > 0)
      {
       while($row = $Query->fetch_assoc()) 
       { 
      ?>
      <tr>
        <td><?php echo $row['customerID']; ?></td>
        <td><?php echo $row['customerName']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['gender']; ?></td>
        <td> <a href="customerOrder.php?cid=<?php echo $row['customerID']; ?>&cname=<?php echo $row['customerName']; ?>">Orders</a> </td>
        <td><?php echo $row['date']; ?></td>
        
        <td><?php echo $row['status']; ?></td>
        <td> <a href="editCustomer.php?ID=<?php echo $row['customerID']; ?>">Edit</a> </td>
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