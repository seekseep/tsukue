// app.js

var app = require('http').createServer(handler),
    io = require('socket.io').listen(app),
    fs = require('fs');

app.listen(9001);

function handler(req, res) {
    fs.readFile(__dirname + '/index.html', function (err, data) {
        if (err) {
            res.witeHead(500);
            return res.end('Error');
        }
        res.writeHead(200);
        res.write(data);
        res.end()
    })
}
// ================================================================================================
// Card
// ================================================================================================
var Card = function (option) {

    this.init = function (option) {
        this.id = option.id;
        this.x = 0;
        this.y = 0;
        this.z = 0;
        this.front = true;
        this.rotate = 0;
    };

    this.init(option);
};
// ------------------------------------------------------------------------------------------------
Card.prototype = {
    id: null,
    rotate: null,
    x: null,
    y: null,
    z: null,
    front: null
};
// ================================================================================================

// ================================================================================================
// CardPackage
// ================================================================================================
var CardPackage = function (cardNum) {

    this.init = function (cardPackageJSON) {
        this.list = [];
        for (var i = 0; i < cardNum; i++) {
            var option = {};
            option.id = i;
            var card = new Card(option);
            this.list.push(card) // すべてを裏にする
        }
    };

    this.init(cardNum);
};
// ------------------------------------------------------------------------------------------------
CardPackage.prototype = {
    list: null
};
// ================================================================================================
// Player
// ================================================================================================
var Player = function (option) {

    // 初期化文
    this.init = function (option) {
        this.id = option.id;
        this.name = option.name;
        this.socket = option.socket;
    };

    this.init(option);

    // set Player
    return this;
};
// ------------------------------------------------------------------------------------------------
Player.prototype = {
    name: null,
    id: null,
    socket: null
};
// ================================================================================================

// ================================================================================================
// Player Collection 
// ================================================================================================
var PlayerCollection = function () {

    this.init = function () {
        this.playerTable = {};
        this.playerIndex = 0;
    };

    this.setPlayer = function (player) {
        this.playerTable[player.id] = player;
    };

    this.playerExists = function (playerId) {
        return this.playerTable[player.id];
    };

    this.getPlayersId = function () {
    };

    // getPlayerメソット
    this.getNewPlayerId = function () {
        var playerId = this.playerIndex;

        this.playerIndex++;

        if (this.playerIndex > 999999) {
            this.playerIndex = 0;
        }

        return playerId;
    };

    this.init();
};
//------------------------------------------------------------------------------------------------
PlayerCollection.prototype = {
    playerTable: null,
    playerIndex: null
};
// ================================================================================================

// ================================================================================================
// CardMap
// ================================================================================================
var CardMap = function (cardPackage) {
    this.init = function (cardPackage) {
        this.map = {};
        this.map.field = [];
        //カードの情報を取得
        this.map.field = cardPackage.list;
        console.log(this, this.map);
    };

    this.setPlayer = function (player) {
        this.map[player.id] = [];
    };

    //カードの受け渡し
    this.moveCard = function (cardId, toPlayerId, fromPlayerId) {
        //受け渡しするためのメソットを作成
        //相手側のカードメソット
        var toList = this.map[toPlayerId];
        //自分のカードメソット
        var fromList = this.map[fromPlayerId];
        //移動させるカード
        var targetCard = null;

        console.log(fromPlayerId);
        console.log(toPlayerId);
        console.log(cardId);

        //カードの受け渡し処理
        for (var i = 0; i < fromList.length; i++) {
            console.log(fromList[i], cardId);
            if (fromList[i].id == cardId) {
                targetCard = fromList.splice(i, 1)[0];
            }
        }

        //リストの中身を更新
        toList.push(targetCard);
    };

    this.updateCard = function (playerId, cardId, data) {
        var cardList = this.map[playerId];
        var targetCard = null;
        for (var i = 0; i < cardList.length; i++) {
            console.log(cardList[i], cardId);
            if (cardList[i] == cardId) {
                targetCard = cardList[i];
            }
        }
        console.log(targetCard);
    };

    this.init(cardPackage);
};
// ------------------------------------------------------------------------------------------------
CardMap.prototype = {
    map: {}
};
// ================================================================================================

// ================================================================================================
// Room
// ================================================================================================
var Room = function (option) {
    console.log("new Room with", option);
    // option = {
    //     id: id,
    //     cardPackageId: cardPackageId
    // }

    this.init = function (optoin) {

        console.log("Room.init() with ", option);

        // IDを設定する
        this.id = option.id;

        // パッケージを設定する
        this.cardPackage = new CardPackage(optoin.cardNum);

        // カードマップを設定
        this.cardMap = new CardMap(this.cardPackage);

        // プレイヤーコレクションの設定
        this.playerCollection = new PlayerCollection();
    };

    this.addPlayer = function (option) {
        option.id = this.playerCollection.getNewPlayerId();

        var player = new Player(option);
        this.setPlayer(player);

        return player;
    };

    this.setPlayer = function (player) {
        this.playerCollection.setPlayer(player);
        this.cardMap.setPlayer(player);
    };

    this.update = function () {
        var playerTable = this.playerCollection.playerTable;
        var cardMap = this.cardMap.map;
        for (var id in playerTable) {
            var player = playerTable[id];
            var socket = player.socket;
            socket.emit("update", cardMap);
        }
    };

    this.singleUpdate = function(){

    };

    this.init(option);
};
// ------------------------------------------------------------------------------------------------
Room.prototype = {
    id: null,
    cardPackageid: null,
    playerCollection: null,
    cardMap: null,
    setPlayer: null
};
// ------------------------------------------------------------------------------------------------

// ================================================================================================
// RoomCollection
// ================================================================================================
var RoomCollection = function () {

    this.init = function () {
        this.roomTable = {};
        this.roomIndex = 0;
    };

    this.setRoom = function (Room) {
        this.roomTable[Room.id] = Room;
    };

    this.getRoom = function (roomId) {
        return this.roomTable[roomId];
    };

    this.getNewRoomId = function () {
        var roomId = this.roomIndex;
        this.roomIndex++;
        if (this.roomIndex > 99999999) {
            this.roomIndex = 0;
        }
        return roomId;
    };

    this.init();
}
// ------------------------------------------------------------------------------------------------
RoomCollection.prototype = {
    roomTable: null,
    roomIdHeader: null,
    roomIndex: null
}
// ================================================================================================

var roomCollection = new RoomCollection();
io.on('connection', function (socket) {
    console.log(socket.id, "is connected");
    socket.on("enterRoom", function (enterRoomOption) {
        console.log("on enterRoom");

        var makeRoomOption = enterRoomOption.makeRoomOption;
        var visitRoomOption = enterRoomOption.visitRoomOption;

        var response = {};

        if (makeRoomOption) {
            console.log("makeRoom with ", makeRoomOption)
            try {

                // ルームを作るためのオプション
                var option = {};
                option.id = roomCollection.getNewRoomId();
                option.cardNum = makeRoomOption.cardNum;

                // room を作る
                var room = new Room(option);
                response.room = {};
                response.room.id = room.id;
                response.room.cardMap = room.cardMap.map;

                //ルームを保存する
                roomCollection.setRoom(room);
                console.log("roomCollection", roomCollection);

                // player 作成の為のオプションを作る
                var option = {};
                option.name = makeRoomOption.playerName;
                option.socket = socket;

                //playerを保存する
                var player = room.addPlayer(option);
                response.player = {};
                response.player.id = player.id;

            } catch (e) {
                console.error(e);
                response = false;
            } finally {
                console.log('makeRoomResponse', response);
                socket.emit('makeRoomResponse', response);
            }

        } else if (visitRoomOption) {

            try {
                // visitRoomOption を取り出す
                var option = enterRoomOption.visitRoomOption;
                console.log("option", option);

                // 部屋が存在するかを確認する
                var roomId = option.roomId;
                var room = roomCollection.getRoom(roomId);
                if (!room) {
                    throw "[存在しない部屋が参照されました。]";
                } else {
                    console.log("room-id : ", room.id)
                }

                var option = {};
                option.name = visitRoomOption.playerName;
                option.socket = socket;

                var player = room.addPlayer(option);

                response.room = {};
                response.room.id = room.id;
                response.room.cardMap = room.cardMap.map;

                response.player = {};
                response.player.id = player.id;
                socket.emit('visitRoomResponse', response);
                room.update();
            } catch (e) {
                console.log(e);
            } finally {

            }

        } else if (enterRoomOption.returnRoomOption) {
            var option = enterRoomOption.returnRoomOption


        } else {

        }

        return;
    });
    socket.on("singleUpdateApply", function (option) {
        try{
            var room = roomCollection.getRoom(option.room.id);
            var fromList = room.cardMap.map[option.list.from];
            var toList =  room.cardMap.map[option.list.to];

            console.log("======================================");
            console.log(room.cardMap.map);
            console.log(option.list.from);
            console.log(fromList);
            console.log(fromList[option.card.id]);
            console.log("======================================");
            fromList[option.card.id] = undefined;
            toList[option.card.id] = option.card;

            var players = room.playerCollection.playerTable;
            for (var id in players) {
                var player = players[id];
                var socket = player.socket;
                socket.emit("singleUpdate", option);
            }
        }catch(e){
            console.log(e);
        }
    });
});


console.log("this is app.js")