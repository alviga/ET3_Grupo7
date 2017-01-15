var body = document.getElementsByTagName("body")[0];

body.addEventListener("load", main());
addEventListener("keydown", function(event){
  if(event.keyCode == 13 ){
    doSubmit();
    event.preventDefault();
  }
});
var minimo = 2;
var maximo = 64;

function main() {
    $("[name='username']").blur(function(){ checkValidity($(this)); });
    $("[name='pass']").blur(function(){ checkPass($(this)); });
};

function doSubmit(){
  if(checkValidity($("[name='username']")) && checkPass($("[name='pass']"))){
    $("#loginform").submit();
  }
}

function checkValidity(e){
  clean(e);
  if(!vacio(e) && !tooShort(e) && !tooLong(e)){
    clean(e);
    return true;
  }
  return false;
}

function vacio(e) {
  var data = e.val();
  if(data == ''){
    putError(e);
    sayError(e,"cannot be empty");
    return true;
  }
  if(e.attr("name")=="nombre"){
    data = data.replace(/ /g,"_");
    e.val(data);
  }
  return false;
}

function tooShort(e){
  var data = e.val();
  if(data.length < minimo && data != '' ){
    putError(e);
    sayError(e,"minumum 2 chars");
    return true;
  }
  return false;
}

function tooLong(e){
  var data = e.val();
  if(data.length > maximo ){
    putError(e);
    sayError(e,"maximum 64 chars");
    return true;
  }
  return false;
}

function checkPass(e){
  if(checkValidity(e)){
    if(!e.hasClass("crypted")){
      var pass1 = $("[name='pass']");
      var hash = CryptoJS.SHA1(e.val());
      pass1.val(hash);
      pass1.addClass("crypted");
      pass1.after("<em class=' text-right glyphicon glyphicon-lock' > Encrypted</em>");
      console.log("crypted");
      //pass1.attr("readonly",true);
    }
    return true;
  }
  e.removeClass("crypted");
  $("em").remove();
  return false;
}

function putError(e){
  e.addClass("error");
}

function sayError(e,error){
  var anterior = e.val();
  var temp = "not valid : " + anterior + "";
  //var content = "<div class='error-text'>"+temp + ' ' + error + "</div>";
  //e.after(content);
  e.val('');
  e.attr("placeholder", temp + " " + error );
}

function clean(e){
  e.removeClass("error");
}
