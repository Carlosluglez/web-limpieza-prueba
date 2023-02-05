
  if (document.addEventListener)
  window.addEventListener("load", iniciar)
else if (document.attachEvent)
  window.attachEvent("onload", iniciar);

function iniciar(){
  let login_boton1 = document.getElementById("presupuesto1");
  let login_boton2 = document.getElementById("presupuesto2");
  let login_boton3 = document.getElementById("presupuesto3");
  let login_boton4 = document.getElementById("presupuesto4");
  let login_boton5 = document.getElementById("presupuesto5");
  let login_boton6 = document.getElementById("presupuesto6");
  let login_boton7 = document.getElementById("presupuesto7");
  let login_boton8 = document.getElementById("presupuesto8");


  if (document.addEventListener) login_boton1.addEventListener("click", mostrarFormularioRegistro);
  else if (document.attachEvent) login_boton1.attachEvent("onclick", mostrarFormularioRegistro);

  if (document.addEventListener) login_boton2.addEventListener("click", mostrarFormularioRegistro);
  else if (document.attachEvent) login_boton2.attachEvent("onclick", mostrarFormularioRegistro);

  
  if (document.addEventListener) login_boton3.addEventListener("click", mostrarFormularioRegistro);
  else if (document.attachEvent) login_boton3.attachEvent("onclick", mostrarFormularioRegistro);

  if (document.addEventListener) login_boton4.addEventListener("click", mostrarFormularioRegistro);
  else if (document.attachEvent) login_boton4.attachEvent("onclick", mostrarFormularioRegistro);

  
  if (document.addEventListener) login_boton5.addEventListener("click", mostrarFormularioRegistro);
  else if (document.attachEvent) login_boton5.attachEvent("onclick", mostrarFormularioRegistro);

  if (document.addEventListener) login_boton6.addEventListener("click", mostrarFormularioRegistro);
  else if (document.attachEvent) login_boton6.attachEvent("onclick", mostrarFormularioRegistro);

  
  if (document.addEventListener) login_boton7.addEventListener("click", mostrarFormularioRegistro);
  else if (document.attachEvent) login_boton7.attachEvent("onclick", mostrarFormularioRegistro);

  if (document.addEventListener) login_boton8.addEventListener("click", mostrarFormularioRegistro);
  else if (document.attachEvent) login_boton8.attachEvent("onclick", mostrarFormularioRegistro);
}    

function mostrarFormularioRegistro(){

  document.getElementById("formulario_registro").setAttribute("open", "true");
}

