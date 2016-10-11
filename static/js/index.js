// Toggle Function
$('.toggle').click(function(){
    // Switches the Icon
    $(this).children('i').toggleClass('fa-pencil');
    // Switches the forms  
    $('.form').animate({
      height: "toggle",
      'padding-top': 'toggle',
      'padding-bottom': 'toggle',
      opacity: "toggle"
    }, "slow");
});

/*
 * Bloqueia letras nos logins.
 */
function bloquearLetras(evt) {
    var evento = evt || window.event;
    var key = String.fromCharCode(evento.keyCode || evento.which);
    var regex = /[0-9]/;
    
    if(!regex.test(key)) {
        evento.returnValue = false;
        if(evento.preventDefault) evento.preventDefault();
    }
}