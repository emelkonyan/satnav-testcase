<?php
  $listen_port = '1617';
  $sleep_time = 15; //seconds
  $clients = array();
  $socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
  socket_bind($socket,'0.0.0.0',$listen_port);
  socket_listen($socket);
  socket_set_nonblock($socket);
  $foo = 0;
  $hostname = gethostname();
  echo "[Server started on $hostname][SHOWTIME!]\n";

  while(true)
  {
      if(($newc = socket_accept($socket)) !== false)
      {
          echo "---NEW CLIENT has connected\n";
          $clients[] = $newc;
      }
      if (count($clients)) {
        $msg = "Unit {$foo} started ....\n";
	$payload = ['sender' => $hostname, 'message' => $msg];
	$payload = json_encode($payload);
        foreach ($clients AS $k => $v) {
          $writeResult = socket_write($v, $msg);
          if ( $writeResult === false) {
              socket_close($clients[$k]);
              unset($clients[$k]);
          }
        }
        
        echo "MSG BROADCASTED: [$payload]\n";
      }
      sleep($sleep_time);
      $foo++;
  }

?>
