var btn_log =$('.btn__logout')
var el1 =$('#tippy-1').detach();
var el2 =$('#tippy-2').detach();
var el4 = $('#tippy-4').detach();


$("#header_menu_dropdown").click(function(){
    if($('#header_menu_dropdown').attr('aria-expanded') === "false"){
        if($('.header_button_icon').attr('aria-expanded') === "true"){
            $('.header_button_icon').attr('aria-expanded','false')
            $('#tippy-2').detach();
        }
        $('#header_menu_dropdown').attr('aria-expanded','true')
        $(".page").last().after(el1);
        $("#tippy-1").css({
            'z-index' : '9999',
            'visibility' : 'visible',
            'position': 'absolute',
            'inset':' 0px auto auto 0px',
            'margin': '0px',
            'transform': 'translate(558px,'+ trscrol()+'px)',
            'transition-duration':"200ms",
            'opacity': '1'

        });
        $(".tippy_box").css({
            'transition-duration':"200ms",
        });

    }else {
        $('#header_menu_dropdown').attr('aria-expanded','false')
        $('#tippy-1').detach();
    }
});

$("body").mouseup( function(e){
    var div = $(".tippy_box");
    if ( !div.is(e.target) && div.has(e.target).length === 0 ) {
        $('#header_menu_dropdown').attr('aria-expanded','false')
        $('#tippy-1').detach();
        $('.header_button_icon').attr('aria-expanded','false')
        $('#tippy-2').detach();
        $('.header-right-menu__avatar').attr('aria-expanded','false')
        $('#tippy-4').detach();
    }
});

$(".header_button_icon").click(function(){
    if($('.header_button_icon').attr('aria-expanded') === "false"){
        if($('#header_menu_dropdown').attr('aria-expanded') === "true"){
            $('#header_menu_dropdown').attr('aria-expanded','false')
            $('#tippy-1').detach();
        }
        $('.header_button_icon').attr('aria-expanded','true')
        $(".page").last().after(el2);
        $("#tippy-2").css({
            'z-index' : '9999',
            'visibility' : 'visible',
            'position': 'absolute',
            'inset':' 0px auto auto 0px',
            'margin': '0px',
            'transform': 'translate(950px,'+ trscrol()+'px)'})

    }else {
        $('.header_button_icon').attr('aria-expanded','false')
        $('#tippy-2').detach();
    }
});

$(".header-right-menu__avatar").click(function(){
    if($('.header-right-menu__avatar').attr('aria-expanded') === "false"){
        if($('#header_menu_dropdown').attr('aria-expanded') === "true"){
            $('#header_menu_dropdown').attr('aria-expanded','false')
            $('#tippy-1').detach();
        }
        if($('.header_button_icon').attr('aria-expanded') === "true"){
            $('.header_button_icon').attr('aria-expanded','false')
            $('#tippy-2').detach();
        }
        $('.header-right-menu__avatar').attr('aria-expanded','true')
        $(".page").last().after(el4);
        $("#tippy-4").css({
            'z-index' : '9999',
            'visibility' : 'visible',
            'position': 'absolute',
            'inset':' 0px auto auto 0px',
            'margin': '0px',
            'transform': 'translate(1158px,'+ trscrol()+'px)',
            'opacity': '1'
        });
    }else {
        $('.header-right-menu__avatar').attr('aria-expanded','false')
        $('#tippy-4').detach();
    }
});

$(window).on("scroll", function() {
    $("#tippy-1").css( {'transform' :  'translate(558px,'+ trscrol() +'px)'})
    $("#tippy-2").css( {'transform' :  'translate(950px,'+ trscrol() +'px)'})
    $("#tippy-4").css( {'transform' :  'translate(1158px,'+ trscrol() +'px)'})
});

function trscrol(){
    return (pageYOffset +52);
}


$("#search_link").click(function(){
    $('#tippy-1').detach();
    $('#tippy-2').detach();
    setTimeout(function(){
        $(".search").removeClass("hidden")
    $("body").css({
        'overflow' : 'hidden',
        'padding-right' : '12px',
        'overscroll-behavior': 'none',

    });
      }, 0);

});
$(".search_icon_close").click(function(){
    $(".search").addClass("hidden")
    $("body").css({
        'overflow' : '',
        'padding-right' : '',
        'overscroll-behavior': '',

    });
});

$(document).mouseup( function(e){
    var div = $(".search_container");
    if ( !div.is(e.target) && div.has(e.target).length === 0 ) {
            $(".search").addClass("hidden")
            $("body").css({
                'overflow' : '',
                'padding-right' : '',
                'overscroll-behavior': '',

            });
    }
});

$(document).on('keyup', function(e) {
	if ( e.key == "Escape" ) {
        $(".search").addClass("hidden")
        $("body").css({
            'overflow' : '',
            'padding-right' : '',
            'overscroll-behavior': '',

        });
	}
});



$('.search_type').each(function(i, obj) {
    if($(obj).hasClass("search__type_active")){
        $(".search_input").attr("placeholder", "Поиск по " + $(this).text());
    }
    $('.search_type').click(function() {
        $('.search_type').each(function(){
            $(this).removeClass("search__type_active")
        });
        $(this).addClass("search__type_active")
        switch($(this).text()   ) {

            case 'Вики':  // if (x === 'value1')
                $(".search_input").attr("placeholder", "Поиск по Вики");
            break;

            case 'Обсуждения':
                $(".search_input").attr("placeholder", "Поиск по Обсуждениям");
            break;

            case 'Новости':
            $(".search_input").attr("placeholder", "Поиск по Новостям");
            break;

            case 'Пользователь':
            $(".search_input").attr("placeholder", "Поиск по Пользователям");
            break;
          }
    });
});



btn_log.click(async function(e){
    e.preventDefault();
    let response = await fetch('../PHPscripts/logout.php')
        if(response.ok){
            window.location.href = "http://practise/";
        }else{
            alert("Ошибка");

        }

});