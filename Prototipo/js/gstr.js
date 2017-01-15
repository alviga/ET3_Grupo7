var body = document.getElementsByTagName("body")[0];

body.addEventListener("load", main());

var minimo = 2;
var maximo = 64;
var globalID = 0;

function main() {
  $(function () { $('[data-toggle="popover"]').popover()}); //popover
    $("#formulario :input").each(function(){
      $(this).blur(function(){ checkValidity($(this)); } ); //<-- Should return all input elements in that specific form.
    });
    $("[name='email']").blur(function(){ checkEmail($(this)); });
    $("[name='pass2']").blur(function(){ checkPass($(this)); });
};

function doSubmit(){
    if(checkALL()){
      $("#formulario").submit();
    }
}
function doBorrar(type,id){
  //console.log(type);
  globalID = id;
  $("#modalOK").off("click");
  var packet = {type:type,id:id};
  $("#modalOK").click(packet,BORRAR);
  $("#myModal").modal();
}

function BORRAR(packet){
  var type = packet.data.type;
  var id = packet.data.id;
  switch (type) {
    case "usuario":
      location.href="../php/GestionUsuarios/process_borrarUsuario.php?id="+id+"&confirm=1";
    break;
    case "rol":
      location.href="../php/GestionRoles/process_borrarRol.php?id="+id+"&confirm=1";
    break;
    case "pagina":
      location.href="../php/GestionPaginas/process_borrarPagina.php?id="+id+"&confirm=1";
    break;
    case "funcionalidad":
      location.href="../php/GestionFuncionalidades/process_borrarFuncionalidad.php?id="+id+"&confirm=1";
    break;
    case "media":
      location.href="../php/GestionMedia/process_borrarMedia.php?id="+id+"&confirm=1";
    break;
    default:

  }
}

function checkALL(){
  var correction = true;
  $("#formulario :input[type='text'], textarea").each( function(){
    if(!checkValidity($(this))){ //que pasa con los emails o las contrase~nas?
      correction = false;
    }
  });

  $("#formulario :input[type='password']").each( function(){
    if(!checkValidity($(this))){ //que pasa con los emails o las contrase~nas?
      correction = false;
    }
  });
  return correction;
}

function checkValidity(e){
  clean(e);
  if(!vacio(e) && !tooShort(e) && !tooLong(e)){
    clean(e);
    return true;
  }
  return false;
}

function checkEmail(e){
  var regex = /[\w-\.]{2,}@[\w-]{2,}\.*[\w-]{2,}\.[\w-]{2,4}/;
  console.log(e.val());
  if(! regex.test(e.val()) ){
    putError(e);
    sayError(e,"email not valid");
  }
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
    var pass1 = $("[name='pass1']");
    var pass2 = $("[name='pass2']");
    if( pass1.val() != pass2.val() ){
      putError(e);
      sayError(e,"pass don't match");
      //sayError($("[name='pass1']"),"pass don't match");
    }else{
      if(!e.hasClass("crypted")){
        var hash = CryptoJS.SHA1(e.val());
        pass1.val(hash);
        pass2.val(hash);
        pass1.addClass("crypted");
        pass1.attr("readonly",true);
        pass2.attr("readonly",true);
        pass2.addClass("crypted");
        pass2.after("<em class=' text-right glyphicon glyphicon-lock' > Encrypted</em>");
        pass1.after("<em class=' text-right glyphicon glyphicon-lock' > Encrypted</em>");
      }
    }
  }
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
