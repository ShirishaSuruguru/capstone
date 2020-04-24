
<?php
include('header.php'); 
?>  
<div class="row"> 
  <?php 
  $Query = $dbc->query("SELECT * FROM variant");
      if($Query->num_rows > 0)
      {
       while($row = $Query->fetch_assoc()) 
       { 
  ?>
  <div class="column">
    <div class="try">
        <a href="singlecat.php?id=<?php echo $row['varID']; ?>">   
          <img src="../<?php echo $row['image']; ?>" style="width:100%">
          <div></div>
          <div></div>   
        </a> 
    </div>
  </div>
<?php }} ?>
</div>
    

    </main>

<?php
include('footer.php'); 
?>  