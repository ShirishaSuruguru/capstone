 </div>





        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });

                 // Category change
            $('#category').on('change', function() {
                if($('#sbcategory').val() != "")
                {
                    var sub_id = $('#sbcategory').val();
                }
                else
                {
                    var sub_id = 1;
                }
                console.log(sub_id);
            var category_id = this.value;
            $.ajax({
                url: "selectSubCat.php",
                type: "POST",
                data: {
                    category_id: category_id,
                    sub_id: sub_id
                },
                cache: false,
                success: function(dataResult){
                    $("#subCat").html(dataResult);
                }
            });
        
        
    });
             });
         </script>
<?php 
if(isset($_SESSION['ProductData']))
{
    ?>
<script type="text/javascript">
             $(document).ready(function () {
                if($('#sbcategory').val() != "")
                {
                    var sub_id = $('#sbcategory').val();
                }
                else
                {
                    var sub_id = 1;
                }
                var category_id = $('#category').val();
                console.log(sub_id);

                $.ajax({
                url: "selectSubCat.php",
                type: "POST",
                data: {
                    category_id: category_id,
                    sub_id: sub_id
                },
                cache: false,
                success: function(dataResult){
                    $("#subCat").html(dataResult);
                }
            });
             });
</script>
<?php
}
?>
    </body>
</html>