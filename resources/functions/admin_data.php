<?php

/*--- Database Connection ---*/
$dbHost = getenv('IP');
$dbPort = 3306;
$dbName = "valet";
$username = getenv('C9_USER');
$password = "";

$dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/*--------------------------*/


$table = '';
if (isset($_POST['table'])) {
    $table = $_POST['table'];
}


if(!isset($_POST['filter'])) {
    if ($table == 'driver') {
        $stmt = queryAll($table, $dbConn);
        $str = "<div class='table-responsive'>";
        $str = $str . "<table class='table table-bordered'>";
        $str = $str . "<thead>
                        <tr>
                          <th>Driver ID</th>
                          <th>Name</th>
                          <th>Active Status</th>
                        </tr>
                        </thead>";
        $str = $str . "<tbody>";
        
        while ($row = $stmt -> fetch())  {
            $str = $str. "<tr>";
            $str = $str . "<td>" . $row['driver_id'] . "</td>";
            $str = $str . "<td>" . $row['name'] . "</td>";
            $str = $str . "<td>" . $row['active_status'] . "</td>";
            $str = $str . "</tr>";
        }
        $str = $str . "</tbody></table></div>";
        echo $str;
    }
    if ($table == 'customer') {
        $stmt = queryAll($table, $dbConn);
        $str = "<div class='table-responsive'>";
        $str = $str . "<table class='table table-bordered'>";
        $str = $str . "<thead>
                        <tr>
                          <th>Customer ID</th>
                          <th>Name</th>
                          <th>Make</th>
                          <th>Model</th>
                          <th>Paid Status</th>
                        </tr>
                        </thead>";
        $str = $str . "<tbody>";
        
        while ($row = $stmt -> fetch())  {
            $str = $str. "<tr>";
            $str = $str . "<td>" . $row['customer_id'] . "</td>";
            $str = $str . "<td>" . $row['name'] . "</td>";
            $str = $str . "<td>" . $row['make'] . "</td>";
            $str = $str . "<td>" . $row['model'] . "</td>";
            $str = $str . "<td>" . $row['paid_status'] . "</td>";
            $str = $str . "</tr>";
        }
        $str = $str . "</tbody></table></div>";
        echo $str;
    }
    if ($table == 'parking_spot') {
        $stmt = queryAll($table, $dbConn);
        $str = "<div class='table-responsive'>";
        $str = $str . "<table class='table table-bordered'>";
        $str = $str . "<thead>
                        <tr>
                          <th>Parking Spot ID</th>
                          <th>Status</th>
                          <th>Ticket</th>
                        </tr>
                        </thead>";
        $str = $str . "<tbody>";
        
        while ($row = $stmt -> fetch())  {
            $str = $str. "<tr>";
            $str = $str . "<td>" . $row['parking_spot_id'] . "</td>";
            $str = $str . "<td>" . $row['status'] . "</td>";
            $str = $str . "<td>" . $row['ticket_id'] . "</td>";
            $str = $str . "</tr>";
        }
        $str = $str . "</tbody></table></div>";
        echo $str;
    }
    if ($table == 'ticket') {
        $stmt = queryAll($table, $dbConn);
        $str = "<div class='table-responsive'>";
        $str = $str . "<table class='table table-bordered'>";
        $str = $str . "<thead>
                        <tr>
                          <th>Ticket ID</th>
                          <th>Customer ID</th>
                          <th>Dropoff Driver ID</th>
                          <th>Pickup Driver ID</th>
                          <th>Parking Spot</th>
                          <th>Dropoff Time</th>
                        </tr>
                        </thead>";
        $str = $str . "<tbody>";
        
        while ($row = $stmt -> fetch())  {
            $str = $str. "<tr>";
            $str = $str . "<td>" . $row['ticket_id'] . "</td>";
            $str = $str . "<td>" . $row['customer_id'] . "</td>";
            $str = $str . "<td>" . $row['drop_off_driver'] . "</td>";
            if ($row['pick_up_driver'] == '') {
                $str = $str . "<td>" . 'None' . "</td>";
            }
            else {
                $str = $str . "<td>" . $row['pick_up_driver'] . "</td>";
            }
            
            $str = $str . "<td>" . $row['parking_spot_id'] . "</td>";
            $str = $str . "<td>" . $row['time'] . "</td>";
            $str = $str . "</tr>";
        }
        $str = $str . "</tbody></table></div>";
        echo $str;
    }
}

if(isset($_POST['filter'])) {
    $filter = $_POST['filter'];
    $match ='';
    $new_fitler = 0;
    if ($table == 'parking_spot') {
        switch($filter) {
            case 'Occupied':
                $match = 'status';
                $new_filter = 1;
                break;
            case 'Available';
                $match = 'status';
                $new_filter = 0;
                break;
        }
        $stmt = queryFilter($table, $match, $new_filter, $dbConn);
        $str = "<div class='table-responsive'>";
        $str = $str . "<table class='table table-bordered'>";
        $str = $str . "<thead>
                        <tr>
                          <th>Parking Spot ID</th>
                          <th>Status</th>
                          <th>Ticket</th>
                        </tr>
                        </thead>";
        $str = $str . "<tbody>";
        
        while ($row = $stmt -> fetch())  {
            $str = $str. "<tr>";
            $str = $str . "<td>" . $row['parking_spot_id'] . "</td>";
            $str = $str . "<td>" . $row['status'] . "</td>";
            if ($row['ticket_id'] == '') {
                $str = $str . "<td>" . 'None' .  "</td>";
            }
            else {
                $str = $str . "<td>" . $row['ticket_id'] . "</td>";
            }
            $str = $str . "</tr>";
        }
        $str = $str . "</tbody></table></div>";
        echo $str;
    }
    if ($table == 'driver') {
        $filter = $_POST['filter'];
        $match ='';
        $new_fitler = 0;
        switch($filter) {
            case 'Active':
                $match = 'active_status';
                $new_filter = 1;
                break;
            case 'Inactive';
                $match = 'active_status';
                $new_filter = 0;
                break;
        }
        $stmt = queryFilter($table, $match, $new_filter, $dbConn);
        $str = "<div class='table-responsive'>";
        $str = $str . "<table class='table table-bordered'>";
        $str = $str . "<thead>
                        <tr>
                          <th>Parking Spot ID</th>
                          <th>Status</th>
                          <th>Active Status</th>
                        </tr>
                        </thead>";
        $str = $str . "<tbody>";
        
        while ($row = $stmt -> fetch())  {
            $str = $str. "<tr>";
            $str = $str . "<td>" . $row['driver_id'] . "</td>";
            $str = $str . "<td>" . $row['name'] . "</td>";
            $str = $str . "<td>" . $row['active_status'] .  "</td>";
            $str = $str . "</tr>";
        }
        $str = $str . "</tbody></table></div>";
        echo $str;
    }
    if ($table == 'customer') {
        $filter = $_POST['filter'];
        $match ='';
        $new_fitler;
        $special = 0;
        switch($filter) {
            case 'Paid':
                $match = 'paid_status';
                $new_filter = 1;
                break;
            case 'Unpaid';
                $match = 'paid_status';
                $new_filter = 0;
                break;
            case 'Car in Lot';
                $match = 'active_status';
                $special = 1;
                $new_filter = "SELECT customer.customer_id, `name`, `make`, `model`, `paid_status` FROM `customer`
                                LEFT JOIN ticket ON ticket.customer_id=customer.customer_id
                                WHERE pick_up_driver IS NULL";
                break;
            case 'Car picked up';
                $match = 'active_status';
                $special = 1;
                $new_filter = "SELECT customer.customer_id, `name`, `make`, `model`, `paid_status` FROM `customer`
                                LEFT JOIN ticket ON ticket.customer_id=customer.customer_id
                                WHERE pick_up_driver IS NOT NULL";
                break;
        }
        if($special == 1) {
            $stmt = executeSQL($dbConn, $new_filter);
        } else {
          $stmt = queryFilter($table, $match, $new_filter, $dbConn); 
        }
        
        $str = "<div class='table-responsive'>";
        $str = $str . "<table class='table table-bordered'>";
        $str = $str . "<thead>
                        <tr>
                          <th>Customer ID</th>
                          <th>Name</th>
                          <th>Make</th>
                          <th>Model</th>
                          <th>Paid</th>
                        </tr>
                        </thead>";
        $str = $str . "<tbody>";
        
        while ($row = $stmt -> fetch())  {
            $str = $str. "<tr>";
            $str = $str . "<td>" . $row['customer_id'] . "</td>";
            $str = $str . "<td>" . $row['name'] . "</td>";
            $str = $str . "<td>" . $row['make'] .  "</td>";
            $str = $str . "<td>" . $row['model'] .  "</td>";
            $str = $str . "<td>" . $row['paid_status'] .  "</td>";
            $str = $str . "</tr>";
        }
        $str = $str . "</tbody></table></div>";
        echo $str;
    }
    if ($table == 'ticket') {
        $filter = $_POST['filter'];
        $match;
        $new_filter = '';
        switch($filter) {
            case 'Car Delivered':
                $new_filter = 'SELECT * FROM `ticket` WHERE pick_up_driver IS NOT NULL';
                break;
            case 'Needs Pickup';
                $new_filter = 'SELECT * FROM `ticket` WHERE pick_up_driver IS NULL';
                break;
        }

        $stmt = executeSQL($dbConn, $new_filter);
        $str = "<div class='table-responsive'>";
        $str = $str . "<table class='table table-bordered'>";
        $str = $str . "<thead>
                        <tr>
                          <th>Ticket ID</th>
                          <th>Customer ID</th>
                          <th>Dropoff Driver ID</th>
                          <th>Pickup Driver ID</th>
                          <th>Parking Spot</th>
                          <th>Dropoff Time</th>
                        </tr>
                        </thead>";
        $str = $str . "<tbody>";
        
        while ($row = $stmt -> fetch())  {
            $str = $str. "<tr>";
            $str = $str . "<td>" . $row['ticket_id'] . "</td>";
            $str = $str . "<td>" . $row['customer_id'] . "</td>";
            $str = $str . "<td>" . $row['drop_off_driver'] . "</td>";
            if ($row['pick_up_driver'] == '') {
                $str = $str . "<td>" . 'None' . "</td>";
            }
            else {
                $str = $str . "<td>" . $row['pick_up_driver'] . "</td>";
            }
            
            $str = $str . "<td>" . $row['parking_spot_id'] . "</td>";
            $str = $str . "<td>" . $row['time'] . "</td>";
            $str = $str . "</tr>";
        }
        $str = $str . "</tbody></table></div>";
        echo $str;
    }
} //end filter set

function queryAll($table, $dbConn) {
    $sql = "SELECT * FROM `$table`";
    $stmt = $dbConn -> prepare ($sql);
    $stmt -> execute ();
    return $stmt;
}

function queryFilter($table, $match, $new_filter, $dbConn) {
    $sql = "SELECT * FROM $table WHERE `$match` = $new_filter";
    $stmt = $dbConn -> prepare ($sql);
    $stmt -> execute ();
    return $stmt;
}

function executeSQL($dbConn, $sql) {
    $stmt = $dbConn -> prepare ($sql);
    $stmt -> execute ();
    return $stmt;
}

  
?>