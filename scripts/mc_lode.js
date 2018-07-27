jQuery(function($){

    //loading 
    $('.loading').animate({'width':'95%'},9000);
    $(window).load(function() {
	//progress bar
	$('.circle-loading').fadeOut(300);
		$('.loading').stop().animate({'width':'100%'},300,function() {
			$(this).fadeOut(300);
		});
	});
	
	/* sidebar tab */
	if( $('.widget-nav').length ){
		$('.widget-nav li').each(function(e){
			$(this).hover(function(){
				$(this).addClass('active').siblings().removeClass('active')
				$('.widget-navcontent .item:eq('+e+')').addClass('active').siblings().removeClass('active')
			})
		})
	}

    //fixed position of div
    $(function() {
		var hb = $('.head-bottom');//head-bottom
		var page_l = $('.pageleft');
		var subnav = $('.subnav');
		var startPos = $(hb).offset().top;
		var topOffset = 100;
		var dId1 = 'hot_tags-2';
		var dId2 = 'side_tab';
		$.event.add(window, "scroll", function() {
			var ct = $('.content');
			var l = $(ct).offset().left;
			var p = $(window).scrollTop();
			$(hb).css('position',((p) > startPos) ? 'fixed' : 'static');
			$(page_l).css('position',((p) > startPos) ? 'fixed' : 'static');
			$(hb).css('top',((p) > startPos) ? '0px' : '');
			$(page_l).css('top',((p) > startPos) ? '70px' : '');
			$(subnav).css('top',((p) > startPos) ? '0px' : '');

			if ((p) > $(".sidebar").height()+topOffset) {
				if ($(".sidebar").css('position')=='relative') {
					$(".sidebar").children().hide().each(function(){
					_this = this;
					if ($(_this).attr('id') == dId1 || $(_this).attr('id') == dId2) $(_this).show();
					});
					$(".sidebar").css('position','fixed');
					$(".sidebar").css('top','30px');
					$(".sidebar").css({right: l});
				}
			} else { 
				if ($(".sidebar").css('position')=='fixed') {
					$(".sidebar").css("position",'relative').children().show();
					$(".sidebar").css('top','0px');
					$(".sidebar").css('right','0px');
				}
			}
		});

		$.event.add(window, "resize", function() {
			var ct = $('.content');
			var l = $(ct).offset().left;
			if ($(".sidebar").css('position')=='fixed') {
				$(".sidebar").css({right: l});
			}

			var x = 0;
			var w = 0;
			$(".nav ul").each(function(){
			x = $(this).children().first().position().left;
			w = $(this).children().first().css('width');
			});
			$(".nav ul li").each(function(){
			var navX = $(this).position().left;
			var navW = $(this).css('width');
			if ($(this).hasClass("current-menu-item") || $(this).hasClass('current-category-ancestor') || $(this).hasClass("current-post-ancestor")) {
				x = navX;
				w = navW;
			}
			$("#nav-current").css({left: x});
			$("#nav-current").width(w);
			$(this).mouseenter(function() {
				$("#nav-current").stop().animate({left: navX}, 300);
				$("#nav-current").width(navW);
			});
			});
			$(".nav ul").mouseleave(function() {
			$("#nav-current").stop().animate({left: x}, 500);
			$("#nav-current").width(w);
			});
		});
	});
	
    //menu top
    var x = 0;
    var w = 0;
    $(".nav ul").each(function(){
	x = $(this).children().first().position().left;
	w = $(this).children().first().css('width');
    });
    $(".nav ul li").each(function(){
	var navX = $(this).position().left;
	var navW = $(this).css('width');
	if ($(this).hasClass("current-menu-item") || $(this).hasClass('current-category-ancestor') || $(this).hasClass("current-post-ancestor")) {
	    x = navX;
	    w = navW;
	}
	$("#nav-current").css({left: x});
	$("#nav-current").width(w);
	$(this).mouseenter(function() {
	    $("#nav-current").stop().animate({left: navX}, 300);
	    $("#nav-current").width(navW);
	});
    });
    $(".nav ul").mouseleave(function() {
	$("#nav-current").stop().animate({left: x}, 500);
	$("#nav-current").width(w);
    });

    //
    $.extend({
	tipsBox: function (options) {
	    options = $.extend({
		obj: null,
		str: "+1",
		startSize: "12px",
		endSize: "30px",
		interval: 600,
		color: "red",
		callback: function () { }
	    }, options);
	    $("body").append("<span class='num'>" + options.str + "</span>");
	    var box = $(".num");
	    var left = options.obj.offset().left;
	    var top = options.obj.offset().top;
	    box.css({
		"position": "absolute",
		"left": left + "px",
		"top": top + "px",
		"z-index": 9999,
		"font-size": options.startSize,
		"line-height": options.endSize,
		"color": options.color
	    });
	    box.animate({
		"font-size": options.endSize,
		"opacity": "0",
		"top": top - parseInt(options.endSize) + "px"
	    }, options.interval, function () {
		box.remove();
		options.callback();
	    });
	}
    });
    
    function mc_Heart(prop) {
	prop.find('i').addClass('mc_heart');
	setTimeout(function(){
	    prop.find('i').removeClass('mc_heart');	
	},1000);		
    }

    //
    $(document).ready(function() { 
	$.fn.postLike = function() {
	    if ($(this).hasClass('done')) {
		alert('亲！您已经赞过这篇文章，请不要重复点赞哦！\n\n非常感谢您的支持！');
		return false;
	    } else {
		$(this).addClass('done');
		var id = $(this).data('id'),
		    action = $(this).data('action'),
		    rateHolder = $(this).children('.count');
		var ajax_data = {
		    action: "mc_like",
		    um_id: id,
		    um_action: action
		};
		$.post("./wp-admin/admin-ajax.php", ajax_data,
		       function(data) {
			   $(rateHolder).html(data);
		       });
		
		$.tipsBox({
		    obj: $(this),
		    str: "+1",
		    callback: function () {
		    }
		});
		mc_Heart($(this));
		
		return false;
	    }
	};
	$(document).on("click", ".favorite",
		       function() {
			   $(this).postLike();
		       });
    });

    //to-top
    $(window).scroll(function(){
	if ($(this).scrollTop() >= 30) {
	    if (!$(".to-top").hasClass("topbtnfadein"))
		$(".to-top").removeClass("topbtnfadeout topbtnhide").addClass("topbtnfadein topbtnshow").removeClass("topbtnfadein");
	    //$(".to-top").stop().animate({bottom: 30, opacity: 100});
	} else {
	    if (!$(".to-top").hasClass("topbtnfadeout"))
		$(".to-top").removeClass("topbtnfadein topbtnshow").addClass("topbtnfadeout topbtnhide").removeClass("topbtnfadeout");
	}
    })
    
    $(".to-top").click(function() {
	$("body, html").stop().animate({scrollTop:0});
    });

    //article category
    jQuery(document).ready(function($){
        (function(){
            $('#al_expand_collapse,#mc_archives span.al_mon').css({cursor:"s-resize"});
            $('#mc_archives span.al_mon').each(function(){
                var num=$(this).next().children('li').size();
                var text=$(this).text();
                $(this).html(text+'<em> ( '+num+' 篇文章 )</em>');
            });
            var $al_post_list=$('#mc_archives ul.al_post_list'),
                $al_post_list_f=$('#mc_archives ul.al_post_list:first');
            $al_post_list.hide(1,function(){
                $al_post_list_f.show();
            });
            $('#mc_archives span.al_mon').click(function(){
                $(this).next().slideToggle(400);
                return false;
            });
            $('#al_expand_collapse').toggle(function(){
                $al_post_list.show();
            },function(){
                $al_post_list.hide();
            });
        })();
    });
    
    //get cookie    
    function getCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';'); //把cookie分割成组    
	for (var i = 0; i < ca.length; i++) {
	    var c = ca[i]; //取得字符串    
	    while (c.charAt(0) == ' ') { //判断一下字符串有没有前导空格    
		c = c.substring(1, c.length); //有的话，从第二位开始取    
	    }
	    if (c.indexOf(nameEQ) == 0) { //如果含有我们要的name    
		return unescape(c.substring(nameEQ.length, c.length)); //解码并截取我们要值    
	    }
	}
	return false;
    }

    //clear cookie    
    function clearCookie(name) {
	setCookie(name, "", -1);
    }

    //init cookie    
    function setCookie(name, value, seconds) {
	seconds = seconds || 0; //seconds有值就直接赋值，没有为0，这个跟php不一样。    
	var expires = "";
	if (seconds != 0) { //设置cookie生存时间    
	    var date = new Date();
	    date.setTime(date.getTime() + (seconds * 1000));
	    expires = "; expires=" + date.toGMTString();
	}
	document.cookie = name + "=" + escape(value) + expires + "; path=/"; //转码并赋值    
    }

});
