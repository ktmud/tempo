<?php
    include('inc/config.php');
    include('inc/mode.php');
    $page = $_GET['page'] ? $_GET['page'] : 'default';
    $file = 'pages/' . $page . ".php";
    if(file_exists($file)) {
        require($file);
    } else {
        echo "�Ҳ�����Ҫ��ҳ�棡\n\n\n";
        header('Content-type: text/plain');
        include 'README.md' ;
    }
?>
