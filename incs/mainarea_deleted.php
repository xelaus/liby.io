<section id="mainarea">


<?php

$book_array = $_SESSION['bigbook'];

//echo $book_array[1];

try {

    
    // sql to delete a record
    $sql = "DELETE FROM books WHERE book_id=$book_array[6]";

    // use exec() because no results are returned
    $DB_con->exec($sql);
    echo "<h2>" . $book_array[1] . " with the ID " . $book_array[6] ." deleted successfully.</h2>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>




</section>