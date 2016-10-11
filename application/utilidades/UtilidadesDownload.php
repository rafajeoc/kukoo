<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Classe de utilidades de download.
 * 
 * @author Rafael Cantoni Augusto
 * @version 1.0
 * @package utilidades
 */
class UtilidadesDownload {
    
    /**
     * Baixa um arquivo do servidor.
     * 
     * @param   string $hashEntidade    Hash da entidade.
     * @param   string $hashArquivo     Hash do arquivo.
     */
    public function baixarArquivo($hashEntidade, $hashArquivo) {
        
        // Monta o endereço baseado nos parâmetros.
        // Ex.: /home/ubuntu/workspace/uploads/1a8f5r2g5f9s3ertg851sd8fgok5iuyhn14mm5h8gfd9r5esds4543r8f5g96310/654asd789f74qaws85ed14zaxs2536asfgjk4589qaswed1782frvgtb582nhy9h.pdf
        //          primeiro hash = hash da entidade
        //          segundo hash = hash do arquivo
        $arquivo = '/home/ubuntu/workspace/uploads/'.$hashEntidade.'/'.$hashArquivo.'.pdf';
        
        // Verifica se o arquivo existe antes de baixar.
        if (file_exists($arquivo)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($arquivo).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($arquivo));
            readfile($arquivo);
            exit;
        }
        
    }
    
}

?>