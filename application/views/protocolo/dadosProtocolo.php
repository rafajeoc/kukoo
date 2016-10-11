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
	        <h1 class="pull-left">Dados do Protocolo</h1>
	        <form method="post" action="<?php echo base_url();?>protocolos">
	            <button type="submit" class="btn btn-danger pull-right">Voltar</button>
	        </form>
	        <div class="clearfix"></div>
	    </section>
	
	    <!-- Main content -->
	    <section class="content">
	        <div class="row">
	            <div class="col-xs-12">
	                <div class="box">
							
						<!-- Dados do Usuário -->
						<form id="frmProtocolo" class="form-horizontal" action="<?php echo base_url();?>gravar-dados-protocolo" method="post" role="form">
			    			<div class="panel panel-default dialog-panel">
			    				<!-- Corpo do painel -->
			    				<div class="panel-body">
									
									<!-- Pega o tipo da operação que está sendo feita: inclusão ou alteração, e o ID do usuário se for alteração. -->
	                				<input id="tipoOperacao" name="tipoOperacao" type="hidden" value="<?= $tipoOperacao ?>" />
	                				<input id="IdProtocolo" name="IdProtocolo" type="hidden" value="<?= $proId ?>" />
	                				<input id="IdCliente" name="IdCliente" type="hidden" value="<?= $cliId ?>" />
	                				<input id="DtHrEmissao" name="DtHrEmissao" type="hidden" value="" />
	                				
	                				<!-- Menu -->
			    				    <ul class="nav">
	                                    <!-- Botão Gravar -->
	                                    <?php if ($tipoOperacao != 'a') { ?>
							            	<button type="submit" class="btn btn-success pull-right" title="Grava as informações.">Gravar</button>
							            <?php } ?>
	                                </ul>
	                				
	                				<div id="divProtocoloId" class="form-group col-md-12">
										<label class="control-label col-md-2">Código do Protocolo</label>
										<div class="col-md-10">
											<div class="col-md-2 indent-small">
												<div class="form-group internal">
													<input id="txtProtocoloId" name="txtProtocoloId" type="text" class="form-control" value="<?= $proId ?>" disabled />
												</div>
											</div>
										</div>
									</div>
	                				<div id="divClienteId" class="form-group col-md-12">
										<label class="control-label col-md-2">Razão Social</label>
										<div class="col-md-10">
											<div class="col-md-10 indent-small">
												<div class="form-group internal">
													<select id="slcRazaoSocial" name="slcRazaoSocial" class="form-control">
													</select>
												</div>
											</div>
										</div>
									</div>
									<div id="divProtocoloAssunto" class="form-group col-md-12">
										<label class="control-label col-md-2">Assunto</label>
										<div class="col-md-10">
											<div class="col-md-10 indent-small">
												<div class="form-group internal">
													<input id="txtAssunto" name="txtAssunto" type="text" class="form-control" placeholder="Do que se trata?" value="<?= $proAssunto ?>" />
												</div>
											</div>
										</div>
									</div>
									<div id="divProtocoloDescricao" class="form-group col-md-12">
									    <label class="control-label col-md-2">Conteúdo</label>
										<div class="col-md-10">
											<div class="col-md-10 indent-small">
												<div class="form-group internal">
													<textarea id="txtDescricao" name="txtDescricao" class="form-control" rows="20" cols="50"><?= $proDescricao ?></textarea>
												</div>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</form>
	                    	
	                </div><!-- /.box -->
	            </div><!-- /.col -->
	        </div><!-- /.row -->
	        
	    </section><!-- /.content -->
	</div>
	
	<script src="<?= base_url() ?>static/js/protocolo/protocolo.js"></script>
	<script src="<?= base_url() ?>static/js/utilidades/validador.js"></script>
<?php } ?>