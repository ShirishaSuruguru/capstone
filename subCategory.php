<?php 
include('header.php');
include('connection.php');
unset($_SESSION["data"]);
if(isset($_GET['catId']))
{
   $parentCat = $_GET['catId'];
   $Query1 = $dbc->query("SELECT * FROM category WHERE catID = '$parentCat' ");
   $row1 = $Query1->fetch_assoc();
   $parentCatName = $row1['catName'];
   $parentCatId = $row1['catID'];
}
else
{
  header("Location: category.php");
}

?>

<div class="container">
<table class="table table-hover">
	<caption>Sub Categories <a href="editSubCategory.php" id="addCat">Add Sub Category</a></caption>
    <thead>
      <tr>
        <th>Id</th>
        <th>Parent Category Name</th>
        <th>Sub Category Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    	<?php 
    	$Query = $dbc->query("SELECT * FROM sub_category WHERE catID = '$parentCat' ");
	    if($Query->num_rows > 0)
	    {
	     while($row = $Query->fetch_assoc()) 
	     { 
    	?>
      <tr>
        <td><?php echo $row['subCatID'] ?></td>
        <td><?php echo $parentCatName; ?></td>
        <td><?php echo $row['subCatName'] ?></td>
        <td> <a href="editSubCategory.php?parent=<?php echo $parentCatId; ?>&Id=<?php echo $row['subCatID']; ?>">Edit</a> </td>
      </tr>
      <?php 
  }
}else
{
  echo "no record found";
}
      ?>
    </tbody>
  </table>
</div>
<?php 
include('footer.php');
?>