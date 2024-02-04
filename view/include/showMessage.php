<?php
    if (isset($_SESSION["errorMessage"])) {
        echo "<div class=\"error-message\"> \n";
        echo $_SESSION["errorMessage"]; 
        echo "</div> \n";
        unset($_SESSION["errorMessage"]);
    }

    if (isset($_SESSION["successMessage"])) {
        echo "<div class=\"success-message\"> \n";
        echo $_SESSION["successMessage"]; 
        echo "</div> \n";
        unset($_SESSION["successMessage"]);
    }
?>
