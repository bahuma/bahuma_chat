module.exports = function (app, io) {
    var chat = io.of('/chat').on('connection', function (socket) {
       
       // New Message
       socket.on('newMessage', function (data) {
           
       });
       
       // New Message
       socket.on('newMessage', function (data) {
           
       });
       
       // Kick
       socket.on('kick', function (data) {
           
       });
       
       // Refresh
       socket.on('refresh', function (data) {
           
       });
       
       // Get online users
       socket.on('getOnlineUsers', function (data) {
           
       });
        
    });
}