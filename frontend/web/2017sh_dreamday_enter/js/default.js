function fontresize(){
    var ww=document.documentElement.clientWidth;
    var maxbasesize=ww>425?425:ww;
    document.documentElement.style.fontSize = 20 * (maxbasesize / 320) + "px";
    $(".inf").css({"font-size":ww/320*20+"px"});
}

function windowresize(){
    //other codes
}

$(window).resize(function(){
    windowresize();
    fontresize();
});


windowresize();
fontresize();



//点击去掉初始值
$('#form1 input[type=text],#form2 input[type=text],#form3 input[type=text]').each(function(){
        $(this).prop('oldvalue',this.value);
        $(this).focus(function(){
            if(this.value==$(this).prop('oldvalue')){
                this.value='';
            }
        }).blur(function(){
            if(this.value==''){
                this.value=$(this).prop('oldvalue');
            }
        });
    });





var pop1=new kspop({content:".qr",modal:true,position:"fixed",width:400,height:400});
