<?php
include('header.php'); 
?>    
<main class="middle">
    <section class="slider">
        <img src="img/2.jpg"/>
        <h1 id="get-text">GET WHAT YOU WANT..</h1>
    </section>

    <section class="recpies">
    <h2>TOP CATEGORIES</h2>

    <section class="recpie-flex">
        <?php 
        $Query = $dbc->query("SELECT * FROM category LIMIT 4");
        if($Query->num_rows > 0)
        {
         while($row = $Query->fetch_assoc()) 
         { 
        ?>
            <aside><a href=""><img src="../<?php echo $row['catImg']; ?>"> <b><?php echo $row['catName'] ?></b></a><span><?php echo $row['catDesc']; ?></span></aside>
        <?php } } ?>
    </section>
        </section>

    <article>
    <h2>ABOUT THE GADGETS</h2>
    <p>
     Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis
    </p>
    <p>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnisadipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis

        adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis
    </p>
    </article>
    </main>
        

        </main>
<?php
include('footer.php'); 
?>  