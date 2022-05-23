
const timeout = 1500;

$(".header_sing_in").click(function(){
    $(".popup").addClass('open')
    bodyLock();
});

$(".popup__close").click(function(){
    $(".popup").removeClass('open')
    bodyUnLock();
});

$(".popup").mouseup( function(e){
    var div = $(".popup__content");
    if ( !div.is(e.target) && div.has(e.target).length === 0 ) {
        $(".popup").removeClass('open')
        bodyUnLock();
    }
});

$(document).on('keyup', function(e) {
	if ( e.key == "Escape" ) {
        $(".popup").removeClass('open')
        bodyUnLock();
	}
});


function bodyLock(){
    $("body").css({
        'overflow' : 'hidden',
        'padding-right' : '12px',
        'overscroll-behavior': 'none',

    });
}

function bodyUnLock() {
    setTimeout(function (){
        $("body").css({
            'overflow' : '',
            'padding-right' : '',
            'overscroll-behavior': '',

        });
    },timeout);
}
