<?php
   // PHP version 7.4 used here
    echo "\nConnection to server ongoing...";
    $redis = new Redis() or die("Cannot load Redis module in PHP.");

    //Connection to the Redis DB
    $redis->connect('container_redis', 6379);

    //Setup the user
    // $redis->auth(['redisUser', '3FAKExSW6Rez9Xw0admB']);
	$redis->auth('mdp');

    // Ping the redis instance
    echo "\nServer is running: ".$redis->ping("OK");

    // Set the key pair
    echo "\nSet key pair (foo,cowabunga).";
    $redis->set('foo', 'cowabunga');

    //Get the value of the key foo
    $response = $redis->get('foo');
    echo "\nGet the value for key foo :";
    echo $response;

    if ($response == "cowabunga") {
        echo "\nPHP test with Redis OK.•\n";
    } else {
        echo "\nPHP Test FAILED\n";
    }
?>
