    $(window).on("load", iniciar);
    
function iniciar(){

    $("#log_button").on("click",mostrarFormularioLogin);
    $("#boton_registro").on("click",cerrarDialog);
    $("#boton_cancelar").on("click",cerrarDialog);
    $("#boton_cerrar_carrito").on("click",cerrarDialog);
    
   
}    

function mostrarFormularioLogin(){

    document.getElementById("correo").value="";
    document.getElementById("pass").value="";
    document.getElementById("formulario_login").setAttribute("open", "true");
    
}

function cerrarDialog(evt) {

    if(evt.target.id == "boton_registro"){
        document.getElementById("formulario_login").close();
        document.getElementById("formulario_registro").setAttribute("open", "true");
    }else if(evt.target.id =="log_button"){

    }else if(evt.target.id == "boton_cancelar"){
        document.getElementById("formulario_registro").close();
        document.getElementById("formulario_login").setAttribute("open", "true");
    }else if(evt.target.id =="boton_cerrar_carrito"){
        document.getElementById("mostrar_carrito").close();
    }

}

function abrirSesion(){

    console.log("uola");
    document.getElementById("log_button").removeEventListener("click", mostrarFormularioLogin);
    document.getElementById("log_button").addEventListener("click",cerrarSesion);

}
function cerrarSesion(){

    document.getElementById("log_button").removeEventListener("click",cerrarSesion);
    document.getElementById("log_button").addEventListener("click", mostrarFormularioLogin);
    
}

function mostrarCarrito(nif_usu){
   
    if(nif_usu==""){
        mostrarFormularioLogin();
    }else{
        document.getElementById("mostrar_carrito").setAttribute("open", "true");
    }
}