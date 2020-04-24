<?php 
include('header.php');
include('connection.php');

if(isset($_GET['Id']))
{
	$id = $_GET['Id'];
	$parentid = $_GET['parent'];
	
	$Q1 = "SELECT * FROM sub_category WHERE subCatID = '$id' ";
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
	$pCatId = $_POST['prntID'];
	$subname = $_POST['subname'];

	if(empty($pCatId) || strlen($pCatId) < 1)
	{
		echo "Please select parent Category";
	}
	if(empty($subname) || strlen($subname) < 1)
	{
		echo "Please enter Sub Category Name";
	}

	if(isset($_SESSION['data']))
	{
	$Q2 = "UPDATE sub_category SET catID ='$pCatId',subCatName='$subname' WHERE subCatID='$id' ";
		if (mysqli_query($dbc, $Q2)) {
			echo "Sub Category Updated successfully";
		} else {
		    echo "Error: " . $Q2 . "<br>" . $dbc->error;
		}
	}
	else
	{
		$Q = "INSERT INTO sub_category SET catID ='$pCatId',subCatName='$subname' ";
			if (mysqli_query($dbc, $Q)) {
		    echo "New record created successfully";
			} else {
			    echo "Error: " . $Q . "<br>" . $dbc->error;
			}
	}
	
}
	
if (isset($_POST['delete'])) {
	$id = $_GET['Id'];
	$q = "DELETE FROM sub_category WHERE = $id ";
	if($dbc->query($q) === TRUE)
	{
		$delete = TRUE;
	}
	$q11 = $dbc->query("SELECT * FROM product WHERE subCatID= $id ");
	  if($q11->num_rows > 0)
      {
       while($row = $q11->fetch_assoc()) 
       { 
       		echo $idp = $row['subCatID'];
       		$subcatD = $row['proID'];
       		$qp = "DELETE FROM product WHERE subCatID= $idp ";
			  if ($dbc->query($qp) === TRUE) {
			  	$qpt = "DELETE FROM variant WHERE proID= $subcatD ";
			  	if ($dbc->query($qpt) === TRUE) {
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
      <label class="control-label col-sm-2" for="cname">Parent Category Name:</label>
      <div class="col-sm-10">
      	<select name="prntID">
      		<?php 
      		$Q2 = "SELECT * FROM category ";
			$result2 = $dbc->query($Q2);
      		if ($result2->num_rows > 0) {
				while($row2 = $result2->fetch_assoc()) {
					$_SESSION['parentdata'] = $row2;
					
      		?>
      		<option
      		<?php
      		if(isset($_GET['parent']))
      		{
      			if($row2['catID'] == $parentid)
					{
						echo "selected = selected";
					}
      		}
      		
      		?>
      		value="<?php echo $row2['catID']; ?>"><?php echo $row2['catName']; ?></option>
      		<?php 
      			}
			}
      		?>
      	</select>
        <input type="text" class="form-control" id="subname" placeholder="Name of Sub Category" name="subname" value="<?php if(!empty($_SESSION['data'] )){ echo $_SESSION['data']['subCatName']; } ?>">
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