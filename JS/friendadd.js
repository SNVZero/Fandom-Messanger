var user_1 = $("#uid_1").val();
var user_2 = $("#uid_2").val();
$("#add__friend").click(async function(e){
    e.preventDefault();
    let response = await fetch('../PHPscripts/friendadd.php?uid_1='+user_1 +'&'+'uid_2='+user_2);
        if(response.ok){
            let result = await response.json();
            if(result.error === "1"){
              alert(result.massage)
            }else{
                alert("Пользователю отправленно приглашение")
            }
        }else{
            alert("Ошибка");

        }

});

$("#exept__friend").click(async function(e){
    e.preventDefault();
    let response = await fetch('../PHPscripts/friendadd.php?uid_1='+user_1 +'&'+'uid_2='+user_2);
        if(response.ok){
            let result = await response.json();
            if(result.error === "1"){
              alert(result.massage)
            }else{
                alert("Пользователю отправленно приглашение")
            }
        }else{
            alert("Ошибка");

        }

});