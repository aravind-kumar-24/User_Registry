<?php

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
            echo "Failed to fetch countries: " . $error->getMessage();
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
            echo "Failed to fetch states: " . $error->getMessage();
        }
    }

    
?>