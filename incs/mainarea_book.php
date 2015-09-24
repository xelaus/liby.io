<section id="mainarea">

    
    <?php


    //echo $_GET["bookid"];

//    if(!isset($_GET["bookid"])){
//        header('index.php');
//        exit();
//    }

if(isset($_GET["bookid"])){
    
    $bigbookid = $_GET["bookid"];
    

    if(isset($_POST['lendedto'])){

        
        $lendedto = $_POST['lendedto'];
        
         try{
   
            $db_lend = $DB_con->prepare("UPDATE books SET lended_to=:lendedto WHERE user_id=:user_id AND book_id=:bigbookid");
             
             
            $db_lend->bindparam(":lendedto", $lendedto);  
            $db_lend->bindparam(":user_id", $user_id);
            $db_lend->bindparam(":bigbookid", $bigbookid); 
            $db_lend->execute(); 
             
            //echo "Book lended succesfully"; 
   
       }
       catch(PDOException $e)
       {
           echo "Sorry, there was an unexpected error. Error Code: BLND001"; 
       }
        
        
    }
    
    if(isset($_POST['btn_unlend'])){
        //echo "Wowowoowowowowoow aldlas";
        //$unlendedto = $_POST['lendedto'];
        
         try{
   
            $db_lend = $DB_con->prepare("UPDATE books SET lended_to=NULL WHERE user_id=:user_id AND book_id=:bigbookid");
             
             
            $db_lend->bindparam(":user_id", $user_id);
            $db_lend->bindparam(":bigbookid", $bigbookid); 
            $db_lend->execute(); 
             
            //echo "Book lended succesfully"; 
   
       }
       catch(PDOException $e)
       {
           echo "Sorry, there was an unexpected error. Error Code: BLND002"; 
       }
        
    }
    

    //$bigbookid = $_GET["bookid"];


    $db_book = $DB_con->prepare("SELECT * FROM books WHERE user_id=:user_id AND book_id=:bigbookid");
    $db_book->bindparam(":bigbookid", $bigbookid);
    $db_book->bindparam(":user_id", $user_id);
    $db_book->execute(); 
    



    if(!$db_book) {
        die('<br/>MySQL Error: ' . mysql_error());
        header("home.php"); /* Redirect browser */
        exit();
    }
    else {
    //echo '<br />Result is true';
   
        $row=$db_book->fetch(PDO::FETCH_ASSOC);
    //echo '<br />tryed fetching row';
        if(!isset($row['book_id'])){
            echo "<h2>You don't have any books with the ID " . $bigbookid . "</h2>";
        }
        else{
            
            $bigbook = new book($user_id,
                                $row['book_name'],
                                $row['author'],
                                $row['genre'],
                                $row['publisher'],
                                $row['location'],
                                $row['book_id']);
            
            
            $bigbook->display_bigbook();
            
            echo ' <div id="bookoptions_wrapper">
                <div id="bookoptions">
                   <h2>Options:</h2>
                   <i class="fa fa-trash-o" id="delete_button" title="Delete"></i>
                   ';
            
            if(!is_null($row['lended_to'])){
             //echo "wow";
            
                //echo $row['lended_to']; 
                echo '<i class="fa fa-hand-rock-o" id="unlend_button" title="Unlend"></i>';
                echo '<form method="post" id="unlend_form">
                        <button type="submit" name="btn_unlend" value="unlend" id="btn_unlend">
                            
                            </button>
                        </form>
                '; 
                echo '<p id="lendedname">Lended to ' . $row['lended_to'] . '</p>';
                
            }
            else {
                 echo '<i class="fa fa-hand-paper-o" id="lend_button" title="Lend"></i>';
            }
            
            
           
            
            
            echo '
               </div>
               
               <div id="optionquestion_delete">
                    <p>Are you sure?</p>
                    <a href="deleted.php"><p class="answer" id="answer_yes">Yes</p></a>
                    <p class="answer" id="answer_no">No</p>
               </div>
               
               <div id="optionquestion_lend">
                        <form action="book.php?bookid=' . $bigbookid . '" method="post">
                            
                    <div class="lend_input">
	                   			<input id="lendinput" type="text" maxlength="90" name="lendedto" required/>
	                   		
                            <button type="submit" name="btn_lend" value="lend" id="btn_lend">
                            Lend
                            </button>
                           
                          <p id="cancel_lend">Cancel</p>
                            
                            </div>
                        </form>
                         
               </div>
            
            </div>
            </div>';
            
            $book_array = array($user_id,
                            $row['book_name'],
                            $row['author'],
                            $row['genre'],
                            $row['publisher'],
                            $row['location'],
                            $row['book_id']);
            
            $_SESSION['bigbook'] = $book_array;
        
            $_SESSION['bigbookid'] = $bigbookid;   
            
        }
       
  
    }
}

else{
    echo "Please input a book id.";
}


    ?>
    
    
    
</section>