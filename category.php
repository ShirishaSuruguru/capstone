<?php 

include('header.php');
include('connection.php');
unset($_SESSION["data"]);
?>

<div class="container">
<table class="table table-hover">
	<caption>Categories <a href="addCategory.php" id="addCat">Add Category</a></caption>
    <thead>
      <tr>
        <th>Id</th>
        <th>Category Name</th>
        <th>Image</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    	<?php 
    	$Query = $dbc->query("SELECT * FROM category");
	    if($Query->num_rows > 0)
	    {
	     while($row = $Query->fetch_assoc()) 
	     { 
    	?>
      <tr>
        <td><?php echo $row['catID'] ?></td>
        <td><a href="subCategory.php?catId=<?php echo $row['catID']; ?>"><?php echo $row['catName'] ?></a> </td>
        <td> <img src="<?php echo $row['catImg'] ?>" height="100px" width="100px"> </td>
        <td><?php echo $row['catDesc'] ?></td>
        <td> <a href="addCategory.php?catId=<?php echo $row['catID']; ?>">Edit</a> </td>
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