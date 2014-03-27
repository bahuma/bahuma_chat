module.exports = function (app, io){
    // Routes
    app.get('/', function(req, res){
		res.render('home');
	});
	
	app.get('/chat.html', function(req, res){
		res.render('chat');
	});
};