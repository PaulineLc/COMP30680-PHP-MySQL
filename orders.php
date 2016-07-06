<!DOCTYPE HTML>
<html>
    
    <head>
        <?php include 'head.php';?>
    </head>

    <body>
        <?php include 'navbar.php';?>
        <div class="spacer"></div>
        <?php
        
        //check config
        if(!file_exists("config.php")) {
            die("config not found");
        } else {
            require_once 'config.php';
        }
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM `orders` WHERE `orders`.`status` = 'In process' ORDER BY `orders`.`orderNumber` DESC";
        $result = $conn->query($sql);
        
        echo "<div id = 'table-box'>";
        echo "<table>";
        echo "<th>Order number</th><th>date</th><th>status</th>";
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td onclick='showOrderDetails(" . $row["orderNumber"]  . ")'>" 
                            . "<span class='custom-link'>". $row["orderNumber"] . "</span></td><td>"  
                            . $row["orderDate"] . "</td><td>" 
                            . $row["status"] ."</tr>";
            }
            
        } else {
            echo "0 results";
        }
        
        echo "</table>";  
            
        $sql = "SELECT * FROM `orders` WHERE `orders`.`status` = 'cancelled' ORDER BY `orders`.`orderNumber` DESC";
        $result = $conn->query($sql);
            
         echo "<table>";
        echo "<th>Order number</th><th>date</th><th>status</th>";
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo  "<tr>
                        <td onclick='showOrderDetails(" . $row["orderNumber"]  . ")'>" 
                            . "<span class='custom-link'>". $row["orderNumber"] . "</span></td><td>"  
                            . $row["orderDate"] . "</td><td>" 
                            . $row["status"] ."</tr>";
            }
            
        } else {
            echo "0 results";
        }
        
        echo "</table>";  
                    
        $sql = "SELECT * FROM `orders` ORDER BY `orders`.`orderDate` DESC LIMIT 20";
        $result = $conn->query($sql);
            
        echo "<table>";
            
        echo "<th>Order number</th><th>date</th><th>status</th>";
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo  "<tr>
                        <td onclick='showOrderDetails(" . $row["orderNumber"]  . ")'>" 
                            . "<span class='custom-link'>". $row["orderNumber"] . "</span></td><td>" 
                            . $row["orderDate"] . "</td><td>" 
                            . $row["status"] ."</tr>";
            }
            
        } else {
            echo "0 results";
        }
        
        echo "</table>";
        
        echo "</div>";
            
        $sql = "SELECT * FROM products, customers, orders, orderdetails WHERE orders.customerNumber = customers.customerNumber and orders.orderNumber = orderdetails.orderNumber and orderdetails.productCode = products.productCode";
        $result = $conn->query($sql);
            
        echo "<div id = 'order-detail'>";
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class='hidden " . $row["orderNumber"] . "'>" 
                            . "<span class = 'catg'>Order No</span>: " 
                            . $row["orderNumber"] . "<br>"
                            . "<span class = 'catg'>Product code</span>: " 
                            . $row["productCode"] . "<br>"
                            . "<span class = 'catg'>Product</span>: " 
                            . $row["productName"] . "<br>"
                            . "<span class = 'catg'>Product line</span>: " 
                            . $row["productLine"] . "<br>"
                            . "<span class = 'catg'>Product scale</span>: " 
                            . $row["productScale"] . "<br>"
                            . "<span class = 'catg'>Vendor</span>: " 
                            . $row["productVendor"] . "<br>"
                            . "<span class = 'catg'>Description</span>: " 
                            . $row["productDescription"] . "<br><br>"
                            . "<span class = 'catg'>Customer No</span>: " 
                            . $row["customerNumber"] . "<br>"
                            . "<span class = 'catg'>customer</span>: " 
                            . $row["customerName"] . "<br>"
                            . "<span class = 'catg'>contact</span>: " 
                            . $row["contactFirstName"] . " " . $row["contactLastName"] . "<br>"
                            . "<span class = 'catg'>Place</span>: " 
                            . $row["country"] . ", " . $row["city"] . "<br><br>"
                            . "<span class = 'catg'>Ordered on</span>: " 
                            . $row["orderDate"] . "<br>"
                            . "<span class = 'catg'>Required by</span>: " 
                            . $row["requiredDate"] . "<br>"
                            . "<span class = 'catg'>Shipped</span>: "
                            . $row["shippedDate"] . "<br>"
                            . "<span class = 'catg'>Comments</span>: " 
                            . $row["comments"] . "<br><br><br>"
                            . "</div>";
            }
            
        } else {
            echo "0 results";
        }
        
        $conn->close();
        echo "</div>";
        ?>
        <div class="spacer"></div>
        <?php include 'footer.php';?>
        <script>
            function showOrderDetails(order_id) {
                console.log("here");
                
                for (var i = 0; i < document.getElementsByClassName('hidden').length; i++) {
                    document.getElementsByClassName('hidden')[i].style.display='none';
                }
                
                for (var i = 0; i < document.getElementsByClassName(order_id).length; i++) {
                    document.getElementsByClassName(order_id)[i].style.display='block';
                }
                
            }
        
        </script>
    </body>
</html>