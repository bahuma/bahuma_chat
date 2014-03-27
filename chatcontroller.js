var activeUsers = [];

module.exports = function (app, io) {
    var chat = io.of('/socket').on('connection', function (socket) {
       
       // New Message
       socket.on('send message', function (data) {
          socket.broadcast.emit('message', data);
          socket.emit('message', data);
       });
       
       // Login
       socket.on('login', function (data, callback) {
          if (activeUsers.indexOf(data) != -1)
            callback(false);
          else {
            callback(true);
            socket.user.nickname = data;
            activeUsers.push(socket.user.nickname);
            socket.emit('update userlist', activeUsers);
          }
       });

       // Kick
       socket.on('kick', function (data) {

       });
       
       // Refresh
       socket.on('refresh', function (data) {
           
       });        
    });
    
    io.of('/chat').on('disconnect', function() {
        console.log("disconnected" + chat.socket.user.nickname);
    });
}