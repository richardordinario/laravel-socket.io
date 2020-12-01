var app = require('express')()
var http = require('http').Server(app)
var io = require('socket.io')(http)
var Redis = require('ioredis');
var redis = new Redis()
var users = []

http.listen(8005, function(){
    console.log('listening to port 8005')
})

redis.subscribe('message-channel' , function() {
    console.log('subscribe to message channel')
})

redis.on('message', function(channel, message) {
    console.log(channel)
    console.log(message)
    
    message = JSON.parse(message)
    console.log(message.event)
    console.log(channel + ':' + message.event)
    if(channel == 'message-channel') {
        let data = message.data.data
        let receiver_id = data.receiver_id

        io.to(`${users[receiver_id]}`).emit(channel + ':' + message.event, data)
    }
})

io.on('connection', function(socket) {
    socket.on('user_connected', function(user_id) {
        users[user_id] = socket.id
        io.emit('updateUserStatus', users)
        console.log('user connected ' + user_id)
    })

    socket.on('disconnect', function() {
        var i = users.indexOf(socket.id)
        users.splice(i, 1, 0)
        io.emit('updateUserStatus', users)
    })
})
