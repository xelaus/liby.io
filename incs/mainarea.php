<section id="mainarea">
  
    
    <div id="welcomemsg">
        <h2> 
            <?php 
                if (!isset($check)){
                    echo "Welcome.";
                }
            ?>
        </h2>
        
        
        <h2>
<?php


$del = $DB_con->prepare("SELECT * FROM books where user_id='$user_id'");
$del->execute();


$count = $del->rowCount();

if($count == 1){
    echo "You currently have " . $count . " book in your library.";
}
else{
echo "You currently have " . $count . " books in your library.";
}

?>
        
        
        </h2>
        
    </div>
    
    
    <div id="lastbook">
       <?php

            
            
            if($count != 0){
                
                echo '<h2 style="margin-top:70px;">Last book you added;</h2>';
                
                
                $result = $del->fetchAll();
                
                //print_r($result[$count-1]);
                
                $row = $result[$count-1];
                //echo $row['book_name'];
                
                $lastbook = new book($user_id,
                                     $row['book_name'],
                                     $row['author'],
                                     $row['genre'],
                                     $row['publisher'],
                                     $row['location'],
                                     $row['book_id']);
                
                $lastbook->display_books_search();
                //echo "lol";
            }

        
        ?>
        
    
    
    </div>

    
</section>