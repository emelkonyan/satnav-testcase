var net = require('net');

var client = new net.Socket();
client.connect(1617, '{{ server_ip }}', function() {
	console.log('Connected');
});

client.on('data', function(data) {
	console.log('Received: ' + data);
	//client.destroy(); 
});

client.on('close', function() {
	console.log('Connection closed');
});
