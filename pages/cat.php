<div class="container">
<div class="row">
 <?php
    
        $k=0;
    
       foreach ($products as $item):
        $k+=4;
        if ($k>12) {
            echo '</div></div><div class="container"><div class="row">';
            $k=0;
        }?>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
   <table class="table table-hover">
   <tr>
      
       <td>
        <div><a href="index.php?view=product&id=<?php echo $item['id']?>"> <img src= "images/<?php echo $item['image']?>"/></a>
            
        </div>
        <div class="description">
            <div class="product-name">
                <a href="#"><?php echo $item['title']?></a>
            </div>
            <div class="product-price">
            Cena: <?php echo $item['price']?> zł    
            </div>
        </div>   
       </td>
   </tr>
    
</table>
</div>
<?php
endforeach;
?>
</div>
</div>
