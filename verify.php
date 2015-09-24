<?php
    require_once 'dbconfig.php';

    $email = $_GET['email'];
    $hash = $_GET['code'];
    $active = 0;

    $sql = $DB_con->prepare("SELECT user_email, hash, active FROM users WHERE user_email=:email AND hash=:hash AND active=:active");

    $sql->bindparam(":email", $email);
    $sql->bindparam(":hash", $hash); 
    $sql->bindparam(":active", $active);

    $sql->execute();

    $userRow=$sql->fetch(PDO::FETCH_ASSOC);
     
    if($sql->rowCount() > 0){
        //echo "YAYAYYAYY"; 
        $active = 1;
        $sqlu = $DB_con->prepare("UPDATE users SET active=:active WHERE user_email=:email AND hash=:hash");
        
        $sqlu->bindparam(":active", $active);
        $sqlu->bindparam(":email", $email);
        $sqlu->bindparam(":hash", $hash); 
        
         $sqlu->execute();
        
        if($sqlu->rowCount() > 0){
            //echo "Activations is complete!!!";
            $_SESSION['activestatus'] = "active";
            header('Location: index.php');
        }
        else{
           $error['link'] = "- Invalid url or account has already been verified."; 
        }
    }
    else{
        $error['link'] = "Invalid url or account has already been verified."; 
    }

?>


<html xmlns="http://www.w3.org/1999/xhtml">
    
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
    
		<link rel="stylesheet" href="style/normalize.css"/>
		<link rel="stylesheet" href="style/main.css"/>
		<link rel="stylesheet" href="style/layout.css"/>
    
<link href='http://fonts.googleapis.com/css?family=Poiret+One|Oxygen:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    
    
    <style>
        
        #mainareaverify {
            float: left;
            
            margin-top: 100px;
            width: 90%;
            margin-left: 4.5%;
            text-align: center;
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
    </style>

<title>Verify - Liby.io</title>
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
        
        <div id="wrapper">

            <section id="mainareaverify">
                <h2>
                    <?php
                        echo $error['link'];
                    ?>
                
                </h2>
            </section>
        </div>
        <footer>
           <p id="copyright">Copyright © <?php echo date("Y"); ?> Liby.io</p> 
        </footer>
    </body>
</html>  