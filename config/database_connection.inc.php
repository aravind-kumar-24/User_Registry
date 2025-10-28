<?php

    $server_name = "localhost";
    $user_name = "root";
    $password = "";
    $database_name = "user_registry";
    $port = "3307";

    $data_source_name = "mysql:host=$server_name;port=$port;dbname=$database_name";

    try{
        $connection = new PDO($data_source_name, $user_name, $password);

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    }catch(PDOException $error){
        echo "Connection failed: " . $error->getMessage();
    }

?>