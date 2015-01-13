// app.js

var mouseWheelEvent = 'onwheel' in document ? 'wheel' : 'onmousewheel' in document ? 'mousewheel' : 'DOMMouseScroll';

var App = {};

App.init = function () {

    var App = this;
    App.z = 0;

    this.initSocket();
    this.initStartForm();
	this.initHeader();
	this.initFooter();

};

App.initSocket = function(){
	var socket = new io('http://tsukue.asia:1337/');
	var App = this;
	App.room = {};

	socket.on("test",function(res){
		console.log("test()",res);
	});
	socket.on('makeRoomRes', function(res){
		console.log(res);

		var player = res.player;
		var room = res.room;

		App.player = player;
		App.room = room;

		App.initField();
		App.initTableList();

		$("#start").hide();

		App.showHeader();
	});

	socket.on('joinRoomRes', function(res){
		var room = res.room;
		var player = res.player;

		App.room = room;
		App.player = player;

		App.initField();
		App.initTableList();

		$("#start").hide();
		
		App.showHeader();
		App.updateFooter();
	});

    socket.on('joinedPlayer', function(res){
		console.log("JOINED-PLAYER", res);
		
        var room = res.room;
        App.room.player = room.player;
        App.updateFooter();
    });

	socket.on('moveCard', function(res){
		console.log("moveCard",res);
		
		var fromList = res.player.from.id;
		var toList = res.player.to.id;
		var card = res.card;
		
        App.removeCard(fromList, card);
		App.addCard(toList, card);
		App.updateCard(toList, card.id);
	});

    App.socket = socket;
};

App.initStartForm = function(){

    $("#start .join").hide();
    $("#start .make").hide();

    $("#to_join").click(function(){
        $("#start .type").hide();
        $("#start .join").show();
    });

    $("#to_make").click(function(){
        $("#start .type").hide();
        $("#start .make").show();
    });

    $("#make_submit").click(function(){
        var num = $("[name=package]").val();
        var name = $("[name=player]").val();
        var option = {
            'room' : {
                'card' : {
                    'num' : num
                }
            },
            'player': {
                'name' : name
            }
        };

        $("#start .make").hide();

        App.socket.emit('makeRoom', option);

        $("#start .wait").show();

    });

    $("#join_submit").click(function(){
        var id = $("[name=room]").val();
        var name = $("[name=player]").val();
        var option = {
            'room' : {
                'id' : id
            },
            'player': {
                'name' : name
            }
        };

        $("#start .join").hide();

        App.socket.emit('joinRoom', option);

        $("#start .wait").show();
    });
};

App.initField = function () {

    var App = this;

    this.view = {};
    this.view.id = 0;

    this.view[0] = {};
    this.view[this.player.id] = {};

    this.view[0].zoom = 1;
    this.view[0].x = -2000;
    this.view[0].y = -2000;
    this.view[0].tmp = {};
    this.view[0].tmp.zoom = null;
    this.view[0].tmp.x = null;
    this.view[0].tmp.y = null;
    this.view[0].width = 4000;
    this.view[0].height = 4000;
    $("#table")
	.attr({
		"data-list" : 0
	})
	.addClass("view")
	.css({
        'width': this.view[0].width + 'px',
        'height': this.view[0].height + 'px'
    });

    this.view[this.player.id].zoom = 1;
    this.view[this.player.id].x = -2000;
    this.view[this.player.id].y = -2000;
    this.view[this.player.id].tmp = {};
    this.view[this.player.id].tmp.zoom = null;
    this.view[this.player.id].tmp.x = null;
    this.view[this.player.id].tmp.y = null;
    this.view[this.player.id].width = 4000;
    this.view[this.player.id].height = 4000;
    $("#hand")
	.attr({
		"data-list" : this.player.id
	})
	.addClass("view")
	.css({
        'width': this.view[this.player.id].width + 'px',
        'height': this.view[this.player.id].height + 'px'
    });


    this.updateField();

    $("#field .background")
        .hammer({
            recognizers: [
                [Hammer.Tap, {time: 500, threshold: 10}],
                [Hammer.Pan, {direction: Hammer.DIRECTION_ALL}],
                [Hammer.Rotate, {enable: true}],
                [Hammer.Press]
            ]
        })
        .on("panstart", function (event) {
            console.log("panstart @ field");
            var id = App.view.id;
            var view = App.view[id];

            view.tmp.x = view.x;
            view.tmp.y = view.y;
        })
        .on("panmove", function (event) {
            console.log("panmove @ field");
            var id = App.view.id;
            var view = App.view[id];
		
            view.x = view.tmp.x + (event.gesture.deltaX / view.zoom);
            view.y = view.tmp.y + (event.gesture.deltaY / view.zoom);
		
            App.updateField();
        })
        .on("panend", function (event) {
            console.log("panend @ field");
        
			var id = App.view.id;
            var view = App.view[id];
		
            view.x = view.tmp.x + (event.gesture.deltaX / view.zoom);
            view.y = view.tmp.y + (event.gesture.deltaY / view.zoom);
            App.updateField();
        });


    $(window).on(mouseWheelEvent, function (event) {
        event.preventDefault();

        var id = App.view.id;
		var view = App.view[id];

        view.x += (-(event.originalEvent.deltaX) / view.zoom);
        view.y += (-(event.originalEvent.deltaY) / view.zoom);

        App.updateField();
    });

    $(window).on('resize', function () {
        App.updateField();
    });
};

App.updateField = function () {

    var App = this;
	var id = App.view.id;
	var view = App.view[id];

    $("#field") // 画面サイズに合わせて中央に表示
        .css({
            "marginLeft": ($(window).innerWidth() / 2) + "px",
            "marginTop": ($(window).innerHeight() / 2) + "px"
        });
	
	console.log(id);
	if(id == 0){ // 表示する領域の切り替え
		$(".view[data-list=0]").show();
		$(".view[data-list=" + App.player.id + "]").hide();
	}else{
		$(".view[data-list=0]").hide();
		$(".view[data-list=" + App.player.id + "]").show();	
	}

    view.x = Math.max(-view.width, view.x);
    view.y = Math.max(-view.height, view.y);
	
    view.x = Math.min(view.width, view.x);
    view.y = Math.min(view.height, view.y);

    var prop = "";
    prop += "scale(" + view.zoom + ") ";
    prop += "translate(" + view.x + "px, " + view.y + "px) ";

    $(".view[data-list=" + id + "]") // 表示される領域の表示設定
        .css({
            "-webkit-transform": prop,
            "-moz-transform": prop,
            "-ms-transform": prop,
            "-o-transform": prop,
            "transform": prop
        });
};

App.toggleView = function () {
    if (this.view.id == 0) {
        this.view.id = this.player.id;
    } else {
        this.view.id = 0;
    }

    this.updateField();
};

App.initTableList = function(){
	var App = this;
	
	if(App && App.room && App.room.list && App.room.list[0] && App.room.list[0].length > 0){
		App.room.list[0].forEach(function(card){
			if(card){
				App.addCard(0, card);
			}
		});
	}
};

App.addCard = function (list, card) {

	var App = this;
	
	if(list !== 0 && list !== App.player.id){
		return;
	}
	
    App.room.list[list][card.id] = card;

    var tmp = {};
    tmp.x = null;
    tmp.y = null;

    $("<div>")
        .addClass("card")
        .attr({
            "data-id": card.id
        })
        .appendTo(".view[data-list='" + list + "']")
        .hammer({
            recognizers: [
                [Hammer.Tap, {time: 500, threshold: 10}],
                [Hammer.Pan, {direction: Hammer.DIRECTION_ALL}],
                [Hammer.Rotate, {enable: true}],
                [Hammer.Press]
            ]
        })
        .on('panstart rotatestart', function (event) {
            tmp.x = card.x;
            tmp.y = card.y;
            App.room.list[list][card.id].z = App.z++;
        })
        .on('panmove rotatemove panend pancancel rotateend rotatecancel', function (event) {
            var id = App.view.id;
            var view = App.view[id];
            App.room.list[id][card.id].x = tmp.x + (event.gesture.deltaX / view.zoom);
            App.room.list[id][card.id].y = tmp.y + (event.gesture.deltaY / view.zoom);
            App.updateCard(id, card.id);
        })
        .on('tap', function (event) {
			var id = App.view.id;
            var view = App.view[id];
            if (App.room.list[id][card.id].front) {
                App.room.list[id][card.id].front = false;
            } else {
                App.room.list[id][card.id].front = true;
            }
            App.updateCard(id, card.id);
        })
        .on('press', function (event) {
            App.showFooter(event.target);
        });

    App.updateCard(list, card.id);
};

App.removeCard = function (list, card) {
	console.log("removeCard()");
	
	var App = this;
	
	if(list !== 0 && list !== App.player.id){
		return;
	}	
	
	var id = card.id;
	
	console.log("[BEFORE]", App.room.list[list]);
    delete App.room.list[list][card.id];
	console.log("[AFTER]", App.room.list[list]);
    $(".view[data-list='" + list + "'] .card[data-id='" + card.id + "']").remove();
};

App.updateCard = function (list, id) {
    var card = App.room.list[list][id];
    var view = App.view[list];

    if (!card.x || card.x === null || card.x === undefined) {
        card.x = view.width / 2;
    }

    if (!card.y ||card.y === null || card.y === undefined) {
        card.y = view.height / 2;
    }

    if (!card.z ||card.z === null || card.z === undefined) {
        card.z = 0;
    }

    if (!card.rotate ||card.rotate === null || card.rotate === undefined) {
        card.rotate = 0;
    }

    if(card.front === undefined){
        card.front = true;
    }

    var prop = "";
    prop += "translate(" + card.x + "px," + card.y + "px) ";

    $(".card[data-id='" + id + "']")
        .attr({
            "data-front": card.front
        })
        .css({
            "-webkit-transform": prop,
            "-moz-transform": prop,
            "-ms-transform": prop,
            "-o-transform": prop,
            "transform": prop
        });

    if(list === 0){ // テーブルのカードが更新された時
        console.log(list, card);
    }
};

App.moveCard = function (fromList, id, toList) {
        var card = App.room.list[fromList][id];

        card.x = null;
        card.y = null;

		var req = {
			room : {
				id : App.room.id
			},
			player: {
				from : {
					id : fromList
				},
				to : {
					id : toList
				},
			},
			card : card
		} 
		
		console.log(req);
		
		App.socket.emit("moveCardApply", req);
};

App.initHeader = function () {
    $("#toggle_view")
        .click(function () {
            App.toggleView();
        });

    $("#zoom_in")
        .click(function () {
            var name = App.view.name;
            var view = App.view[name];

            view.zoom += 0.1;

            view.zoom = Math.max(2.0, view.zoom);

            App.updateField();
        });

    $("#zoom_out")
        .click(function () {
            var name = App.view.name;
            var view = App.view[name];

            view.zoom -= 0.1;

            view.zoom = Math.max(0.5, view.zoom);

            App.updateField();
        });

    App.hideHeader();
};

App.showHeader = function(){
	console.log(App.room.id);
	$("<div>")
		.addClass("roomId")
		.css({
		"background" : "#333"	
	})
		.html(App.room.id)
		.appendTo("#header");
	$("#header").show();
};

App.hideHeader = function(){
    $("#header").hide();
};

App.initFooter = function () {
    App.hideFooter();
    if(App.target){
        $(App.target).removeClass('selected');
        App.target = null;
    }


    $("#footer")
        .hammer({
            recognizers: [
                [Hammer.Tap, {time: 500, threshold: 10}],
                [Hammer.Pan, {direction: Hammer.DIRECTION_ALL}],
                [Hammer.Rotate, {enable: true}],
                [Hammer.Press]
            ]
        });

    App.hideFooter();

    $("#close_footer").click(function(){
        App.hideFooter();
    });

    $("#to_table").click(function(){
        var id = $(App.target).attr('data-id');
        App.moveCard(App.view.id, id, 0);
        App.hideFooter();
    });

    $("#to_hand").click(function(){
        var id = $(App.target).attr('data-id');
		console.log(App.view.id, id, App.player.id);
        App.moveCard(App.view.id, id, App.player.id);
        App.hideFooter();
    });
};

App.updateFooter = function(){
	var players = App.room.player;
	console.log(players);
	for(var i=1;i<players.length;i++){
		if(i != App.player.id){
			$("<li>")
				.attr({
					"data-id" : i
				})
				.appendTo("#to_players").html(players[i].name).on("click",function(){
					var targetId = $(App.target).attr("data-id");
					var toId = $(this).attr("data-id");
					App.moveCard(App.view.id, targetId,  toId);
					App.hideFooter();
				});			
		}
	}
};

App.showFooter = function (target) {
    App.target = target;
    $("#footer").show();
    $(target).addClass("selected");
    if(App.view.id == 0){
        $("#footer #to_hand").show();
        $("#footer #to_table").hide();
    }else{
        $("#footer #to_hand").hide();
        $("#footer #to_table").show();
    }
};

App.hideFooter = function () {
    App.target = null;
    $("#footer").hide();
    $(".selected").removeClass('selected');
};

$(function () {
    App.init();
});
