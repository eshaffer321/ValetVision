<?php
    function getDatabaseConnection() {
        $dbHost = getenv('IP');
        $dbPort = 3306;
        $dbName = "valet";
        $username = getenv('C9_USER');
        $password = "";
        
        $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConn;
    }
    function executeSQL() {
        $db = getDatabaseConnection();
        $sql = " SELECT * FROM co_department";
        $stmt = $db -> prepare ($sql);
        $stmt -> execute ();
        while ($row = $stmt -> fetch())  {
            var_dump($row);
            //echo  $row['my_first_column'] . ", " . $row['field2_name'];
        }
    }
?>