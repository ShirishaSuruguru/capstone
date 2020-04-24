<?php 
include('header.php');
include('connection.php');

if(isset($_GET['new']))
{
	unset($_SESSION['VariantData']);
	unset($_SESSION['ProductData']);
	unset($_SESSION['subCatData']);
	unset($_SESSION['catData']);
}

if(isset($_GET['proID']))
{
	$id = $_GET['proID'];
	
	// fetching variants
	$Q1 = "SELECT * FROM variant WHERE VarID = '$id' ";
	$result = $dbc->query($Q1);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$_SESSION['VariantData'] = $row;
		}
    }

    //Fetching products
    $productID = $_SESSION['VariantData']['proID'];
    $Q2 = "SELECT * FROM product WHERE proID = '$productID' ";
	$result = $dbc->query($Q2);
	if ($result->num_rows > 0) {
		while($row2 = $result->fetch_assoc()) {
			$_SESSION['ProductData'] = $row2;
		}
    }

    //Fetching Sub categories
    $subCatID = $_SESSION['ProductData']['subCatID'];
    $Q3 = "SELECT * FROM sub_category WHERE subCatID = '$subCatID' ";
	$result = $dbc->query($Q3);
	if ($result->num_rows > 0) {
		while($row3 = $result->fetch_assoc()) {
			$_SESSION['subCatData'] = $row3;
		}
    }

    //Fetching categories
    $CatID = $_SESSION['subCatData']['catID'];
    $Q4 = "SELECT * FROM category WHERE catID = '$CatID' ";
	$result = $dbc->query($Q4);
	if ($result->num_rows > 0) {
		while($row4 = $result->fetch_assoc()) {
			$_SESSION['catData'] = $row4;
		}
    }
}
else
{
	$edit = false;
}
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$target_dir = "images/products/";
	$target_file = $target_dir . basename($_FILES["pimg"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$pname = $_POST['pname'];
	$subCatName = $_POST['subCatName'];
	$price = $_POST['price'];
	$desc = $_POST['desc'];
	$size = $_POST['size'];
	$color = $_POST['color'];
	$inv = $_POST['inv'];
	
	if(empty($pname) || strlen($pname) < 1)
	{
		echo "Please enter product name";
	}
	if(empty($price) || strlen($price) < 1)
	{
		echo "Please enter product price";
	}
	if(empty($desc) || strlen($desc) < 1)
	{
		echo "Please enter product Description";
	}
	if(empty($size) || strlen($size) < 1)
	{
		echo "Please select product size";
	}
	if(empty($color) || strlen($color) < 1)
	{
		echo "Please enter product color";
	}
	if(empty($inv) || strlen($inv) < 1)
	{
		echo "Please enter product inventory";
	}
	if(empty($subCatName) || strlen($subCatName) < 1)
	{
		echo "Please select Sub Category Name";
	}

	//Image uploding
	if(isset($_SESSION['VariantData']))
	{
		
		if(empty($imageFileType) || strlen($imageFileType) < 1)
		{
			$img = $_SESSION['VariantData']['image'];
			move_uploaded_file($_FILES["pimg"]["tmp_name"], $img);
		}
		else
		{
			move_uploaded_file($_FILES["pimg"]["tmp_name"], $target_file);
			$img = $target_file;
		}
	}
	else
	{
		if(empty($imageFileType) || strlen($imageFileType) < 1)
		{
			echo "Please select Image";
		}
		else
		{
			move_uploaded_file($_FILES["pimg"]["tmp_name"], $target_file);
			$img = $target_file;
		}
	}

	if(isset($_SESSION['VariantData']))
	{
	echo $productID = $_SESSION['VariantData']['proID'];
	$Q2 = "UPDATE product SET subCatID ='$subCatName',proName='$pname',price='$price',description='$desc' WHERE proID='$productID' ";
	$Q1 = "UPDATE variant SET proID ='$productID',size='$size',color='$color',inventory='$inv',image='$img' WHERE varID='$id' ";
		if (mysqli_query($dbc, $Q2) && mysqli_query($dbc, $Q1)) {
			echo "Updated";
		} else {
		    echo "Error: " . $Q2 . "<br>" . $dbc->error;
		}
	}
	else
	{
		$Q = "INSERT INTO product SET subCatID ='$subCatName',proName='$pname',price='$price',description='$desc' ";
			if (mysqli_query($dbc, $Q)) {
		    $newProID = $dbc->insert_id;
			} else {
			    echo "Error: " . $Q . "<br>" . $dbc->error;
			}
	 $Q1 = "INSERT INTO variant SET proID ='$newProID',size='$size',color='$color',inventory='$inv',image='$img' ";
			if (mysqli_query($dbc, $Q1)) {
		    echo "Product inserted successfuly";
			} else {
			    echo "Error: " . $Q1 . "<br>" . $dbc->error;
			}
	}
	
}
	

	
	
if (isset($_POST['delete'])) {
	$Vid = $_GET['proID'];
	$Pid = $_SESSION['ProductData']['proID'];
	$v = "DELETE FROM product WHERE proID = $Pid ";
	$p = "DELETE FROM variant WHERE proID = $Pid ";
	if($dbc->query($v) === TRUE && $dbc->query($p) === TRUE)
	{
		echo "Product deleted";
	}
}






?>
<div class="container">
<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    
     <div class="form-group">
      <label class="control-label col-sm-2" for="pname">Product Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="pname" placeholder="Name of Product" name="pname" value="<?php if(!empty($_SESSION['ProductData'] )){ echo $_SESSION['ProductData']['proName']; } ?>">
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-2" for="cname">Category Name:</label>
      <div class="col-sm-10">
      	<select name="CatName" id="category">
      		<?php 
      		$Q5 = "SELECT * FROM category ";
			$result = $dbc->query($Q5);
			if ($result->num_rows > 0) {
				while($row5 = $result->fetch_assoc()) {
      		?>
      		<option 
      		value="<?php echo $row5['catID']; ?>"
      		<?php 
      		if(isset($_SESSION['catData']))
      		{
      		if($row5['catID'] == $_SESSION['catData']['catID'])
      		{
      			echo "selected";
      		}}
      		?>
      		 ><?php echo $row5['catName']; ?></option>
      		<?php 
      			}
			} ?>
      	</select>
      	<input type="hidden" name="sbcategory" id="sbcategory" value="<?php if(isset($_SESSION['ProductData'])) echo $_SESSION['ProductData']['subCatID']; ?>">
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-2" for="cname">Sub Category Name:</label>
      <div class="col-sm-10">
      	<select name="subCatName" id="subCat">
      		
      	</select>
      </div>
    </div>

       <div class="form-group">
      <label class="control-label col-sm-2" for="price">Price:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="price" placeholder="Price" name="price" value="<?php if(!empty($_SESSION['ProductData'] )){ echo $_SESSION['ProductData']['price']; } ?>">
      </div>
    </div>

        <div class="form-group">
      <label class="control-label col-sm-2" for="desc">Description:</label>
      <div class="col-sm-10">
        <textarea name="desc" id="desc">
        	<?php if(!empty($_SESSION['ProductData'] )){ echo $_SESSION['ProductData']['description']; } ?>
        </textarea>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="cname">Size:</label>
      <div class="col-sm-10">
      	<select name="size">
      		<option value="S" <?php if(isset($_SESSION['VariantData'])) if($_SESSION['VariantData']['size'] == 'S') echo "selected" ?>>S</option>
      		<option value="M" <?php if(isset($_SESSION['VariantData'])) if($_SESSION['VariantData']['size'] == 'M') echo "selected" ?>>M</option>
      		<option value="L" <?php if(isset($_SESSION['VariantData'])) if($_SESSION['VariantData']['size'] == 'L') echo "selected" ?>>L</option>
      		<option value="XL" <?php if(isset($_SESSION['VariantData'])) if($_SESSION['VariantData']['size'] == 'XL') echo "selected" ?>>XL</option>
      	</select>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="color">Color:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="color" placeholder="Color" name="color" value="<?php if(!empty($_SESSION['VariantData'] )){ echo $_SESSION['VariantData']['color']; } ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pimg">Product Image</label>
      <div class="col-sm-10"> 
      <?php if(!empty($_SESSION['VariantData'] )){ ?>
      	<img src="<?php echo $_SESSION['VariantData']['image']; ?>" height="100px" width="100px">
      <?php } ?>
           
        <input type="file" class="form-control" id="pimg" placeholder="Image" name="pimg">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="inv">Inventory:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="inv" placeholder="Inventory" name="inv" value="<?php if(!empty($_SESSION['VariantData'] )){ echo $_SESSION['VariantData']['inventory']; } ?>">
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