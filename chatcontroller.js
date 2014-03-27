var activeUsers = [];

function array_remove (array, item) {
    var i = array.indexOf(item);
    if(i != -1) {
        array.splice(i, 1);
    }
}

module.exports = function (app, io) {
    var chat = io.of('/socket').on('connection', function (socket) {
       
       // New Message
       socket.on('send message', function (data) {
          socket.broadcast.emit('message', {'user' : socket.user, 'message' : data});
          socket.emit('message',  {'user' : socket.user, 'message' : data});
       });
       
       // Login
       socket.on('login', function (data, callback) {
          if (activeUsers.indexOf(data) != -1)
            callback(false);
          else {
            callback(true);
            socket.user = {'nickname' : data};
            activeUsers.push(socket.user);
            socket.emit('update userlist', activeUsers);
          }
       });
       
        
       
       socket.on('logout', function (data) {
            array_remove(activeUsers, socket.user);
       });
       
       socket.on('test', function (data, callback) {
            callback(socket.user);
       });

       // Kick
       socket.on('kick', function (data) {

       });
       
       // Refresh
       socket.on('refresh', function (data) {
           
       });        
    });
    
    io.of('/chat').on('disconnect', function() {
        array_remove(activeUsers, chat.socket.user);
        chat.socket.emit('update userlist', activeUsers);
        console.log("disconnected" + chat.socket.user.nickname);
    });
}