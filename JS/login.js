
$(".login__elem").each(function(i,obj){

    $(this).blur(async function(){
            let response = await fetch('../PHPscripts/login.php?'+ $(this).attr("name") + '=' + $(this).val());
            if(response.ok){
                let result = await response.json();
                if(result.error === "1"){
                   console.log(result.massage);
                   $(this).siblings(".for_error").children().addClass("invalid");
                   $(this).siblings(".for_error").children().html(result.massage);

                }else {
                    console.log(result.massage);
                    $(this).siblings(".for_error").children().removeClass("invalid");
                    $(this).siblings(".for_error").children().html('');

                }



            }else{
                alert("Ошибка");

            }


    });
});


$("#login_btn").click(async function(e){
    e.preventDefault();
    let formData = new FormData(form);
    form.classList.add('_sending');
    let response = await fetch('../PHPscripts/login.php',{
        method: 'POST',
        body: formData
        });
        if(response.ok){
            let result = await response.json();
            form.classList.remove('_sending');
            if(result.error === "1"){
                $(".for_login").children().addClass("invalid");
                $(".for_pass").children().addClass("invalid");
                $(".for_login").children().html(result.massagel);
                $(".for_pass").children().html(result.massagep);
            }else{
                $(".for_login").children().removeClass("invalid");
                $(".for_pass").children().removeClass("invalid");
                $(".for_login").children().html('');
                $(".for_pass").children().html('');
                window.location.href = "http://practise/";
            }
        }else{
            alert("Ошибка");
            form.classList.remove('_sending');
        }

});