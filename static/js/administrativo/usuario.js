function clickCbAdmin() {
    if ($('#cbAdmin').prop('checked') == true) {
        $('#cbGerenciamentoObrigacoes').prop('checked', true);
        $('#cbGerenciamentoClientes').prop('checked', true);
        $('#cbGerenciamentoProtocolos').prop('checked', true);
    }
}



/* ------------------------------------------------------------------------- */
/* ------------------------------- NÃO MEXER ------------------------------- */
/* ------------------------------------------------------------------------- */
window.onload = function() {
    setTimeout(function() { $(document.body).scrollTop(0); }, 1);
};
/* ------------------------------------------------------------------------- */
/* ------------------------------- NÃO MEXER ------------------------------- */
/* ------------------------------------------------------------------------- */