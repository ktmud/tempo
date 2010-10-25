<?php
    /**
     * 根据开发模式载入资源文件
     */
    function get_assets($module, $type = 'js', $url = ''){

        //global $_module;
        //global $_type;
        global $timestamp, $mode;

        switch ($mode) {

            case 'dev':
                devfile_tags($module, $type);
                break;

            case 'debug':
                if ($url != '')  pubfile_tags($url, $type, true);
                break;
            
            default:
                if ($url != '') pubfile_tags($url, $type, false);
                break;

        }
    }

    //输出线上地址
    function pubfile_tags ($path, $type, $debug){

        global $timestamp;

        //debug模式加上source字符串
        if($debug) {
            $path = preg_replace("/\." . $type . "/", ".source." . $_type, $path);
            //$path = preg_replace("/a\.tbcdn\.cn/", "assets.daily.taobao.net",  $path);
        }

        switch ($type) {
            case 'css':
                echo <<<EOB
<link rel="stylesheet" href="$path?t=$timestamp.css" />

EOB;
                break;
            
            default:
                echo <<<EOB
<script src="$path?t=$timestamp.js" $extraOptions></script>

EOB;
                break;
        }

    }

    //输出开发文件
    function devfile_tags ($module, $type){
        $combo = isset($_GET['c']); //url里包含参数 c 时，使用单一地址，通过 inc/assets-echo.php 输出
        
        $related_path = 'src/'.$module.'/'.$type.'/';
        $path = realpath('.') .'/'. $related_path;

        $filelist = scandir( $path );

        $module = urlencode($module);

        switch ($type) {

            case 'css':
                if ($combo) {
                echo <<<EOB
<link href="inc/assets-echo.php?module=$module&type=css" rel="stylesheet" />

EOB;
                } else {
                    foreach ($filelist as $file) {
                        if(preg_match('/' . $type . '$/', $file)) {
                            echo '<link rel="stylesheet" href="' . $related_path . $file .'" />'."\n";
                        }
                    }
                }
                break;
            
            case 'js':
                if ($combo) {
                echo <<<EOB
<script src="inc/assets-echo.php?module=$module"></script>

EOB;
                } else {
                    foreach ($filelist as $file)  {
                        if(preg_match('/' . $type . '$/', $file)) {
                            echo '<script src="' . $related_path . $file .'"></script>'."\n";
                        }
                    }
                }
                break;

            default:
                echo "<!--输出资源文件 ". $_type ." 时文件类型不对。 -->";
                break;

        }
    }


    //读取文件，内联脚本
    //function inlinescript ($script) {
        //if(file_exists($script)) {
            //echo "<script>";
            //$script_content = fopen($script, 'r');
            //while(!feof($script_content)) {
                //$line = fgets($script_content);
                //echo $line;
            //}
            //fclose($script_content);
            //echo "</script>";
        //}
    //}

?>
