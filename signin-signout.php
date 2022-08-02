<?php

/*
 * Complete the 'processLogs' function below.
 *
 * The function is expected to return a STRING_ARRAY.
 * The function accepts following parameters:
 *  1. STRING_ARRAY logs
 *  2. INTEGER maxSpan
 */

function processLogs($logs, $maxSpan) {
    $explodedLog = array();
    
    for($i = 0; $i < count($logs); $i++){
        $element = $logs[$i];
        $explodedLog[] = explode(" ", $logs[$i]);
    }
    
    // $counter = 0;
    $newLogs = array();
    
    foreach($explodedLog as $log){
        if($log[2] == "sign-out"){  // negative value
            if(array_key_exists($log[0], $newLogs)){
                $newLogs[$log[0]] = $newLogs[$log[0]] - ($log[1]); 
            }else{
                $newLogs[$log[0]] = -1 * ($log[1]);
            }
        }else{
            if(array_key_exists($log[0], $newLogs)){
                $newLogs[$log[0]] = $newLogs[$log[0]] + $log[1];
            }else{
                $newLogs[$log[0]] = $log[1];
            }
        }
    }
    
    
    $userIds = array();
    foreach($newLogs as $id => $timestamp){
        if(abs($timestamp) < $maxSpan){
            $userIds[] = $id;
        }
    }
    
    sort($userIds);
    
    return $userIds;    
}


$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$logs_count = intval(trim(fgets(STDIN)));

$logs = array();

for ($i = 0; $i < $logs_count; $i++) {
    $logs_item = rtrim(fgets(STDIN), "\r\n");
    $logs[] = $logs_item;
}

$maxSpan = intval(trim(fgets(STDIN)));

$result = processLogs($logs, $maxSpan);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($fptr);