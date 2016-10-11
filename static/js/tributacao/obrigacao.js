function verificarDataEspecificaObrigacao() {
    
    // Pega o valor selecionado no select.
    var tipoPeriodo = $('#slcTipoDataObrigacao option:selected').val();
    
    // Mostra ou esconde os selects de data específica.
    alterarTipoDataObrigacao(tipoPeriodo);
    
    // Altera a label conforme o tipo do período.
    alterarLabelDataLimite(tipoPeriodo);
}

function alterarTipoDataObrigacao(tipoPeriodo) {
    if (tipoPeriodo == 'E') {
        $('#divInternaTipoDataObrigacao').after('<div id="divInternaRepeticaoObrigacao" class="col-md-1 indent-small">' +
												'<div class="form-group internal">' +
													'<select id="slcRepeticaoObrigacao" name="slcRepeticaoObrigacao" type="text" class="form-control"' +
															'title="Indica a frequência da repetição no período informado anteriormente."' +
															'onChange="alterarLabelDataLimite();">' +
														'<option value="1">1</option>' +
														'<option value="2">2</option>' +
														'<option value="3">3</option>' +
														'<option value="4">4</option>' +
														'<option value="5">5</option>' +
														'<option value="6">6</option>' +
														'<option value="7">7</option>' +
														'<option value="8">8</option>' +
														'<option value="9">9</option>' +
														'<option value="10">10</option>' +
														'<option value="11">11</option>' +
													'</select>' +
												'</div>' +
											'</div>' +
											'<div id="divInternaPeriodoObrigacao" class="col-md-2 indent-small">' +
												'<div class="form-group internal">' +
													'<select id="slcPeriodoObrigacao" name="slcPeriodoObrigacao" type="text" class="form-control"' +
															'title="Indica o período em que a obrigação deve ser enviada (mês ou ano)."' +
															'onChange="alterarLabelDataLimite();"> ' +
														'<option value="M">MÊS</option>' +
														'<option value="A">ANO</option>' +
													'</select>' +
												'</div>' +
											'</div>');
    } else {
        if ($('#divInternaPeriodoObrigacao').length > 0) {
            $('#divInternaPeriodoObrigacao').remove();
            $('#divInternaRepeticaoObrigacao').remove();
        }
    }
}

function alterarLabelDataLimite(tipoPeriodo) {
    if (tipoPeriodo == 'M1') {
        $('#divDataLimiteObrigacao label').html('Dia Limite');
    } else {
        $('#divDataLimiteObrigacao label').html('Próx. Data Limite');
    }
}

function mascararDataLimiteObrigacao(evt) {
    
    // Define as regras para o input.
    var evento = evt || window.event;
    var key = String.fromCharCode(evento.keyCode || evento.which);
    var regex = /[0-9]/;
    
    // Garante que só serão digitadas informações que respeitem as regras definidas para o input.
    if (!regex.test(key)) {
        evento.returnValue = false;
        if (evento.preventDefault) evento.preventDefault();
    }
    
    // Pega o valor selecionado no select.
    var tipoPeriodo = $('#slcTipoDataObrigacao option:selected').val();
    
    // Se for mês, mascara o dia limite somente para, no máximo, 2 dígitos.
    if (tipoPeriodo == 'M1') {
        $('#txtDataLimiteObrigacao').attr("maxlength", "2");
    }
    // Se for ano ou data específica (repetição em anos), precisa digitar o dia e o mês em que a Obrigação Específica se repetirá.
    else {
        $('#txtDataLimiteObrigacao').attr("maxlength", "10");
        
        // Mascara o campo devidamente.
        if ($('#txtDataLimiteObrigacao').val().length == 2 || $('#txtDataLimiteObrigacao').val().length == 5) {
            $('#txtDataLimiteObrigacao').val($('#txtDataLimiteObrigacao').val() + '/');
        }
    }
}


/* -------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
/* ---------------------- NÃO MEXER -------------------------------------------- NÃO MEXER -------------------------------------------- NÃO MEXER --------------------- */
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
// Posiciona a página no início.
window.onload = function() {
    setTimeout(function() {
        $(document.body).scrollTop(0);
    }, 1);
};

// Indica que alterar o regime de tributação de uma cliente já gravada acarretará na limpeza da tabela de obrigações.
$(document).ready(function() {
    verificarDataEspecificaObrigacao();
    
    // Verifica se são outras datas.
    if ($('#periodoRepeticao').val().substr(1, 1) > 1) {
        $('#slcRepeticaoObrigacao').val( $('#periodoRepeticao').val().substr(1, 1) );
        $('#slcPeriodoObrigacao').val( $('#periodoRepeticao').val().substr(0, 1) );
    }
});
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
/* ---------------------- NÃO MEXER -------------------------------------------- NÃO MEXER -------------------------------------------- NÃO MEXER --------------------- */
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------------- */