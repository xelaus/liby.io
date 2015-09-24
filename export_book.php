<?php

$htmlcss = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    p {
        font-size: 20px;
        font-family: helvetica;
        text-align: center;
        color:#444e4f;
    }
    
    table tr th {
        font-size: 15px;
        font-weight: lighter;
        font-family: helvetica;
        text-align: left;
        width: 150px;
        color:#272c2d;
    }
    
    #name {
        width: 300px;
    }
    
    
    tr #bookid {
        background-color: #cfd4d4;
        width: 60px;
    }
    
    tr #number {
        width: 60px;
    }
    
    #author {
         background-color: #cfd4d4;
    }
    
    #genre {
         background-color: #cfd4d4;
    }
    
    #titles th {
        font-size: 17px;
        
    }
    
    
</style>
<table border="1">
    <p>Books Liby.io</p>
    <tr id="titles">
    	<th id="number">No</th>
        <th id="bookid">ID</th>
		<th>Name</th>
		<th>Author</th>
        <th>Publisher</th>
        <th>Genre</th>
        <th>Location</th>
        
	</tr>';

echo $htmlcss;

include_once 'dbconfig.php';
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
$pagetitle = "Liby.io";

header("Content-type: application/vnd.ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=liby-export.xls");


    $sql = $DB_con->prepare("SELECT * FROM books WHERE user_id=:user_id");
    $sql->bindparam(":user_id", $user_id);
    $sql->execute();
	$no = 1;
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
        //echo "as";
		echo '
		<tr>
			<th id="number">'.$no.'</th>
            <th id="bookid">'.$data['book_id'].'</th>
			<th id="name">'.$data['book_name'].'</th>
			<th id="author">'.$data['author'].'</th>
            <th id="publisher">'.$data['publisher'].'</th>
            <th id="genre">'.$data['genre'].'</th>
            <th id="location">'.$data['location'].'</th>
            
		</tr>
		';
		$no++;
	}

    echo '<p>' . $userRow['user_email'] . '</p>';
    echo '</table>';
?>
   



