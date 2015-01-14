<?php 
// 这里是我们上面得到的deviceToken，直接复制过来（记得去掉空格）
$deviceToken = '0a2c399716bdf5ba88284bd5de9804930d9f1b55e84f0c6b0c390353e3710456';
// $deviceToken = 'adc1caa98c6b1e57cd99520b63a1862d4881a599037f11e53639038570545d9c';

// Put your private key's passphrase here:
$passphrase = 'zhuge';

// Put your alert message here:
$message = 'hello from zhuge';

 
////////////////////////////////////////////////////////////////////////////////
$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'zg.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
//这个为正是的发布地址
 //$fp = stream_socket_client(“ssl://gateway.push.apple.com:2195“, $err, $errstr, 60, //STREAM_CLIENT_CONNECT, $ctx);

//这个是沙盒测试地址，发布到appstore后记得修改哦
$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', 
							$err,
							$errstr, 
							60, 
							STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, 
							$ctx);

 
if (!$fp)
	exit("Failed to connect: $err $errstr" . PHP_EOL);

echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
$body['aps'] = array(
'alert' => $message,
'sound' => 'default'
);
$body['mid'] = '2015010800001';

 
// Encode the payload as JSON
$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
 
// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));

 
if (!$result)
	echo 'Message not delivered' . PHP_EOL;
else
	echo 'Message successfully delivered' . PHP_EOL;

// Close the connection to the server
fclose($fp);
?>
