<?php
include_once 'incs/dbconnect.php';

$pagetitle = "Liby.io";

include 'incs/header.php';

echo '<div id="wrapper">';

    include 'incs/searcharea.php';
    include 'incs/mainarea_book.php';

echo '</div>';

include 'incs/footer.php';

?>