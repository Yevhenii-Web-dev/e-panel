<?php
/*
* File for execute all sql files.
*/

declare(strict_types=1);

require_once $_SERVER['DOCUMENT_ROOT']. './config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . './database/DB.php';

$db = DB::getInstance();
$conn = $db->getConnection();

if (is_dir(DB_TABLES_PATH)) {

    $files = glob(DB_TABLES_PATH . '*.sql');

    foreach ($files as $file) {
        importDatabaseTables($conn, $file);
    }
}

function importDatabaseTables($connToDb, $filePath)
{
    // Temporary variable, used to store current query
    $templine = '';

    // Read in entire file
    $lines = file($filePath);

    $error = '';

    // Loop through each line
    foreach ($lines as $line) {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '') {
            continue;
        }

        // Add this line to the current segment
        $templine .= $line;

        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';') {
            // Perform the query
            if (!$connToDb->query($templine)) {
                $error .= 'Error importing query "<b>' . $templine . '</b>": ' . $connToDb->error . '<br /><br />';
            }

            // Reset temp variable to empty
            $templine = '';
        }
    }
    return !empty($error) ? die($error) : true;
}


// Close connection
$db::closeInstance();

header('Location: index.php');