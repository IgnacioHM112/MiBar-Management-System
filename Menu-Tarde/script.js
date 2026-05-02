function busqueda(param){
    if(param == null || param<=0){
        document.cookie = escape("cookiebusqueda") + "=" + '' + "; path=/";
        location.reload();
    }else{
        document.cookie = escape("cookiebusqueda") + "=" + escape(param) + "; path=/";
        location.reload();
    }
}