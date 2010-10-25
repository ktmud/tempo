<?php 
$type = isset($_GET['type']) ? $_GET['type'] : 'js';

if ($type == 'css') {
    header('Content-type: text/css');
} else {
    header('Content-type: application/x-javascript');
}


$path = urldecode($_GET['module']) . '/' . $type . '/';

function real_path () {
    global $path;
    $base_dir = realpath('../src');
    return $base_dir . '/' . $path;
}

$path = real_path();
$filelist = scandir( $path );

$lineNumber = 1;
foreach ( $filelist as $file ) {
    if( preg_match('/' . $type . '$/', $file) 
        && $fh = fopen( $path . $file, 'r') ) 
    {
        echo '/*========FILE=: '.$file." ----line: ". $lineNumber ."----===============*/\n";
        while (!feof($fh)) {
            $line = fgets($fh);
            $lineNumber += 1;
            echo $line;
        }
        fclose($fh);
    }
}

?>
