<?php
    require_once 'dbconfig.php';
    require('PHPMailer/class.phpmailer.php');
    
        if($_POST) {
        
        //echo "wqqwqw";
        
        $submitbutton = $_POST['btn-submit'];
        
            if(isset($submitbutton)){
                
                $semail = strtolower(trim($_POST['txt_email']));
            
                if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $semail)) {
		          $error['semail'] = "Please enter a valid email address.";
	            }
                else {
                
                    try {
                     
                    $stmt = $DB_con->prepare("SELECT user_email FROM users WHERE user_email=:semail");
                    $stmt->execute(array(':semail'=>$semail));
                    $row=$stmt->fetch(PDO::FETCH_ASSOC);
                

                    if($stmt->rowCount() > 0) {
                       
                        //echo "Asda";
                        $hashcode = md5(rand(0,1000));
                        
                        if($user->insert_forgothash($semail,$hashcode)){
                            $check = true;
                        } else { $check = false; }
                        

                        
                        
                        if($user->send_forgotpass($semail,$hashcode) && $check) {
                            
                            $confirm['emailsent'] = "Please follow the instructions we just sent to your e-mail to reset your password."; 
                        }
                        else{
                            $error['mailerror'] = "There was an unexpected error please try again in a few minutes. Error Code: FRTM001";
                        }
                        
                    } 
                    else {
                        sleep(4);
                         $confirm['emailsentt'] = "Please follow the instructions we just sent to your e-mail to reset your password."; 
                        
                    }
                }
                catch(PDOException $e)
                {
                   //echo $e->getMessage();
                    $error['catcherror'] = "There was an unexpected error please try again later. Error Code: FRTC001";
                }
                
                }
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
    
<link href='https://fonts.googleapis.com/css?family=Oxygen:400,700,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
    
        $(document ).ready(function() {   
    
            $('#btn-submit').on('click',function(){
                
                setTimeout( function(){
                     $('#loading').css({"position": "relative","visibility": "visible"});
                },500);
      
            });
    
        });
    
    
    </script>
    
    <style>
        .form-group {
            margin: 0 auto;
            height: 33px;
            width: 99%;
            margin-bottom: 8px;
        }
        
        .form-group input {
             width: 50%;
             height: 33px;
             font-size: 20px;
             font-weight: 300; 
             padding-left: 5px;
             border: none;
             background-color:#ccf4ff;
             color: darksalmon;
             display: inline-block;
             margin-left: 17%;
        }
        
        .form-group button {
             width: 15%;
             margin-left: 1%;
             display: inline-block;
             height: 33px;
             font-size: 20px;
             font-weight: 300; 
             padding-left: 5px;
             border: none;
             background-color: #efb5a1;
             position: relative;
             color: #627071;
        }
        
        #mainareaforgot {
            width: 96%; 
            margin-left: 2%;
            min-height: 400px;
            float: left;
            margin-top: 130px;
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
            
            #leftheader {
                margin-left: 4%;
                width: 40%;
            }
            
            #rightheader {
                margin-left: 8%;
                width: 40%
            }
            
            .form-group input {
                width:98%;
                display: inherit;
                margin-left: 1%;
            }
            
            .form-group button {
                width:45%;
                margin-left: 27%;
                margin-top: 10px;
              display: inherit;
            }
            
            #msgforgot {
                margin-top: 60px;
            }
            
        }

        
    </style>

<title>Forgot Password - Liby.io</title>
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
                <h2>
                    Please enter your e-mail to reset your password.
                
                </h2>
                
                <form method="post">
                    <div class="form-group">
                    <input type="text" class="form-control" name="txt_email" id="logininput" placeholder="E-Mail"/>
                        <button type="submit" name="btn-submit" id="btn-submit">Submit</button>
                    </div>
                </form>
                <div id="msgforgot">
                    <?php

                        if(isset($error['semail'])){
                            echo '<p style="color: #ff5a5a;">' . $error['semail'] . '</p>';
                        }
                        elseif(isset($error['mailerror'])){
                            echo '<p style="color: #ff5a5a;">' . $error['mailerror'] . '</p>';
                        }
                        elseif(isset($confirm['emailsent'])){
                            echo '<p style="color: forestgreen;">' . $confirm['emailsent'] . '</p>';
                        }
                        elseif(isset($confirm['emailsentt'])){
                            echo '<p style="color: forestgreen;">' . $confirm['emailsentt'] . '</p>';
                        }
                        elseif(isset($error['catcherror'])){
                            echo '<p style="color: #ff5a5a;">' . $error['catcherror'] . '</p>';
                        }

                    ?>
                   
                </div>
                <div id="loading">
                    <img src="images/loading.gif" >
                </div>
            </section>
        </div>
        <footer>
           <p id="copyright">Copyright © <?php echo date("Y"); ?> Liby.io</p>  
        </footer>
    </body>
    <script src="js/tabs.js"></script>
</html>  