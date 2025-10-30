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
    
?>