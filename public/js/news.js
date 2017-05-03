function tick(){
	    var TOP_NEWS = $('.news-feed li:first');
	    
	    $(TOP_NEWS).animate({ //.fadeTo(250, 0)
	        marginTop: '-100px',
	        opacity: 0
	      },333, function() {
	        $(TOP_NEWS).hide(0, function () {
	          $(TOP_NEWS).appendTo($('.news-feed')).slideDown().animate({ 
	            marginTop: '0',
	            opacity: 1
	          }, 0);
	      });
	    });	  
	  }
	  
	  var NEWS_TIMER = setInterval( function(){tick()},10000);
	  
	  $('.news-panel').hover(function() {
	    NEWS_TIMER = clearInterval(NEWS_TIMER);
	    }, function() {
	      NEWS_TIMER = setInterval( function(){tick()},10000);
	  });
	  
	  $('.next-news-item').click( function() {
	    tick();
	    return false;
	  });