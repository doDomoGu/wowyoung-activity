function kspop(opts){
    var _ww=$(window).width();
    var _wh=$(window).height();
    this.opts={id:opts.id||"kspop"+Math.floor(Math.random()*99999+10)}
    this.opts.modal=typeof(opts.modal)!='undefined'?opts.modal:false;
    this.opts.position=opts.position||"fixed";
    this.opts.closeonblur=typeof(opts.closeonblur)!='undefined'?opts.closeonblur:true;
    if(typeof(opts.width)=='number'){
        this.opts.width=(opts.width>_ww)?_ww:opts.width;
    }
    if(typeof(opts.height)=='number'){
        this.opts.height=(opts.height>_wh)?_wh:opts.height;
    }
    
    var v=opts.content.indexOf("@")!=-1?opts.content:$(opts.content);

    if(this.opts.modal){
        $("body").append('<div class="kspopbg" id="'+this.opts.id+'bg" '+ (this.opts.closeonblur?'onclick="close2(\''+ this.opts.id +'\')"':'') +'></div>');
    }
    

    
    $("body").append('\
        <div class="kspopwin" id="'+this.opts.id+'win" \
        style="position:'+this.opts.position +';width:'+this.opts.width+'px;height:'+ this.opts.height+'px;left:50%;top:50%;margin-left:-'+ (this.opts.width/2)+'px;margin-top:-'+(this.opts.height/2) +'px">\
            <div class="kspopcontent" id="'+this.opts.id+'content"\
            style="width:'+(this.opts.width-30)+'px;height:'+ (this.opts.height-30)+'px;margin:15px"><div>\
        </div>\
    ');
    $("#"+this.opts.id+"win .kspopcontent").append(v);
    
    this.show=function(fn){
        $("#"+this.opts.id+"bg").show();
        $("#"+this.opts.id+"win").fadeIn();
        if(fn){fn.call();}
    }

    this.show2=function(fn){
        $("#"+this.opts.id+"bg").show().animate({opacity:.6},0);
        var final_margin_top=-1*this.opts.height/2;
        $("#"+this.opts.id+"win").show().animate({opacity:0,'margin-top':(final_margin_top-50)+'px'},0,function(){
            $(this).animate({opacity:1,'margin-top':final_margin_top+'px'},500);
        });
        if(fn){fn.call();}
    }
}

function close2(_id){
    var id=typeof(_id)=='string'?_id:$(_id).parents('.kspopwin').attr('id').replace('win','');
    var final_margin_top=$("#"+id+"win").css('margin-top').toLowerCase().replace('px','')
    $("#"+id+"bg").animate({opacity:0},200,function(){
        $("#"+id+"bg").hide().animate({opacity:.6},0);
    });
    $("#"+id+"win").animate({opacity:0,'margin-top':(final_margin_top-50)+'px'},200,function(){
        $("#"+id+"win").hide();
        
    });
}