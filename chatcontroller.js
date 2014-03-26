var activeUsers = [];

module.exports = function (app, io) {
    var chat = io.of('/chat').on('connection', function (socket) {
       
       // New Message
       socket.on('send message', function (data) {
          socket.broadcast.emit('message');
          socket.emit('message');
       });
       
       // Login
       socket.on('login', function (data, callback) {
          if (activeUsers.indexOf(data) != -1)
            callback(false);
          else {
            callback(true);
            activeUsers.push(data);
            socket.emit('update userlist', userlist);
          }
       });

       // Kick
       socket.on('kick', function (data) {
           
       });
       
       // Refresh
       socket.on('refresh', function (data) {
           
       });        
    });
}