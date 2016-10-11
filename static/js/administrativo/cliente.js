/**
 * Adiciona um item na lista de Obrigacoes do cadastro de clientes.
 */
function adicionarObrigacaoLista() {
    
    // Verifica se os campos foram selecionados corretamente.
    if ($('#slcNomeObrigacao').val() == null) {
        mostraAlertBootstrap('Erro', 'Informe um nome de obrigação válido!', 'slcNomeObrigacao');
    } else if ($('#txtDiaLimiteObrigacao').val() == '') {
        mostraAlertBootstrap('Erro', 'Informe um dia limite válido!', 'txtDiaLimiteObrigacao');
    }
    // Se passou na validação, insere na tabela.
    else {
        // Pega o ID do Obrigacao selecionado.
        var idObrigacao = $('#slcNomeObrigacao option:selected').val().substring(0, $('#slcNomeObrigacao option:selected').val().indexOf(','));
        
        // Verifica se a obrigação já existe na tabela. Se sim, mostra erro.
        if ($('#tr_cliodt_i_' + idObrigacao).length > 0) {
            mostraAlertBootstrap('Erro', 'Obrigacao já existente na tabela!', 'slcNomeObrigacao');
        }
        // Senão, insere na tabela.
        else {
            
            // Pega os valores necessários para inserir na tabela.
            var nomeObrigacao = $('#slcNomeObrigacao option:selected').text();
            var diaLimite = $('#txtDiaLimiteObrigacao').val();
            var trObrigacaoInsID = ('tr_cliodt_i_' + idObrigacao);
            var trObrigacaoDelID = ('tr_cliodt_d_' + idObrigacao);
            var tdObrigacaoID = ('td_cliodt_i_' + idObrigacao);
            
            // Verifica se a obrigação está na lista dos removidos. Em caso afirmativo, remove da lista dos removidos para adicionar na tabela.
            if ($('#' + trObrigacaoDelID).length > 0) {
                $('#' + trObrigacaoDelID + "d").remove();
            }
            
            // Insere a linha na tabela.
            $('#tblObrigacoes tr:last').after(
                '<tr id="' + trObrigacaoInsID + '" name="' + trObrigacaoInsID + '">' +
                    '<td>' + idObrigacao + "<input type='hidden' name='" + tdObrigacaoID + "' value='" + idObrigacao + "'/></td>" +
                    '<td name="tblObrigacoes">' + nomeObrigacao + '</td>' +
                    '<td name="tblObrigacoes">' + $('#txtDiaLimiteObrigacao').val() + '<input type="hidden" name="td_dialimite_odt_' + idObrigacao + '" '
                        + 'value="' + diaLimite + '"/></td>' +
                    '<td name="tblObrigacoes"><button id="btnDelObrigacao' + nomeObrigacao + '" type="button" class="btn btn-default btn-md" '
                        + 'onclick="removerObrigacaoLista(' + idObrigacao + ');"><span class="glyphicon glyphicon-trash"></span></button></td>' +
                "</tr>");
        }
    }
}


/**
 * Remove um item da lista de Obrigacoes do cadastro de clientes.
 * 
 * @param {string} pIdObrigacao - ID do Obrigacao a ser removido do cadastro de clientes.
 */
function removerObrigacaoLista(pIdObrigacao) {
    
    // Pega os valores de ID de inserção e remoção do Obrigacao.
    var trObrigacaoInsID = 'tr_cliodt_i_' + pIdObrigacao;
    var trObrigacaoDelID = 'tr_cliodt_d_' + pIdObrigacao;
    
    // Remove a obrigação da tabela de impostos.
    $('#' + trObrigacaoInsID).remove();
    
    /* Se o tipo da operação for alteração, pode haver alteração nos impostos. Vai adicionar na div escondida de impostos excluídos.
       Fiz isso porque se for inclusão de nova cliente, não existem informações a respeito dessa cliente no banco, logo, ainda não existem Obrigacoes.
       No caso da alteração, precisei fazer isso para manter um controle do que mandar para o banco de dados. */
    if ($('#tipoOperacao').val() == 'a') {
        $('#divObrigacoesRemovidasAlteracao').append(
            '<input type="hidden" id="' + trObrigacaoDelID + '" name="' + trObrigacaoDelID + '" value="' + pIdObrigacao + '" />'
        );
    }
}


/**
 * Monta o elemento select do html com os impostos do respectivo regime de tributação selecionado.
 */
function montarSelectObrigacoesRegimeTributacao() {
    
    // Pega o ID do Regime de Tributação selecionado para a cliente.
    var idRegimeTributacao = document.getElementById('slcRegimeTributacao').options[document.getElementById('slcRegimeTributacao').selectedIndex].value;
    
    // Validação para não quebrar.
    if (idRegimeTributacao != 0) {
        
        // Monta a URL com a rota definida e o ID do regime de tributação.
        var url = (window.location.origin + '/carregar-obrigacoes-regime/' + idRegimeTributacao);
        
        // Faz a chamada AJAX.
        $.ajax({
            url: url,
            type: "post",
            data: {idRegimeTributacao: idRegimeTributacao},
            dataType: "json",
            success:
                function (data) {
                    // Esvazia o select de nome dos Obrigacoes.
                    $('#slcNomeObrigacao').empty();
                    $('#slcNomeObrigacao').append($('<option disabled selected>').text("Escolha uma obrigação"));
                    
                    // Mapeia as obrigações recuperadas do banco de dados.
                    $.map(data, function (obj) {
                        return {
                            obrId: obj.obrId, obrNome: obj.obrNome, obrPeriodo: obj.obrPeriodo, obrRepeticao: obj.obrRepeticao,
                            obrDptResp: obj.obrDptResp, obrDataMovel: obj.obrDataMovel, odtDiaLimite: obj.odtDiaLimite,
                            odtMesLimite: obj.odtMesLimite, odtAnoLimite: obj.odtAnoLimite
                        };
                    });
                    
                    for (var i = 0; i < data.length; i++) {
                        $('#slcNomeObrigacao')
                            .append($('<option>', { value : [data[i].obrId, data[i].obrPeriodo, data[i].obrRepeticao, data[i].odtDiaLimite, data[i].odtMesLimite, data[i].odtAnoLimite] })
                            .text([data[i].obrNome])); 
                    }
                    
                    // Libera o botão para a modal de Obrigacoes.
                    $("#btnModalObrigacoes").hasClass("disabled") ? $("#btnModalObrigacoes").removeClass("disabled") : null;
                    $("#btnModalObrigacoes").hasOwnProperty("data-toggle") ? null : $("#btnModalObrigacoes").attr("data-toggle", "modal");
                    $("#btnModalObrigacoes").hasOwnProperty("data-target") ? null : $("#btnModalObrigacoes").attr("data-target", "#mdlObrigacoes");
                }
        });
    }
}


/**
 * Muda o período do Obrigacao para controlar a máscara de data ou dia limite.
 */
function mudarPeriodoObrigacao() {
    var valueSlcNomeObrigacao = document.getElementById('slcNomeObrigacao').options[document.getElementById('slcNomeObrigacao').selectedIndex].value;
    var arrayPeriodoRepeticao = valueSlcNomeObrigacao.split(',');
    var periodoObrigacao = arrayPeriodoRepeticao[1];
    var repeticaoObrigacao = arrayPeriodoRepeticao[2];
    var dataLimiteObrigacao;
    
    $('#txtPeriodoObrigacao').val(periodoObrigacao);
    $('#txtRepeticaoObrigacao').val(repeticaoObrigacao);
    
    if (periodoObrigacao == 'M' && repeticaoObrigacao == 1) {
        dataLimiteObrigacao = arrayPeriodoRepeticao[3];
    } else {
        dataLimiteObrigacao = arrayPeriodoRepeticao[3] + '/' + arrayPeriodoRepeticao[4] + '/' + arrayPeriodoRepeticao[5];
    }
    
    $('#txtDiaLimiteObrigacao').val(dataLimiteObrigacao);
}


/**
 * Aplica máscara no campo de data da obrigação específica.
 * 
 * @param {string} idCampoPeriodo   - ID do campo de período do Obrigacao.
 * @param {string} idCampoDiaLimite - ID do campo de dia limite.
 * @param {event}  evt              - Evento do Javascript.
 */
function mascararDataLimiteObrigacao(idCampoPeriodo, idCampoRepeticao, idCampoDiaLimite, evt) {
    
    // Define as regras para o input.
    var evento = evt || window.event;
    var key = String.fromCharCode(evento.keyCode || evento.which);
    var regex = /[0-9]/;
    
    // Garante que só serão digitadas informações que respeitem as regras definidas para o input.
    if (!regex.test(key)) {
        evento.returnValue = false;
        
        if (evento.preventDefault) {
            evento.preventDefault();
        }
    }
    
    // Pega o valor selecionado no select.
    var tipoPeriodo = $('#' + idCampoPeriodo).val();
    var repeticao = $('#' + idCampoRepeticao).val();
    
    if (tipoPeriodo == 'M' && repeticao == 1) {
        $('#' + idCampoDiaLimite).attr("maxlength", "2");
    }
    else {
        $('#' + idCampoDiaLimite).attr("maxlength", "10");
        
        // Mascara o campo devidamente.
        if ($('#' + idCampoDiaLimite).val().length == 2 || $('#' + idCampoDiaLimite).val().length == 5) {
            $('#' + idCampoDiaLimite).val($('#' + idCampoDiaLimite).val() + '/');
        }
    }
}


/**
 * Valida o submit do form antes de mandar para o banco.
 */
function validarSubmit(event) {
    
    // Verifica se há número de documento (CPF/CNPJ).
    if ($("#txtCPFCNPJ").val().length == 0) {
        mostraAlertBootstrap('Erro', 'Você não preencheu o número do documento!', 'txtCPFCNPJ');
        event.preventDefault();
    }
    //
    else if ($("#txtRazaoSocial").val().length == 0) {
        mostraAlertBootstrap('Erro', 'Você não preencheu a razão social!', 'txtRazaoSocial');
        event.preventDefault();
    }
    //
    else if ($("#txtNomeFantasia").val().length == 0) {
        mostraAlertBootstrap('Erro', 'Você não preencheu o nome fantasia!', 'txtNomeFantasia');
        event.preventDefault();
    }
    //
    else if ($("#txtEmail").val().length == 0) {
        mostraAlertBootstrap('Erro', 'Você não preencheu o e-mail!', 'txtEmail');
        event.preventDefault();
    }
    //
    else if ($("#txtTelefone1").val().length == 0) {
        if ($("#txtTelefone2").val().length > 0) {
            mostraAlertBootstrap('Atenção', 'Você trocou os campos de telefone de lugar! Eu farei a troca automática para você.', '');
            $("#txtTelefone1").val($("#txtTelefone2").val());
            $("#txtTelefone2").empty();
        } else {
            mostraAlertBootstrap('Erro', 'Você não preencheu ao menos um telefone!', 'txtTelefone1');
            event.preventDefault();
        }
        event.preventDefault();
    }
}


/**
 * 
 */
function habilitarRepeticao(idCampoPeriodo) {
    
    // Pega o valor selecionado no select.
    var tipoPeriodo = $('#' + idCampoPeriodo + ' option:selected').val();
    
    // Verifica o tipo de período - trava o campo de repetição somente no ano.
    habilitar('slcObrigacaoEspecificaRepeticao', (tipoPeriodo == 'M'));
    
    // Limpa o campo de dia/data limite.
    limparCampo('txtDiaLimiteObrigacaoEspecifica');
}


/**
 * Aplica máscara no campo de data da obrigação específica.
 * 
 * @param {string} idCampoPeriodo   - ID do campo de período da Obrigação Específica.
 * @param {string} idCampoRepeticao - ID do campo de repetição da Obrigação Específica.
 * @param {string} idCampoDiaLimite - ID do campo de dia limite.
 * @param {event}  evt              - Evento do Javascript.
 */
function mascararDataPeriodoObrigacaoEspecifica(idCampoPeriodo, idCampoRepeticao, idCampoDiaLimite, evt) {
    
    // Define as regras para o input.
    var evento = evt || window.event;
    var key = String.fromCharCode(evento.keyCode || evento.which);
    var regex = /[0-9]/;
    
    // Garante que só serão digitadas informações que respeitem as regras definidas para o input.
    if (!regex.test(key)) {
        evento.returnValue = false;
        if(evento.preventDefault) evento.preventDefault();
    }
    
    // Pega o valor selecionado no select.
    var tipoPeriodo = document.getElementById(idCampoPeriodo).options[document.getElementById(idCampoPeriodo).selectedIndex].value;
    
    // Se for ano ou data específica (repetição em anos), precisa digitar o dia e o mês em que a Obrigação Específica se repetirá.
    if (tipoPeriodo == 'A') {
        $('#' + idCampoDiaLimite).attr("maxlength", "5");
        if ($('#' + idCampoDiaLimite).val().length == 2) {
            $('#' + idCampoDiaLimite).val($('#' + idCampoDiaLimite).val() + '/');
        }
    }
    // Se for mês, mascara o dia limite somente para, no máximo, 2 dígitos.
    else {
        $('#' + idCampoDiaLimite).attr("maxlength", "2");
    }
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
/* - */ // Indica que alterar o regime de tributação de uma cliente já gravada acarretará na limpeza da tabela de obrigações.
/* - */ $(document).ready(function() {
/* - */     if ($('#tipoOperacao').val() == 'a') {
/* - */         montarSelectObrigacoesRegimeTributacao();
/* - */         mostrarAlertBootstrap('Atenção!', 'Lembre-se de que, ao alterar o regime de tributação do cliente, a tabela de obrigações será zerada!', '');
/* - */     }
/* - */ });
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
/* ---------------------- NÃO MEXER -------------------------------------------- NÃO MEXER -------------------------------------------- NÃO MEXER --------------------- */
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------------- */