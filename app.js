// Initialize express
var express = require('express');
var app = express();

// Setup port
var port = process.env.PORT || 8080;

// Initialize socket.io
var io = require('socket.io').listen(app.listen(port));

// Do config and routes
require('./config')(app, io);
require('./routes')(app,io);

console.log('Bahuma Chat is running on ' + process.env.IP + ":" + port);