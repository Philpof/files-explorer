<!-- test de fil d'ariane -->

<?php

function ScanDirectory($pDir, $pData) {

    if (!empty($pData)) {
        $pDir = $pDir.'/'.$pData;
    }

    if ($dir = opendir($pDir)) {
        $listDir = array();

        while($file = readdir($dir)) {
            if($file != '.' && $file != '..') {
                if (!empty($pData)) {
                    $listDir[] = $pData.'/'.$file;

                } else {
                   $listDir[] = $file;

                }
          }
        }
    closedir($dir);
    }
    return $listDir;

}

$defaultDir = getcwd();

if (empty($_GET['dir']))  {
    $list = ScanDirectory($defaultDir, "");
} else {
    $dir = $_GET['dir'];
    $list = ScanDirectory($defaultDir, $dir);
}
chdir($defaultDir);
?>
