<?

define('DB_PROXY_IP','localhost'); 
define('DB_USERNAME','' );
define('DB_PASSWORD','');
define('DB_DATABASE','');
define('DB_PROXY_PORT','');

$config = [
    'MYNAME'=>'John Patterson',
    'POSITION'=>'Full Stack Developer',
    'EMAIL'=>'john@jpatterson.io',
    'LINKEDIN'=>'https://www.linkedin.com/in/jnhpatterson/',
    'RESUMELINK'=>'',
];

foreach($config as $const=>$val){
    define($const,$val);
}
?>