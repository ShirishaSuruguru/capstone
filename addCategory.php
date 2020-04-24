<?php 
include('header.php');
include('connection.php');

if(isset($_GET['catId']))
{
	$id = $_GET['catId'];
	$Q1 = "SELECT * FROM category WHERE catID = '$id' ";
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
	$name = $_POST['cname'];
	$desc = $_POST['cdesc'];
	$target_dir = "images/categories/";
	$target_file = $target_dir . basename($_FILES["cimg"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$newImage = $target_dir.$name.".".$imageFileType;

	if(empty($name) || strlen($name) < 1)
	{
		echo "Please enter Category Name";
	}
	if(empty($desc) || strlen($desc) < 1)
	{
		echo "Please enter Category Description";
	}
	if(isset($_SESSION['data']))
	{

	}
	else
	{
	if(empty($imageFileType) || strlen($imageFileType) < 1)
	{
		echo "Please select Image";
	}
	else
	{
		move_uploaded_file($_FILES["cimg"]["tmp_name"], $newImage);
	}
	}
	

	if(isset($_SESSION['data']))

	{
	$Q2 = "UPDATE category SET catName ='$name',catDesc='$desc' WHERE catID='$id' ";
	if (mysqli_query($dbc, $Q2)) {
	} else {
	    echo "Error: " . $Q2 . "<br>" . $dbc->error;
	}
	}
	else
	{
	$Q = "INSERT INTO category SET catName ='$name',catDesc='$desc',catImg='$newImage' ";
	if (mysqli_query($dbc, $Q)) {
    echo "New record created successfully";
	} else {
	    echo "Error: " . $Q . "<br>" . $dbc->error;
	}
	}
	

}

if (isset($_POST['delete'])) {
	$id = $_GET['catId'];
	$q = "DELETE FROM category WHERE catID= $id ";
	if($dbc->query($q) === TRUE)
	{
		$delete = TRUE;
	}
	$q11 = $dbc->query("SELECT * FROM sub_category WHERE catID= $id ");
	  if($q11->num_rows > 0)
      {
       while($row4 = $q11->fetch_assoc()) 
       { 
       		$idp = $row4['catID'];
       		$subIDs = $row4['subCatID'];
       		 $qp = "DELETE FROM sub_category WHERE catID= $idp ";
			  if ($dbc->query($qp) === TRUE) {
			  	$qp1 = "DELETE FROM product WHERE subCatID= $subIDs ";
			  if ($dbc->query($qp1) === TRUE) {
			    $delete = TRUE;
			  	}
			  }
			  else
			  {
			  	$delete = False;
			  } 
       }

     
	}



	if($delete == TRUE)
	{
		echo "<br>Category Deleted.";
	}
}



?>
<div class="container">
<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label class="control-label col-sm-2" for="cname">Category Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="cname" placeholder="Name of Category" name="cname" value="<?php if(!empty($_SESSION['data'] )){ echo $_SESSION['data']['catName']; } ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="cdesc">Category Description:</label>
      <div class="col-sm-10">
        <textarea name="cdesc" id="cdesc">
        	<?php if(!empty($_SESSION['data'] )){ echo $_SESSION['data']['catDesc']; } ?>
        </textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="cimg">Category Image</label>
      <div class="col-sm-10"> 
      <?php if(!empty($_SESSION['data'] )){ ?>
      	<img src="<?php echo $_SESSION['data']['catImg']; ?>" height="100px" width="100px">
      <?php } ?>
           
        <input type="file" class="form-control" id="cimg" placeholder="Image" name="cimg" value="<?php echo $_SESSION['data']['catImg']; ?>">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </form>
 </div>
<?php 
include('footer.php');
?>