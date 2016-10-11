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
			<h1 class="pull-left">Dados do Cliente</h1>
			<form method="post" action="<?= base_url() ?>clientes">
				<button type="submit" class="btn btn-danger pull-right">Voltar</button>
			</form>
			<div class="clearfix"></div>
		</section>
		<!-- ./Header -->
	
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
	
						<!-- Dados do Usuário -->
						<form id="frmCliente" class="form-horizontal" action="<?= base_url() ?>gravar-dados-cliente" method="post" role="form" onSubmit="return validarSubmit(event);">
							<div class="panel panel-default dialog-panel">
	
								<!-- Corpo do painel -->
								<div class="panel-body">
	
									<input id="tipoOperacao" name="tipoOperacao" type="hidden" value="<?= $tipoOperacao ?>" />
									<input id="IdCliente" name="IdCliente" type="hidden" value="<?= $cliId ?>" />
									
									<!-- Tabs do cadastro -->
									<ul class="nav nav-tabs" role="tablist">
										<li class="active">
											<a href="#informacoesCliente" role="tab" data-toggle="tab">Informações</a>
										</li>
										<li>
											<a href="#obrigacoes" role="tab" data-toggle="tab">Obrigações</a>
										</li>
										<button type="submit" class="btn btn-success pull-right" title="Grava as informações.">Gravar</button>
									</ul>
									<!-- ./Tabs do cadastro -->
	
									<div class="tab-content">
	
										<!-- Painel Dados Cliente -->
										<div class="tab-pane active" id="informacoesCliente">
											<br>
											
											<div class="form-group">
												<label class="control-label col-md-2">Código da Cliente</label>
												<div class="col-md-10">
													<div class="col-md-2 indent-small">
														<div class="form-group internal">
															<input id="txtClienteID" name="txtClienteID" type="text" class="form-control" value="<?= $cliId ?>" disabled />
														</div>
													</div>
												</div>
											</div>
											
											<!-- CPF/CNPJ -->
											<div class="form-group">
												<label class="control-label col-md-2">Tipo</label>
												<div class="col-md-10">
													<div class="col-md-2 indent-small">
														<div class="form-group internal">
															<select id="slcTipoPessoa" name="tipoDocumento" class="form-control" onChange="limparCampo('txtCPFCNPJ');">
																<option <?= $cliCPFSelecionado ?> value="cpf">CPF</option>
																<option <?= $cliCNPJSelecionado ?> value="cnpj">CNPJ</option>
															</select>
														</div>
													</div>
													<div class="col-md-8 indent-small">
														<div class="form-group internal">
															<input class="form-control" id="txtCPFCNPJ" name="txtCPFCNPJ" type="text" placeholder="Número do documento" 
																	onKeyPress="mascararCampo(event, 'Documento', 'txtCPFCNPJ', true, false);"
																	onBlur="validarCampo('txtCPFCNPJ');" value="<?= $cliCPFCNPJ ?>" />
														</div>
													</div>
												</div>
											</div>
	
											<!-- Razão Social / Nome Fantasia -->
											<div class="form-group">
												<label class="control-label col-md-2">Identificação</label>
												<div class="col-md-10">
													<div class="col-md-5 indent-small">
														<div class="form-group internal">
															<input class="form-control" id="txtRazaoSocial" name="txtRazaoSocial" type="text" placeholder="Razão Social"
																value="<?= $cliRazaoSocial ?>" />
														</div>
													</div>
													<div class="col-md-5 indent-small">
														<div class="form-group internal">
															<input class="form-control" id="txtNomeFantasia" name="txtNomeFantasia" type="text" placeholder="Nome Fantasia" 
																	value="<?= $cliNomeFantasia ?>" />
														</div>
													</div>
												</div>
											</div>
	
											<!-- Contato -->
											<div class="form-group">
												<label class="control-label col-md-2">Contato</label>
												<div class="col-md-10">
													<div class="col-md-4 indent-small2">
														<div class="form-group internal">
															<input class="form-control" id="txtEmail" name="txtEmail" type="text" placeholder="Endereço de E-mail"
																	onBlur="validarCampo('txtEmail');" value="<?= $cliEmail ?>" />
														</div>
													</div>
													<div class="col-md-3 indent-small2">
														<div class="form-group internal">
															<input class="form-control" id="txtTelefone1" name="txtTelefone1" type="text" placeholder="Telefone 1"
																	onKeyPress="mascararCampo(event, 'Telefone', 'txtTelefone1', true, false);" value="<?= $cliTelefone1 ?>" />
														</div>
													</div>
													<div class="col-md-3 indent-small2">
														<div class="form-group internal">
															<input class="form-control" id="txtTelefone2" name="txtTelefone2" type="text" placeholder="Telefone 2"
																	onKeyPress="mascararCampo(event, 'Telefone', 'txtTelefone2', true, false);" value="<?= $cliTelefone2 ?>" />
														</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-10 col-md-offset-2">
													<div class="col-md-2 indent-small2">
														<div class="form-group internal">
															<input class="form-control" id="txtCEP" name="txtCEP" type="text" placeholder="CEP"
																	onKeyPress="mascararCampo(event, 'CEP', 'txtCEP', true, false);" value="<?= $cliCEP ?>" />
														</div>
													</div>
													<div class="col-md-5 indent-small2">
														<div class="form-group internal">
															<input class="form-control" id="txtLogradouro" name="txtLogradouro" type="text" placeholder="Logradouro"
																	value="<?= $cliLogradouro ?>" />
														</div>
													</div>
													<div class="col-md-1 indent-small2">
														<div class="form-group internal">
															<input class="form-control" id="txtNumero" name="txtNumero" type="text" maxlength="5" placeholder="Nº"
																	onKeyPress="mascararCampo(event, 'Numero', 'txtNumero', true, false);" value="<?= $cliNumero ?>" />
														</div>
													</div>
													<div class="col-md-2 indent-small2">
														<div class="form-group internal">
															<input class="form-control" id="txtComplemento" name="txtComplemento" type="text" placeholder="Complemento"
																	value="<?= $cliComplemento ?>" />
														</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-10 col-md-offset-2">
													<div class="col-md-5 indent-small2">
														<div class="form-group internal">
															<input class="form-control" id="txtBairro" name="txtBairro" type="text" placeholder="Bairro"
																	value="<?= $cliBairro ?>" />
														</div>
													</div>
													<div class="col-md-4 indent-small2">
														<div class="form-group internal">
															<input class="form-control" id="txtMunicipio" name="txtMunicipio" type="text" placeholder="Município"
																	value="<?= $cliMunicipio ?>" />
														</div>
													</div>
													<div class="col-md-1 indent-small2">
														<div class="form-group internal">
															<input class="form-control" id="txtUF" name="txtUF" type="text" placeholder="UF" maxlength="2"
																	onKeyPress="mascararCampo(event, 'UF', 'txtUF', false, false);" value="<?= $cliUF ?>" />
														</div>
													</div>
												</div>
											</div>
	
											<!-- Cliente ativa/inativa -->
											<div class="form-group">
												<label class="control-label col-md-2">Cliente Ativo?</label>
												<div class="col-md-10">
													<div class="col-md-1 indent-small">
														<div class="form-group internal">
															<input id="cbClienteAtivo" name="cbClienteAtivo" type="checkbox" <?= $cbClienteAtivoChecked ?> />
														</div>
													</div>
												</div>
											</div>
											
										</div>
										<!-- ./Painel Dados Cliente -->
	
										<!-- Painel Tributação -->
										<div class="tab-pane" id="obrigacoes">
											<br>
											<!-- Regime de Tributação -->
											<div id="divRegimeTributação" class="form-group">
												<label class="control-label col-md-2">Regime de Tributação</label>
												<div class="col-md-10">
													<div class="col-md-3 indent-small">
														<div class="form-group internal">
															<!-- Select Regime tributação -->
															<select id="slcRegimeTributacao" name="slcRegimeTributacao" class="form-control" onChange="montarSelectObrigacoesRegimeTributacao();">
																<option <?= (($tipoOperacao == 'i') ? 'selected' : '') ?> disabled>Escolha um regime</option>
																<option <?= (($tipoOperacao == 'a' && $cliente[0]->rgtId == 1) ? 'selected' : '') ?> value="1">MEI</option>
																<option <?= (($tipoOperacao == 'a' && $cliente[0]->rgtId == 2) ? 'selected' : '') ?> value="2">Simples Nacional</option>
																<option <?= (($tipoOperacao == 'a' && $cliente[0]->rgtId == 3) ? 'selected' : '') ?> value="3">Lucro Presumido</option>
																<option <?= (($tipoOperacao == 'a' && $cliente[0]->rgtId == 4) ? 'selected' : '') ?> value="4">Lucro Real</option>
															</select>
														</div>
													</div>
													<div class="col-md-1 indent-small" style="margin-left: 20px;">
														<div class="form-group internal">
															<button id="btnModalObrigacoes" type="button" class="btn btn-primary btn-md <?= (($tipoOperacao == 'i') ? 'disabled' : '') ?>"
																	title="Clique neste botão para abrir a janela de obrigações.">
																Obrigações
															</button>
														</div>
													</div>
												</div>
											</div>
	
											<!-- Obrigações -->
											<div class="modal fade" id="mdlObrigacoes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h4 class="modal-title" id="myModalLabel">Obrigações</h4>
														</div>
														<div class="modal-body">
															<div class="form-group">
																<div class="col-md-12">
																	<div class="col-md-5 indent-small">
																		<div class="form-group internal">
																			<select id="slcNomeObrigacao" class="form-control" name="txtNomeObrigacao" onChange="mudarPeriodoObrigacao();">
															                </select>
																			<input id="txtPeriodoObrigacao" name="txtPeriodoObrigacao" type="hidden" value="" />
																			<input id="txtRepeticaoObrigacao" name="txtRepeticaoObrigacao" type="hidden" value="" />
																		</div>
																	</div>
																	<div class="col-md-3 indent-small">
																		<div class="form-group internal">
																			<input id="txtDiaLimiteObrigacao" name="txtDiaLimiteObrigacao" class="form-control" type="text"
																					value="" placeholder="Digite a data"
																					onKeyPress="mascararDataLimiteObrigacao('txtPeriodoObrigacao', 'txtRepeticaoObrigacao', 'txtDiaLimiteObrigacao', event);" />
																		</div>
																	</div>
																	<div class="col-md-1 indent-small">
																		<div class="form-group internal">
																			<button id="btnAddObrigacao" name="btnAddObrigacao" type="button" class="btn btn-default btn-md"
																					onClick="adicionarObrigacaoLista();">
																				<span class="glyphicon glyphicon-plus"></span>
																			</button>
																		</div>
																	</div>
																</div>
															</div>
															<div class="form-group centered">
																<div class="col-md-10 table-responsive">
																	<table id="tblObrigacoes" class="table">
																		<tr>
																			<th>Código</th>
																			<th>Obrigação</th>
																			<th>Dia Limite</th>
																			<th>Remover?</th>
																		</tr>
																		<?php
																			if ($tipoOperacao == "a") {
																				foreach ($cliente as $obrigacao) {
																					echo '<tr id="tr_cliodt_i_'.$obrigacao->obrId.'" name="tr_cliodt_i_'.$obrigacao->obrId.'">';
																					echo '<td>'.$obrigacao->obrId.'<input type="hidden" name="td_cliodt_i_'.$obrigacao->obrId.'" value="'.$obrigacao->obrId.'" /></td>';
																					echo '<td>'.$obrigacao->obrNome.'</td>';
																					
																					if ($obrigacao->cliodtMesLimite == NULL) {
																						echo '<td>'.$obrigacao->cliodtDiaLimite.'<input type="hidden" name="td_dialimite_odt_'.$obrigacao->obrId.'" value="'.$obrigacao->cliodtDiaLimite.'" /></td>';
																					} else {
																						echo '<td>'.$obrigacao->cliodtDiaLimite.'/'.$obrigacao->cliodtMesLimite.'/'.$obrigacao->cliodtAnoLimite.'<input type="hidden" name="td_dialimite_odt_'.$obrigacao->obrId.'" value="'.$obrigacao->cliodtDiaLimite.'/'.$obrigacao->cliodtMesLimite.'/'.$obrigacao->cliodtAnoLimite.'" /></td>';
																					}
																					
																					echo '<td><button id="btnDelObrigacao'.$obrigacao->obrNome.'" type="button" class="btn btn-default btn-md" onclick="removerObrigacaoLista('.$obrigacao->obrId.');"><span class="glyphicon glyphicon-trash"></span></button></td>';
																					echo '</tr>';
																				}
																			}
																		?>
																	</table>
																</div>
															</div>
															<!-- Usada para manter um controle dos obrigações removidas na alteração -->
															<div id="divObrigacoesRemovidasAlteracao">
															</div>
														</div>
													</div>
												</div>
											</div>
											
										</div>
										<!-- ./Painel Tributação -->
										
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
	
									</div>
	
								</div>
							</div>
							<br>
						</form>
	
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
	
		</section>
		<!-- /.content -->
	</div>
	
	<script src="<?= base_url() ?>static/js/administrativo/cliente.js"></script>
	<script src="<?= base_url() ?>static/js/utilidades/validador.js"></script>
<?php } ?>