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

// room_id��ۑ�����
var rooms = {};
io.on('connection', function(socket){

	// ���������
	socket.on('create_room', function(data){
		var ret;
		var room_id = data.room_id;
		if(room_id) {
			// room_id���n����Ă�Ƃ�
			console.log(rooms[room_id]);
			if(rooms[room_id]){ // �����̏d���m�F
				// ����������Ƃ�
				console.error('room_id : ' + room_id + ' is already exisit');
				ret = false;
			}else{
				// �������Ȃ��Ƃ�
				rooms[room_id] = {};
				console.log('room_id : ' + room_id + 'is maked');
				ret = true;
			}
		}else{
			//room_id���n����ĂȂ��Ƃ�
			console.error("room_id is not defined");
			ret = false;
		}
		
		console.log(rooms);
	
		// socket.emit('', ret)
	});

	// �����\�m�F
	socket.on('check_enter_room', function(data){
	
		var ret; // true or false
		var room_id = data.room_id;
		if(rooms[room_id]){
			// ����������Ƃ�
			console.log('room_id : ' + room_id + 'is able to be entered');
			ret = true;
		}else{
			// �������Ȃ��Ƃ�
			console.log('room_id : ' + room_id + 'is not able to be entered');
			ret = false;
		}
	
		socket.emit('ret_check_enter_room', ret); // true or false
	});// end: 'emit_from_client'
	
	// ��������
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
