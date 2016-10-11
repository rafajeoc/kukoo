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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="pull-left">Obrigações Enviadas</h1>
            <div class="clearfix"></div>
        </section>
    
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <input type="text" id="txtPesquisaObrigacao" class="form-control" placeholder="Digite algum dado a ser buscado..." />
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tblObrigacoes" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Razão Social</th>
                                        <th>Mês de Referência</th>
                                        <th>Apagar</th>
                                    </tr>
                                </thead>
                                <tbody>
                    	            <?php
                    	                if (count($obrigacoesEnviadas) != -1) { // Verifica se não está vazio
                        		            foreach ($obrigacoesEnviadas as $obrigacaoEnviada) {
            	                  		        echo '<tr>';
            	                  		        echo '<td>'.$obrigacaoEnviada->obrcodId.'</td>';
            	                    	        echo '<td>'.mb_strtoupper($obrigacaoEnviada->obrNome, 'UTF-8').'</td>';
												echo '<td>'.mb_strtoupper($obrigacaoEnviada->cliRazaoSocial, 'UTF-8').'</td>';
												echo '<td>'.$obrigacaoEnviada->obrcodMesRef.'</td>';
            	                    	        echo '<td><a href="'.(base_url().'apagar-obrigacao-enviada/'.$obrigacaoEnviada->cliId.'/'.$obrigacaoEnviada->obrcodId).'"><i class="fa fa-close"></i></a></td>';
            	                  		        echo '</tr>';
                          	                }
                    	                }
                                    ?>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            
        </section><!-- /.content -->
    </div>
    
    <script type="text/javascript">
        $(document).ready(function() {
            var rows = $('#tblObrigacoes tbody tr');
            $('#txtPesquisaObrigacao').keyup(function() {
                var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
        
                rows.show().filter(function() {
                    var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                    return !~text.indexOf(val);
                }).hide();
            });
        });
    </script>
<?php } ?>
