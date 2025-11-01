<?php

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    function fetch_countries($connection){
        try{
            $fetch_countries_query = "
                SELECT * FROM countries;
            ";

            $statement = $connection->prepare($fetch_countries_query);

            $statement->execute();

            $countries = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $countries;

        }catch(PDOException $error){
            error_log("[" . date("Y-m-d H:i:s") . "] Failed to fetch countries: " . $error->getMessage() . "\n", 3, __DIR__ . "/error.log");
        }
    }

    function fetch_states($connection){
        try{
            $fetch_states_query = "
                SELECT * FROM states;
            ";

            $statement = $connection->prepare($fetch_states_query);

            $statement->execute();

            $states = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $states;

        }catch(PDOException $error){
            error_log("[" . date("Y-m-d H:i:s") . "] Failed to fetch states: " . $error->getMessage() . "\n", 3, __DIR__ . "/error.log");
        }
    }

    function log_database_error(PDOException $error) {
        $log_message = sprintf("[%s] Database error in %s (line %d): %s\n",
            date("Y-m-d H:i:s"),
            $error->getFile(),
            $error->getLine(),
            $error->getMessage()
        );
        error_log($log_message, 3, __DIR__ . "/error.log");
    }

    function set_flash($type, $message){
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

    function get_flash(){
        if(isset($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }

    function get_country_name($connection, $country_id){
        try{
            $get_country_name_query = "
                SELECT * FROM countries
                WHERE id = :country_id;
            ";

            $statement = $connection->prepare($get_country_name_query);

            $statement->bindParam(":country_id", $country_id);

            $statement->execute();

            $result = $statement->fetch();

            return $result['country_name'];
        }catch(PDOException $error){
            error_log("[" . date("Y-m-d H:i:s") . "] Failed to fetch country against the user: " . $error->getMessage() . "\n", 3, __DIR__ . "/error.log");
        }
    }

    function get_state_name($connection, $state_id){
         try{
            $get_state_name_query = "
                SELECT * FROM states
                WHERE id = :state_id;
            ";

            $statement = $connection->prepare($get_state_name_query);

            $statement->bindParam(":state_id", $state_id);

            $statement->execute();

            $result = $statement->fetch();

            return $result['state_name'];
        }catch(PDOException $error){
            error_log("[" . date("Y-m-d H:i:s") . "] Failed to fetch state against the user: " . $error->getMessage() . "\n", 3, __DIR__ . "/error.log");
        }
    }
    
?>