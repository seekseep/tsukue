	var app = require('http').createServer(handler)
var io = require('socket.io')(app);

// ***********************************************************************

function handler (req, res) {
    res.writeHead(200);
    res.end('this is socket server');
}

// ***********************************************************************

var Rooms = {};
Rooms.index = 0;

// ***********************************************************************

io.on('connection', function (socket) {

    socket.on('makeRoom', function(data){
        console.log('makeRoom', data);


        var room = {};
        room.player = {};
        room.id = Rooms.index++;
        room.playerIndex = 1;
        room.list = {};
        Rooms[room.id] = room;

        var player = {};
        player.id = room.playerIndex++;
        player.name = data.player.name;
        player.socket = socket;
//        console.log('player', player);

        room.player[player.id] = player;

        room.list[0] = [];
        room.list[player.id] = [];

        var num = data.room.card.num;
        for(var idx = 0; idx < num; idx++){
            room.list[0].push({
                id : idx
            });
        }

        var players = [];
        for(var id in room.player){
            players[id] = {
                'name' : room.player[id].name
            };
        }

        var res = {
            'room' : {
                'id' : room.id,
                'list' : room.list,
                'player' : players
            },
            'player' : {
                'id' : player.id,
                'name' : player.name
            }
        };

        socket.emit('makeRoomRes', res); // makeRoom のレスポンス
        socket.join(room.id); // broadcast のグループを決める
    });

    socket.on('joinRoom', function(data){

        var room = Rooms[data.room.id];

        if(!room){
             socket.emit('joinRoomRes', {error:"The Room Not Found"});
            return false;
        }

        var player = {};
        player.id = room.playerIndex++;
        player.name = data.player.name;
        player.socket = socket;

        room.player[player.id] = player;
        room.list[player.id] = [];

        var players = [];
        for(var id in room.player){
            players[id] = {
                'name' : room.player[id].name
            };
        }

        var res = {
            'room' :{
                'id' : room.id,
                'list' : room.list,
                'player' : players
            },
            'player':{
                'id' : player.id,
                'name' : player.name
            }
        };

        socket.join(room.id); // room に追加
        socket.emit('joinRoomRes', res); // 自分の情報を追加

        var broadcastData = {
            'room' : {
                'id' : room.id,
                'list' : room.list,
                'player': players
            }
        };
		console.log('ROOM-ID IS ', room.id);
        socket.broadcast.to(room.id).emit('joinedPlayer', broadcastData); // 追加したことを全体に報告
    });

    socket.on('updateCardApply', function(data){

        var room = Rooms[data.room.id];
        var player = data.player;
        var card = data.card;

        room.list[player.id][card.id] = card;

        socket.broadcast.to(room.id).emit('updateCard', data);

    });

    socket.on('moveCardApply', function(data){
		console.log("MOVE-CARD-APPLY");
        var room = Rooms[data.room.id];
	    var roomId = room.id;
        var fromPlayer = data.player.from;
        var toPlayer = data.player.to;
        var card = data.card;

        room.list[fromPlayer.id][card.id] = undefined;
        room.list[toPlayer.id][card.id] = card;

		console.log(socket.rooms);

		io.to(room.id).emit('moveCard', data);
    });
});


app.listen(1337);
console.log("server on :1337");