var fs = require('fs');

var pkey = fs.readFileSync('/etc/nginx/ssl/godj.online/98595/server.key');

var pcert = fs.readFileSync('/etc/nginx/ssl/godj.online/98595/server.crt')

var options = {

  key: pkey,

  cert: pcert

};

var app = require('https').createServer(options);

var io = require('socket.io')(app);

var Redis = require('ioredis');

var redis = new Redis();

app.listen(3000, function() {

    console.log('Server is running!');

});

function handler(req, res) {

    res.setHeader('Access-Control-Allow-Origin', '*');

    res.writeHead(200);

    res.end('');

}

io.on('connection', function(socket) {

    //

});

redis.psubscribe('*', function(err, count) {

    //

});

redis.on('pmessage', function(subscribed, channel, message) {

    message = JSON.parse(message);

    console.log('Channel is ' + channel + ' and message is ' + message);

    io.emit(channel, message.data);
  });
