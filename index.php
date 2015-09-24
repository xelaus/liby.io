<?php

require_once 'dbconfig.php';
require('PHPMailer/class.phpmailer.php');

if($user->is_loggedin()!=""){
    $user->redirect('home.php');
    exit();
}

if(isset($_SESSION['activestatus'])){
    $error['verify'] = "Your account is now verified, you can login here.";
    unset($_SESSION['activestatus']);
}
if(isset($_SESSION['passchangesuccess'])){
    $error['passchange'] = $_SESSION['passchangesuccess'];
    unset($_SESSION['passchangesuccess']);
}

    if($_POST) {
        
        //echo "wqqwqw";
        
        $loginbutton = $_POST['btn-login'];
        $signupbutton = $_POST['btn-signup'];
        
        if(isset($loginbutton)){
            //echo "Login pressed";
            
            
            $lmail = strtolower(trim($_POST['ltxt_email']));
            $lpass = trim($_POST['ltxt_pass']);
            
            
          
            
            if($user->login($lmail,$lpass)) {
                $_SESSION['loggedinemail'] = $lmail;
                
                //echo '<meta http-equiv="refresh" content="0">';
                $user->redirect('home.php'); 
                exit();
            }
            
            
            
            elseif(isset($_SESSION['active'])){
                $error['notactive'] = "Please check your e-mail to activate your account.";
                unset($_SESSION['active']);
            }
            
            else{
                $error['wrongdetails'] = "Wrong e-mail or password.";
            } 
            

        }
        
        elseif(isset($signupbutton)){
            
            //echo "Sign up pressed";
            
            $iserror = false;
            
            $semail = strtolower(trim($_POST['stxt_email']));
            $spass = trim($_POST['stxt_pass']);
            $spassre = trim($_POST['stxt_passre']);
            
            if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $semail)) {
		        $error['semail'] = "Please enter a valid email address.";
                $iserror = true;
	        }
            
            if(strlen($spass) < 6){
                $error['spass'] = "Password must be atleast 6 characters."; 
                $iserror = true;
            }
            
            if(strcmp($spass, $spassre) != 0){
                $error['spassre'] = "Passwords do not match.";
                $iserror = true;
            }
            
            if(!$iserror){
                //echo "wohoooo";
                 try {
                     
                    $stmt = $DB_con->prepare("SELECT user_email FROM users WHERE user_email=:semail");
                    $stmt->execute(array(':semail'=>$semail));
                    $row=$stmt->fetch(PDO::FETCH_ASSOC);
                

                    if($row['user_email']==$semail) {
                       $error['mailtaken'] = "Sorry, email adress is already taken.";
                    }
                    else
                    {
                        $hashcode = md5(rand(0,1000));
                       if($user->send_activation($semail,$hashcode)) 
                       {
                           //$user->redirect('sign-up.php?joined');

                           if($user->register($semail,$spass,$hashcode)){
                                $error['regactive'] = "Registration is complete. Please check your e-mail to activate your account.";
                           }
                           else{
                                $error['activationerror'] = "There was an unexpected error please try again later.";
                           }
                       }
                    }
                }
                catch(PDOException $e)
                {
                   //echo $e->getMessage();
                    $error['activationerror'] = "There was an unexpected error please try again later. Error Code: IND001";
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
		<link rel="stylesheet" href="style/main_login.css"/>
		<link rel="stylesheet" href="style/layout_login.css"/>
    
    <link rel="icon" type="image/png" href="images/favico.png">
    
<link href='https://fonts.googleapis.com/css?family=Oxygen:400,700,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/login.js"></script>
    
    <style>
        
        input{
            text-transform: lowercase;
        }
        
        
    </style>

<title>Liby.io</title>
</head>
    <body>
        <header>
            <div id="leftheader">
                <p>Liby.io</p>
            </div>
            
            <div id="rightheader">
                <p id="aboutp"><a href="about.php">About</a></p>
                <p><a id="cont" href="contact.php">Contact</a></p>     
            </div>
        </header>
        
        <div id="wrapper">
        
           <section id="firstsection">
             <div id="info">
                <div id="title">
                    <h1>Welcome to Liby.io</h1>
                </div>
                <div id="infolist">
                    <p>Library database for your home.</p>
                   
                    <p>Keep track of your books in the simplest way.</p>
          
                    <p>Add your books with their info.</p>
                    
                    <p>Access your books' info however you want to.</p>
                    
                    <p>Export your database to excel.</p>
                    
                </div>
            </div>

           </section>
            
           <section id="secondsection">
                 <div class="form-container-login">
        <form method="post">
            <h1>Log in</h1>
            <div class="form-group">
             <input type="text" class="form-control" name="ltxt_email" id="logininput" placeholder="E-Mail" required maxlength="60"/>
            </div>
            <div class="form-group">
             <input type="password" class="form-control" name="ltxt_pass" id="logininputpass" placeholder="Password" required maxlength="229"/>
                  
            </div>
            <div class="form-group">
                   <a href="forgotpass.php"> <p id="forgotpass">Forgot your password?</p></a>
                    <button type="submit" name="btn-login" id="btn-login">
                            Log in
                    </button>
            </div>
            
        </form>
                     
            <div id="loginmsg">
                <?php 
                    

                        if(isset($error['wrongdetails'])){
                            echo "<p>" . $error['wrongdetails'] . "</p>";
                        } 
                        elseif(isset($error['notactive'])){
                            echo "<p>" . $error['notactive'] . "</p>";
                        }
                        elseif(isset($error['verify'])){
                            echo '<p style="color:forestgreen">' .  $error['verify'] . '</p>';
                            unset($_SESSION['activestatus']);
                        }
                        if(isset($error['passchange'])){
                            echo '<p style="color:forestgreen">' . $error['passchange'] . '</p>';
                        }
    

                ?>
            </div>
       </div>
               
               
               
               
        <div class="form-container-signup">
        <form method="post">
            <h1>Sign up</h1>

            <div class="form-group">
            <input type="text" class="form-control" id="signupinput" name="stxt_email" placeholder="Enter E-Mail" maxlength="60"/>
            </div>
            <div class="form-group-passwords">
             <input type="password" class="form-control" name="stxt_pass" id="signupinputpass" placeholder="Password" maxlength="229"/>
                <input type="password" class="form-control" name="stxt_passre" id="signupinputpassretry" placeholder="re-enter password" maxlength="229"/>
            </div>
            <div class="clearfix"></div>
            <div class="form-group-signup">
                <div id="loading">
                    <img src="images/loading.gif" >
                </div>
             <button type="submit" class="btn-signup" id="btn-signup" name="btn-signup">
                 Sign up
                </button>
            </div>  
           
        </form>
            <div id="loginmsg">
                 
                <?php 
                    
                        if(isset($error['semail'])){
                            echo "<p>" . $error['semail'] . "</p>";
                        }
                        if(isset($error['spass'])){
                            echo "<p>" . $error['spass'] . "</p>";
                        } 
                        if(isset($error['spassre'])){
                            echo "<p>" . $error['spassre'] . "</p>";
                        }
                        if(isset($error['mailtaken'])){
                            echo "<p>" . $error['mailtaken'] . "</p>";
                        }
                        if(isset($error['regactive'])){
                            echo '<p style="color:forestgreen">' . $error['regactive'] . '</p>';
                        }
                        if(isset($error['activationerror'])){
                            echo "<p>" . $error['activationerror'] . "</p>";
                        }



                ?>
            </div>
       </div>   
           </section>
           
        </div>
        <footer>
          <p>Copyright © <?php echo date("Y"); ?> Liby.io</p> 
        </footer>
    </body>
</html>    