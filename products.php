<!DOCTYPE HTML>
<html>
    
    <head>
        <?php include 'head.php';?>
    </head>

    <body>
        <?php include 'navbar.php';?>
        <div class="spacer"></div>
        <div class=content>
            
            <?php
            // define variables and set to empty values
            $productLine = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
               $productLine = ($_POST["productLine"]);
            }

            ?>

            <?php
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

            $sql = "SELECT * FROM `productlines` ORDER BY `productLine` ASC";
            $result = $conn->query($sql);
            ?>
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">Product line: 
                <select name="productLine">
            
            <?php
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo  "<option value='" . $row["productLine"] ."'>" . $row["productLine"] . "</option>";
                }

            } else {
                echo "0 results";
            }
            ?>
                
                </select>
                <input type="submit" name="submit" value="Submit">
            </form>
            
            <?php
            
            if ($productLine != "") {
                
                $sql = "SELECT * FROM `products` WHERE `productLine` = '" . $productLine . "' ORDER BY `productCode` ASC";

                $result = $conn->query($sql);

                echo "<table>";
                echo    "<tr>
                         <th>Product code</th>
                         <th>Product name</th>
                         <th>Product line</th>
                         <th>Product scale</th>
                         <th>Product vendor</th>
                         <th>Product description</th>
                         <th>Quantity in stock</th>
                         <th>Buy price</th>
                         </tr>";

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo    "<tr>
                                <td>" . $row["productCode"] . "</td>
                                <td>" . $row["productName"] . "</td>
                                <td>" . $row["productLine"] . "</td>
                                <td>" . $row["productScale"] . "</td>
                                <td>" . $row["productVendor"] . "</td>
                                <td>" . $row["productDescription"] . "</td>
                                <td>" . $row["quantityInStock"] . "</td>
                                <td>" . $row["buyPrice"] ."</tr>";
                    }

                } else {
                    echo "0 results";
                }

                echo "</table>";
            
            }
            
            $conn->close();
            ?>
                
        </div>
        <div class="spacer"></div>
        <?php include 'footer.php';?>
        
    </body>
</html>