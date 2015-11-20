<?php
class USER
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
    public function register($umail,$upass,$uhash){
       try
       {
           $new_password = password_hash($upass, PASSWORD_DEFAULT);
   
           $stmt = $this->db->prepare("INSERT INTO users(user_email,user_pass,hash) 
                                                       VALUES(:umail, :upass, :uhash)");
              
           $stmt->bindparam(":umail", $umail);
           $stmt->bindparam(":upass", $new_password); 
           $stmt->bindparam(":uhash", $uhash);
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 
    public function login($umail,$upass)
    {
       try
       {
           
          $stmt = $this->db->prepare("SELECT * FROM users WHERE user_email=:umail LIMIT 1");
          $stmt->execute(array(':umail'=>$umail));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
              
             if(password_verify($upass, $userRow['user_pass']) && $userRow['active'] == 1)
             {
                $_SESSION['user_session'] = $userRow['user_id'];
                return true;
             }
             elseif($userRow['active'] == 0 && password_verify($upass, $userRow['user_pass'])){
                 $active = "nope";
                 $_SESSION['active'] = $active;  
                 return false;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
       //exit();
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
    
    public function send_activation($umail,$uhash){
        
       
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; 
        $mail->Host = "";
        $mail->Port = 465; // or 587
        $mail->Username = "";
        $mail->Password = "";
        $mail->SetFrom("");
        $mail->IsHTML(true); 
        $mail->Subject = "Liby.io Activation";
        
//        $mail->Body = '<p>Thank you for using Libry.io!</p>
//                        <p>Please click on the link below to verify your account.</p>
//                        <a href="localhost/libr/verify.php?email=' . $umail . '&code=' . $uhash . '"'. '>
//                        localhost/libr/verify.php?email=' . $umail . '&code=' . $uhash . '
//                        </a>
//        ';
        
        $body = '

						<h2>Thank you for signing up with Liby.io!</h2>
						<h3>To verify your e-mail, click on the link below.</h3>
						<p><a href="http://liby.io/verify.php?email=' . $umail . '&code=' . $uhash . '"'. '">http://liby.io/verify.php?email=' . $umail . '&code=' . $uhash . '</a></p>
				';
        
        
        
        $mail->Body = $body;
        
        $mail->AddAddress($umail);
        
        if($mail->Send()) {
            return true;
        } 
        else {
            return false;
        }
    }
    
        public function send_forgotpass($umail,$uhash){
        
       
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; 
        $mail->Host = "";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true); 
        $mail->Username = "";
        $mail->Password = "";
        $mail->SetFrom("");
        $mail->Subject = "Liby.io Reset Password";
            
                $body = '
						<h3>Ignore this message if you didnt send a request to reset your password on Liby.io</h3>
						<h3>Please click on the link below to reset your password.</h3>
						
                        <a href="http://liby.io/resetpass.php?email=' . $umail . '&code=' . $uhash . '"'. '>
                        http://liby.io/resetpass.php?email=' . $umail . '&code=' . $uhash . '
                        </a>
				        ';
            
        $mail->Body = $body;
            
        $mail->AddAddress($umail);
        
        if($mail->Send()) {
            return true;
        } 
        else {
            return false;
        }
    }
    
    public function insert_forgothash($semail,$hashcode){
        try{
             $stmt = $this->db->prepare("UPDATE users SET forgot_hash=:hashcode WHERE user_email=:semail");
           
             $stmt->bindparam(":hashcode", $hashcode);
             $stmt->bindparam(":semail", $semail);
             $stmt->execute(); 
             return true;
        }
        catch(PDOException $e){
            return false;
        }
    }
    
    public function reset_pass($umail,$upass,$uhash){
       try
       {
           $new_password = password_hash($upass, PASSWORD_DEFAULT);
   
           $stmt = $this->db->prepare("UPDATE users SET user_pass=:new_password, forgot_hash= NULL WHERE user_email=:umail AND forgot_hash=:uhash");
              
           $stmt->bindparam(":umail", $umail);
           $stmt->bindparam(":new_password", $new_password); 
           $stmt->bindparam(":uhash", $uhash);
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
        
    }
    
    
    public function addbook($user_id,$newbook){
       try {
   
           $btab = $this->db->prepare("INSERT INTO books(user_id, book_name,genre,author,publisher,location) 
                                                       VALUES(:user_id, :bname, :bgenre, :bauthor, :bpublisher, :blocation)");
              
           $btab->bindparam(":user_id", $newbook->user_id);
           $btab->bindparam(":bname", $newbook->name);
           $btab->bindparam(":bauthor", $newbook->author);
           $btab->bindparam(":bgenre", $newbook->genre);
           $btab->bindparam(":bpublisher", $newbook->publisher);
           $btab->bindparam(":blocation", $newbook->location);
           $btab->execute(); 
           
           $_SESSION['lastbookid'] = $this->db->lastInsertId();
            
   
           return $btab; 
       }
       catch(PDOException $e){
           return false;
       }    
    }
    
    public function display_add_message($check,$newbook){
        if($check){
            echo '<h2>The book succesfully added to your library </h2>';
            echo '<h3> ' . '<b style="font-weight: 400">Book Name: </b>' . $newbook->name . '</h1>';
            echo '<h3> ' . '<b style="font-weight: 400">Author:    </b>' . $newbook->author . '</h1>';
            echo '<h3> ' . '<b style="font-weight: 400">Genre:     </b>' . $newbook->genre . '</h1>';
            echo '<h3> ' . '<b style="font-weight: 400">Publisher: </b>' . $newbook->publisher . '</h1>';
            echo '<h3> ' . '<b style="font-weight: 400">Location:  </b>' . $newbook->location . '</h1>';
            echo '<h3> ' . '<b style="font-weight: 400">Book ID:   </b>' . $newbook->book_id . '</h1>';
            //echo '<br>';
            echo '<p id="goafteradd"><a href="book.php?bookid=' . $newbook->book_id . '">Go to books page.</a></p>';
        }
        else{
            echo "<h2>" . "Sorry, there was an unexpected error. Error Code: DAM001" . "</h2>";
        }
    }
    
    
    public function display_lendedbook($user_id){
        try
       {
           
            
          $stmt = $this->db->prepare("SELECT * FROM books WHERE lended_to IS NOT NULL AND user_id=:user_id");
          $stmt->bindparam(":user_id", $user_id);
            $stmt->execute();
          
          //$row=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
               
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
              
                  echo '<a href="book.php?bookid=' . $row[book_id] .' ">
                            <div class="lended">
                                <div class="lended_info"><p><i class="fa fa-book"></i> ' . $row['book_name'] . '</p></div>
                                <div class="lended_info_person"><p><i class="fa fa-hand-paper-o"></i> ' . $row['lended_to'] . '</p></div>
                            </div>
                        </a>';
              }

          }
            else{
                echo "You dont have any lended books.";
            }
       }
       catch(PDOException $e)
       {
           echo "There was an unexpected error. Please try again later. Error Code: LND001";
       }
         
     }
    
    

}
?>