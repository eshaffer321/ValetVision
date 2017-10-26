<?php
    include 'database.php';
    
    function displayTicket($db) {
        $db = getDatabaseConnection();
        $ticketInfo = getTicketData($db);
        $driverName = $ticketInfo['driverName'];
        $ticketNumber = $ticketInfo['ticketNumber'];
        $parkingSpot = $ticketInfo['parkingSpot'];
        $time = $ticketInfo['time'];
        
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        
        echo 
            "<div class='ticket'>
              <div class='stub'>
                <div class='top'>
                  <span class='admit'>Valet</span>
                  <span class='line'></span>
                  <span class='num'>
                    Ticket Number
                    <span>$ticketNumber</span>
                  </span>
                </div>
                <div class='number'>$parkingSpot</div>
                <div class='invite'>
                </div>
              </div>
              <div class='check'>
                <div class='big'>
                  Valet <br> Ticket
                </div>
                <div class='number'>$parkingSpot</div>
                <div class='info'>
                  <section>
                    <div class='title'>Date</div>
                    <div>$time</div>
                  </section>
                  <section>
                    <div class='title'>Driver</div>
                    <div>$driverName</div>
                  </section>
                  <section>
                    <div class='title'>Ticket Number</div>
                    <div>$ticketNumber</div>
                  </section>
                </div>
              </div>
            </div>";
    }
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Valet | Ticket Info</title>
</head>
<body>
    <?php
        if (!validInput()) {
            echo "Please make sure that all data is entered correcly on the drop off page...";
        } 
        else if (!spotsAvailable($db)) {
            echo "Sorry we are at maximum capacity! Please come back soon";
        }
        else {
            createTicket($db);
            displayTicket($db);
        }
    ?>
</body>
</html>