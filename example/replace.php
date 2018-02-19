<?php

$dir = new DirectoryIterator(dirname(__FILE__));

$array_current = ['ipsum'];
$array_new = ['muspi'];

foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
        $filename = $fileinfo->getFilename();
        if ($filename != basename(__FILE__)) {
            $file_content = "";
            echo "Processing: " . $filename . PHP_EOL;
            try  {
                $file_content = file_get_contents($filename);
                for ($i = 0; $i < count($array_current); $i++) {
                    $file_content = str_replace($array_current[$i], $array_new[$i], $file_content);
                }
                file_put_contents($filename, $file_content);
            } catch (Exception $e) {
                echo "Failed To Process:  " . $filename . PHP_EOL;
            }
        }
    }
}
?>