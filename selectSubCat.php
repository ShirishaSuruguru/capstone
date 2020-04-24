<?php
      include('connection.php');
      $category_id=$_POST["category_id"];
      $sub_id=$_POST["sub_id"];
      $result = mysqli_query($dbc,"SELECT * FROM sub_category where catID=$category_id");
?>
<option value="">Sub Category</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
      <option value="<?php echo $row['subCatID'];?>" <?php if(isset($sub_id) && $sub_id == $row['subCatID'] )echo "selected"; ?> ><?php echo $row["subCatName"];?></option>
<?php
 

}
?>