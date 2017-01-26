
   <?php
    function db_connect()
    {
        $host = 'localhost';
        $user = 'genya';
        $pswd = 'Y8vb2211';
        $db = 'shop';
        
        $mysqli = new mysqli($host, $user, $pswd, $db);
        $mysqli->set_charset("utf8");
        if ($mysqli->connect_error) {
            die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
            return false;
        }
        return $mysqli;
    }
    
    function get_products()
    {
        $mysqli=db_connect();
        $query = "SELECT * FROM products ORDER BY id DESC";
        $stmt = $mysqli->query($query);
        $rows=array();
                while ($row = $stmt->fetch_assoc()) 
                    {
                    $rows[]=$row;
                    }
                $stmt->free();
                $mysqli->close();
                return $rows;
  }
 function get_category()
    {
        $mysqli=db_connect();
        $query = "SELECT * FROM categories";
        $stmt = $mysqli->query($query);
        $rows=array();
                while ($row = $stmt->fetch_assoc()) 
                    {
                    $rows[]=$row;
                    }
                $stmt->free();
                $mysqli->close();
                return $rows;
  }
function get_product($id)
    {
        $mysqli=db_connect();
        $query = "SELECT * FROM products WHERE id='$id'";
        $stmt = $mysqli->query($query);
        $rows;
                while ($row = $stmt->fetch_assoc()) 
                    {
                    $rows=$row;
                    }
                $stmt->free();
                $mysqli->close();
                return $rows;
  }
 function get_cat_products($cat)
    {
        $mysqli=db_connect();
        $query = "SELECT * FROM products WHERE category='$cat' ORDER BY id DESC";
        $stmt = $mysqli->query($query);
        $rows=array();
                while ($row = $stmt->fetch_assoc()) 
                    {
                    $rows[]=$row;
                    }
                $stmt->free();
                $mysqli->close();
                return $rows;
  }
?>