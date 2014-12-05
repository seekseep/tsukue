// app.js
<<<<<<< HEAD
var app = require('http').createServer(handler),
io = require('socket.io').listen(app),
fs = require('fs');

app.listen(9001);
function handler(req, res) {
	  fs.readFile(__dirname + '/index.html', function(err, data) {
  	  if(err) {
    	  res.witeHead(500);
	     	return res.end('Error'); 
  	  }
    	res.writeHead(200);
    	res.write(data);
    	res.end()
  	})
}

// room_idを保存する
var rooms = {};
io.on('connection', function(socket){

	// 部屋を作る
	socket.on('create_room', function(data){
		var ret;
		var room_id = data.room_id;
		if(room_id) {
			// room_idが渡されてるとき
			console.log(rooms[room_id]);
			if(rooms[room_id]){ // 部屋の重複確認
				// 部屋があるとき
				console.error('room_id : ' + room_id + ' is already exisit');
				ret = false;
			}else{
				// 部屋がないとき
				rooms[room_id] = {};
				console.log('room_id : ' + room_id + 'is maked');
				ret = true;
			}
		}else{
			//room_idが渡されてないとき
			console.error("room_id is not defined");
			ret = false;
		}
		
		console.log(rooms);
	
		// socket.emit('', ret)
	});

	// 入室可能確認
	socket.on('check_enter_room', function(data){
	
		var ret; // true or false
		var room_id = data.room_id;
		if(rooms[room_id]){
			// 部屋があるとき
			console.log('room_id : ' + room_id + 'is able to be entered');
			ret = true;
		}else{
			// 部屋がないとき
			console.log('room_id : ' + room_id + 'is not able to be entered');
			ret = false;
		}
	
		socket.emit('ret_check_enter_room', ret); // true or false
	});// end: 'emit_from_client'
	
	// 入室処理
	socket.on('enter_room', function(data){
	
		var room_id = data.room_id;
	
		var room = rooms[room_id];
		room[socket.id] = socket;
	
		console.log(room_id, room);
	
		// socket.emit('enter_room_ret', data); // true or false
	
	});// end: 'emit_from_client'

});// end: io.on('connection')
console.log("Hello world!")
=======

console.log("this is app.js")
>>>>>>> 4a04c157286f8994e672621e85746a92221eead4
