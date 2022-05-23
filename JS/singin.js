let names = $('#name');
let email = $("#email");
let pass = $('#pass');
let rpass = $("#rpass");


$(".contnent__elem").each(function(i,obj){

    $(this).blur(async function(){

        if($(this).attr("name") == "rpass"){
            let response = await fetch('../PHPscripts/singinscript.php?'+ $(this).attr("name") + '=' + $(this).val() + '&pass=' +$("#pass").val());
            if(response.ok){
                let result = await response.json();
                if(result.error === "1"){
                    $(this).siblings(".for_error").children().addClass("invalid");
                    $(this).siblings(".for_error").children().html(result.massage);
                }else {
                    $(this).siblings(".for_error").children().removeClass("invalid");
                    $(this).siblings(".for_error").children().html('');

                }



            }else{
                alert("Ошибка");

            }

        }else{
            let response = await fetch('../PHPscripts/singinscript.php?'+ $(this).attr("name") + '=' + $(this).val());
            if(response.ok){
                let result = await response.json();
                if(result.error === "1"){
                    $(this).siblings(".for_error").children().addClass("invalid");
                    $(this).siblings(".for_error").children().html(result.massage);

                }else {
                    $(this).siblings(".for_error").children().removeClass("invalid");
                    $(this).siblings(".for_error").children().html('');

                }



            }else{
                alert("Ошибка");

            }
        }

    });
});

$("#send").click(async function(e){
    e.preventDefault();
    let formData = new FormData(form);
    form.classList.add('_sending');
    let response = await fetch('../PHPscripts/singinscript.php',{
        method: 'POST',
        body: formData
        });
        if(response.ok){
            let result = await response.json();
            form.classList.remove('_sending');
            if(result.error === "1"){
              alert(result.massage)
            }else{
                window.location.href = "http://practise/";
            }
        }else{
            alert("Ошибка");
            form.classList.remove('_sending');
        }

});


