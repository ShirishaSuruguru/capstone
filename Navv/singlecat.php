<?php include 'header.php'; ?>
<?php 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
        $Q1 = "SELECT * FROM variant WHERE VarID = '$id' ";
    $result = $dbc->query($Q1);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $_SESSION['VariantData'] = $row;
        }
    }

    $productID = $_SESSION['VariantData']['proID'];
    $Q2 = "SELECT * FROM product WHERE proID = '$productID' ";
    $result = $dbc->query($Q2);
    if ($result->num_rows > 0) {
        while($row2 = $result->fetch_assoc()) {
            $_SESSION['ProductData'] = $row2;
        }
    }
}
?>
<form method="POST" action="checkout.php?id=single">
        <section class="single-cat-detail">
            <h1><?php echo $_SESSION['ProductData']['proName']; ?></h1>
            <div class="products">
                <img src="../<?php echo $_SESSION['VariantData']['image']; ?>" style="width: 100%;height: 500px;">
                <h3>Size : <?php echo $_SESSION['VariantData']['size']; ?></h3>
                <h3>Color: <?php echo $_SESSION['VariantData']['color']; ?></h3>
                <h3>Price : $<?php echo $_SESSION['ProductData']['price']; ?></h3>
            </div>
            <input type="hidden" name="pname" value="<?php echo $_SESSION['ProductData']['proName']; ?>">
             <input type="hidden" name="pid" value="<?php echo $_SESSION['ProductData']['proID'];  ?>">
              <input type="hidden" name="price" value="<?php echo $_SESSION['ProductData']['price']; ?>">
              <input type="submit" name="sb" value="Checkout">
        </section>
    
       </form>

        

    </main>
    
<?php include 'footer.php'; ?>