<?php

    require_once 'dbconfig.php';

    $isValid = false;
    $isError = false;
    
    if($_POST) {
        
        
        if(isset($_GET['email']) && isset($_GET['code'])){
        
            $email = $_GET['email'];
            $hash = $_GET['code'];

            $sql = $DB_con->prepare("SELECT user_email, forgot_hash FROM users WHERE user_email=:email AND forgot_hash=:hash");
    
            $sql->bindparam(":email", $email);
            $sql->bindparam(":hash", $hash); 
    
            $sql->execute();
    
            $userRow=$sql->fetch(PDO::FETCH_ASSOC);
         
            if($sql->rowCount() > 0){
                $isValid = true;  
            }
        
        } 
        else {
            $isValid = false;  
        }
        
        
        if($isValid){
        
            $spass = trim($_POST['txt_pass']);
            $spassre = trim($_POST['txt_passre']);
            
            
            if(strlen($spass) < 6){
                $error['spass'] = "Password must be atleast 6 characters."; 
                $isError = true;
            }
            
            if(strcmp($spass, $spassre) != 0){
                $error['spassre'] = "Passwords do not match.";
                $isError = true;
            }
            
            if(!$isError){
             
                
                
                if($user->reset_pass($email,$spass,$hash)){
                    $_SESSION['passchangesuccess'] = "Password changed succesfully login here.";
                    header('Location: index.php');
                }
                else{
                    $error['resetpass'] = "There was an error resetting your password, please try again later. Error Code: RSP001";
                }
                
                
            
            }
        
        }
        
        
    }



    else{    

    
        
        
        if(isset($_GET['email']) && isset($_GET['code'])){
        
            $email = $_GET['email'];
            $hash = $_GET['code'];

            $sql = $DB_con->prepare("SELECT user_email, forgot_hash FROM users WHERE user_email=:email AND forgot_hash=:hash");
    
            $sql->bindparam(":email", $email);
            $sql->bindparam(":hash", $hash); 
    
            $sql->execute();
    
            $userRow=$sql->fetch(PDO::FETCH_ASSOC);
         
            if($sql->rowCount() > 0){
                $isValid = true;  
            }
        
        } 
        else {
            $isValid = false;  
        }

    
    }

?>


<html xmlns="http://www.w3.org/1999/xhtml">
    
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
    
		<link rel="stylesheet" href="style/normalize.css"/>
		<link rel="stylesheet" href="style/main.css"/>
		<link rel="stylesheet" href="style/layout.css"/>
    
     <link rel="icon" type="image/png" href="images/favico.png">
    
<link href='http://fonts.googleapis.com/css?family=Poiret+One|Oxygen:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    
    
    <style>
        .form-group {
            margin: 0 auto;
            height: 33px;
            width: 50%;
            margin-bottom: 8px;
        }
        
        .form-group input {
             width: 98%;
             height: 33px;
             font-size: 20px;
             font-weight: 300; 
             padding-left: 5px;
             border: none;
             background-color:#ccf4ff;
             color: darksalmon;
              margin-bottom: 8px;
            
        }
        
        .form-group button {
             width: 25%;
             margin-left: 35%;
             
             height: 33px;
             font-size: 20px;
             font-weight: 300; 
             padding-left: 5px;
             border: none;
             background-color: #efb5a1;
             position: relative;
             color: #627071;
             text-align: center;
        }
        
        #mainareaforgot {
            width: 96%; 
            margin-left: 2%;
            min-height: 400px;
            float: left;
            margin-top: 141px;
        }

        #mainareaforgot h2 {
            text-align: center;
        }


        #wrapperforgot {
            width: 95%;
            margin: 0 auto;
            max-width: 1100px;
        }
        
        #msgforgot {
            width: 99%;
            margin: 0 auto;
            margin-top: 100px;
            
        }
        
        #msgforgot p {
            text-align: center;
            color: forestgreen;
        }
        
        #loading {
            height: 32px;
            text-align: center;
            position: fixed;
            visibility: hidden;
        }
        
        #loading img {
            height: 32px;
        }
            
        #gobackhome{
            text-align: center;
        }
        
         #gobackhome a:hover{
            color:  rgb(68, 179, 194);
            cursor: pointer;
         }
        
        #cont{
            color: white;
        }
        
        #cont:hover {
            color: darksalmon;
        }
        
        #copyright {
            width:80%;
            margin: 0 auto;
            text-align: center;
        }
        
                
        @media screen and (max-width: 766px) {
            
             #mainareaforgot {
                margin-top: 100px;
             }
            .form-group{
                width: 75%;
            }
            
            .form-group input {
                width:98%;
            }
            
            .form-group button {
                width:35%;
            }
            
        #msgforgot {
            margin-top: 120px;
            
        }
            
            #leftheader {
                margin-left: 4%;
                width: 40%;
            }
            
            #rightheader {
                margin-left: 8%;
                width: 40%
            }
            

        }
        
        

        
    </style>

<title>Reset Password - Liby.io</title>
</head>
    <body>
        <header>
            <div id="leftheader">
                <p><a href="home.php">Liby.io</a></p>
            </div>
            
            <div id="rightheader">
                <p><a id="cont" href="contact.php">Contact</a></p>
            </div>
        </header>
        
        <div id="wrapperforgot">

            <section id="mainareaforgot">
                <?php if($isValid ){?>
                    <h2> Reset your password.</h2>
                

                    <form method="post">
                        <div class="form-group">
                            <input type="password" class="form-control" name="txt_pass" id="logininput" placeholder="Password"/>
                            <input type="password" class="form-control" name="txt_passre" id="logininput" placeholder="Password Again"/>
                            <button type="submit" name="btn-submit" id="btn-submit">Submit</button>
                        </div>
                    </form>
                <?php } else{?>
                    
                    <h2> Sorry, invalid link.</h2>
                    <p id="gobackhome"><a href="index.php">Go back to home page.</a></p>
                <?php } ?>

                <div id="msgforgot">
                    <?php

                        if(isset($error['spass'])){
                            echo '<p style="color: #ff5a5a;">' . $error['spass'] . '</p>';
                        }
                        if(isset($error['spassre'])){
                            echo '<p style="color: #ff5a5a;">' . $error['spassre'] . '</p>';
                        }
                        if(isset($error['resetpass'])){
                            echo '<p style="color: #ff5a5a;">' . $error['resetpass'] . '</p>';
                        }

                        
                    ?>
                   
                </div>

            </section>
        </div>
        <footer>
          <p id="copyright">Copyright © <?php echo date("Y"); ?> Liby.io</p> 
        </footer>
    </body>
</html>  