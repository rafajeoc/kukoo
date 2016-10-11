/**
 * Mostra o alert do bootstrap e foca no campo que precisa ter as informações trocadas.
 * 
 * @param {string} pTitulo  - Título do modal de alert.
 * @param {string} pTexto   - Texto do modal de alert.
 * @param {string} pIdCampo - ID do campo que receberá o foco para alteração de dados.
 */
function mostraAlertBootstrap(pTitulo, pTexto, pIdCampo) {
    
    // Monta a mensagem e faz o fade-in.
    $("#mdlErro .modal-title").html(pTitulo);
    $("#mdlErro .modal-body").html(pTexto);
    $("#mdlErro").modal();
    
    // Redireciona o foco para o campo referente à mensagem.
    if (pIdCampo != '') {
        $("#mdlErro").on("hidden.bs.modal", function() {
            document.getElementById(pIdCampo).focus();
        });
    }
}


/**
 * Limpa o conteúdo de um campo.
 * 
 * @param {string} pIdCampo - ID do campo a sofrer limpeza.
 */
function limparCampo(pIdCampo) {
    $('#' + pIdCampo).val('');
}


/**
 * Função para validar um campo de acordo com a sua regra pré-definida.
 * 
 * @param {string} pIdCampo - ID do campo a ser validado.
 */
function validarCampo(pIdCampo) {
    
    // Valida campo de CPF/CNPJ.
    if (pIdCampo == 'txtCPFCNPJ' || pIdCampo == 'txtCPF') {
        
        // Trata o campo para só pegar os números.
        var sanitizedField = $('#' + pIdCampo).val().replace(/[^\w\s]/gi, '');
        
        // Deixa clicar em outros campos se estiver vazio, para não ser incômodo.
        if (sanitizedField.length != 0) {
            if ((sanitizedField.length != 11) && ($('#slcTipoPessoa').val() == 'cpf') || $('#txtCPF').length > 0) {
                mostraAlertBootstrap('Erro', 'Informe um CPF completo!', 'txtCPFCNPJ');
            } else if ((sanitizedField.length != 14) && ($('#slcTipoPessoa').val() == 'cnpj')) {
                mostraAlertBootstrap('Erro', 'Informe um CNPJ completo!', 'txtCPFCNPJ');
            }
        }
    }
    // Valida campo de endereço de e-mail.
    else if (pIdCampo == 'txtEmail') {
        
        // Regex de email.
        var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    
        // Só valida o campo se ele não estiver vazio. Se deu errado, põe o foco nele novamente.
        if (($('#' + pIdCampo).val().match(regex) == null) && ($('#' + pIdCampo).val().length != 0)) {
            mostraAlertBootstrap("Erro", "Informe um endereço de e-mail válido!", "txtEmail");
        }
    }
    // 
}


/**
 * Mascara um campo de acordo com o seu tipo.
 * 
 * @param {event}  evt              - Evento da página.
 * @param {string} pTipoMascara     - Indica qual o tipo da máscara: documento, telefone, CEP, etc..
 * @param {string} pIdCampo         - ID do campo a ser mascarado.
 * @param {int}    pSomenteNumeros  - Indica se aceita somente números na expressão regular.
 * @param {int}    pPermiteSimbolos - Indica se permite símbolos na expressão regular.
 */
function mascararCampo(evt, pTipoMascara, pIdCampo, pSomenteNumeros, pPermiteSimbolos) {
    
    // Pega o evento da página.
    var evento = evt || window.event;
    var key = String.fromCharCode(evento.keyCode || evento.which);
    var regex;
    
    // Aplica a regra de regex.
    if (pSomenteNumeros) {
        regex = /[0-9]/;
    } else {
        // Regex alfanumérica.
        if (!pPermiteSimbolos) {
            
            // Faz um desvio para o caso de UF.
            if (pTipoMascara == 'UF') {
                regex = /^([A-Z]+)$/;
            }
            // Senão, prossegue normalmente.
            else {
                regex = /^([a-zA-Z0-9 ]+)$/;
            }
        }
        // Regex com números, letras e símbolos
        else {
            regex = /^([a-zA-Z0-9 !@#$%&*()_+=~^[\]{}?/:;.><,"'´`-]+)$/;
        }
    }
    
    // Testa para garantir que somente os caracteres da regra serão atribuídos.
    if (!regex.test(key)) {
        evento.returnValue = false;
        if(evento.preventDefault) evento.preventDefault();
    }
    
    // Mascara campo de CPF/CNPJ.
    if (pTipoMascara == 'Documento') {
        
        // Mascara campo de CPF da Entidade.
        if ($('#slcTipoPessoa').val() == "cpf" || $('#txtCPF').length > 0) {
            
            // Atribui tamanho máximo para 14, contando com pontos e hífen.
            $('#' + pIdCampo).attr("maxlength", "14");
            
            // Insere os pontos no lugar certo.
            if ($('#' + pIdCampo).val().length == 3 || $('#' + pIdCampo).val().length == 7) {
                $('#' + pIdCampo).val($('#' + pIdCampo).val() + '.');
            }
            // Insere o hífen no lugar certo.
            else if ($('#' + pIdCampo).val().length == 11) {
                $('#' + pIdCampo).val($('#' + pIdCampo).val() + '-');
            }
        }
        // Mascara campo de CNPJ da Entidade.
        else if ($('#slcTipoPessoa').val() == 'cnpj') {
            
            // Atribui tamanho máximo para 18, contando com pontos, barra e hífen.
            $('#' + pIdCampo).attr("maxlength", "18");
            
            // Insere os pontos no lugar certo.
            if ($('#' + pIdCampo).val().length == 2 || $('#' + pIdCampo).val().length == 6) {
                $('#' + pIdCampo).val($('#' + pIdCampo).val() + '.');
            }
            // Insere a barra no lugar certo.
            else if ($('#' + pIdCampo).val().length == 10) {
                $('#' + pIdCampo).val($('#' + pIdCampo).val() + '/');
            }
            // Insere o hífen no lugar certo.
            else if ($('#' + pIdCampo).val().length == 15) {
                $('#' + pIdCampo).val($('#' + pIdCampo).val() + '-');
            }
        }
    }
    // Mascara telefone.
    else if (pTipoMascara == 'Telefone') {
        
        // Se o telefone começar com 9, é celular - adiciona um dígito.
        if ($('#' + pIdCampo).val().charAt(5) == 9) {
            $('#' + pIdCampo).attr("maxlength", "15");
        }
        // Senão, é telefone fixo.
        else {
            $('#' + pIdCampo).attr("maxlength", "14");
        }
        
        // Coloca o abre parêntese no início do telefone (código de área).
        if ($('#' + pIdCampo).val().length == 0) {
            $('#' + pIdCampo).val('(' + $('#' + pIdCampo).val());
        }
        // Coloca o fecha parêntese no final do código de área.
        else if ($('#' + pIdCampo).val().length == 3) {
            $('#' + pIdCampo).val($('#' + pIdCampo).val() + ') ');
        }
        // Coloca o hífen no lugar certo, independentemente de ser celular ou fixo.
        else if ((($('#' + pIdCampo).val().length == 10) && ($('#' + pIdCampo).val().charAt(5) == '9')) || 
                 (($('#' + pIdCampo).val().length == 9) && ($('#' + pIdCampo).val().charAt(5) != '9'))) {
            $('#' + pIdCampo).val($('#' + pIdCampo).val() + '-');
        }
    }
    // Mascara campo de CEP.
    else if (pTipoMascara == 'CEP') {
        
        // Atribui tamanho máximo para 9, contando com o hífen.
        $('#' + pIdCampo).attr("maxlength", "9");
        
        // Insere o hífen no lugar certo.
        if ($('#' + pIdCampo).val().length == 5) {
            $('#' + pIdCampo).val($('#' + pIdCampo).val() + '-');
        }
    }
}
