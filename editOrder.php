<?php 
include('header.php');
include('connection.php');

if(isset($_GET['ID']))
{
	$id = $_GET['ID'];
	$Q1 = "SELECT * FROM orders WHERE orderID = '$id' ";
	$result = $dbc->query($Q1);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$_SESSION['data'] = $row;
		}
    }

    // Getting cutomer information
    $cID = $_SESSION['data']['customerID'];
    $Q2 = "SELECT * FROM customers WHERE customerID = '$cID' ";
    $result = $dbc->query($Q2);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$_SESSION['customer'] = $row;
		}
    }

    // Getting Product information
    $pID = $_SESSION['data']['proID'];
    $Q3 = "SELECT * FROM product WHERE proID = '$pID' ";
    $result = $dbc->query($Q3);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$_SESSION['product'] = $row;
		}
    }
}
else
{
	$edit = false;
}
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$status = $_POST['status'];

	if(empty($status) || strlen($status) < 1)
	{
		echo "Please select status";
	}
	
	if(isset($_SESSION['data']))

	{
	$Q2 = "UPDATE orders SET status = '$status' WHERE orderID = '$id' ";
	if (mysqli_query($dbc, $Q2)) {
		echo "Status updated";
	} else {
	    echo "Error: " . $Q2 . "<br>" . $dbc->error;
		}
	}
	

}

?>
<div class="container">
<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label class="control-label col-sm-2" for="cname">Customer Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="cname" placeholder="Name of Category" name="cname" value="<?php echo $_SESSION['customer']['customerName']; ?>" readonly>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="cdesc"> Product Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="cname" placeholder="Name of Category" name="cname" value="<?php echo $_SESSION['product']['proName']; ?>" readonly>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="cdesc"> Total:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="cname" placeholder="Name of Category" name="cname" value="<?php echo $_SESSION['data']['total']; ?>" readonly>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="cdesc"> Status:</label>
      <div class="col-sm-10">
        <select name="status" id="status" class="form-control">
        	<option value="Accepted" <?php if(isset($_SESSION['data']) && $_SESSION['data']['status'] == "Accepted" ) echo "selected" ?>>Accepted</option>
        	<option value="Processing" <?php if(isset($_SESSION['data']) && $_SESSION['data']['status'] == "Processing" ) echo "selected"  ?>>Processing</option>
        	<option value="Shipped" <?php if(isset($_SESSION['data']) && $_SESSION['data']['status'] == "Shipped" ) echo "selected"  ?>>Shipped</option>
        	<option value="Completed" <?php  if(isset($_SESSION['data']) && $_SESSION['data']['status'] == "Completed" ) echo "selected"  ?>>Completed</option>
        	<option value="Cancelled" <?php if(isset($_SESSION['data']) && $_SESSION['data']['status'] == "Cancelled" ) echo "selected"  ?>>Cancelled</option>
        </select>
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
 </div>
<?php 
include('footer.php');
?>