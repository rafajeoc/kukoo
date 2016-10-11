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
	    
	    <!-- Header -->
	    <section class="content-header">
	        <h1 class="pull-left">Dados do Usuário</h1>
	        <form method="post" action="<?= base_url() ?>usuarios">
	            <button type="submit" class="btn btn-danger pull-right">Voltar</button>
	        </form>
	        <div class="clearfix"></div>
	    </section>
	
	    <!-- Conteúdo -->
	    <section class="content">
	        <div class="row">
	            <div class="col-xs-12">
	                <div class="box">
							
						<form id="frmUsuario" class="form-horizontal" action="<?= base_url() ?>gravar-dados-usuario" method="post" role="form">
			    			<div class="panel panel-default dialog-panel">
			    				
			    				<!-- Corpo do painel -->
			    				<div class="panel-body">
									
	                				<input type="hidden" name="tipoOperacao" value="<?= $tipoOperacao ?>" />
	                				<input type="hidden" name="IdUsuario" value="<?= $usrId ?>" />
	                				
	                				<!-- Menu -->
			    				    <ul class="nav">
							            <button type="submit" class="btn btn-success pull-right" title="Grava as informações.">Gravar</button>
	                                </ul>
	                				
									<!-- Identificação -->
									<div class="form-group">
										<label class="control-label col-md-2">Código do Usuário</label>
										<div class="col-md-10">
											<div class="col-md-10 indent-small">
												<div class="form-group internal">
													<input id="txtIdUsuario" name="txtIdUsuario" class="form-control" type="text" placeholder="Nome completo" value="<?= $usrId ?>" disabled />
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-2">Identificação</label>
										<div class="col-md-10">
											<div class="col-md-10 indent-small">
												<div class="form-group internal">
													<input id="txtNomeCompleto" name="txtNomeCompleto" class="form-control" type="text" placeholder="Nome Completo" value="<?= $usrNome ?>" />
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-10 col-md-offset-2">
											<div class="col-md-10 indent-small">
												<div class="form-group internal">
													<input id="txtCPF" name="txtCPF" class="form-control" type="text" placeholder="CPF" maxlength="14"
															onKeyPress="mascararCampo(event, 'Documento', 'txtCPF', true, false);"
															onBlur="validarCampo('txtCPF');" value="<?= $usrCPF ?>" />
												</div>
											</div>
										</div>
									</div> <!-- ./Identificação -->
									
									<!-- Contato -->
									<div class="form-group">
										<label class="control-label col-md-2">Contato</label>
										<div class="col-md-10">
											<div class="col-md-10 indent-small">
												<div class="form-group internal">
													<input id="txtEmail" name="txtEmail" class="form-control" type="text" placeholder="Endereço de E-mail"
															onBlur="validarCampo('txtEmail');" value="<?= $usrEmail ?>" />
												</div>
											</div>
										</div>
									</div>
									
									<!-- Permissões -->
									<div class="form-group">
										<label class="control-label col-md-2">Permissões</label>
										<div class="col-md-6">
											<div class="col-md-6 indent-small">
												<div class="form-group internal">
													<input id="cbAdmin" name="cbAdmin" type="checkbox" <?= $cbAdministradorChecked ?> onClick="clickCbAdmin();" /> Administrador<br>
													<input id="cbGerenciamentoObrigacoes" name="cbGerenciamentoObrigacoes" type="checkbox" <?= $cbGerObrigacoesChecked ?> onClick="clickCbAdmin();" /> Gerenciamento de Obrigações<br>
													<input id="cbGerenciamentoClientes" name="cbGerenciamentoClientes" type="checkbox" <?= $cbGerClientesChecked ?> onClick="clickCbAdmin();" /> Gerenciamento de Clientes<br>
													<input id="cbGerenciamentoProtocolos" name="cbGerenciamentoProtocolos" type="checkbox" <?= $cbGerProtocolosChecked ?> onClick="clickCbAdmin();" /> Gerenciamento de Protocolos<br>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Departamentos -->
									<div class="form-group">
										<label class="control-label col-md-2">Departamentos</label>
										<div class="col-md-10">
											<div class="col-md-10 indent-small">
												<div class="form-group internal">
													<input id="cbDptFiscal" name="cbDptFiscal" type="checkbox" <?= $cbDptFiscalChecked ?> /> Fiscal<br>
													<input id="cbDptContabil" name="cbDptContabil" type="checkbox" <?= $cbDptContabilChecked ?> /> Contábil<br>
													<input id="cbDptPessoal" name="cbDptPessoal" type="checkbox" <?= $cbDptPessoalChecked ?> /> Pessoal<br>
													<input id="cbDptCertAlv" name="cbDptCertAlv" type="checkbox" <?= $cbDptCertAlvChecked ?> /> Certidões/Alvarás<br>
													<input id="cbDptDecFis" name="cbDptDecFis" type="checkbox" <?= $cbDptDecFisChecked ?> /> Declarações - Dep. Fiscal<br>
													<input id="cbDptDecCtb" name="cbDptDecCtb" type="checkbox" <?= $cbDptDecCtbChecked ?> /> Declarações - Dep. Contábil<br>
													<input id="cbDptDecPes" name="cbDptDecPes" type="checkbox" <?= $cbDptDecPesChecked ?> /> Declarações - Dep. Pessoal<br>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Usuário ativo/inativo -->
									<div class="form-group">
										<label class="control-label col-md-2">Usuário Ativo?</label>
										<div class="col-md-10">
											<div class="col-md-1 indent-small">
												<div class="form-group internal">
													<input id="cbUsuarioAtivo" name="cbUsuarioAtivo" type="checkbox" <?= $cbUsuarioAtivoChecked ?> />
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
	        
	        <!-- Modal -->
	        <div class="modal fade" id="mdlInativar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	            <div class="modal-dialog" role="document">
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                        <h4 class="modal-title" id="myModalLabel">Inativar Usuário</h4>
	                    </div>
	                    <div class="modal-body">
	                        Tem certeza que deseja inativar o usuário <b><?= $user['usrNome']; ?></b>?
	                    </div>
	                    <div class="modal-footer">
	                        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
	                        <button type="button" class="btn btn-success">Sim</button>
	                    </div>
	                </div>
	            </div>
	        </div>
	        
	    </section><!-- /.content -->
	</div>
	
	<script src="<?= base_url() ?>static/js/administrativo/usuario.js"></script>
	<script src="<?= base_url() ?>static/js/utilidades/validador.js"></script>
	
<?php } ?>