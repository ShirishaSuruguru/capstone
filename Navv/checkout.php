<?php include 'header.php'; ?>
<main class="middle">
<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_GET['single']))
	{
	$_SESSION['name']  = $_POST['pname'];
    $_SESSION['price']  = $_POST['price'];
    $_SESSION['id'] = $_POST['pid'];
	}
	else
	{
	$_SESSION['name']  = "T shirt";
    $_SESSION['price']  = '$45';
    $_SESSION['id'] = "3";
	}
    
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
{
	$fname = $_POST['fname'];
	$cnum =$_POST['cnum'];
	$method =$_POST['method'];
	$date = date('Y-m-d');
	$error = false;
	$name =$_SESSION['name'] ; 
   $price= $_SESSION['price'] ;
   $id = $_SESSION['id'] ;
	if(empty($fname) || strlen($fname) < 1)
	{
		echo "Please enter name";
		$error = true;
	}
	if(empty($cnum) || strlen($cnum) < 1)
	{
		echo "Please enter card number";
		$error = true;
	}
	if(empty($method) || strlen($method) < 1)
	{
		echo "Please enter method";
		$error = true;
	}

	if($error == true)
	{
	$Q = "INSERT INTO orders SET customerID ='1',proID='$id',total='$price',cardNo='$cnum',method='$method',status='Recieved',odate='$date' ";
			if (mysqli_query($dbc, $Q)) {
		    $newProID = $dbc->insert_id;
		    header("location: thanks.php");
			} else {
			    echo "Error: " . $Q . "<br>" . $dbc->error;
			}	
	}
	
}
?>

<article>
    <h2>Checkout</h2>
    <h3>You Bought : <?php echo $_SESSION['name']; ?></h3>
    <h3>Your Total: $<?php echo $_SESSION['price']; ?></h3>
    <form method="post" action="thanks.php">
		<label for="fname">Full Name</label>
		<div class="input"><input type="text" value="" name="fname" id="fname"/></div>
		<input type="hidden" name="cname" value="1">
		<label for="pnumber">Card No: </label>
		<div class="input"><input type="text" name="cnum" id="pnumber"/></div>
		<label for="subject">Method</label>
		<div class="input">
			<select name="method">
				<option value="Credit">Credit</option>
				<option value="Debit">Debit</option>
			</select>
		</div>
		<div class="button"><input type="submit" name="submit" id="submit" /></div>

    </form>
    
</article>
</main>
 
    </main>
    
<?php include 'footer.php'; ?>