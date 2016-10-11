/**
 * Envia um documento para o servidor.
 */
function enviarDocumento(idCampoDocumento) {
    $('#' + idCampoDocumento).submit(function (e) {

        // Não permite que a página seja recarregada.
        e.preventDefault();
        
        // Faz a chamada AJAX.
        var url = (window.location.origin + '/enviar-documento/' + idRegimeTributacao);
        $.ajax ({
            url: url,
            type: 'POST',
            data: {
                removeall: 'delete-all'
            },
            success: function () {
                
            }
        });

    }); 
}