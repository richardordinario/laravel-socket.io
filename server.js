var app = require('express')()
var http = require('http').Server(app)
var io = require('socket.io')(http)
var users = []

http.listen(8005, function(){
    console.log('listening to port 8005')
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
