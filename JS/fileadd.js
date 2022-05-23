
    let fields = document.querySelectorAll('.field__file');
    Array.prototype.forEach.call(fields, function (input) {
      let label = input.nextElementSibling,
        labelVal = label.querySelector('.field__file-fake').innerText;

      input.addEventListener('change', function (e) {
        let countFiles = '';
        if (this.files && this.files.length >= 1)
          countFiles = this.files.length;
          var name = $(".field__file").val();
        if (countFiles)
          label.querySelector('.field__file-fake').innerText = 'Выбран файл: ' + ClearName(name);
        else
          label.querySelector('.field__file-fake').innerText = labelVal;
      });
    });
function ClearName(name){

    var startIndex = (name.indexOf('\\') >= 0 ? name.lastIndexOf('\\') : name.lastIndexOf('/'));
    var filename = name.substring(startIndex);
    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
        filename = filename.substring(1);
    }
    return (filename);

}



$(".btn_for_edit").click(async function(e){
  e.preventDefault();
  let formData = new FormData(form__for_edit);

  let response = await fetch('../PHPscripts/editscript.php',{
      method: 'POST',
      body: formData
      });
      if(response.ok){
          let result = await response.json();

          if(result.error === "1"){

          }else{
            alert(result.massage)
          }
      }else{
          alert("Ошибка");
          form.classList.remove('_sending');
      }

});