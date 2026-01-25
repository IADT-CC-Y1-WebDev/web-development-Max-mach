<?php 
function isValidEmail($email){
    if(strpos($email,"@") !== false) {
    echo"Valid email $email";
    } else{
        echo "Not valid email: $email";
    }
    ;
}
isValidEmail("bob@gamil.ie");

?>