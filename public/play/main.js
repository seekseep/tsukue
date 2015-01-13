$(function () {

    /* ========================================================= */
    var socket = io.connect('http://dev.tsukue.asia:9001');

    var roomId = null;
    var playerId = null;
    var cardMap = null;

    socket.on('connect', function () {
        console.log('connect');
        if (window.confirm('部屋をつくりますか?')) {
            console.log("MAKE-ROOM");
            socket.emit('enterRoom', {'makeRoomOption': {cardNum: 54}});
        } else {
            var res = window.prompt('enter Room Id');
            console.log("VISIT-ROOM TO : ", res);
            socket.emit('enterRoom', {'visitRoomOption': {'roomId': res}});
        }
    });

    socket.on('makeRoomResponse', function (res) {
        roomInit(res);
    });

    socket.on('visitRoomResponse', function (res) {
        roomInit(res);
    });

    socket.on("update", function (resCardMap) {
        console.log(resCardMap);
        cardMap = resCardMap;
        updateMenu();
        cardMapUpdate(cardMap);
    });

    socket.on("singleUpdate", function(option){
        if(option.field.from == 'field' || option.field.to == 'field' || option.field.to == userId) {
            var field = cardMap[option.field.id];
            field.forEach(function (card, index, list) {
                if (card.id == option.card.id) {
                    var card = option.card;
                    list[index] = card;
                    point[card.id].x = card.x;
                    point[card.id].y = card.y;
                    point[card.id].deg = card.degree;
                    updateCardPosition(card.id);
                }
            });
        }
    });

    function roomInit(res){
        roomId = res.room.id;
        playerId = res.player.id;
        $("body")
            .attr('data-roomid', roomId)
            .attr('data-playerid', playerId);
        $("<h1>")
            .html("ROOM : " + roomId + "<br>" + "PLAYER : " + playerId)
            .appendTo("body")
            .css({"font-size": "30px", "position": "absolute", "right": 0, "bottom": 0})
        playerId = res.player.id;
        cardMap = res.room.cardMap;
        cardMapUpdate(cardMap);
    }

    function cardMapUpdate(cardMap) {
        var field = cardMap.field;
        var mine = cardMap[playerId];

        document.querySelector('#field').innerHTML = "";
        field.forEach(function (card) {
            add(card.id, 'field')
        });

        document.querySelector('#hand').innerHTML = "";
        mine.forEach(function (card) {
            add(card.id, 'hand');
        });

        console.log(field, mine);
    }

    /* ========================================================= */

    var point = [];
    var tmp = {};
    var index = 0;
    var zoom = 1;
    var limit = {
        x: -2600 * zoom + $("body").width(),
        y: -1500 * zoom + $("body").height()
    };
    var flag;
    Hammer.defaults.preset[4][1] = {time: 500, threshold: 10};

    /*
     * カードの移動
     */
    function send(cardId, fromPlace, toPlace) {
        var prop = {
            room: {
                id: roomId
            },
            card: {
                id: cardId
            },
            fromPlayerId: fromPlace,
            toPlayerId: toPlace
        };
        socket.emit('moveCard', prop);
        console.log(prop);
    }

    /*
     * カードの生成、追加、各種イベントの登録
     */
    function add(cnt, loc) {
        var elem = $('<div class="card" id="card' + (cnt + 1) + '" style="background-position:' + -200 * (cnt % 13) + 'px ' + -300 * parseInt(cnt / 13) + 'px;z-index:' + (++index) + '" data-id=' + cnt + '></div>').appendTo("#" + loc).hammer({
            recognizers: [
                [Hammer.Tap, {time: 500, threshold: 10}],
                [Hammer.Pan, {direction: Hammer.DIRECTION_ALL}],
                [Hammer.Rotate, {enable: true}],
                [Hammer.Press]
            ]
        });
        elem.on("panstart rotatestart", function (ev) {
            if (!tmp.name) {
                var n = this.id.substr(4) - 0;
                point[n] = point[n] || {};
                tmp.x = point[n].x || 0;
                tmp.y = point[n].y || 0;
                tmp.deg = point[n].deg || 0;
                tmp.name = this.id;
                $(this).css("z-index", ++index);
            }
            ev.stopImmediatePropagation();
            ev.gesture.srcEvent.stopImmediatePropagation();
        });
        elem.on("panmove rotatemove", function (ev) {
            //$("#box").offset({left:point.left+ev.gesture.deltaX,top:point.top+ev.gesture.deltaY});
            var field = this.parentNode.id;
            var id = $(this).attr('data-id');
            console.log("field : ", field, "id : ", id);
            if (tmp.name == this.id) {
                var n = this.id.substr(4) - 0;
                point[n].x = tmp.x + ev.gesture.deltaX / zoom;
                point[n].y = tmp.y + ev.gesture.deltaY / zoom;
                point[n].deg = tmp.deg + ev.gesture.rotation;
                if (point[n].x < 0) {
                    point[n].x = 0;
                }
                /*else if(point[n].x>$("body").width()-$(this).width()){
                 point[n].x=$("body").width()-$(this).width();
                 }*/
                if (point[n].y < 0) {
                    point[n].y = 0;
                }
                /*else if(point[n].y>$("body").height()-$(this).height()){
                 point[n].y=$("body").height()-$(this).height();
                 }*/
                socket.emit('singleUpdateApply',{
                   room : {
                       id : roomId
                   },
                    list: {
                        from: 'field',
                        to: 'field'
                    },
                    card : {
                        id : id,
                        x: point[n].x,
                        y: point[n].y,
                        degree: point[n].deg
                    }
                });
                updateCardPosition(n);
            }
            ev.stopImmediatePropagation();
            ev.gesture.srcEvent.stopImmediatePropagation();
        });
        elem.on("panend pancancel rotateend rotatecancel", function () {
            if (tmp.name == this.id) {
                tmp.name = null;
            }
        });
        elem.on("tap", function (ev) {
            /*if(flag){
             $(this).toggleClass("select");
             ev.stopImmediatePropagation();
             ev.gesture.srcEvent.stopImmediatePropagation();
             }else{*/
            $(this).toggleClass("back");
            //}
            $(this).css("z-index", ++index);
        });
        elem.on("press", function (ev) {
            tmp.name = this;
            $("#menu").css("transform", "translate3d(" + ev.gesture.center.x + "px," + ev.gesture.center.y + "px,0)");
            $("#menu").show();
        });
        //$(".card").data("hammer").get("rotate").set({enable:true});
        //$(".card").data("hammer").get("pan").set({direction:Hammer.DIRECTION_ALL});
    }

    $("#msg").on("touchstart", function () {
        $("#hand").toggle();
        $("#field").toggle();
        if (flag) {
            flag = false;
        } else {
            flag = true;
        }
    });
    /*
     * サブメニュー処理
     */
    /*				$("#menu").on("touchstart",function(e){
     e.stopPropagation();
     $(this).hide();
     del(tmp.name);
     if(tmp.name.parentNode.id=="field"){
     add(tmp.name.id.substr(4)-0,"hand");
     }else{
     add(tmp.name.id.substr(4)-0,"field");
     }
     tmp.name=null;
     flag=true;
     $("#msg").show();
     });*/
    function del(elem) {
        $(elem).remove();
    }

    /*
     * スクロール処理
     */
    var container = $("body").hammer({
        recognizers: [
            [Hammer.Pan, {direction: Hammer.DIRECTION_ALL}],
            [Hammer.Pinch, {enable: true}],
            [Hammer.Tap, {time: 500, threshold: 10}]
        ]
    });
    container.on("panstart", function () {
        point[0] = point[0] || {};
        tmp.x = point[0].x || 0;
        tmp.y = point[0].y || 0;
    });
    container.on("panmove", function (ev) {
        point[0].x = tmp.x + ev.gesture.deltaX;
        point[0].y = tmp.y + ev.gesture.deltaY;
        draw();
    });
    container.on("pinchstart", function () {
        point[0] = point[0] || {};
        tmp.x = point[0].x || 0;
        tmp.y = point[0].y || 0;
        tmp.zoom = zoom;
    });
    container.on("pinchmove", function (ev) {
        var scale = ev.gesture.scale;
        zoom = tmp.zoom * scale;
        if (zoom > 1) {
            zoom = 1;
        } else if (zoom < 0.5) {
            zoom = 0.5;
        }
        if (scale > (1 / tmp.zoom)) {
            scale = 1 / tmp.zoom;
        } else if (scale < (0.5 - tmp.zoom + 1)) {
            scale = 0.5 - tmp.zoom + 1;
        }
        limit.x = -2600 * zoom + $("body").width();
        limit.y = -1500 * zoom + $("body").height();
        if (limit.x > 0) {
            limit.x = 0;
        }
        if (limit.y > 0) {
            limit.y = 0;
        }
        point[0].x = (tmp.x - $("body").width() / 2) * scale + $("body").width() / 2;
        point[0].y = (tmp.y - $("body").height() / 2) * scale + $("body").height() / 2;
        draw();
    });
    container.on("tap", function () {
        console.log("body");
        $("#menu").hide();
        //$("#msg").hide();
        tmp.name = null;
    });

    function updateMenu(){
        $("#menu").html("");
        var list = $("<ul>").css({'listStyle': 'none', 'margin': 0, 'padding': 0});
        for (var name in cardMap) {
            var item = $('<li data-name="' + name + '">' + name + '</li>')
                .css({'padding': '5px', 'margin': 0, 'display': 'block', 'background': 'rgba(0,0,0,0.1)'});

            item.on('touchend', function () {
                var ele = tmp.name;
                var id = $(ele).attr('data-id');
                var toPlace = $(this).attr('data-name');
                var fromPlace = tmp.name.parentNode.id;

                send(id, fromPlace, toPlace);

                $("#menu").hide();
            });
            list.append(item);
        }
        $("#menu").append(list);
    }

    function draw() {
        if (point[0].x > 0) {
            point[0].x = 0;
        } else if (point[0].x < limit.x) {
            point[0].x = limit.x;
        }
        if (point[0].y > 0) {
            point[0].y = 0;
        } else if (point[0].y < limit.y) {
            point[0].y = limit.y;
        }
        $("#field").css("transform", "translate3d(" + point[0].x + "px," + point[0].y + "px,0) scale(" + zoom + ")");
    }

    function updateCardPosition(id){
        $("[data-id=" + (id-1) + "]").css("transform", "translate3d(" + point[id].x + "px," + point[id].y + "px,0) rotate3d(0,0,1," + point[id].deg + "deg)");
    }
});
