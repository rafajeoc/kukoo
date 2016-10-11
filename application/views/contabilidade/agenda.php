<?php if ($licencaAtiva == 'N') { ?>
    <!-- Modal de erro -->
	<div class="modal fade" id="mdlErro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                    </button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">OK!</button>
				</div>
			</div>
		</div>
	</div>
	<!-- ./Modal de erro -->
	
	<script src="<?= base_url() ?>static/js/utilidades/validador.js"></script>
    <script>
        $(document).ready(function() {
            mostraAlertBootstrap('Erro!', 'Sua licença do módulo de Contabilidade e Cadastros expirou! Por favor, entre em contato com o suporte.', '');
        });
    </script>
<?php } else { ?>
    <div class="content-wrapper">
        
        <section class="content-header">
            <h1 class="pull-left">Agenda</h1>
            <div class="clearfix"></div>
        </section>
    
        <section class="content">
            <div id="panelImpostos" class="panel-group">
                
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Obrigações a Enviar</h3>
                    </div>
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Obrigação</th>
                                        <th>Razão Social</th>
                                        <th>Quando?</th>
                                        <th>Data Limite</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (count($agenda) != 0) {
                                            
                                            $diaAtual = intval(date('j'));
                                            $mesAtual = intval(date('n'));
                                            $anoAtual = intval(date('Y'));
                                            $arrayMesCobrancaTrimestral = array(1, 4, 7, 10);
                                            
                                            // Monta o array dos departamentos do usuário atual.
                                            $departamentosUsuario = array();
                                            if ($usuarioAtual->dptFiscal == 1) array_push($departamentosUsuario, 11);
                                            if ($usuarioAtual->dptContabil == 1) array_push($departamentosUsuario, 21);
                                            if ($usuarioAtual->dptPessoal == 1) array_push($departamentosUsuario, 31);
                                            if ($usuarioAtual->dptCertAlv == 1) array_push($departamentosUsuario, 41);
                                            if ($usuarioAtual->dptDecFis == 1) array_push($departamentosUsuario, 51);
                                            if ($usuarioAtual->dptDecCtb == 1) array_push($departamentosUsuario, 52);
                                            if ($usuarioAtual->dptDecPes == 1) array_push($departamentosUsuario, 53);
                                            
                                            // Monta a agenda.
                                            foreach ($agenda as $obrigacao) {
                                                
                                                // Imprime as obrigações até o mês atual do ano atual que estejam em aberto.
                                                // Para cada obrigação, verifica se a obrigação corresponde aos departamentos do usuário.
                                                if ($obrigacao->cliodtMesLimite <= $mesAtual &&
                                                    $obrigacao->cliodtAnoLimite <= $anoAtual &&
                                                    in_array($obrigacao->obrDptResp, $departamentosUsuario)) {
                                                    
                                                    
                                                    /* ---------------------------------------------------------------------------------------------- */
                                                    /* ----------------------- Cálculo de quando deve ser enviado - INÍCIO -------------------------- */
                                                    /* ---                                                                                        --- */
                                                    /* ---                                                                                        --- */
                                                    /* --- 1. Se a obrigação for mensal, calcula com base no dia.                                 --- */
                                                    /* --- 2. Se a obrigação for trimestral, calcula com base no dia e nos meses 1, 4, 7 e 10.    --- */
                                                    /* --- 3. Se a obrigação for anual, calcula com base no dia e no mês da obrigação.            --- */
                                                    /* --- 4. Se a obrigação for de data específica, usa como base o ano em que foi enviada.      --- */
                                                    /* ---------------------------------------------------------------------------------------------- */
                                                    $obrDiaLimite = $obrigacao->cliodtDiaLimite;
                                                    $obrMesLimite = $obrigacao->cliodtMesLimite;
                                                    $obrAnoLimite = $obrigacao->cliodtAnoLimite;
                                                    $obrPeriodo = $obrigacao->obrPeriodo;
                                                    $obrRepeticao = $obrigacao->obrRepeticao;
                                                    
                                                    // Se a repetição foi 1 (mensal ou anual):
                                                    if (($obrPeriodo == 'M' || $obrPeriodo == 'A') && $obrRepeticao == 1) {
                                                        
                                                        // Se o mês limite da obrigação for o mês atual, ou se ele não tiver mês limite (mensal ou trimestral), imprime normalmente.
                                                        // Senão, indica que está vencido.
                                                        if ($obrigacao->cliodtMesLimite == $mesAtual || ($obrigacao->cliodtMesLimite == NULL && $obrigacao->cliodtDiaLimite >= $diaAtual)) {
                                                            echo '<tr>';
                                                        } else {
                                                            echo '<tr style="color: red;">';
                                                        }
                                                        
                                                        echo '<td>'.$obrigacao->obrNome.'</td>';
                                                        echo '<td>'.$obrigacao->cliRazaoSocial.'</td>';
                                                        
                                                        // Se o dia limite for menor ou igual o dia atual do mês, é hoje (pode ser hoje ou estar vencido).
                                                        if ($obrDiaLimite <= $diaAtual || ($obrigacao->cliodtMesLimite !== NULL && $obrigacao->cliodtMesLimite < $mesAtual)) {
                                                            echo '<td><span class="label label-danger">Hoje</span></td>';
                                                        }
                                                        // Se a diferença entre o dia limite e o dia atual for maior que 0 e menor ou igual a 7, é esta semana.
                                                        else if (($obrDiaLimite - $diaAtual) > 0 && ($obrDiaLimite - $diaAtual) <= 7) {
                                                            echo '<td><span class="label label-warning">Esta Semana</span></td>';
                                                        }
                                                        // Se a diferença entre o dia limite e o dia atual for maior que 7, é este mês.
                                                        else if (($obrDiaLimite - $diaAtual) > 7) {
                                                            echo '<td><span class="label label-success">Este Mês</span></td>';
                                                        }
                                                        
                                                        if ($obrigacao->obrPeriodo == 'A') {
                                                            if ($obrigacao->cliodtAnoLimite < $anoAtual) {
                                                                echo '<td>'.$obrigacao->cliodtDiaLimite.'/'.$obrigacao->cliodtMesLimite.'/'.$obrigacao->cliodtAnoLimite.'</td>';
                                                            } else {
                                                                echo '<td>'.$obrigacao->cliodtDiaLimite.'/'.$obrigacao->cliodtMesLimite.'</td>';
                                                            }
                                                        } else {
                                                            echo '<td>'.$obrigacao->cliodtDiaLimite.'</td>';
                                                        }
                                                        
                                                        echo '<td><a href="" data-toggle="modal" data-ent="'.$obrigacao->cliId.'" data-cliodt="'.$obrigacao->cliodtId.'" data-entemail="'.$obrigacao->cliEmail.'" data-target="#mdlObrigacao" class="abrirModalObrigacao"><span class="label label-primary">Enviar</span></a></td>';
                                                        echo '</tr>';
                                                    }
                                                    // Se a obrigação for trimestral:
                                                    else if ($obrPeriodo == 'M' &&
                                                            $obrRepeticao == 3 &&
                                                            in_array($mesAtual, $arrayMesCobrancaTrimestral)
                                                            // falta pensar em uma forma de virada de mês aqui
                                                            ) {
                                                        
                                                        // Se o mês limite da obrigação for o mês atual, ou se ele não tiver mês limite (mensal ou trimestral), imprime normalmente.
                                                        // Senão, indica que está vencido.
                                                        if ($obrigacao->cliodtMesLimite == $mesAtual || ($obrigacao->cliodtMesLimite == NULL && $obrigacao->cliodtDiaLimite >= $diaAtual)) {
                                                            echo '<tr>';
                                                        } else {
                                                            echo '<tr style="color: red;">';
                                                        }
                                                        
                                                        echo '<td>'.$obrigacao->obrNome.'</td>';
                                                        echo '<td>'.$obrigacao->cliRazaoSocial.'</td>';
                                                        
                                                        // Se o dia limite for menor ou igual o dia atual do mês, é hoje (pode ser hoje ou estar vencido).
                                                        if ($obrDiaLimite <= $diaAtual || ($obrigacao->cliodtMesLimite !== NULL && $obrigacao->cliodtMesLimite < $mesAtual)) {
                                                            echo '<td><span class="label label-danger">Hoje</span></td>';
                                                        }
                                                        // Se a diferença entre o dia limite e o dia atual for maior que 0 e menor ou igual a 7, é esta semana.
                                                        else if (($obrDiaLimite - $diaAtual) > 0 && ($obrDiaLimite - $diaAtual) <= 7) {
                                                            echo '<td><span class="label label-warning">Esta Semana</span></td>';
                                                        }
                                                        // Se a diferença entre o dia limite e o dia atual for maior que 7, é este mês.
                                                        else if (($obrDiaLimite - $diaAtual) > 7) {
                                                            echo '<td><span class="label label-success">Este Mês</span></td>';
                                                        }
                                                        
                                                        echo '<td>'.$obrigacao->cliodtDiaLimite.'/'.$mesAtual.'</td>';
                                                        echo '<td><a href="" data-toggle="modal" data-ent="'.$obrigacao->cliId.'" data-cliodt="'.$obrigacao->cliodtId.'" data-entemail="'.$obrigacao->cliEmail.'" data-target="#mdlObrigacao" class="abrirModalObrigacao"><span class="label label-primary">Enviar</span></a></td>';
                                                        echo '</tr>';
                                                        
                                                    }
                                                    // Senão, é data específica
                                                    else if ($obrPeriodo == 'A' && $obrRepeticao > 1) {
                                                        
                                                        // Se o mês limite da obrigação for o mês atual, ou se ele não tiver mês limite (mensal ou trimestral), imprime normalmente.
                                                        // Senão, indica que está vencido.
                                                        if ($obrigacao->cliodtMesLimite == $mesAtual || ($obrigacao->cliodtMesLimite == NULL && $obrigacao->cliodtDiaLimite >= $diaAtual)) {
                                                            echo '<tr>';
                                                        } else {
                                                            echo '<tr style="color: red;">';
                                                        }
                                                        
                                                        echo '<td>'.$obrigacao->obrNome.'</td>';
                                                        echo '<td>'.$obrigacao->cliRazaoSocial.'</td>';
                                                        
                                                        // Se o dia limite for menor ou igual o dia atual do mês, é hoje (pode ser hoje ou estar vencido).
                                                        if ($obrDiaLimite <= $diaAtual || ($obrigacao->cliodtMesLimite !== NULL && $obrigacao->cliodtMesLimite < $mesAtual)) {
                                                            echo '<td><span class="label label-danger">Hoje</span></td>';
                                                        }
                                                        // Se a diferença entre o dia limite e o dia atual for maior que 0 e menor ou igual a 7, é esta semana.
                                                        else if (($obrDiaLimite - $diaAtual) > 0 && ($obrDiaLimite - $diaAtual) <= 7) {
                                                            echo '<td><span class="label label-warning">Esta Semana</span></td>';
                                                        }
                                                        // Se a diferença entre o dia limite e o dia atual for maior que 7, é este mês.
                                                        else if (($obrDiaLimite - $diaAtual) > 7) {
                                                            echo '<td><span class="label label-success">Este Mês</span></td>';
                                                        }
                                                        
                                                        if ($obrigacao->cliodtAnoLimite < $anoAtual) {
                                                            echo '<td>'.$obrigacao->cliodtDiaLimite.'/'.$obrigacao->cliodtMesLimite.'/'.$obrigacao->cliodtAnoLimite.'</td>';
                                                        } else {
                                                            echo '<td>'.$obrigacao->cliodtDiaLimite.'/'.$obrigacao->cliodtMesLimite.'</td>';
                                                        }
                                                        
                                                        echo '<td><a href="" data-toggle="modal" data-ent="'.$obrigacao->cliId.'" data-cliodt="'.$obrigacao->cliodtId.'" data-entemail="'.$obrigacao->cliEmail.'" data-target="#mdlObrigacao" class="abrirModalObrigacao"><span class="label label-primary">Enviar</span></a></td>';
                                                        echo '</tr>';
                                                    }
                                                        
                                                    /* ---------------------------------------------------------------------------------------------- */
                                                    /* -----------------------                                              ------------------------- */
                                                    /* --------------------      Cálculo de quando deve ser enviado - FIM      ---------------------- */
                                                    /* -----------------------                                              ------------------------- */
                                                    /* ---------------------------------------------------------------------------------------------- */
                                                }
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
        </section><!-- /.content -->
        
        <div class="alert alert-success alert-fixed-bottom">
        </div>
        
        <div class="alert alert-danger alert-fixed-bottom">
        </div>
        
        <!-- Modal de obrigações -->
        <div class="modal fade" id="mdlObrigacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Enviar Obrigação</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url() ?>enviar-obrigacao" method="post" enctype="multipart/form-data">
                            Selecione o documento para enviar:
                            <input id="obrigacaoUpload" name="obrigacaoUpload" type="file" />
                            <input id="enviarObrigacao" name="enviarObrigacao" type="submit" value="Enviar" />
                            <input id="IdObrigacaoClienteOdt" name="IdObrigacaoClienteOdt" type="hidden" value="" />
                            <input id="IdCliente" name="IdCliente" type="hidden" value="" />
                            <input id="EmailCliente" name="EmailCliente" type="hidden" value="" />
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- ./Modal de obrigações -->
        
    </div>
    
    <script>
        $(document).on('click', '.abrirModalObrigacao', function () {
             $('#IdObrigacaoClienteOdt').val( $(this).data('cliodt') );
             $('#IdCliente').val( $(this).data('ent') );
             $('#EmailCliente').val( $(this).data('entemail') );
        });
    </script>
<?php } ?>