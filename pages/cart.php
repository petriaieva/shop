<?php
if ($_SESSION['cart']!=NULL)
{
?>
  
   <div class="container">
    <div class="row">
       <form action="index.php?view=update_cart" method="post" id="cart-form">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <table class="table table-stripped">
              <tr>
                <td>
                    <h4>Twój koszyk</h4>
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
                <td><input type='text' name="<?php echo $id?>" value="<?php 
                    echo $quantity;
                    ?> "
                    >
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
                <td><button type="submit" class="btn btn-default ">Przelicz</button></td>
                <td><?php echo number_format($_SESSION['total_price'],2)?> </td>
            </tr>
             
            </table>
              
        </div> 
        </form> 
        <a href='index.php?view=order' class="btn btn-default">Wybierz dostawę i płatność</a>
    </div>
</div>    
<?php
                    }
                else {
                   
                    echo "<div class='container'><div class='row'>
                                <p align='center'>Twój koszyk jest pusty!</p>
                            </div>
                            </div>";
                  
                }
                ?>     