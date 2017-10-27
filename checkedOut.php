<?php
session_start();
$carArray = $_SESSION['carArray'];
// print_r($_SESSION['carArray']);
// print_r($carArray);
$count = 0;
echo "<div class = 'carCheckout'>";
foreach($_SESSION as $key){
    if($count > 0){
        $customerArray = $carArray[0][(string)$key[0]];
        $ticket = $customerArray[6];
        $delivDriver = updateDelivery($ticket);
        echo "Thank you, " . $customerArray[0] . " your " . $customerArray[1] . " " . $customerArray[2] . " will be delivered by " . $delivDriver . " shortly!" . "<br>";
    }
    $count += 1;
}
 
echo "<br>";
echo "</div>";
session_destroy();
echo " <a href='index.php'><div class='btn btn-primary'>Back to Homepage</div></a>";

function updateDelivery($ticketNum){
    $dbHost = getenv('IP');
    $dbPort = 3306;
    $dbName = "valet";
    $username = getenv('C9_USER');
    $password = "";
    $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $ticketExecute = array(":ticket_id" =>  $ticketNum);
    $randDriver = genRandDriver();
    $sql2 = "UPDATE `ticket` as t 
             SET t.pick_up_driver = $randDriver 
             WHERE t.ticket_id = :ticket_id";
    $stmt2 = $dbConn -> prepare ($sql2);
    $stmt2 -> execute ($ticketExecute);
    $sql2 = "UPDATE parking_spot AS ps
             JOIN ticket AS t
             ON t.ticket_id = ps.ticket_id
             SET ps.status = 0
             WHERE t.pick_up_driver IS NOT NULL";
    $stmt2 = $dbConn -> prepare ($sql2);
    $stmt2 -> execute ($ticketExecute);
    $ticketExecute = array(":driver_id" =>  $randDriver);
    $sql = "SELECT *
             FROM `driver` AS d
             WHERE d.driver_id = :driver_id";
    $stmt = $dbConn -> prepare ($sql);
    $stmt -> execute ($ticketExecute);
    while ($row = $stmt -> fetch())  {
            $driver =  $row['name'];
        }
        
    return $driver;
}

function genRandDriver(){
    return rand(1,8);
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check Out</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    
</body>
</html>