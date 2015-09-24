<?php

include_once 'incs/dbconnect.php';

$check = false;

if(!isset($user_id)){
    header("Location: index.php");
    exit();
}



if(isset($_SESSION['bigbookid'])){
    
    
    $bigbookid = $_SESSION['bigbookid'];
    
    if(!isset($_GET['btn_update'])){
        header('Location: book.php?bookid=' . $bigbookid);
        exit(); 
    }
    
    unset($_SESSION['bigbookid']);
    
    echo $bigbookid;
    
    try{
        $stmt = $DB_con->prepare("SELECT * FROM books WHERE (user_id=:user_id) AND  (book_id=:bigbookid)");
        $stmt->bindparam(":bigbookid", $bigbookid);
        $stmt->bindparam(":user_id", $user_id);
        $stmt->execute(); 
        
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
                
        if($stmt->rowCount() > 0){
            $check = true;
            //echo "<p>YAY THAR IS A BOOK</p>";
        }
        else {
            //err code + go back home
             echo '<p>Sorry there was an unexpected error. Error Code: BUPDT001</p>
                    <p><a href="index.php">Go back home</a></p>';
        }
    
    }
    catch(PDOException $e){
        //err code + go back home
        echo '<p>Sorry there was an unexpected error. Error Code: BUPDT002</p>
                    <p><a href="index.php">Go back home</a></p>';
    }



}

else {
    header("Location: index.php");
    exit();
}

if($check){

    
    if($_GET['btn_update'] == "name"){
        
        $name = $_GET['book_name'];
        
        try{
            $stmt = $DB_con->prepare("UPDATE books SET book_name=:name WHERE user_id=:user_id AND book_id=:bigbookid");
              
            $stmt->bindparam(":name", $name);
            $stmt->bindparam(":user_id", $user_id); 
            $stmt->bindparam(":bigbookid", $bigbookid);
           
            $stmt->execute(); 
    
            if(!$stmt){
               echo '<p>Sorry there was an unexpected error. Error Code: BUPDT1000</p>
                    <p><a href="index.php">Go back home</a></p>';
            }
            else{
                header('Location: book.php?bookid=' . $bigbookid);
                exit();
            }
        } catch(PDOException $e){
            //errr code + go back home
            echo    '<p>Sorry there was an unexpected error. Error Code: BUPDT004</p>
                     <p><a href="index.php">Go back home</a></p>';
        }
    
    }
    
    
    elseif($_GET['btn_update'] == "author"){
        
        $author = $_GET['author'];
        
        try{
            $stmt = $DB_con->prepare("UPDATE books SET author=:author WHERE user_id=:user_id AND book_id=:bigbookid");
              
            $stmt->bindparam(":author", $author);
            $stmt->bindparam(":user_id", $user_id); 
            $stmt->bindparam(":bigbookid", $bigbookid);
           
            $stmt->execute(); 
    
            if(!$stmt){
               echo '<p>Sorry there was an unexpected error. Error Code: BUPDT1001</p>
                    <p><a href="index.php">Go back home</a></p>';
            }
            else{
                header('Location: book.php?bookid=' . $bigbookid);
                exit();
            }
        } catch(PDOException $e){
            //errr code + go back home
            echo    '<p>Sorry there was an unexpected error. Error Code: BUPDT005</p>
                     <p><a href="index.php">Go back home</a></p>';
        }    
        
        
    }
    
    
    elseif($_GET['btn_update'] == "genre"){
        
        $genre = $_GET['genre'];
        
        try{
            $stmt = $DB_con->prepare("UPDATE books SET genre=:genre WHERE user_id=:user_id AND book_id=:bigbookid");
              
            $stmt->bindparam(":genre", $genre);
            $stmt->bindparam(":user_id", $user_id); 
            $stmt->bindparam(":bigbookid", $bigbookid);
           
            $stmt->execute(); 
    
            if(!$stmt){
               echo '<p>Sorry there was an unexpected error. Error Code: BUPDT1002</p>
                    <p><a href="index.php">Go back home</a></p>';
            }
            else{
                header('Location: book.php?bookid=' . $bigbookid);
                exit();
            }
        } catch(PDOException $e){
            //errr code + go back home
            echo    '<p>Sorry there was an unexpected error. Error Code: BUPDT006</p>
                     <p><a href="index.php">Go back home</a></p>';
        }    
        
        
    }
    

    elseif($_GET['btn_update'] == "publisher"){
        
        $publisher = $_GET['publisher'];
        
        try{
            $stmt = $DB_con->prepare("UPDATE books SET publisher=:publisher WHERE user_id=:user_id AND book_id=:bigbookid");
              
            $stmt->bindparam(":publisher", $publisher);
            $stmt->bindparam(":user_id", $user_id); 
            $stmt->bindparam(":bigbookid", $bigbookid);
           
            $stmt->execute(); 
    
            if(!$stmt){
               echo '<p>Sorry there was an unexpected error. Error Code: BUPDT1003</p>
                    <p><a href="index.php">Go back home</a></p>';
            }
            else{
                header('Location: book.php?bookid=' . $bigbookid);
                exit();
            }
        } catch(PDOException $e){
            //errr code + go back home
            echo    '<p>Sorry there was an unexpected error. Error Code: BUPDT007</p>
                     <p><a href="index.php">Go back home</a></p>';
        }    
        
        
    }
    
    
    elseif($_GET['btn_update'] == "location"){
        
        $location = $_GET['location'];
        
        try{
            $stmt = $DB_con->prepare("UPDATE books SET location=:location WHERE user_id=:user_id AND book_id=:bigbookid");
              
            $stmt->bindparam(":location", $location);
            $stmt->bindparam(":user_id", $user_id); 
            $stmt->bindparam(":bigbookid", $bigbookid);
           
            $stmt->execute(); 
    
            if(!$stmt){
               echo '<p>Sorry there was an unexpected error. Error Code: BUPDT1004</p>
                    <p><a href="index.php">Go back home</a></p>';
            }
            else{
                header('Location: book.php?bookid=' . $bigbookid);
                exit();
            }
        } catch(PDOException $e){
            //errr code + go back home
            echo    '<p>Sorry there was an unexpected error. Error Code: BUPDT008</p>
                     <p><a href="index.php">Go back home</a></p>';
        }    
        
        
    }
    
    else {
        echo    '<p>Sorry there was an unexpected error. Error Code: BUPDT009</p>
                     <p><a href="index.php">Go back home</a></p>';
    }
  
        
}
?>
