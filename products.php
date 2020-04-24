<?php 
include('header.php');
include('connection.php');
unset($_SESSION["data"]);
?>

<div class="container">
<table class="table table-hover">
  <caption>Products <a href="addProduct.php?new=true" id="addCat">Add Product</a></caption>
    <thead>
      <tr>
        <th>Id</th>
        <th>Image</th>    
        <th>Product Name</th>
        <th>Sub Category</th>
        <th>Description</th>
        <th>Size</th>
        <th>Color</th>
        <th>Price</th>
        <th>Inventory</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $Query = $dbc->query("SELECT * FROM variant");
      if($Query->num_rows > 0)
      {
       while($row = $Query->fetch_assoc()) 
       { 
        $sb = $row['proID'];
      ?>
      <tr>
        <td><?php echo $row['varID']; ?></td>
        <td> <img src="<?php echo $row['image'] ?>" height="100px" width="100px"> </td>
        <td><?php 
      $Query1 = $dbc->query("SELECT * FROM product WHERE proID = '$sb' ");
        $row1 = $Query1->fetch_assoc();
        $sbcat = $row1['subCatID'];
        echo $row1['proName'];
        ?></td>
        <td>
          <?php 
            $Query2 = $dbc->query("SELECT subCatName FROM sub_category WHERE subCatID = '$sbcat' ");
            $row2 = $Query2->fetch_assoc();
           echo $row2['subCatName'];
          ?>
        </td>
        <td><?php echo $row1['description'] ?></td>
        <td><?php echo $row['size'] ?></td>
        <td><?php echo $row['color']; ?></td>
        
        <td>$<?php echo $row1['price']; ?></td>
        
        <td><?php echo $row['inventory'] ?></td>
        <td> <a href="addProduct.php?proID=<?php echo $row['varID']; ?>">Edit</a> </td>
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