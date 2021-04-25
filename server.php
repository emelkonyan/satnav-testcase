<?php

  $clients = array();
  $socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
  socket_bind($socket,'0.0.0.0','1617');
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
        foreach ($clients AS $k => $v) {
          $msg = "Unit {$foo} started ....\n";
          $writeResult = socket_write($v, $msg);
          echo "[$hostname]MSG BROADCASTED: [$msg]\n";
          if ( $writeResult === false) {
              socket_close($clients[$k]);
              unset($clients[$k]);
          }
        }
      }
      sleep(5);
      $foo++;
  }

?>
