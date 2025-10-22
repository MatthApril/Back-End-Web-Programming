<?php 
    function errorMessage(){
        if (isset($_SESSION["error"])){ 
            echo "<label style='color: red;''>" . $_SESSION["error"] . " </label>";
            unset($_SESSION["error"]);
       }
    }
    function alert($message){
        echo "<script>alert('$message');</script>";
    }
?>