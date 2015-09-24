<section id="mainarea">
     <div id="searchresults">
    <?php
        

        $isgensearch = true;
        $validID = true;

            if($_GET['general_search'] != ""){
                //echo "woowowoow";
                $query = trim($_GET['general_search']);
                // gets value sent over search form
                $isgensearch = true;
            }
            else {
                $query = trim($_GET['spesific_search']);
                // gets value sent over search form 
                //echo "nananana batman";
                $isgensearch = false;
                $selectOption = $_GET['search_option'];
                //echo $selectOption;
            }
            
            if($isgensearch){
                    echo '<h2 title="General Search"><b style="font-weight: 400">Search key : </b> ' . $query . '</h2>';
 
            }
            else{
                
                echo '<h2><b style="font-weight: 400">'; 
                
                if($selectOption == "sbook_name"){
                        echo '<i title="Searching by Book Name" class="fa fa-book"></i>';
                    }
                    elseif($selectOption == "sauthor"){
                        echo '<i title="Searching by Author" class="fa fa-user"></i>';
                    }
                    elseif($selectOption == "sgenre"){
                        echo '<i title="Searching by Genre" class="fa fa-circle"></i>';
                    }
                    elseif($selectOption == "spublisher"){
                        echo '<i title="Searching by Publisher" class="fa fa-globe"></i>';
                    }
                    elseif($selectOption == "slocation"){
                        echo '<i title="Searching by Location" class="fa fa-map-marker"></i>'; 
                    }
                    elseif($selectOption == "sid"){
                    
                    }
                    else{
                        //Do nothing
                    }
                echo ' Search key : </b> ' . $query . '</h2>';
                //echo '<h2><b style="font-weight: 400"> <i class="fa fa-map-marker"></i> Search key : </b> ' . $query . '</h2>';
            }

            $min_length = 1;
            // you can set minimum length of the query if you want

            if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then

                $query = htmlspecialchars($query); 
                // changes characters used in html to their equivalents, for example: < to &gt;


                if($isgensearch){
                        $raw_results = $DB_con->prepare("SELECT * FROM books
                        WHERE (`user_id` LIKE $user_id ) AND 
                        ((`book_name` LIKE '%".$query."%') OR 
                        (`book_id` LIKE  '%".$query."%') OR 
                        (`location` LIKE '%".$query."%')OR 
                        (`genre` LIKE '%".$query."%') OR 
                        (`publisher` LIKE '%".$query."%') OR 
                        (`author` LIKE '%".$query."%'))");
                }
                else {
                    
                    
                    
                    if($selectOption == "sbook_name"){
                        $raw_results = $DB_con->prepare("SELECT * FROM books
                        WHERE (`user_id` LIKE $user_id ) AND 
                        (`book_name` LIKE '%".$query."%')");
                    }
                    elseif($selectOption == "sauthor"){
                        $raw_results = $DB_con->prepare("SELECT * FROM books
                        WHERE (`user_id` LIKE $user_id ) AND 
                        (`author` LIKE '%".$query."%')");
                    }
                    elseif($selectOption == "sgenre"){
                        $raw_results = $DB_con->prepare("SELECT * FROM books
                        WHERE (`user_id` LIKE $user_id ) AND 
                        (`genre` LIKE '%".$query."%')");
                    }
                    elseif($selectOption == "spublisher"){
                        $raw_results = $DB_con->prepare("SELECT * FROM books
                        WHERE (`user_id` LIKE $user_id ) AND 
                        (`publisher` LIKE '%".$query."%')");
                    }
                    elseif($selectOption == "slocation"){
                        $raw_results = $DB_con->prepare("SELECT * FROM books
                        WHERE (`user_id` LIKE $user_id ) AND 
                        (`location` LIKE '%".$query."%')");
                    }
                    elseif($selectOption == "sid"){
                        
                        if(is_numeric($query)){
                            $raw_results = $DB_con->prepare("SELECT * FROM books
                        WHERE (`user_id` LIKE $user_id ) AND 
                        (`book_id` LIKE $query )");
                        $validID = true;
                            //Headers already sent errro. TO DO
                            //header('book.php?id=' . $query);
                        }
                        else{
                            $validID=false;
                            echo "<h2>Please only enter numeric input for Book ID</h2>";
                        }
                        
                        
                    }
                    else{
                        $raw_results = $DB_con->prepare("SELECT * FROM books
                        WHERE (`user_id` LIKE $user_id ) AND 
                        ((`book_name` LIKE '%".$query."%') OR 
                        (`book_id` LIKE  '%".$query."%') OR 
                        (`location` LIKE '%".$query."%')OR 
                        (`genre` LIKE '%".$query."%') OR 
                        (`publisher` LIKE '%".$query."%') OR 
                        (`author` LIKE '%".$query."%'))");
                    }
                }
               
                if($validID){
                    $raw_results->execute();
                
                
                    if($raw_results->rowCount() > 0){ 
                    
                        while($results = $raw_results->fetch(PDO::FETCH_ASSOC)){

                            $newbook = new book($user_id,$results['book_name'],$results['author'],$results['genre'],$results['publisher'],$results['location'],$results['book_id']);
                        
                            $newbook->display_books_search();

                        }

                    }
                    else{ // if there is no matching rows do following
                        echo "<h2>No results</h2>";
                    }
                }

            }
            else{ // if query length is less than minimum
                //echo "Minimum length is ".$min_length;
                echo "<h2>Enter something.</h2>";
            }

 
        if (isset($check)){
            $user->display_add_message($check,$newbook);
        }  
?>
         
    </div>
</section>