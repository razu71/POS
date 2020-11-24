(function($){ 

    // custome collapsing
    $('.collapse_area .collapse_btn').on('click', function () {
        $(this).parents(".collapse_area").find('.collapse_item').slideToggle();
    })


//    LightBox- Single

    $('.sl-lbimg').each(function(){
        var singlesystem= $(this)
        slllbact(singlesystem);
        function slllbact(lightbox){
            var countsingle = $('body').find('#sl-lbimg-frm');
            if(countsingle.length==0){
                $('body').prepend('<div class="dc-lbimg-frm" id="sl-lbimg-frm"><img style="display:none" src="#" alt="Image is not found"/><ul class="dc-lbcont"><li class="lb_close"><i class="fa fa-close"></i></li></ul></div>');
            }
            $('#sl-lbimg-frm').find('img').on('load',function(){
                var a = ($(window).outerHeight()-$(this).outerHeight())/2;
                $(this).css({
                    'margin-top': a +'px'
                })
                $('#sl-lbimg-frm').find('img').fadeIn();
            });
            lightbox.on('click',function(e){
                e.preventDefault();

                 $('#sl-lbimg-frm').find('img').hide();                

                var bi = lightbox.attr('href');
                $('#sl-lbimg-frm').find('img').attr('src', bi);
                $('#sl-lbimg-frm').show();
            });

            $('#sl-lbimg-frm').find('.lb_close').on('click',function(i){
                $('#sl-lbimg-frm').find('img').attr('src', '');            
                $('#sl-lbimg-frm').fadeOut(); 
                $('#sl-lbimg-frm').find('img').hide();           
            });

            $(window).resize(function(){
                $('#sl-lbimg-frm').find('img').each(function(){
                    var a = ($(window).outerHeight()-$(this).outerHeight())/2;
                    $(this).css({
                        'margin-top': a +'px'
                    })
                });

                $('#sl-lbimg-frm').find('img').show();
            })
        }
    })
//  LightBox- Group

    $.fn.dcLightBox = function(options){
        options = $.extend({
            portfolio:false,
            section: '',
            idtype: 'false'
        }, options);
        var pfo = this;
        if(!pfo.attr('id') && options.idtype==false){
            pfo.each(function(){
                var eachPfo = $(this)
                lightboxaction(eachPfo);
            })
        }
        else{
            lightboxaction(pfo);
        }

        function lightboxaction(lightbox){
            var curImg = 0;
            var allImg='';
            if(options.portfolio==true && options.section!=''){
                allImg = lightbox.find(options.section).find('.dc-lbimg-lnk');
            }
            else{
                allImg = lightbox.find('.dc-lbimg-lnk');
            }
            var allsrc=[];
            if(options.portfolio==false && options.section==''){
                lightbox.prepend('<div class="dc-lbimg-frm"><img style="display:none" src="#" alt="Image is not found"/><ul class="dc-lbcont"><li class="lb_prev"><i class="fa fa-angle-left"></i></li><li class="lb_next"><i class="fa fa-angle-right"></i></li><li class="lb_close"><i class="fa fa-close"></i></li></ul></div>');
            }
            for(var i=0; i<allImg.length; i++){
                if(options.portfolio==true && options.section!=''){
                    allsrc.push(lightbox.find(options.section).find('.dc-lbimg-lnk').eq(i).attr('href'));
                    lightbox.find(options.section).find('.dc-lbimg-lnk').eq(i).attr('data-count', i);
                }
                else{
                    allsrc.push(lightbox.find('.dc-lbimg-lnk').eq(i).attr('href'));
                    lightbox.find('.dc-lbimg-lnk').eq(i).attr('data-count', i);
                }
            }

            lightbox.find('.dc-lbimg-frm').find('img').on('load',function(){
                var a = ($(window).outerHeight()-$(this).outerHeight())/2;
                $(this).css({
                    'margin-top': a +'px'
                })
                lightbox.find('.dc-lbimg-frm').find('img').fadeIn();
            });

            var selPf='';
            if(options.portfolio==true && options.section!=''){
                selPf= lightbox.find(options.section).find('.dc-lbimg-lnk');
            }
            else{
                selPf= lightbox.find('.dc-lbimg-lnk');
            }
            selPf.each(function(){
                var pfl = $(this);
                pfl.on('click',function(e){
                    e.preventDefault();

                    lightbox.find('.dc-lbimg-frm').find('img').hide();                

                    var bi = pfl.attr('href');
                    lightbox.find('.dc-lbimg-frm').find('img').attr('src', bi);
                    lightbox.find('.dc-lbimg-frm').show();
                    curImg= pfl.data('count');
                });
            });

            lightbox.find('.lb_next').on('click',function(e){
                e.preventDefault();
                
                lightbox.find('.dc-lbimg-frm').find('img').hide();

                if(curImg < allsrc.length-1){
                    curImg++;
                    lightbox.find('.dc-lbimg-frm').find('img').attr('src', allsrc[curImg]);
                }
                else{
                    curImg=0;
                    lightbox.find('.dc-lbimg-frm').find('img').attr('src', allsrc[curImg]);
                }
            });

            lightbox.find('.lb_prev').on('click',function(i){
                i.preventDefault();            

                lightbox.find('.dc-lbimg-frm').find('img').hide();            

                if(curImg > 0){
                    curImg--;
                    lightbox.find('.dc-lbimg-frm').find('img').attr('src', allsrc[curImg]);
                }
                else{
                    curImg = allsrc.length - 1;
                    lightbox.find('.dc-lbimg-frm').find('img').attr('src', allsrc[curImg]);
                }
            });
            lightbox.find('.lb_close').on('click',function(i){
                lightbox.find('.dc-lbimg-frm').find('img').attr('src', '');            
                lightbox.find('.dc-lbimg-frm').fadeOut(); 

                lightbox.find('.dc-lbimg-frm').find('img').hide();           
            });

            $(window).resize(function(){
                lightbox.find('.dc-lbimg-frm').find('img').each(function(){
                    var a = ($(window).outerHeight()-$(this).outerHeight())/2;
                    $(this).css({
                        'margin-top': a +'px'
                    })
                });

                lightbox.find('.dc-lbimg-frm').find('img').show();
            })
        }
    };

// Portfolio

    $.fn.dcPfolio = function(options){ 
        options = $.extend({
            button:true,
            transition: 600,
            column: 4,
            medium: 3,
            small: 2,
            tiny: 1,
            appearance: 'zoomIn',
            animation: 'classic',
            leftspace:0,
            rightspace:0,
            topspace:0,
            bottomspace:0,
            startgroup:'',
            capitalize: 'yes'
        }, options);
        //Start Main Variables Declaration
        var thisone = this;
        thisone.each(function(){
            var $this = $(this)
            $(window).on('load',function(){
                    var disabledButton='all';
                    var optionsAppearance;
                    if(!$this.attr('data-appearance')){optionsAppearance = options.appearance;}else{optionsAppearance = $this.attr('data-appearance')}
                    var expCol;
                    if(!$this.attr('data-maincol')){expCol = options.column;}else{expCol = Math.floor($this.attr('data-maincol'))}
                    var medCol =options.medium;
                    if(!$this.attr('data-medcol')){medCol = options.medium;}else{medCol = Math.floor($this.attr('data-medcol'))}
                    var smCol =options.small;
                    if(!$this.attr('data-smcol')){smCol = options.small;}else{smCol = Math.floor($this.attr('data-smcol'))}
                    var tinyCol =options.tiny;
                    if(!$this.attr('data-tinycol')){tinyCol = options.tiny;}else{tinyCol = Math.floor($this.attr('data-tinycol'))}
                    var animationTime = options.transition;
                    var globThisData='.dc-pfitem';
                    var globItemdiv='';
                    var items = $this.find('.dc-pfitem');
                    var section=[];
                    var pFolioButton = '<button class="dc-pfbtn" data-dc-pfctg="all">All</button>';
                    var startgroup = options.startgroup;
                    var capitalizeit;
                    if(!$this.attr('data-capitalize')){capitalizeit = options.capitalize;}else{capitalizeit = $this.attr('data-capitalize')}
                    if(startgroup !=''){
                        pFolioButton='';
                        startgroup = startgroup.toLowerCase();
                        if(capitalizeit!='no'){
                            startgroup = capitalize(startgroup);
                        }
                        startgroup = $.trim(startgroup);
                        startgroup = startgroup.replace(/\ /g, '-');
                    };
                    var col;
                    var myOffset=[];
                    var pfolioRatio =1;
                    var pfCurrScr = $this.outerWidth();
                    var animationtype;
                    if(!$this.attr('data-animation')){animationtype = options.animation;}else{animationtype = $this.attr('data-animation')}
                    var pftop;
                    if(!$this.attr('data-top')){pftop = options.topspace;}else{pftop = Math.floor($this.attr('data-top'))}
                    var pfbottom=options.bottomspace;
                    if(!$this.attr('data-bottom')){pfbottom = options.bottomspace;}else{pfbottom = Math.floor($this.attr('data-bottom'))}
                    var pfleft=options.leftspace;
                    if(!$this.attr('data-left')){pfleft = options.leftspace;}else{pfleft = Math.floor($this.attr('data-left'))}
                    var pfright=options.rightspace;
                    if(!$this.attr('data-right')){pfright = options.rightspace;}else{pfright = Math.floor($this.attr('data-right'))}
                    if(! $.isNumeric(pftop)){pftop=0;}
                    if(! $.isNumeric(pfbottom)){pfbottom=0;}
                    if(! $.isNumeric(pfleft)){pfleft =0;}
                    if(! $.isNumeric(pfright)){pfright =0;}
                    items.css({
                        'padding-top' : pftop,
                        'padding-right' : pfright,
                        'padding-bottom' : pfbottom,
                        'padding-left' : pfleft
                    });
                    if(animationtype !='none' || animationtype !='modern' || animationtype!='classic'){
                        animationtype == 'modern';
                    }
                    $this.prepend('<div class="dc-lbimg-frm"><img src="#" alt="Image is not found"/><ul class="dc-lbcont"><li class="lb_prev"><i class="fa fa-angle-left"></i></li><li class="lb_next"><i class="fa fa-angle-right"></i></li><li class="lb_close"><i class="fa fa-close"></i></li></ul></div>');
                    //End Main Variables Declaration
                    
                    //Start Showing portfolio item containers if js is active
                    $this.show();
                    //End Showing portfolio item containers if js is active

                    //Start calculating animation time
                    if(!$.isNumeric(animationTime) || animationTime<100){
                        animationTime = 600;
                    }
                    //End calculating animation time
                    function capitalize(a) {
                        return a.charAt(0).toUpperCase() + a.slice(1);
                    }
                    //Start Auto Generated Button
                    items.each(function(){
                        var dataSec = $(this).data('dc-pfsec');
                        dataSec = dataSec.toLowerCase();
                        dataSec = dataSec.split(',');
                        var dataSecLen = dataSec.length;
                        for(var i=0; i<dataSecLen; i++){
                            var dataSecTrim = $.trim(dataSec[i]);
                                dataSecTrim = dataSecTrim.replace(/\ /g, '-');
                                if(capitalizeit!='no'){
                                    dataSecTrim = capitalize(dataSecTrim);
                                }
                            $(this).addClass('dc-pf-'+ dataSecTrim);
                            var validate = $.inArray(dataSecTrim, section);
                            if(validate === -1){
                                section.push(dataSecTrim);
                            }
                        }
                    });
                    section.sort();
                    var sectionLen = section.length;
                    if(options.button==true){
                        pFolioButton = '<div class="dc-pfbtn-grp">' + pFolioButton;
                        for(var i=0; i<sectionLen; i++){
                                var dis='';
                            if(startgroup!='' && startgroup==section[i]){
                                var dis=' disabled';
                            };
                            pFolioButton = pFolioButton + '<button class="dc-pfbtn" data-dc-pfctg="dc-pf-'+ section[i] +'"'+ dis +'>'+ section[i].replace(/\-/g, ' ') +'</button>';
                        }
                        pFolioButton = pFolioButton + '</div>';
                        $this.closest('.dc-pfolio').prepend(pFolioButton);
                    }
                    //End Auto Generated Button
                    
                    if(animationtype=='modern'){
                        items.addClass('animated').addClass(optionsAppearance);
                    }
                    
                    responsCol();
                    //End Calling Default grid at the beginning

                    //Start Function for Beginning layout and Responsive layout
                    function responsCol(){
                        if(globItemdiv===''){
                            globItemdiv = items;
                        }

                        if(expCol===6){
                            if($(window).width()>991){
                                col = 6;
                            }
                            else{
                                respDevice();
                            }
                        }
                        else if(expCol===5){
                             if($(window).width()>991){
                                col = 5;
                            }
                            else{
                                respDevice();
                            }
                        }
                        else if(expCol===3){
                            if($(window).width()>991){
                                col = 3;
                            }
                            else{
                                respDevice();
                            }
                        }
                        else{
                            if($(window).width()>991){
                                col = 4;
                            }
                            else{
                                respDevice();
                            }

                        }
                        function respDevice(){
                            if($(window).width()>767){
                                col = medCol;
                            }
                            else if($(window).width()>479){
                                col = smCol;
                            }
                            else if($(window).width()<=480){
                                col = tinyCol;
                            }
                        }
                        if(startgroup !=''){
                            globThisData = '.dc-pf-'+ startgroup;
                            globItemdiv = $this.children(globThisData);
                        }
                        if(animationtype !='classic'){
                            thisDefault(col, globItemdiv, items, globThisData);                
                        }
                        else{
                            thisDefault2(col, globItemdiv, items, globThisData);                
                        }
                        $this.dcLightBox({
                            portfolio:true,
                            section: globThisData
                        })
                    }
                    //End Function for Beginning layout and Responsive layout
                    
                    //Start Responsiveness
                    $(window).on('resize', function(){
                        responsCol();
                    });
                    //End Responsiveness

                    //Start Detecting Button Click
                    $this.closest('.dc-pfolio').find('.dc-pfbtn').each(function(){
                        var thisData = $(this).data('dc-pfctg');
                        disabledButton = thisData;
                        if(thisData === 'all'){
                            thisData = '.dc-pfitem';
                            $(this).attr('disabled', 'disabled');
                        }
                        else{    
                            thisData = '.'+ thisData;
                        }
                        var itemdiv = $this.children(thisData);
                        $(this).on('click', function(){
                            $(this).attr('disabled', 'disabled');
                            $(this).siblings('button').removeAttr('disabled');
                            globThisData = thisData;
                            globItemdiv = itemdiv;
                            if(animationtype !='classic'){
                                thisDefault(col, itemdiv, items, thisData);
                            }
                            else{
                                thisAnimation(col, itemdiv, items, thisData);                    
                            }
                            $this.dcLightBox({
                                portfolio:true,
                                section: thisData,
                                idtype:true
                            })
                        });
                    });
                    //End Detecting Button Click
                    
                    //start selected button
                    
                    //end selected button
                    
                    //Start Default Function CSS
                    function thisDefault(col, subitems, items, thisData){
                        var subitemsLen = subitems.length;
                        var itemsLen = items.length;
                        var gridWidth = Math.round($this.outerWidth()/col);
                        var minOffset;
                        var myOffsetValue;
                        myOffset =[];
                        for(var i=0; i<col; i++){
                            myOffset.push(0);
                        }

                        for(var x=0; x<itemsLen; x++){
                            $(items[x]).removeClass('dc-pfactive');
                        }
                        for(var x=0; x<subitemsLen; x++){
                            $(subitems[x]).addClass('dc-pfactive');
                        }
                        for(var x=0; x<itemsLen; x++){
                            $(items[x]).css({
                                opacity: 0,
                                width: gridWidth,
                                zIndex:0,
                                top: Math.round($(this).outerHeight()/4),
                                left: $this.outerWidth()/2 - $(items[x]).outerWidth()/2

                            });
                            $(items[x]).hide();
                        }
                        for(var z=0; z<subitemsLen; z++){
                            for(var i=0; i<myOffset.length; i++){
                                if(i===0){
                                    myOffsetValue=myOffset[i];
                                    minOffset=0;
                                }
                                else if(myOffset[i]<myOffsetValue){
                                    myOffsetValue = myOffset[i];
                                    minOffset = i;
                                }
                            }
                            $(subitems[z]).show();
                            $(subitems[z]).css({
                                opacity: 1,
                                width: gridWidth,
                                zIndex:99,
                                top: myOffsetValue,
                                left: minOffset*gridWidth
                            });
                            myOffset[minOffset] = myOffsetValue + $(subitems[z]).outerHeight();

                        }
                        for(var i=0; i<myOffset.length; i++){
                            if(i===0){
                                myOffsetValue=myOffset[i];
                                minOffset=0;
                            }
                            else if(myOffset[i]>myOffsetValue){
                                myOffsetValue = myOffset[i];
                                minOffset = i;
                            }
                        }
                        $this.css({
                            height:myOffsetValue
                        });
                    }
                    //End Default Function CSS

                    //Start Default Function CSS
                    function thisDefault2(col, subitems, items, thisData){
                        var subitemsLen = subitems.length;
                        var itemsLen = items.length;
                        var gridWidth = Math.round($this.outerWidth()/col);
                        var minOffset;
                        var myOffsetValue;
                        myOffset =[];
                        for(var i=0; i<col; i++){
                            myOffset.push(0);
                        }

                        for(var x=0; x<itemsLen; x++){
                            $(items[x]).removeClass('dc-pfactive');
                        }
                        for(var x=0; x<subitemsLen; x++){
                            $(subitems[x]).addClass('dc-pfactive');
                        }
                        for(var x=0; x<itemsLen; x++){
                            if(!$(items[x]).hasClass('dc-pfactive')){
                                $(items[x]).css({
                                    opacity: 0,
                                    width: gridWidth,
                                    zIndex:0,
                                    top: Math.round($(this).outerHeight()/4),
                                    left: $this.outerWidth()/2 - $(items[x]).outerWidth()/2

                                });
                                $(items[x]).hide();
                            }
                        }
                        for(var z=0; z<subitemsLen; z++){
                            for(var i=0; i<myOffset.length; i++){
                                if(i===0){
                                    myOffsetValue=myOffset[i];
                                    minOffset=0;
                                }
                                else if(myOffset[i]<myOffsetValue){
                                    myOffsetValue = myOffset[i];
                                    minOffset = i;
                                }
                            }
                            $(subitems[z]).show();
                            $(subitems[z]).css({
                                opacity: 1,
                                width: gridWidth,
                                zIndex:99,
                                top: myOffsetValue,
                                left: minOffset*gridWidth
                            });
                            myOffset[minOffset] = myOffsetValue + $(subitems[z]).outerHeight();

                        }
                        for(var i=0; i<myOffset.length; i++){
                            if(i===0){
                                myOffsetValue=myOffset[i];
                                minOffset=0;
                            }
                            else if(myOffset[i]>myOffsetValue){
                                myOffsetValue = myOffset[i];
                                minOffset = i;
                            }
                        }
                        $this.css({
                            height:myOffsetValue
                        });
                    }
                    //End Default Function CSS


                    //Start Function for animation
                    function thisAnimation(col, subitems, items, thisData){
                        var subitemsLen = subitems.length;
                        var itemsLen = items.length;
                        var gridWidth = Math.round($this.outerWidth()/col);
                        var minOffset;
                        var myOffsetValue;
                        myOffset =[];
                        for(var i=0; i<col; i++){
                            myOffset.push(0);
                        }

                        for(var x=0; x<itemsLen; x++){
                            $(items[x]).removeClass('dc-pfactive');
                        }
                        for(var x=0; x<subitemsLen; x++){
                            $(subitems[x]).addClass('dc-pfactive');
                        }
                        for(var x=0; x<itemsLen; x++){
                            if(!$(items[x]).hasClass('dc-pfactive')){
                                $(items[x]).animate({
                                    opacity: 0,
                                    width: gridWidth,
                                    zIndex: 0,
                                    top: Math.round($(this).outerHeight()/4),
                                    left: $this.outerWidth()/2 - $(items[x]).outerWidth()/2
                                }, animationTime, function(){$(items[x]).hide();});
                            }
                        }
                        for(var z=0; z<subitemsLen; z++){
                            for(var i=0; i<myOffset.length; i++){
                                if(i===0){
                                    myOffsetValue=myOffset[i];
                                    minOffset=0;
                                }
                                else if(myOffset[i]<myOffsetValue){
                                    myOffsetValue = myOffset[i];
                                    minOffset = i;
                                }
                            }
                            $(subitems[z]).show();
                            $(subitems[z]).animate({
                                opacity: 1,
                                width: gridWidth,
                                top: myOffsetValue,
                                zIndex:99,
                                left: minOffset*gridWidth
                            }, animationTime);
                            myOffset[minOffset] = myOffsetValue + $(subitems[z]).outerHeight();

                        }
                        for(var i=0; i<myOffset.length; i++){
                            if(i===0){
                                myOffsetValue=myOffset[i];
                                minOffset=0;
                            }
                            else if(myOffset[i]>myOffsetValue){
                                myOffsetValue = myOffset[i];
                                minOffset = i;
                            }
                        }
                        $this.animate({
                            height:myOffsetValue
                        }, animationTime);
                    }

                    // Calculate the height ratio of the current pfolio itmes 
                    function changePfolioHeight(){         
                            pfolioRatio = $this.outerWidth() /  pfCurrScr;
                            pfolioRatio = pfolioRatio
                    }
            })
        })
    };

// scrollToTop initial function

    $(window).scroll(function(){
        if ($(this).scrollTop() > 50) {
            $('.scrollToTop').fadeIn();
        } 
        else {
            $('.scrollToTop').fadeOut();
        }
    });

    $('.scrollToTop').each(function(){
        if($(this).attr('href')==='#'){
            $(this).on('click', function(){
                $('html, body').animate({scrollTop : 0},800); // scroll to top. possible to increasing animation speed by reducing 800
                return false;
            });
        }
    });

// Number counter
 
    $('.dc-count').each(function () {
        var $this = $(this);
        var mytime = +$this.attr('data-time');
        var initcount = $this.attr('data-start');
        var finalcount = $this.data('count');
        if(!finalcount || finalcount==''){
            finalcount=0;
        }
        if(!initcount || initcount==''){
            initcount=0;
        }
        else{
            initcount = +$this.attr('data-start');
        }
        if(!mytime || mytime == ''){
            mytime = 1500;
        }
        if(!$this.hasClass('dc-counted')){
            $({ dccount: initcount }).animate({ dccount: finalcount }, {
                duration: mytime,
                easing: 'swing',
                step: function () {
                    $this.text(Math.ceil(this.dccount));
                }
            });
        }
        $(window).scroll(function(){ // event on scrolling
            var winTop= $(window).scrollTop(); // graving scroll top value
            var winBottom = $(window).height() + winTop;
                var countTop = $this.offset().top;
                var countBottom = $this.outerHeight() + countTop;
                if($(window).scrollTop() + $(window).height() >= $this.offset().top && $(window).scrollTop() <= $this.offset().top + $this.outerHeight()){
                    if(!$this.hasClass('dc-counted') && $this.text()==initcount){
                        $({ dccount: initcount }).animate({ dccount: finalcount }, {
                            duration: mytime,
                            easing: 'swing',
                            step: function () {
                                $this.text(Math.ceil(this.dccount));
                            }
                        });
                        $this.addClass('dc-counted');
                    }
                    else{
                        $this.addClass('dc-counted');
                    }
                }
                //Start reactivation of the counter
                else{
                    if($this.hasClass('dc-counted') && $this.attr('data-count-repeat')=='yes'){
                        $this.removeClass('dc-counted');
                    }
                    else if(!$this.hasClass('dc-counted')){
                        $this.html(initcount);
                    }
                }
            });
    });

// Animated Circular counter 
 
    $('.dc-circle-counter').each(function(){
        var $this = $(this);
        var dataCount = +$(this).attr('data-count');
        var counter = dataCount * 360/100;
            counter = counter.toFixed(1);
            counter = +counter;
        var count = 0;
        var part = 0;
        var anim1 = 0;
        var anim2 = 0 ;
        var animTime = 1000;
        var timeout;
            // if($(window).scrollTop() + $(window).height() >= $this.offset().top && $(window).scrollTop() <= $this.offset().top + $this.outerHeight()){
                if(counter<=180){
                    count = counter;
                    part=3;
                    anim1 = animTime;
                }
                else if(counter>180){
                    count = 180;
                    anim1 = animTime * 50 / dataCount ;
                    anim1 = anim1.toFixed(0);
                    anim1 = +anim1;
                    anim2 = animTime - anim1;
                    anim2 = anim2.toFixed(0);
                    anim2 = +anim2;
                    part=2
                }
                timeout = setTimeout(cycle, 500)
            // }
        $(window).scroll(function(){ // event on scrolling
            var winTop= $(window).scrollTop(); // graving scroll top value
            var winBottom = $(window).height() + winTop;
            var countTop = $this.offset().top;
            var countBottom = $this.outerHeight() + countTop;
            if($(window).scrollTop() + $(window).height() >= $this.offset().top && $(window).scrollTop() <= $this.offset().top + $this.outerHeight()){
                if(!$this.hasClass('dc-circulated') && $this.attr('data-repeted')=='0'){
                    $this.addClass('dc-circulated');
                    if(counter<=180){
                        count = counter;
                        part=3;
                        anim1 = animTime;
                    }
                    else if(counter>180){
                        count = 180;
                        anim1 = animTime * 50 / dataCount ;
                        anim1 = anim1.toFixed(0);
                        anim1 = +anim1;
                        anim2 = animTime - anim1;
                        anim2 = anim2.toFixed(0);
                        anim2 = +anim2;
                        part=2
                    }
                    timeout = setTimeout(cycle, 500);
                    
                }
                else{
                    $this.addClass('dc-circulated');
                }
            }
            //Start reactivation of the counter
            else{
                if($this.hasClass('dc-circulated') && $this.attr('data-circle-repeat')=='yes'){
                    clearTimeout(timeout)
                    $this.removeClass('dc-circulated');
                    count = 0;
                    part = 0;
                    anim1 = 0;
                    anim2 = 0 ;
                    $this.find('.dc-circle-front-1').removeAttr('style');
                    $this.find('.dc-circle-front-2').removeAttr('style');
                }
                else if(!$this.hasClass('dc-circulated')){
                    $this.attr('data-repeted', '0')
                    clearTimeout(timeout)
                    count = 0;
                    part = 0;
                    anim1 = 0;
                    anim2 = 0 ;
                    $this.find('.dc-circle-front-1').removeAttr('style');
                    $this.find('.dc-circle-front-2').removeAttr('style');
                }
            }
        });



        function cycle(){
            if (part==3 || part==2){
                $this.find('.dc-circle-front-1').css({
                    '-o-transition' : 'all ' + anim1 + 'ms linear',
                    '-moz-transition' : 'all ' + anim1 + 'ms linear',
                    '-ms-transition' : 'all ' + anim1 + 'ms linear',
                    '-webkit-transition' : 'all ' + anim1 + 'ms linear',
                    'transition' : 'all ' + anim1 + 'ms linear',
                    '-o-transform' : 'rotate(' + count + 'deg)',
                    '-moz-transform' : 'rotate(' + count + 'deg)',
                    '-ms-transform' : 'rotate(' + count + 'deg)',
                    '-webkit-transform' : 'rotate(' + count + 'deg)',
                    'transform' : 'rotate(' + count + 'deg)'
                })
                if(counter>180){
                    count = counter - count;
                }
            }
            else if (part==1){
                $this.find('.dc-circle-front-2').css({
                    '-o-transition' : 'all ' + anim2 + 'ms linear',
                    '-moz-transition' : 'all ' + anim2 + 'ms linear',
                    '-ms-transition' : 'all ' + anim2 + 'ms linear',
                    '-webkit-transition' : 'all ' + anim2 + 'ms linear',
                    'transition' : 'all ' + anim2 + 'ms linear',
                    '-o-transform' : 'rotate(' + count + 'deg)',
                    '-moz-transform' : 'rotate(' + count + 'deg)',
                    '-ms-transform' : 'rotate(' + count + 'deg)',
                    '-webkit-transform' : 'rotate(' + count + 'deg)',
                    'transform' : 'rotate(' + count + 'deg)'
                })
            }
            if(part==1 || part==3){
                part = 0;
            }
            else if(part==2){
                part=1;
            }
            if (part>0){
                timeout =setTimeout(cycle, anim1-1)
            }
        }
    })

// START:: Tab

    $('.dc-tab').each(function(){
        var $this = $(this);
        var myTabContainer =$this.find('.dc-nav-tab'); // graving very first nav
        var myTabs = myTabContainer.find('li'); // graving li
        var indexactive = myTabContainer.find('.dc-active').index();
        var tabtime= $this.attr('data-time');
        var tabtranstime= $this.attr('data-transtime');
        var tabpause = true;
        if(!tabtime){
            tabtime = 1000;
        }
        if(!tabtranstime){
            tabtranstime = '1s';
        }
        var tabtrans='';

        var navtransition= $this.attr('data-nav-trans');

        if($this.attr('data-slide')=="yes"){
            $this.children('.dc-tab-content').css('overflow', 'hidden');
            $this.children('.dc-tab-content').children('.dc-tab-container').addClass('clearfix');
            if($this.attr('data-section-type')=="float"){
                $this.children('.dc-tab-content').children('.dc-tab-container').addClass('clearfix')
                $this.children('.dc-tab-content').children('.dc-tab-container').css({
                    'width' : (myTabs.length * 100) + '%'
                });
                $this.find('.dc-tab-pane').css({
                    'width' : (100/ myTabs.length) + '%',
                    'float' : 'left',
                    'display' : 'initial'
                });
            }
            else{
                $this.children('.dc-tab-content').children('.dc-tab-container').css({
                    'width' : (myTabs.length * 100) + '%',
                    'display' : 'table'
                });
                $this.find('.dc-tab-pane').css({
                    'width' : (100/ myTabs.length) + '%',
                    'display' : 'table-cell',
                    'position' : 'initial'
                });
            }
            $this.find('.dc-tab-container').css({
                '-moz-transition' : 'all '+tabtranstime+' ease-in-out',
                '-webkit-transition' : 'all '+tabtranstime+' ease-in-out',
                '-ms-transition' : 'all '+tabtranstime+' ease-in-out',
                '-o-transition' : 'all '+tabtranstime+' ease-in-out',
                'transition' : 'all '+tabtranstime+' ease-in-out'
            })
            if(navtransition=='yes'){
                $this.find('.dc-nav-tab-container').css({
                    'overflow': 'hidden'
                })
                $this.find('.dc-nav-tab-container').children('.dc-nav-tab').css({
                    'width' : (myTabs.length * 33.333333) + '%',
                    '-moz-transition' : 'all '+tabtranstime+' ease-in-out',
                    '-webkit-transition' : 'all '+tabtranstime+' ease-in-out',
                    '-ms-transition' : 'all '+tabtranstime+' ease-in-out',
                    '-o-transition' : 'all '+tabtranstime+' ease-in-out',
                    'transition' : 'all '+tabtranstime+' ease-in-out'
                })
                $this.find('.dc-nav-tab-container').children('.dc-nav-tab').children('li').css({
                    'width' : (100/ myTabs.length) + '%',
                    'float' : 'left',
                    '-moz-transition' : 'all '+tabtranstime+' ease-in-out',
                    '-webkit-transition' : 'all '+tabtranstime+' ease-in-out',
                    '-ms-transition' : 'all '+tabtranstime+' ease-in-out',
                    '-o-transition' : 'all '+tabtranstime+' ease-in-out',
                    'transition' : 'all '+tabtranstime+' ease-in-out'
                })
            }
        }
        if($this.attr('data-slide')=="yes"){
            $this.children('.dc-tab-content').children().eq(0).css({
                'margin-left' : '-' + (indexactive * 100) + '%'
            })
        }
        else {
            $this.children('.dc-tab-content').children('.dc-tab-container').children().hide();
            $this.children('.dc-tab-content').children('.dc-tab-container').children().eq(indexactive).show();
        }
        myTabs.each(function(){
            $(this).on('click', function(){ // event on clicking li
                indexactive = $(this).index();
                clicktab();
            });
            // $(this).siblings().removeClass('dc-active'); // removing dcactive class form other li
            // $(this).addClass('dc-active'); // adding dcactive class to selected li
        });
        $this.find('.dc-tab-arrow-prev').on('click',function(){
            prevclick();
        })
        $this.find('.dc-tab-arrow-next').on('click',function(){
            tabslidetransition();
        })
        $this.on('mouseover', function(){
            tabpause=false;
        })
        $this.on('mouseleave', function(){
            tabpause=true;
            if(tabtrans==''){
                setSlideshow()
            }
        })
        setSlideshow();
        function setSlideshow(){
            if($this.attr('data-slide')=='yes' && $this.attr('data-slideshow')=='yes') {
                tabtrans = setTimeout(tabtransition, tabtime);
            }
        }
        function clicktab(){
            if($this.attr('data-slide')=='yes'){
                $this.children('.dc-tab-content').children().eq(0).css({
                    'margin-left' : '-' + (indexactive * 100) + '%'
                })
                if(indexactive==0){
                    $this.find('.dc-nav-tab-container').children('.dc-nav-tab').css({
                        'margin-left' : '0'
                    })
                }
                else if(indexactive==myTabs.length-1){
                    $this.find('.dc-nav-tab-container').children('.dc-nav-tab').css({
                        'margin-left' : '-' + ((indexactive-2) * 33.3333) + '%'
                    })
                }
                else{
                    $this.find('.dc-nav-tab-container').children('.dc-nav-tab').css({
                        'margin-left' : '-' + ((indexactive-1) * 33.3333) + '%'
                    })
                }
            }
            else{
                $this.children('.dc-tab-content').children('.dc-tab-container').children().eq(indexactive).siblings('div').hide(0,function(){
                    $this.children('.dc-tab-content').children('.dc-tab-container').children().eq(indexactive).fadeIn(200); // opening the selecting tab content
                }); // closing other open tab content
            }
            $this.find('.dc-nav-tab-container').children('.dc-nav-tab').children('li').removeClass('dc-active');
            $this.find('.dc-nav-tab-container').children('.dc-nav-tab').children('li').eq(indexactive).addClass('dc-active');
        }
        function prevclick(){
            if($this.attr('data-slide')=='yes' && $this.attr('data-slideshow')=='yes'){
                if(indexactive== 0){
                    indexactive = myTabs.length-1;
                }
                else{
                    indexactive--;
                }
                $this.children('.dc-tab-content').children().eq(0).css({
                    'margin-left' : '-' + (indexactive * 100) + '%'
                })
                if(indexactive==0){
                    $this.find('.dc-nav-tab-container').children('.dc-nav-tab').css({
                        'margin-left' : '0'
                    })
                }
                else if(indexactive==myTabs.length-1){
                    $this.find('.dc-nav-tab-container').children('.dc-nav-tab').css({
                        'margin-left' : '-' + ((indexactive-2) * 33.3333) + '%'
                    })
                }
                else{
                    $this.find('.dc-nav-tab-container').children('.dc-nav-tab').css({
                        'margin-left' : '-' + ((indexactive-1) * 33.3333) + '%'
                    })
                }
                myTabContainer.find('.dc-active').removeClass('dc-active');
                myTabContainer.find('li').eq(indexactive).addClass('dc-active')
            }
            $this.find('.dc-nav-tab-container').children('.dc-nav-tab').children('li').removeClass('dc-active');
            $this.find('.dc-nav-tab-container').children('.dc-nav-tab').children('li').eq(indexactive).addClass('dc-active');
        }
        function tabslidetransition() {
            if($this.attr('data-slide')=='yes' && $this.attr('data-slideshow')=='yes'){
                if(indexactive== myTabs.length-1){
                    indexactive = 0;
                }
                else{
                    indexactive++;
                }
                $this.children('.dc-tab-content').children().eq(0).css({
                    'margin-left' : '-' + (indexactive * 100) + '%'
                })
                if(indexactive==0){
                    $this.find('.dc-nav-tab-container').children('.dc-nav-tab').css({
                        'margin-left' : '0'
                    })
                }
                else if(indexactive==myTabs.length-1){
                    $this.find('.dc-nav-tab-container').children('.dc-nav-tab').css({
                        'margin-left' : '-' + ((indexactive-2) * 33.3333) + '%'
                    })
                }
                else{
                    $this.find('.dc-nav-tab-container').children('.dc-nav-tab').css({
                        'margin-left' : '-' + ((indexactive-1) * 33.3333) + '%'
                    })
                }
                myTabContainer.find('.dc-active').removeClass('dc-active');
                myTabContainer.find('li').eq(indexactive).addClass('dc-active')
            }
            $this.find('.dc-nav-tab-container').children('.dc-nav-tab').children('li').removeClass('dc-active');
            $this.find('.dc-nav-tab-container').children('.dc-nav-tab').children('li').eq(indexactive).addClass('dc-active');
        }

        function tabtransition() {
            if(tabpause==true){  
                tabslidetransition();
                setTimeout(tabtransition, tabtime);
            }
            else{
                tabtrans='';
            }
        }
    });

// accordion

    $('.dc-accordion').each(function(){
        var $this = $(this);
        var dcExp = $this.attr('data-expand')
        var dcClose = $this.attr('data-openicon')
        var dcStart = Math.round($this.attr('data-start'))
        if(!dcClose){
            dcClose = 'fa-minus';
        }
        var dcOpen = $this.attr('data-closeicon')
        if(!dcOpen){
            dcOpen = 'fa-plus';
        }
        $this.find('.dc-accrd-icon').addClass('fa ' + dcOpen)
        $this
            .find('.dc-acc-box')
            .children('.dc-acc-head')
                .on('click',function() // event on clicking on accordion heading
                    {
                        if(!$(this).hasClass('dc-acc-active')){ // checking if the class is available
                            $(this)
                                .next('.dc-acc-body')
                                    .slideDown()
                                        .prev('.dc-acc-head')
                                            .addClass('dc-acc-active') //exapnding accordion body and adding class
                                            .find('i').removeClass(dcOpen).addClass(dcClose);
                        }

                        else{
                            $(this)
                                .next('.dc-acc-body')
                                    .slideUp()
                                        .prev('.dc-acc-head')
                                            .removeClass('dc-acc-active') // collapsing accordion body and removing class
                                            .find('i').removeClass(dcClose).addClass(dcOpen);
                                            
                        }
                        
                        

                        // collapsing other according body and removing class
                        if(dcExp != 'all'){
                            $(this).parent('.dc-acc-box')
                                .siblings()
                                    .children('.dc-acc-body').slideUp().end()
                                    .children('.dc-acc-head').removeClass('dc-acc-active').end()
                                    .children('.dc-acc-head').find('i').removeClass(dcClose).addClass(dcOpen);
                        }
                    });
        $this.find('.dc-acc-box').children('.dc-acc-body').hide();
        if(dcStart && dcStart > 0){
            $this.find('.dc-acc-box').eq(dcStart-1).children('.dc-acc-body').first().show().prev('.dc-acc-head').addClass('dc-acc-active').find('i').removeClass(dcOpen).addClass(dcClose);
        }
    });

// START : PARALLAX BACKGROUND
    
    $('.dc-parallax').each(function(){
        var $this = $(this),
            bgpos = $this.attr('data-parallax-pos'),
            parallaxSpeed = $this.data('parallax-speed'),
            dCrazeVal;
        if(!bgpos || bgpos==''){
            bgpos='center'
        }
        
        if(!$.isNumeric(parallaxSpeed)){
            parallaxSpeed = 1.5; // controller of counting animation speed
        }
        
        instParPos($this)
        $(window).resize(function(){ // setting for window resize
            instParPos($this)
        });
        
        function instParPos(a){
            if(a.attr('data-parallax-dir') !='left' && a.attr('data-parallax-dir') !='right'){
                if($(window).width()<=767){
                    a.css({
                        'background-size' : 'auto auto'
                    });
                }
                else{
                    a.css({
                        'background-size' : 'cover'
                    });
                }
                a.css({
                    'background-position' : 'center center'
                });
            }
            else{
                if(a.attr('data-parallax-fixed') == 'yes'){
                    if(a.outerHeight() >= $(window).height()){
                        a.css({
                        'background-size' : (a.outerHeight() + a.outerWidth()) + 'px auto' 
                        });
                        if(a.attr('data-parallax-dir') =='left'){
                            a.css({
                            'background-position' : (-($(window).scrollTop()+$(window).height()-$this.offset().top)/2) + 'px ' + bgpos
                            });
                        }
                        else{
                            a.css({
                            'background-position' : (-$this.outerHeight()+($(window).scrollTop()+$(window).height()-$this.offset().top)/2) + 'px ' + bgpos
                            });
                        }
                    }
                    else{
                        a.css({
                        'background-size' : ($(window).height() + a.outerWidth()) + 'px auto' 
                        });
                        if(a.attr('data-parallax-dir') =='left'){
                            a.css({
                            'background-position' : (-($(window).scrollTop()+$(window).height()-$this.offset().top)/2) + 'px ' + bgpos
                            });
                        }
                        else{
                            a.css({
                            'background-position' : (-$(window).height()+($(window).scrollTop()+$(window).height()-$this.offset().top)/2) + 'px ' + bgpos
                            });
                        }
                    }
                }
                else if(a.attr('data-parallax-fixed') !== 'yes' && a.attr('data-parallax-type') == 'panaroma'){
                    a.css({
                    'background-size' : 'auto 100%',
                    });
                    if(a.attr('data-parallax-dir') =='left'){
                        a.css({
                        'background-position' : (-($(window).scrollTop()+$(window).height()-$this.offset().top)/2) + 'px ' + bgpos
                        });
                    }
                    else{
                        a.css({
                        'background-position' : (($(this).scrollTop()+$(window).height()-$this.offset().top)/2) + 'px ' + bgpos
                        });
                    }
                }
                else{
                    if(a.attr('data-parallax-dir') =='left'){
                        a.css({
                        'background-position' : (-($(window).scrollTop()+$(window).height()-$this.offset().top)/2) + 'px ' + bgpos
                        });
                    }
                    else{
                        a.css({
                        'background-position' : (($(this).scrollTop()+$(window).height()-$this.offset().top)/2) + 'px ' + bgpos
                        });
                    }
                }
            }
        }

        $(window).on('scroll', function(){
            if($this.attr('data-parallax-dir') =='left'){
                dCrazeVal = (-($(this).scrollTop()+$(window).height()-$this.offset().top)/2) + 'px';
                if($(window).height() + $(this).scrollTop() >= $this.offset().top && $(this).scrollTop() <= $this.outerHeight() + $this.offset().top){
                    $this.css({
                    'background-position' : dCrazeVal + ' ' + bgpos
                    });
                }
            }
            else if($this.attr('data-parallax-dir') =='right'){
                if($this.attr('data-parallax-fixed') == 'yes'){
                    if($this.outerHeight() >=$(window).height()){
                        dCrazeVal = (-$this.outerHeight()+($(this).scrollTop()+$(window).height()-$this.offset().top)/2) + 'px';
                    }
                    else{
                        dCrazeVal = (-$(window).height()+($(this).scrollTop()+$(window).height()-$this.offset().top)/2) + 'px';
                    }
                }
                else{
                        dCrazeVal = (($(this).scrollTop()+$(window).height()-$this.offset().top)/2) + 'px';
                }
                if($(window).height() + $(this).scrollTop() >= $this.offset().top && $(this).scrollTop() <= $this.outerHeight() + $this.offset().top){
                    $this.css({
                    'background-position' : dCrazeVal + ' ' + bgpos
                    });
                }
            }
            else{
                dCrazeVal = Math.ceil((($(this).scrollTop()-$this.offset().top-$this.offset().top/50)-($(this).scrollTop()-$this.offset().top)/parallaxSpeed)) + 'px';
                if($(window).height() + $(this).scrollTop() >= $this.offset().top && $(this).scrollTop() <= $this.outerHeight() + $this.offset().top){
                    $this.css({
                        'background-position' : 'center '+ dCrazeVal
                    });
                }
            }
        });
        
    });
})(jQuery);