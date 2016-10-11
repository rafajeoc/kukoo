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
            mostraAlertBootstrap('Erro!', 'Sua licença do módulo de Protocolos expirou! Por favor, entre em contato com o suporte.', '');
        });
    </script>
<?php } else { ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="pull-left">Protocolos</h1>
            <?php if (count($clientes) > 0) { ?>
                <form method="post" action="<?= base_url() ?>dados-protocolo/novo">
                    <button name="btnDadosProtocolo" type="submit" value="i" class="btn btn-success pull-right">
                        <i class="fa fa-file-text-o fa-fw"></i> Novo Protocolo
                    </button>
                </form>
            <?php } else { ?>
                <button name="btnDadosProtocolo" type="submit" value="i" class="btn btn-success pull-right" disabled>
                    <i class="fa fa-file-text-o fa-fw"></i> Para adicionar um Protocolo, cadastre um Cliente!
                </button>
            <?php } ?>
            <div class="clearfix"></div>
        </section>
    
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <input type="text" id="txtPesquisaProtocolos" class="form-control" placeholder="Digite algum dado a ser buscado..." />
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tblProtocolos" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Razão Social</th>
                                        <th>Assunto</th>
                                        <th>Imprimir?</th>
                                        <th>Visualizar</th>
                                        <th>Remover?</th>
                                    </tr>
                                </thead>
                                <tbody>
                    	            <?php
                    	                if (count($protocolos) != 0) { // Verifica se não está vazio
                        		            foreach ($protocolos as $protocolo) {
            	                  		        echo '<tr>';
            	                    	        echo '<td>' . $protocolo->proId . '</td>';
            	                    	        echo '<td>' . mb_strtoupper($protocolo->cliRazaoSocial, 'UTF-8') . '</td>';
            	                    	        echo '<td>' . mb_strtoupper($protocolo->proAssunto, 'UTF-8') . '</td>';
            	                    	        echo '<td><a href="' . (base_url() . 'imprimir-protocolo/' . $protocolo->proId) .'" target="_blank"><i class="fa fa-print"></i></a></td>';
            	                    	        echo '<td><a href="' . (base_url() . 'dados-protocolo/' . $protocolo->proId) . '"><i class="fa fa-edit"></i></a></td>';
            	                    	        echo '<td><a href="' . (base_url() . 'apagar-protocolo/' . $protocolo->proId) . '"><i class="fa fa-close"></i></a></td>';
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
            var rows = $('#tblProtocolos tbody tr');
            $('#txtPesquisaProtocolos').keyup(function() {
                var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
        
                rows.show().filter(function() {
                    var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                    return !~text.indexOf(val);
                }).hide();
            });
        });
    </script>
<?php } ?>