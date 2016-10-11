/**
 * Retorna a string passada como parâmetro com a primeira letra maiúscula.
 */
function capitalizeString(string) {
    return (string.charAt(0).toUpperCase() + string.slice(1));
}


/**
 * Habilita ou desabilita um campo.
 * 
 * 
 */
function habilitar(pIdCampo, pHabilita) {
    $('#' + pIdCampo).prop('disabled', pHabilita);
}