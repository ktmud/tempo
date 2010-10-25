<?php
    /**
     * ���ݿ���ģʽ������Դ�ļ�
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

    //������ϵ�ַ
    function pubfile_tags ($path, $type, $debug){

        global $timestamp;

        //debugģʽ����source�ַ���
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

    //��������ļ�
    function devfile_tags ($module, $type){
        $combo = isset($_GET['c']); //url��������� c ʱ��ʹ�õ�һ��ַ��ͨ�� inc/assets-echo.php ���
        
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
                echo "<!--�����Դ�ļ� ". $_type ." ʱ�ļ����Ͳ��ԡ� -->";
                break;

        }
    }


    //��ȡ�ļ��������ű�
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
