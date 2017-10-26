<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check Out</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
</head>
<body>
<?php
    session_start();
    
    $_SESSION['carArray'] = array();
    $_SESSION['parkingLot'] = array();
    
    play();
    function play(){
        echo "<div class = 'parkingLotContainer'>";
        genCarArray();
        genParkingLotArray();
        genParkingLot();
        $carArray = $_SESSION['carArray'];
        $carArray = $carArray[0];
        // print_r($carArray);
        echo "</div>";
        echo "<div class = 'infoDisplayContainer'>";
        echo '<div class="centerInfoDisplay">';
        echo '<img src="img/valet.png" ></img>';
        echo "<div class = 'leftInfoDisplay'>";
        if(isset($_POST['button'])){
            $carOwner = key($_POST['button']);
            showCarInfo($carOwner,$carArray);
        }
        echo "</div>";
        echo "<div class = 'rightInfoDisplay'>";
        if(isset($_POST['pickup'])){
                    $ownerToAdd = key($_POST['pickup']);
                    $_SESSION[$ownerToAdd] = $carArray[$ownerToAdd];
                    showCheckOutButton();
        }
        echo "</div>";
        if(isset($_POST['checkout'])){
            echo "<div class = 'rightInfoDisplay'>";
            echo "<div class = 'confirmationPage'>";
            showCheckedOutConfirmation();
            echo "</div>";
            echo "</div>";
        }
        if(isset($_POST['clear'])){
            session_destroy();
            genParkingLotArray();
        }
        if(isset($_POST['confirm'])){
            header('Location: checkedOut.php');
        }
        echo "</div>";
    } 
    function genParkingLot(){
        $parkingLotArray = $_SESSION['parkingLot'];
        $parkingLotArray = $parkingLotArray[0];
        // print_r($parkingLotArray);
        echo '<form action="group.php" method="post">';
        echo '<table border = "0">';
        echo '<tbody>';
        $count = 0;
        $row = 0;
        $k = 0;
        foreach($parkingLotArray as $spot){
            if($count == 0){
                echo '<tr>';
            }
            $status = $spot[1];
            $spotId = $spot[0];
            $carOwner = $spot[2];
            $ticketId = $spot[3];
            $customerId = $spot[4];
            echo "<div>";
            if($status == 0){
                echo "<td class = 'row$row'>$k</td>";
            }
            else{
                echo "<td class = 'row$row'><input type='submit' value='$carOwner' name='button[$carOwner]' ></td>";
            }
            echo "</div>";
            if($count == 11){
                echo '</tr>';
                $count = 0;
                $row += 1;
                if($row % 2 == 0){
                    echo "<tr>";
                    for($i = 0; $i<10;$i++){
                        echo "<div>";
                        echo "<td class='emptyRow'></td>";
                        echo "</div>";
                    }
                    echo "</tr>";
                }
            }
            $k += 1;
            $count += 1;
        }
        echo '</tbody>';
        echo '</table>';
        echo '</form>';
    }
    function showCheckOutButton(){
        echo "<div class = 'checkout'>";
        echo '<form action="group.php" method="post">';
        echo "<input type='submit' value='CHECKOUT' name='checkout'>";
        echo "</form>";
        echo "</div>";
    }
    function showCarInfo($carOwner){
        $cars = $_SESSION['carArray'];
        $cars = $cars[0];
        echo "<div class = 'carInfo'>";
        $temp = $cars[$carOwner];
        echo "Car Info for " . $temp[0] . ": <br>";
        echo "Car: " . $temp[1] . " " . $temp[2] . "<br>";
        echo "Parking spot number: " . $temp[3] . "<br>";
        echo "Arriving driver: " . $temp[4] . "<br>";
        echo "Date/Time of arrival: " . $temp[5] . "<br>";
        echo '<form action="group.php" method="post">';
        echo "<input type='submit' value='pickup' name='pickup[$carOwner]'>";
        echo '</form>';
        echo "</div>";
    }
    function genCarArray(){
        $carCount=0;
        $dbHost = getenv('IP');
        $dbPort = 3306;
        $dbName = "valet";
        $username = "adrianmartinez";
        $password = "";
        $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $sql = "SELECT c.name, c.make, c.model, t.ticket_id, t.time, ps.parking_spot_id, d.name AS driver
                FROM ticket AS t
                JOIN customer AS c
                ON t.customer_id = c.customer_id
                JOIN driver AS d
                ON t.drop_off_driver = d.driver_id
                JOIN parking_spot AS ps
                ON t.parking_spot_id = ps.parking_spot_id
                WHERE t.drop_off_driver = d.driver_id 
                AND t.pick_up_driver IS NULL
                GROUP BY t.ticket_id
                ORDER BY ps.parking_spot_id";
        $stmt = $dbConn -> prepare ($sql);
        $stmt -> execute ();
        while ($row = $stmt -> fetch())  {
            $tempCarMake = $row['make'];
            $tempCarModel = $row['model'];
            $parkingSpot = $row['parking_spot_id'];
            $carOwner = $row['name'];
            $driver = $row['driver'];
            $time = $row['time'];
            $ticket = $row['ticket_id'];
            $tempArray = [];
            array_push($tempArray, $carOwner, $tempCarMake, $tempCarModel, $parkingSpot, $driver,$time,$ticket);
            $carArray[$carOwner] = $tempArray;
        } 
        array_push($_SESSION['carArray'],$carArray);
    }
    function genParkingLotArray(){
        $carCount=0;
        $dbHost = getenv('IP');
        $dbPort = 3306;
        $dbName = "valet";
        $username = "adrianmartinez";
        $password = "";
        $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $sql = "SELECT ps.parking_spot_id, ps.status, c.name, t.ticket_id, c.customer_id  
                FROM parking_spot AS ps
                LEFT JOIN ticket AS t
                ON ps.parking_spot_id = t.parking_spot_id
                LEFT JOIN customer AS c
                ON t.customer_id = c.customer_id
                GROUP BY ps.parking_spot_id";
        $stmt = $dbConn -> prepare ($sql);
        $stmt -> execute ();
        while ($row = $stmt -> fetch()){
            $parkingSpot = $row['parking_spot_id'];
            $parkingStatus = $row['status'];
            $nameOfOwner = $row['name'];
            $ticket = $row['ticket_id'];
            $customerId = $row['customer_id'];
            $tempArray = [];
            array_push($tempArray, $parkingSpot, $parkingStatus, $nameOfOwner, $ticket, $customerId);
            $parkingLot[$parkingSpot] = $tempArray;
        }
        array_push($_SESSION['parkingLot'],$parkingLot);
    }
    function showCheckedOutConfirmation(){
        $count = 0;
        echo "You want to have the following cars delivered: <br>";
        foreach($_SESSION as $car){
            if($count > 1){
                echo $car[0] . "'s " . $car[1] . " " . $car[2] . "<br>";
            }
            $count += 1;
        }
        echo "<div class = 'checkoutButtons'>";
        echo '<form action="group.php" method="post">';
        echo "<input type='submit' value='Confirm' name='confirm'>";
        echo "<input type='submit' value='Clear' name='clear'>";
        echo '</form>';
        echo "</div>";
    }

?>   
</body>
</html>