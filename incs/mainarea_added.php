<section id="mainarea">
  
    
    
    <?php

        $inbook = $_SESSION['lastbookadded'];
        
        //echo $inbook['name'];
        $newbook= new book($user_id,
                           $inbook['name'],
                           $inbook['author'],
                           $inbook['genre'],
                           $inbook['publisher'],
                           $inbook['location'],
                           $_SESSION['lastbookid']);
        //$incomingbook->book_id = $_SESSION['lastbookid'];
        //echo $_SESSION['lastbookid'];
        $check = true;

        $user->display_add_message($check,$newbook);
    ?>
    
</section>