var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');

var redis = new Redis();

redis.subscribe('coolfm-lagos');

redis.on('message', function(channel, message) {
    message = JSON.parse(message);

    var emit = io.emit('coolfmlagos_' + message.event, message.data);
    console.log('coolfmlagos_' + message.event);

});

server.listen(3000, function() {

});