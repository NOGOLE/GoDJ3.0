
var fs = require('fs');

var options = {
  key: fs.readFileSync('/etc/nginx/ssl/godj.online/93947/server.key'),
  cert: fs.readFileSync('/etc/nginx/ssl/godj.online/93947/server.crt')
};

var app = require('https').createServer(options,handler);
var io = require('socket.io')(app);

var Redis = require('ioredis');
var redis = new Redis();

app.listen(3000, function() {
    console.log('Server is running!');
});

function handler(req, res) {
    res.writeHead(200);
    res.end('');
}

io.on('connection', function(socket) {
    //
    console.log('New Connection: ' + socket);
});

redis.psubscribe('*', function(err, count) {
    //
});

redis.on('pmessage', function(subscribed, channel, message) {
  console.log(message);
    message = JSON.parse(message);
    io.emit(channel, message);
});
