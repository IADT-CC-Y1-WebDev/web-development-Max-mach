<?php 
function formatPhoneNumber($number){
    if(is_int($number)!== false) {
    echo"<p>Valid number $number </p>";
    } else{
        echo "<p>Not valid number: $number </p>";
    }
    ;
}
formatPhoneNumber(1888888888888888);

?>