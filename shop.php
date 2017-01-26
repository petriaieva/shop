<!DOCTYPE html>
<html >
  <head>
      <title>Zabawki</title>

    <!-- Bootstrap -->
     <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="style/global.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
 </head>
  
  <body>
      <header>
          <div class="container">
             <div class="row">
                <div class="kol-sm-7">
                   <div class="widget widget-contact">
                        <ul  class="list-inline">
                            <li>
                                <a href="tel:+48 536 490 106"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>+48 536 490 106</a>
                            </li>
                            <li>
                                <a href="mailto:pevgenia@onet.pl"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>pevgenia@onet.pl</a>
                            </li>
                        </ul>
                     </div>
                </div>
                <div class="kol-sm-5">
                 </div>
                 <hr>
             </div>
          </div>
      </header>      
   
      <div class="container">
       <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <div class="pull-right">
                    <nav>
                        <ul class="menu list-inline">
                            <li class="megamenu menu-item">
                                <a href="#">START</a>
                            </li>
                             <li class="megamenu menu-item">
                                 <a href="index.php?view=index">OFERTA</a>
                            </li>
                             <li class="megamenu menu-item">
                                <a href="#">KONTAKT</a>
                            </li>
                        </ul>
                    </nav>
                </div>    
            </div>
       </div>
        <div class="row" hieght ='57px'>
            <div class="col-lg-1 col-md-1 col-sm-1">
               <img src="images/djyterj.jpg">
             
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
             <h2>Zabawki</h2>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 ">
               <div class="pull-left">
                <ul class="menu list-inline">
               <?php
                   $categories=get_category();
                   foreach ($categories as $item):
                   ?>
                  <li><a href='index.php?view=cat&id=<?php echo $item['cat_id']?>'><h4>
                     <?php
                      echo $item['name'];
                      ?>
                      </h4>
                      </a>
                      </li>
                   
                   <?php
                   endforeach;
                   ?>
                   </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 ">
                <div class="pull-right"> 
                     <a href='index.php?view=cart'><h4>Koszyk(<?php echo  $_SESSION['total_items']?>) <?php echo  number_format($_SESSION['total_price'],2)?> zł</h4></a>
                </div>
            </div>    
        </div>
     </div>
            <?php 
            include ($_SERVER['DOCUMENT_ROOT'].'/sklep/pages/'.$view.'.php');
            ?>
      
 </body>
</html>