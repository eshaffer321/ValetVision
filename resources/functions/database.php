<?php
    $name = $_POST['name'];
    $make = $_POST ['make'];
    $model = $_POST['model'];
    $ticketID;
    $db = getDatabaseConnection();
    
    /**
     * Get a databse connection that can be used. Will eventually change to read
     * from .env when deployed.
     */
    function getDatabaseConnection() {
        $dbHost = getenv('DATABASE_HOST');
        $dbPort = 3306;
        $dbName = getenv('DATABASE_NAME');
        $username = getenv('DATABASE_USER');
        $password = getenv('DATABASE_PASSWORD');
        
        $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConn;
    }
    
    /**
     * Check to make sure that all that all the data we need was set
     * properly
     */
    function validInput() {
        if (isset($_POST['name']) && isset($_POST ['make']) && isset($_POST['model'])) {
            return true;
        } 
        return false;
    }
     
    /**
     * Check to see if we are at max capacity
     * Returns true if there is more than 1 spot available and
     * false if there are none available
     */
     function spotsAvailable($db) {
        $sql = "SELECT COUNT(parking_spot_id) as available FROM `parking_spot`
                WHERE `status` = 0 AND ticket_id IS NULL";
        $stmt = $db -> prepare ($sql);
        $stmt -> execute ();
        $amount;
        while ($row = $stmt -> fetch())  {
            $amount = $row['available'];
        }
        
        if ($amount > 0) {
            return true;
        }
        return false;
     }
     
    /**
     * Get a random driver_id from the driver table
     */
    function getDropOffDriver($db) {
        $sql = "SELECT driver_id FROM `driver` 
                ORDER BY rand()
                LIMIT 1";
        $stmt = $db -> prepare ($sql);
        $stmt -> execute ();
        while ($row = $stmt -> fetch())  {
            return $row['driver_id'];
        }
    }

    /**
     * Get the next available parking_spot_id from the parking_spot table
     */
     function getParkingSpot($db) {
         $sql = "SELECT `parking_spot_id` FROM `parking_spot`
                WHERE `status` = 0 
                AND `ticket_id` IS NULL
                LIMIT 1";
        $stmt = $db -> prepare ($sql);
        $stmt -> execute ();
        while ($row = $stmt -> fetch())  {
            return $row['parking_spot_id'];
        }
     }
     
     /**
      * Insert the customer into the customer table
      * Returns the customer_id of the newly created customer
      */
      function createCustomer($db) {
          global $name;
          global $make;
          global $model;

          $sql = "INSERT INTO `customer`(`name`, `make`, `model`) VALUES ('$name','$make','$model')";
          $stmt = $db -> prepare ($sql);
          $stmt -> execute ();
          
          $sql = "SELECT LAST_INSERT_ID()";
          $stmt = $db -> prepare ($sql);
          $stmt -> execute ();
          while ($row = $stmt -> fetch())  {
            return $row['LAST_INSERT_ID()'];
          }
      }
      
      /**
       * Insert a new ticket with the values of
       * customer_id, drop_off_driver, parking_spot_id, and pick_up_driver initally to NULL
       */
       function createTicket($db) {
           $dropOffDriver = getDropOffDriver($db);
           $parkingSpot = getParkingSpot($db);
           $customerId = createCustomer($db);
           $pickUpDriver = NULL; 
           $now = new DateTime();
           $now = $now->format('Y-m-d H:i:s');
           
           $sql = "INSERT INTO `ticket`( `customer_id`, `drop_off_driver`, `pick_up_driver`, `parking_spot_id`, `time`) 
           VALUES ($customerId, $dropOffDriver, NULL, $parkingSpot, NOW())";
           $stmt = $db -> prepare ($sql);
           $stmt -> execute ();
           
          $sql = "SELECT LAST_INSERT_ID()";
          $stmt = $db -> prepare ($sql);
          $stmt -> execute ();
          
          global $ticketID;
          while ($row = $stmt -> fetch())  {
            $ticketID = $row['LAST_INSERT_ID()'];
          }
           updateParkingSpot($parkingSpot, $ticketID, $db);
       }
      
      /**
       * Update the parking spot to have a status of 1 
       */
       function updateParkingSpot($parkingSpotId, $ticketId, $db) {
           $sql = "UPDATE `parking_spot` SET `status`='1',`ticket_id`= '$ticketId 
           'WHERE `parking_spot_id` = $parkingSpotId";
           $stmt = $db -> prepare ($sql);
           $stmt -> execute ();
       }
       
       /**
        * Return data that should be on the ticket
        */
        function getTicketData($db) {
            $db = getDatabaseConnection();
            global $ticketID;
            $sql = "SELECT `ticket_id` as Ticket_Number, `time`, `parking_spot_id` as Parking_ID, `name` FROM `ticket` 
            LEFT JOIN `driver` ON driver.driver_id = ticket.drop_off_driver
            WHERE `ticket_id` = " . $ticketID;
            
            $stmt = $db -> prepare ($sql);
            $stmt -> execute ();
            
            $ticketInfo = array();
            while ($row = $stmt -> fetch())  {
                $ticketInfo['ticketNumber'] = $row['Ticket_Number'];
                $ticketInfo['driverName'] = $row['name'];
                $ticketInfo['parkingSpot'] = $row['Parking_ID'];
                $ticketInfo['time'] = $row['time'];
            }
            return $ticketInfo;
        }
?>
