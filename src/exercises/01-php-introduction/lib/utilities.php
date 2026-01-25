 <?php
        // TODO: Write your solution here
        function truncate($text, $length = 1000){
            if(strlen($text) <=$length){
        $countwords = strlen($text);
         echo"$countwords" ." <br>";
            }
        }
        function formatPrice($amount){
            $dollars = $amount * 1.18;
            echo"Euro $amount to dollars: $dollars" ." <br>";
        }
        function getCurrentYear(){
            $year = date("Y");
            echo"". $year ."";
        }
        truncate("awfawfawfawfawffafaaaaaafafafafafafafafafafafafafafafafafafafafawaf");
        formatPrice(50);
        getCurrentYear();

        ?>
