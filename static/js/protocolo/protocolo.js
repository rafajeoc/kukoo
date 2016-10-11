function getDateTime() {
    var now     = new Date(); 
    var year    = now.getFullYear();
    var month   = now.getMonth()+1; 
    var day     = now.getDate();
    var hour    = now.getHours();
    var minute  = now.getMinutes();
    var second  = now.getSeconds(); 
    
    if(month.toString().length == 1) {
        var month = '0'+month;
    }
    if(day.toString().length == 1) {
        var day = '0'+day;
    }   
    if(hour.toString().length == 1) {
        var hour = '0'+hour;
    }
    if(minute.toString().length == 1) {
        var minute = '0'+minute;
    }
    if(second.toString().length == 1) {
        var second = '0'+second;
    }   
    var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;   
    
    return dateTime;
}

/**
 * Monta o elemento select do html com os impostos do respectivo regime de tributação selecionado.
 */
function montarSelectClientesProtocolo() {
        
    // Monta a URL com a rota definida e o ID do regime de tributação.
    var url = (window.location.origin + '/carregar-clientes-protocolo');
    
    // Faz a chamada AJAX.
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        success:
            function (data) {
                // Esvazia o select de nome dos Obrigacoes.
                $('#slcRazaoSocial').empty();
                
                if ($('#tipoOperacao').val() == 'i') {
                    $('#slcRazaoSocial').append($('<option disabled selected>').text("Escolha uma entidade"));
                } else {
                    $('#slcRazaoSocial').append($('<option disabled>').text("Escolha uma entidade"));
                }
                
                // Mapeia as obrigações recuperadas do banco de dados.
                $.map(data, function (obj) {
                    return { cliId: obj.cliId, cliRazaoSocial: obj.cliRazaoSocial };
                });
                
                for (var i = 0; i < data.length; i++) {
                    $('#slcRazaoSocial')
                        .append($('<option>', { value : data[i].cliId })
                        .text(data[i].cliRazaoSocial)); 
                }
            }
    });
}

/* -------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
/* ---------------------- NÃO MEXER -------------------------------------------- NÃO MEXER -------------------------------------------- NÃO MEXER --------------------- */
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
/* - */ // Posiciona a página no início.
/* - */ window.onload = function() {
/* - */     setTimeout(function() {
/* - */         $(document.body).scrollTop(0);
/* - */     }, 1);
/* - */ };
/* - */ 
/* - */ // Carrega automaticamente as entidades na inclusão de um protocolo novo.
/* - */ $(document).ready(function() {
/* - */     montarSelectClientesProtocolo();
/* - */     
/* - */     if ($('#tipoOperacao').val() == 'a') {
/* - */         $('#slcRazaoSocial').val($('#IdCliente').val());
/* - */     }
/* - */     
/* - */     $('#DtHrEmissao').val(getDateTime());
/* - */ });
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
/* ---------------------- NÃO MEXER -------------------------------------------- NÃO MEXER -------------------------------------------- NÃO MEXER --------------------- */
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------------- */