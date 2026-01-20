<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/03-arrays.php">View Example &rarr;</a>
    </div>

    <h1>Arrays Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Favorite Movies</h2>
    <p>
        <strong>Task:</strong> 
        Create an indexed array with 5 of your favorite movies. Use a for 
        loop to display each movie with its position (e.g., "Movie 1: 
        The Matrix").
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $films = ['The Dark Knight', 'The Lord of the Rings', 'Pirates of the Caribbean', 'Star Wars','Avengers'];
        echo"<ul>";
        for ($i = 0; $i < count($films); $i++) {
            echo"<li>Movie $i: $films[$i] </li>";
        }
        echo "</ul>";
        ?>
        
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Student Record</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array for a student with keys: name, studentId, 
        course, and grade. Display this information in a formatted sentence.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $students = [
            "name" => "Bob",
            "studentId" => "100102",
            "course" => "IT",
            "grade" => "A"
        ];
         $text ="The student name is {$students['name']} , id {$students['studentId']}, course {$students['course']}, grade {$students['grade']}";
         echo"<p>$text</p>";
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Country Capitals</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array with at least 5 countries as keys and their 
        capitals as values. Use foreach to display each country and capital 
        in the format "The capital of [country] is [capital]."
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $country = [
            "Japan"=> "Tokio",
            "United States"=> "Washington",
            "China"=> "Beijing",
            "South Korea"=> "Seoul",
            "Mexico"=> "Mexico City"
        ];
        echo"<ul>";
        foreach($country as $key => $value) {
            echo"<li>The capital of $key is $value.";
        }
        echo "</ul>";
        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Menu Categories</h2>
    <p>
        <strong>Task:</strong> 
        Create a nested array representing a restaurant menu with at least 
        2 categories (e.g., "Starters", "Main Course"). Each category should 
        have at least 3 items with prices. Display the menu in an organized 
        format.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $menu = [
           'Starters'=>[
            'Seafood chowder'=> '12',
            'Chatpata pork'=> '10',
            'Curry leaf prawns'=> '8',
           ],
           'Main' =>[
            'Mangalorean chicken curry'=> '18',
            'Old delhi butter chicken'=> '20',
            'Paneer aur aloo ke kofte'=> '18',
            'Mango prawn'=> '25',
           ],
           'Dessert' =>[
            'Dark chocolate brownie'=> '10',
            'Selection of ice creams' => '10',
            'Selection of sorbets' => '10'
           ] 
           ];
           foreach($menu as $section => $items) {
            echo "<p> $section </p>";
            echo"<ul>";
            foreach($items as $key => $value) {
                echo "<li>$key - €$value</li>";
            }
            echo "</ul>";
           }
        ?>
    </div>

</body>
</html>
