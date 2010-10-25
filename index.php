<?php
    include('inc/config.php');
    include('inc/mode.php');
    $page = $_GET['page'] ? $_GET['page'] : 'default';
    $file = 'pages/' . $page . ".php";
    if(file_exists($file)) {
        require($file);
    } else {
        echo "找不到你要的页面！\n\n\n";
        header('Content-type: text/plain');
        include 'README.md' ;
    }
?>
