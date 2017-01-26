<?php
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
function add_to_cart($id)
{
    if (isset($_SESSION['cart'][$id]))
    {
        $_SESSION['cart'][$id]++;
        return true;
    }
    else
    {
        $_SESSION['cart'][$id]=1;
        return true;
    }
    return false;
}
function update_cart()
{
    foreach($_SESSION['cart'] as $id => $quantity)
    {
        if($_POST[$id]=='0')
        {
            unset($_SESSION['cart'][$id]);
        }
        else
        {
            $_SESSION['cart'][$id]=$_POST[$id];
        }
    }
    
}
function total_items($cart)
{
    $num_items =0;
    if (is_array($cart))
    {
        foreach($cart as $id =>$quantity)
        {
            $num_items+=$quantity;
        }
    }
    return $num_items;
}
function total_price($cart)
{
    $total_price =0.0;
    $mysqli=db_connect();
    
    if (is_array($cart))
    {
        foreach($cart as $id =>$quantity)
        {
            $query = "SELECT price FROM products WHERE id='$id'";
            $stmt = $mysqli->query($query);
               
                while ($row = $stmt->fetch_assoc()) 
                    {
                     $total_price+=$row['price'] * $quantity;
                    
                    }
               $stmt->free();
                
            
        }
    }
    
    $mysqli->close();   
    return $total_price;
}
?>