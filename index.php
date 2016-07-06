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

            $sql = "SELECT * FROM `productlines` ORDER BY `productLine` ASC";
            $result = $conn->query($sql);

            echo "<table>";
            echo "<th colspan=2>Product Line</th>";

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo  "<tr><td>" . $row["productLine"] . "</td><td>" . $row["textDescription"] ."</tr>";
                }

            } else {
                echo "0 results";
            }

            echo "</table>";

            $conn->close();
            ?>
        </div>
        <div class="spacer"></div>
        <?php include 'footer.php';?>
        
    </body>
</html>