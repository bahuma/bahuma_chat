module.exports = function (app, io){
    // Routes
    app.get('/', function(req, res){
		res.render('home');
	});
	
	app.get('/login', function(req, res){
		res.render('login');
	});
	
	app.get('/chat', function(req, res){
		res.render('chat');
	});
};