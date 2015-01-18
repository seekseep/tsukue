var app = require('http').createServer(handler)
var io = require('socket.io')(app);

// ***********************************************************************

function handler (req, res) {
	res.writeHead(200);
	res.end('<h1><a href="http://tsukue.asia">TSUKUE</a></h1>');
}

// ***********************************************************************

var Rooms = {};
Rooms.index = 1;

// ***********************************************************************

io.on('connection', function (socket) {
	socket.tsukue = {};
	socket.on('makeRoom', function(param){
		console.log("============================== MAKEROOM ==============================");
		// ルーム情報を保持する
		var room = {};
		// プレイヤー情報を管理する。
		room.players = [];
		// ルームID を入れる
		room.id = Rooms.index++;
		// パッケージ情報を格納
		room.package = param.room.package; // パッケージ情報を格納
		// プレイヤIDの開始番号を指定
		room.playerIndex = 1;
		// フィールド情報を格納
		room.fields = [];
		// 重なりの管理
		room.zList = [];

		// プレイヤー情報を作成
		var player = {};
		// id をルームから取得
		player.id = room.playerIndex++;
		// 名前をパラメータから取得
		player.name = param.player.name;
		// ルームにプレイヤー情報を格納
		room.players[0] = {id:0,name:'table'};
		room.players[player.id] = player;

		// カードを格納する配列を作成
        room.cards = [];

		// カードの枚数を取得
        var size = room.package.size;
		// カードリストを初期化
        for(var idx = 0; idx < size; idx++){
			var card = {
				id : idx,							// カードを一意に特定するID(int)
                field : 0,                          // 表示する場所(int)
				isFront : true,						// 表裏(bool)
				isHold: false,						// 操作中(bool)
				isSelected: false,					// 選択中(bool)
				width : room.package.card.width,	// 幅(px)
				height : room.package.card.height,	// 高さ(px)
				x : room.package.table.width / 2,	// X座標(px)
				y : room.package.table.height / 2,	// Y座標(px)
				z : room.zIndex++,                  // Z-INDEX(int)
				rotate: {
					x : 0,                          // X軸回転(deg)
					y : 0,                          // Y軸回転(deg)
					z : 0                           // Z軸回転(deg)
				},
				tmp : {}
			};
			room.cards[idx] = card;
		};

        // 返答の作成
        var res = {
            'room' : room,
            'player' : player
        };

        // room を保存
   		Rooms[room.id] = room;
		console.log(Rooms);

		socket.tsukue.player = player;
        socket.join(room.id); // broadcast のグループを決める
        socket.emit('makeRoomRes', res); // makeRoom のレスポンス
		console.log("============================== /MAKEROOM =============================");
    });

	socket.on('roomExist', function(param){
		var room = Rooms[param.room.id];

		var res = {
			room : room
		}

		socket.emit('roomExistRes', res);
	});

    socket.on('joinRoom', function(param){
		console.log("============================== JOINROOM ==============================");
		console.log(param);
		console.log("----------------------------------------------------------------------");
		console.log('ROOM-ID : ', param.room.id);
        var room = Rooms[param.room.id];

		var player = {
			id : room.playerIndex++,
			name : param.player.name
		};

		console.log(room.player);
		room.players[player.id] = player;
		socket.tsukue.player = player;

		var res = {
			'room' : room,
			'player' : player
		};

		Rooms[room.id] = room;
		socket.join(room.id); // broadcast のグループを決める
		socket.emit('joinRoomRes', res); // makeRoom のレスポンス
		socket.broadcast.to(room.id).emit('updatePlayer', res);
		console.log("============================== /JOINROOM =============================");
    });

    socket.on('updateCardApply', function(data){
		console.log('=========================================================');
		console.log(socket.id);
		console.log('==================== updateCardApply ====================');
		var room = Rooms[data.room.id];
		var card = data.card;
		room.cards[card.id] = card;
		socket.broadcast.to(room.id).emit('updateCard', data);
		console.log('==================== /updateCardApply ===================');
    });
});


app.listen(1337);
console.log("server on :1337");
