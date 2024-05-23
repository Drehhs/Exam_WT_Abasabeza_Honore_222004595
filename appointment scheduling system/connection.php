<?php

    $database= new mysqli("localhost","ABAO","222004595","appointment_scheduling_system");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>