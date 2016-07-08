var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();

var usernames={};
var sockets = {};
var users= {};


io.on('connection', function (socket) {
  socket.on( '_init', function( data ) {
    console.log('init '+data['data'])
    sockets[socket.id] = data['data'];
    socket.user_id= data['data'];
    users[data['data']]=socket.id;
		socket.broadcast.emit( 
			'on_not', { 
				data: data['data']
			}
    	);
  });
  socket.on( 'trans', function( data ) {
  	var recip = data['recip'];
    console.log('to user '+recip);
  	if (recip in users) {
      console.log('have user');
      var msg = data['msg'];
  		io.to(users[recip]).emit( 
  			'_forward', { 
    			msg: msg,
          aid: data['aid'],
          sav: data['sav'],
          mid: data['mid']
			}
    	);
  	}
  });
  socket.on('disconnect', function () {
      console.log('disconnect user '+socket.user_id)
      delete sockets[socket.id];
      delete users[socket.user_id];
  });

  socket.on( 'end', function( data ) {
  	if (!socket.id) return;
  	delete users[socket.id];
  });

  socket.on( 'new_count_message', function( data ) {
    io.sockets.emit( 'new_count_message', { 
    	new_count_message: data.new_count_message
    });
  });

  socket.on( 'update_count_message', function( data ) {
    io.sockets.emit( 'update_count_message', {
    	update_count_message: data.update_count_message 
    });
  });

  socket.on( 'new_message', function( data ) {
    io.sockets.emit( 'new_message', {
    	name: data.name,
    	email: data.email,
    	subject: data.subject,
    	created_at: data.created_at,
    	id: data.id
    });
  });
});


http.listen(3000, function(){
    console.log('Listening on Port 3000');
});