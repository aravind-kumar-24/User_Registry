<?php

    function process_input_data($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);

        return $data;
    }

?>