
var room_1 = $("#uid_1").val()+":" + $("#uid_2").val();
var room_2 = $("#uid_2").val()+":" + $("#uid_1").val();

var user_1 = $("#uid_1").val();
var user_2 = $("#uid_2").val();

var user_img_1 = $(".img_user_1").attr("src");
var user_img_2 = $(".img_user_2").attr("src");

var user_nik_1 = $(".nik_user_1").html();



$("#submit__message").click(async function(e){

    var user_message = $("#message-text").val();
    console.log(user_message);

    let response = await fetch('../PHPscripts/server.php?message='+user_message +'&' + 'room_1=' + room_1 + '&' +'room_2=' + room_2 +'&' +'uid_1=' + user_1 +'&'+'uid_2='+user_2);
        if(response.ok){
            let result = await response.json();
            if(result.error === "1"){
              alert("Сообщение пустое");
            }else{
                $("#message-text").val("");
                $(".chat__massage-content").last().after('<div <div class = "user__1"> <div class="users_icon-content"> <img src=" ' + user_img_1 + ' "class="users__icon img_user_1" > </div>  <div class="users__nik nik_user_1">'+user_nik_1+'</div> <div class = "users__massage__1">'+ user_message+ '</div>');
            }
        }else{
            alert("Ошибка");

        }
});

$(document).on('keypress',async function(e){
    if(e.which == 13) {
        var user_message = $("#message-text").val();
        console.log(user_message);

        let response = await fetch('../PHPscripts/server.php?message='+user_message +'&' + 'room_1=' + room_1 + '&' +'room_2=' + room_2 +'&' +'uid_1=' + user_1 +'&'+'uid_2='+user_2);
            if(response.ok){
                let result = await response.json();
                if(result.error === "1"){
                alert("Сообщение пустое");
                }else{
                    $("#message-text").val("");
                    $(".chat__massage-content").last().after('<div <div class = "user__1"> <div class="users_icon-content"> <img src=" ' + user_img_1 + ' "class="users__icon img_user_1" > </div>  <div class="users__nik nik_user_1">'+user_nik_1+'</div> <div class = "users__massage__1">'+ user_message+ '</div>');
                }
            }else{
                alert("Ошибка");

            }
    }
});

