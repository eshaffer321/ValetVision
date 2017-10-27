<!DOCTYPE html>
<html>
    <head>
        <title>Pick up</title>
    </head>
    <body>
       

    </body>
</html>                    
<?php       
        play();
        // need to update parking spot table status
        function play(){
            $dbHost = getenv('IP');
            $dbPort = 3306;
            $dbName = "valet";
            $username = getenv('C9_USER');
            $password = "";
            
            $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
            $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $carPickedUp = false;
            echo "<div class = 'container'>";
            while(!$carPickedUp){
                displayPickUpScreen();
                $carPickedUp = true;
                if(isset($_POST['submit'])){
                    $ticketNum = $_POST['ticketNum'];
                    $ticketExecute = array(":ticket_id" =>  $ticketNum);
                    $sql = "UPDATE `parking_spot` as ps 
                            SET ps.ticket_id = NULL, ps.status = 0 
                            WHERE ps.ticket_id = :ticket_id";
                    $stmt = $dbConn -> prepare ($sql);
                    $stmt -> execute ($ticketExecute);
                    $randDriver = genRandDriver();
                    $sql2 = "UPDATE `ticket` as t 
                             SET t.pick_up_driver = $randDriver 
                             WHERE t.ticket_id = :ticket_id";
                    $stmt2 = $dbConn -> prepare ($sql2);
                    $stmt2 -> execute ($ticketExecute);
                    
                    $sql = "SELECT t.customer_id, c.name, c.make, c.model, d.name AS 'drivName'
                            FROM `ticket` AS t
                            INNER JOIN `customer` AS c
                            ON c.customer_id = t.customer_id
                            INNER JOIN `driver` AS d
                            ON d.driver_id = t.pick_up_driver
                            WHERE t.ticket_id = :ticket_id";
                    $stmt = $dbConn -> prepare ($sql);
                    $stmt -> execute ($ticketExecute);
                    
                    
                    while ($row = $stmt -> fetch()){
                        echo "Thank You! " . $row['name'] . " <br>" . $row['drivName'] . " will deliver your " . $row['make'] . " " . $row['model'] . " shortly. <br/>";
                    }
                    displayAnotherOption();
                    if(isset($_POST['anotherCar'])){
                        $anotherCar = true;
                    }
                    elseif (isset($_post['noCar'])) {
                        $anotherCar = false;
                    }
                    while($anotherCar){
                        play();
                        
                    }
                    // call home screen
                }
            }
            echo "</div>";
        }
        function genRandDriver(){
            return rand(1,8);
        }
        function displayPickUpScreen(){
            echo "<div class = 'pickUpScreen'>";
            echo "<h1>Enter your ticket number please</h1>";
            echo '<form action="pickup.php" method="post">';
            echo '<input type="text" name="ticketNum"/>';
            echo '<input type="submit" name = "submit" value="submit"/>';
            echo '</form>';
            echo "</div>";
        }
        function displayAnotherOption(){
            echo "<div class = 'displayAnotherOption'>";
            echo "<h1>would you like to pick up another car?</h1>";
            echo '<form action="pickup.php" method="post">';
            echo '<input type="submit" name = "true" value="Yes"/>';
            echo '<input type="submit" name = "false" value="No"/>';
            echo '</form>';
        }
?>