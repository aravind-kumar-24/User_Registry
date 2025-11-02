<?php

    require_once __DIR__. '/../bootstrap.php';

    $server_name = $_ENV['DATABASE_HOST'];
    $user_name = $_ENV['DATABASE_USER_NAME'];
    $password = $_ENV['DATABASE_PASSWORD'];
    $database_name = $_ENV['DATABASE_NAME'];
    $port = $_ENV['DATABASE_PORT_NUMBER'];

    $data_source_name = "mysql:host=$server_name;port=$port;dbname=$database_name";

    try{
        $connection = new PDO($data_source_name, $user_name, $password);

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    }catch(PDOException $error){
        echo "Connection failed: " . $error->getMessage();
    }

?>