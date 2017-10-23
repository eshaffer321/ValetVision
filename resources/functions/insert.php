<?php
    include 'database.php';
    $name = $_POST['name'];
    $make = $_POST ['make'];
    $model = $_POST['model'];
    
    $db = getDatabaseConnection();
    $dropOffDriver = getDropOffDriver();
    $parkingSpot = getParkingSpot();
    
    /***
     * Get a random driver_id from the driver table
     */
    function getDropOffDriver() {
        global $db;
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
     function getParkingSpot() {
         global $db;
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
      */
      function createCustomer() {
          global $name;
          global $make;
          global $model;
          //I will have to use OUTPUT to get the customer_id to be used in the ticket table
      }
      
      /**
       * Insert a new ticket with the values of
       * customer_id, drop_off_driver, parking_spot_id, and pick_up_driver initally to NULL
       */
      
      /**
       * Update the parking spot to have a status of 1 a
       */
       function updateParkingSpot() {
           
       }
?>