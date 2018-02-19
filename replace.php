<?php

$dir = new DirectoryIterator(dirname(__FILE__));

#migrating old mysql structure to new database wrapper example

$array_current = [
    'fquery_error_rollback_session',
    'fquery_error_rollback',
    'fquery_error',
    'mysql_query($mqry, $FSQLLink)',
    'mysql_query($qry, $FSQLLink)',
    'mysql_query',
    'mysql_error'
];

$array_new = [
    '$g_db->dbQueryErrorRollbackSession',
    '$g_db->dbQueryErrorRollback',
    '$g_db->dbQueryError',
    '$g_db->dbQuery($mqry)',
    '$g_db->dbQuery($qry)',
    '$g_db->dbQuery',
    '$g_db->dbError'
];

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