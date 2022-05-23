$(".edit__user").click(async function(e){
    e.preventDefault();
    let response = await fetch('profile.php?'+$("edit__user").attr("name") + '=' + $("edit__user").val());
        if(response.ok){
           $(".page__main-item").php("<?php require_once('edit.php')?>");
        }else{
            alert("Ошибка");

        }

});