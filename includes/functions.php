<?
function user_track(){
    $line = date('Y-m-d H:i:s') . " \n " . $_SERVER['REMOTE_ADDR'] . "\n" . $_SERVER['REQUEST_URI'] . "\n";
    foreach($_COOKIE as $cookie){
        $line .= $cookie . "\n";
    }
    file_put_contents('visitors.log', $line . PHP_EOL, FILE_APPEND);
}