<!DOCTYPE HTML>
<html>
    
    <head>
        <?php include 'head.php';?>
    </head>

    <body>
        <?php include 'navbar.php';?>
        <div class="spacer"></div>
        <div class='content'>
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

            $sql = "SELECT * FROM `customers` GROUP BY `country` ASC";
            $result = $conn->query($sql);

            echo "<div id = 'table-box'>";
            echo "<table>";
            echo "<th>Customer</th><th>Country</th>";

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo  "<tr>
                            <td onclick='showCustomerDetails(" . $row["customerNumber"]  . ")'>" 
                                . "<span class='custom-link'>". $row["customerName"] . "</span>" ."</td><td>" 
                                . $row["country"] ."</tr>";
                }

            } else {
                echo "0 results";
            }

            echo "</table>";  
            echo "</div>";
            echo "<div id=customer-detail>";

            $sql = "SELECT * FROM `customers` GROUP BY `country` ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class='hidden' id=" . $row["customerNumber"] . ">" 
                                . "<span class = 'catg'>Customer no</span>: " 
                                . $row["customerNumber"] . "<br>"
                                . "<span class = 'catg'>Customer</span>: " 
                                . $row["customerName"] . "<br>"
                                . "<span class = 'catg'>Contact</span>: " 
                                . $row["contactLastName"] . " " . $row["contactFirstName"] . "<br>"
                                . "<span class = 'catg'>Phone number</span>: " 
                                . $row["phone"] . "<br>"
                                . "<span class = 'catg'>Address</span>: " 
                                . $row["addressLine1"] . ", "
                                . $row["addressLine2"] . ", "
                                . $row["city"] . ", "
                                . $row["state"] . ", "
                                . $row["postalCode"] . ", "
                                . $row["country"] . "<br>"
                                . "<span class = 'catg'>Sales rep</span>: " 
                                . $row["salesRepEmployeeNumber"] . "<br>"
                                . "<span class = 'catg'>Credit limit</span>: " 
                                . $row["creditLimit"] . "</div>";
                }

            } else {
                echo "0 results";
            }

            echo "</div>";

            $conn->close();

            ?>
            
        </div>
        
        <div class="spacer"></div>
        
        <?php include 'footer.php';?>
        
        <script>
            
            function showCustomerDetails(customer_id) {
                
                for (var i = 0; i < document.getElementsByClassName('hidden').length; i++) {
                    document.getElementsByClassName('hidden')[i].style.display='none';
                }
                document.getElementById(customer_id).style.display = "block";
            }
        
        </script>
        
    </body>
</html>