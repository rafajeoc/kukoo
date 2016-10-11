<?php
    function buscaEnderecoCEP($cep) {
        $token = '18aa3e16bcb7bbe4e39e0c62c8340214';
        $url = 'http://www.cepaberto.com/api/v2/ceps.json?cep=' . $cep;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Token token="' . $token . '"'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return curl_exec($ch);
    }
    
    // Pega o parâmetro do campo de CEP
    if (isset($_POST['cep'])) {
        echo buscaEnderecoCEP($_POST['cep']);
    }
?>