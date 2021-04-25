var net = require('net');
var server_ip = '{{ server_ip }}';
var port = 1617;
var client = new net.Socket();

client.connect(port, server_ip, function() {
	console.log('Connected');
});

client.on('data', function(data) {
	console.log('Received: ' + data);
	//client.destroy(); 
});

client.on('close', function() {
	console.log('Connection closed');
});
