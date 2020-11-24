$(function(){
	$('.dc-nav').each(function(){
		var $this = $(this)
		var mobmenu = $this.attr('data-mobilemenu');
		var sticky = $this.attr('data-sticky');
		var stickytop = $this.attr('data-stickytop');
		var menutype = $this.attr('data-menutype');
		var menutext = $this.attr('data-menutext');
		var stickyid = $this.attr('data-stickyid');
		var screen = $(window).outerWidth();
		var adminbar = 0;
		var fixednav = 0;
		var walkMstart =true;
    	var walkingMenu='';
		var myadminbar = $('#wpadminbar');
		if(stickytop<300){stickytop=300}
		var checksticky = $('body').children('#dc-fixed-nav');
			checksticky = checksticky.length

		if(sticky!='yes'){sticky='no';}

		

		$this.find('li').each(function(){
			var a = $(this).children('ul');
			a = a.length;
			if(a>0){
				$(this).prepend('<span class="dc-menutoggler">');
				$(this).addClass('haschild')
			}
		})

		if(checksticky<=0 && sticky=='yes'){
			$('<div id="dc-fixed-nav"></div>').prependTo('body')
			$('#'+stickyid).clone().removeAttr("id").appendTo('#dc-fixed-nav')
		}
		
		if(menutype!='modern'){menutype='classic'}
		if(menutype=='classic'){$this.children('.menu-toggle').text(menutext);$this.addClass('classic');}else{$this.addClass('modern');}
		$this.children('.menu-toggle').on('click',function(){
			if($this.children('nav').hasClass('menuopened')){
				$this.children('nav').slideUp()
				$this.children('nav').removeClass('menuopened')
			}else{
				$this.children('nav').slideDown()
				$this.children('nav').addClass('menuopened')
			}
		})
		responsivetask();

		$(window).on('resize', function(){
			responsivetask();
	    })

		$this.find('.dc-menutoggler').each(function(){
			$(this).on('click',function(){
				if($(this).parent('li').hasClass('menuopened')){
					$(this).parent('li').children('ul').slideUp()
					$(this).parent('li').removeClass('menuopened')
				}else{
					$(this).parent('li').children('ul').slideDown()
					$(this).parent('li').addClass('menuopened')
				}
			})
		})
		
		function responsivetask(){
			screen = $(window).outerWidth();
			if(myadminbar.length>0){adminbar=myadminbar.outerHeight()}else{adminbar=0}
			if(screen > mobmenu){
				$this.removeClass('dc-nav-mobile')
				$this.children('nav').show()
				$this.find('li').children('ul').show();
				
				if(sticky=='yes'){
					fixednav = $('#dc-fixed-nav').outerHeight();
					$('#dc-fixed-nav').show();
					$('#dc-fixed-nav').css({
						top: adminbar
					})
					if($(window).scrollTop()>= Math.floor(adminbar)+Math.floor(stickytop)){$('#dc-fixed-nav').addClass('navshow')}
					else{$('#dc-fixed-nav').removeClass('navshow')}

					$(window).on('scroll',function(){
						if($(window).scrollTop()>= Math.floor(adminbar)+Math.floor(stickytop)){$('#dc-fixed-nav').addClass('navshow')}
						else{$('#dc-fixed-nav').removeClass('navshow')}
					})
				}
			}else{
				fixednav = 0;
				$this.addClass('dc-nav-mobile')
				$this.children('nav').hide()
				$this.children('nav').removeClass('menuopened')
				$this.find('li').children('ul').hide()
				$this.find('li').removeClass('menuopened')
				if(sticky=='yes'){
					$('#dc-fixed-nav').hide();
				}
			}
		}

		$this.find('li').each(function(){
	        var selected = $(this).children('a').eq(0).attr('href');
	        if(selected.substring(0,1)=='#' && selected.length >=2){
	            if(walkMstart==true){
	                walkingMenu = walkingMenu + selected;
	                walkMstart= false;
	            }
	            else{
	                walkingMenu = walkingMenu + ', ' + selected;
	            }
	        }
	    })

	    var walkingholder = $(walkingMenu);
	    walkingholder.each(function(){
	        var thisNav= $(this);
	        walkingNav();
	        $(window).on('scroll',function(){
	        	walkingNav();
	        })
	      	function walkingNav(){
	      		if(thisNav.offset().top >= Math.floor(adminbar)+Math.floor(stickytop) && sticky =='yes' && $(window).outerWidth()> mobmenu){
	        		if($(window).scrollTop() + Math.floor(adminbar) + Math.floor(stickytop) < thisNav.offset().top + thisNav.outerHeight() && $(window).height() + $(window).scrollTop() > thisNav.offset().top){
	        			$('.dc-nav').find('li').children('a').each(function(){
	        				var thisLi =$(this);
	        				if(thisLi.attr('href')== '#'+ thisNav.attr('id')){
                                thisLi.parent().addClass('dc-active');
                            }
	        			})
	        		}
	        		else{
	        			$('.dc-nav').find('li').children('a').each(function(){
	        				var thisLi =$(this);
	        				if(thisLi.attr('href')== '#'+ thisNav.attr('id')){
                                thisLi.parent().removeClass('dc-active');
                            }
	        			})
	        		}
	        	}
	        	else{
	        		if($(window).scrollTop() + Math.floor(adminbar) < thisNav.offset().top + thisNav.outerHeight() && $(window).height() + $(window).scrollTop() > thisNav.offset().top){
	        			$('.dc-nav').find('li').children('a').each(function(){
	        				var thisLi =$(this);
	        				if(thisLi.attr('href')== '#'+ thisNav.attr('id')){
                                thisLi.parent().addClass('dc-active');
                            }
	        			})
	        		}
	        		else{
	        			$('.dc-nav').find('li').children('a').each(function(){
	        				var thisLi =$(this);
	        				if(thisLi.attr('href')== '#'+ thisNav.attr('id')){
                                thisLi.parent().removeClass('dc-active');
                            }
	        			})
	        		}
	        	}
	      	}
	    })
	})

	// Scroll to the section--------------------------//
	$('a[href*=#]:not([href=#])').click(function() { // event on clicking any # link
		if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') || location.hostname === this.hostname) {
	        var dctarget = $(this.hash);
	        var adminbarheight = $('#wpadminbar');
	        if(adminbarheight.length>0){adminbarheight=adminbarheight.outerHeight()}else{adminbarheight=0}
	        dctarget = dctarget.length ? dctarget : $('[name=' + this.hash.slice(1) + ']');
	        if (dctarget.length && dctarget.offset().top >= $('#dc-fixed-nav').outerHeight() + adminbarheight + Math.floor($('#dc-fixed-nav').find('.dc-nav').attr('data-stickytop')) && $('#dc-fixed-nav').find('.dc-nav').attr('data-sticky') =='yes' && $(window).outerWidth()> $('#dc-fixed-nav').find('.dc-nav').attr('data-mobilemenu')) {
	            $('html,body').animate({
	                scrollTop: dctarget.offset().top - $('#dc-fixed-nav').outerHeight() - adminbarheight // scroll to top
	            }, 1200); // controller of animation speed
	            return false;
	        }
	        else if(dctarget.length){
	            $('html,body').animate({
	                scrollTop: dctarget.offset().top - adminbarheight // scroll to top
	            }, 1200); // controller of animation speed
	            return false;
	        }
	    }
	});

})