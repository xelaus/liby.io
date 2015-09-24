<html xmlns="http://www.w3.org/1999/xhtml">
    
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
    
		<link rel="stylesheet" href="style/normalize.css"/>
		<link rel="stylesheet" href="style/main_login.css"/>
		<link rel="stylesheet" href="style/layout_login.css"/>
    
    <link rel="icon" type="image/png" href="images/favico.png">
    
<link href='https://fonts.googleapis.com/css?family=Oxygen:400,700,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    
    <style>
        
        input{
            text-transform: lowercase;
        }
        
        #firstsection{
            width: 90%;
        }
        
        #leftheader a {
            color: white;
        }
        
        #btn-signuplogin {
            width: 85%;
            height: 33px;
            font-size: 20px;
            font-weight: 300; 
            margin: 0 auto;
            border: none;
            background-color: #efb5a1;
            color: #627071;
            max-width: 420px;
        }


        #btn-signuplogin:hover {
            box-shadow: 0px 1px 1px 1px grey;
        }
        
        #btn-signuplogin:active {
            box-shadow: none;
        }
        
        @media screen and (max-width: 770px) {
            #firstsection {
                position: relative;
                visibility: visible;
            }
        }
        
    </style>

<title>Liby.io</title>
</head>
    <body>
        <header>
            <div id="leftheader">
                <p><a href="index.php">Liby.io</a></p>
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
                 <form action="index.php">
                 <button type="submit" id="btn-signuplogin">
                            Sign up / Log in
                    </button>
                 </form>
            </div>

           </section>
            
           
        </div>
        <footer>
          <p>Copyright © <?php echo date("Y"); ?> Liby.io</p> 
        </footer>
    </body>
</html>    