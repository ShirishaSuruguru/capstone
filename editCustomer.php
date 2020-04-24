<?php 
include('header.php');
include('connection.php');

if(isset($_GET['ID']))
{
	$id = $_GET['ID'];
	$Q1 = "SELECT * FROM customers WHERE customerID = '$id' ";
	$result = $dbc->query($Q1);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$_SESSION['data'] = $row;
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
	$Q2 = "UPDATE customers SET status = '$status' WHERE customerID = '$id' ";
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
        <input type="text" class="form-control" id="cname" placeholder="Name of Category" name="cname" value="<?php echo $_SESSION['data']['customerName']; ?>" readonly>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="cdesc"> Email:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="cname" placeholder="Name of Category" name="cname" value="<?php echo $_SESSION['data']['email']; ?>" readonly>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="cdesc"> Status:</label>
      <div class="col-sm-10">
        <select name="status" id="status" class="form-control">
        	<option value="Active" <?php if(isset($_SESSION['data']) && $_SESSION['data']['status'] == "Active" ) echo "selected" ?>>Active</option>
        	<option value="Inactive" <?php if(isset($_SESSION['data']) && $_SESSION['data']['status'] == "Inactive" ) echo "selected"  ?>>Inactive</option>
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