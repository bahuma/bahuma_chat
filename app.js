// Initialize express
var express = require('express');
var app = express();

// Setup port
var ipaddr  = process.env.IP || process.env.OPENSHIFT_NODEJS_IP || "127.0.0.1";
var port    = process.env.PORT || process.env.OPENSHIFT_NODEJS_PORT || 8080;

// Initialize socket.io
var io = require('socket.io').listen(app.listen(port, ipaddr));

// Do config and routes
require('./config')(app, io);
require('./routes')(app, io);
require('./chatcontroller')(app, io);

console.log('Bahuma Chat is running on ' + process.env.IP + ":" + port);