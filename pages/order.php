<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

<?php
if (($_SESSION['cart'])&& (!isset($_POST['order'])))
{
?>
  
   <div class="container">
    <div class="row">
       <form action="index.php?view=order" method="post" id="cart-form">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <table class="table table-stripped">
              <tr>
                <td>
                    <h4>Dostawa i płatność</h4>
                </td>
                <td>
                    <h4>Cena</h4>
                </td>
                <td>
                    <h4>Ilość</h4>
                </td>
                <td>
                    <h4>Razem</h4>
                </td>
                </tr>
                <?php
                    foreach ($_SESSION['cart'] as $id=> $quantity)
                    {$product = get_product($id);
               ?>
            <tr>
                <td>
                 <?php 
                    echo $product['title'];
                    ?>   
                </td>
                <td>
                    <?php 
                    echo number_format($product['price'],2);
                    ?> 
                </td>
                <td><?php 
                    echo $quantity;
                    ?>
                </td>
                <td>
                    <?php 
                    echo number_format($product['price'] * $quantity,2);
                    ?> 
                </td>
            </tr>
            <?php
                    }
            
            ?>
            <tr>
                <td><h4>Razem:</h4></td>
                <td></td>
                <td></td>
                <td><?php echo number_format($_SESSION['total_price'],2)?> </td>
            </tr>
             
            </table>
              
        </div>
        <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-4 col-xs-offset-4">
           <div class="form-group">
               <p>
                    <label for="">Adres</label>
                    <input type="text" class="form-control" name="adres" placeholder="Adres" required>
                </p>
                <p>
                    <label for="">Kod</label>
                     <input type="text" class="form-control" name="post_index" placeholder="Kod" required>
                </p>
                <p>    
                     <label for="">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </p> 
                <p>    
                     <label for="">Imie</label>
                    <input type="text" class="form-control" name="name" placeholder="Imie" required minlength="2">
                </p> 
                <p>    
                    <label for="">Nazwisko</label>
                     <input type="text" class="form-control" name="s_name" placeholder="Nazwisko" required minlength="2">
                 </p>
           </div>
           </div>
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"> 
            <input type='submit' name='order' class="btn btn-default pull-right" value='Zamówić'/>
           </div>
        </form> 
        <script src="js/myscripts.js"></script>
   </div>
</div>
  
<?php
     }
if (!$_SESSION['cart'])
{
    echo "<p align='center'>Zamówienie jest przyjętę!</p>";
}
 if (($_SESSION['cart'])&& isset($_POST['order']))
 {
     $a = array();
        
            foreach ($_POST as $key=>$value){
                $a[$key]=$value;
            }
       
     $date = date('Y-m-d');
     $time = date('H:i:s');
     
     foreach ($_SESSION['cart'] as $id=> $quantity)
     {
         $product = get_product($id);
         $mysqli=db_connect();   
         $query = "INSERT INTO orders(adress,date,email,name,post_index,price,product,prod_id,qty,s_name,time) VALUES('{$a['adres']}','$date','{$a['email']}','{$a['name']}','{$a['post_index']}','{$product['price']}','{$product['title']}','{$product['id']}','$quantity','{$a['s_name']}','$time')";
         $result=mysqli_query($mysqli,$query);
        
     }
         if (!$result)
           {
               echo $mysqli->error;
           }
         else 
         {
             unset($_SESSION['cart']);
             header('Location: index.php?view=order');
             
         }              
 }
?>     