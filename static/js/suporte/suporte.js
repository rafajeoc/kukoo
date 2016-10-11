function mascararCampo(evt) {
    var evento = evt || window.event;
    var key = String.fromCharCode(evento.keyCode || evento.which);
    var regex = /[0-9]/;
    
    if(!regex.test(key)) {
        evento.returnValue = false;
        if(evento.preventDefault) evento.preventDefault();
    }
    
    if (document.getElementById('txtCPF').val().length == 3 || document.getElementById('txtCPF').val().length == 7) {
        document.getElementById('txtCPF').val(document.getElementById('txtCPF').val() + '.');
    } else if (document.getElementById('txtCPF').val().length == 11) {
        document.getElementById('txtCPF').val(document.getElementById('txtCPF').val() + '-');
    }
}