<div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 ">
           <table class="table table-hover">
            <tr>
                <td>
                    <div><a href="#"> <img src= "images/<?php echo $product['image']?>"/></a>

                    </div>
                </td>
       
               </tr>
            </table>
        </div>
       
       <div class="col-lg-8 col-md-8 col-sm-8 ">
       <table class="table table-hover">
            <tr>
                 <td > 
                    <div >
                    <?php echo $product['category']?>
                     </div>
                   <div >
                        <?php echo $product['title']?>
                     </div>
                   <div >
                   <?php echo $product['description']?>
                   </div> 
           
                   <div >
                    Cena: <?php echo $product['price']?> zł    
                </div>
             </tr>
            <tr>
       <td>
          <a class="btn btn-primary" href="index.php?view=add_to_cart&id=<?php echo $product['id']; ?>" role="button">dodaj do koszyka</a>
           
       </td>
   </tr> 
        </table>
    </div>
</div>
</div>

