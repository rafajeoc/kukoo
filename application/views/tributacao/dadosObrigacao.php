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
            mostraAlertBootstrap('Erro!', 'Sua licença do módulo de Tributação expirou! Por favor, entre em contato com o suporte.', '');
        });
    </script>
<?php } else { ?>
	<div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	        <h1 class="pull-left">Dados da Obrigação</h1>
	        <form method="post" action="<?= base_url() ?>obrigacoes">
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
						<form id="frmObrigacao" class="form-horizontal" action="<?= base_url() ?>gravar-dados-obrigacao" method="post" role="form">
			    			<div class="panel panel-default dialog-panel">
			    				
			    				<input id="tipoOperacao" name="tipoOperacao" type="hidden" value="<?= $tipoOperacao ?>" />
			    				<input id="IdObrigacao" name="IdObrigacao" type="hidden" value="<?= $obrId ?>" />
			    				<input id="tipoObrigacao" name="tipoObrigacao" type="hidden" value="<?= $obrTipoObr ?>" />
			    				<input id="periodoRepeticao" name="periodoRepeticao" type="hidden" value="<?= $obrTipoData ?>" />
			    				
			    				<!-- Corpo do painel -->
			    				<div class="panel-body">
	                				
	                				<!-- Menu -->
			    				    <ul class="nav">
	                                    <!-- Botão Gravar -->
							            <button type="button" class="btn btn-success pull-right" title="Grava as informações."
							            		data-toggle="modal" data-target="#mdlConfirmarGravacaoObrigacao">
							            	Gravar
							            </button>
	                                </ul>
	                				
	                				<div id="divCodigoObrigacao" class="form-group col-md-12">
										<label class="control-label col-md-2">Código da Obrigação</label>
										<div class="col-md-10">
											<div class="col-md-3 indent-small">
												<div class="form-group internal">
													<input id="txtIdObrigacao" name="txtIdObrigacao" type="text" class="form-control" value="<?= $obrId ?>"
															title="Código de identificação da obrigação no sistema (códigos novos são gerados automaticamente)." disabled />
												</div>
											</div>
										</div>
									</div>
									<div id="divNomeObrigacao" class="form-group col-md-12">
										<label class="control-label col-md-2">Nome da Obrigação</label>
										<div class="col-md-10">
											<div class="col-md-3 indent-small">
												<div class="form-group internal">
													<input id="txtNomeObrigacao" name="txtNomeObrigacao" type="text" class="form-control" value="<?= $obrNome ?>" 
															title="Nome da obrigação." <?= (($obrTipoObr == 'I') ? 'disabled' : '') ?>/>
												</div>
											</div>
										</div>
									</div>
									<div id="divTipoDataObrigacao" class="form-group col-md-12">
										<label class="control-label col-md-2">Tipo de Data</label>
										<div class="col-md-10">
											<div id="divInternaTipoDataObrigacao" class="col-md-3 indent-small">
												<div class="form-group internal">
													<select id="slcTipoDataObrigacao" name="slcTipoDataObrigacao" type="text" class="form-control"
															title="Indica o tipo de data da obrigação (mensal, trimestral, anual ou outras datas)."
															onChange="verificarDataEspecificaObrigacao();" <?= (($obrTipoObr == 'I') ? 'disabled' : '') ?>>
														<option value="M1" <?= (($obrTipoData == 'M1') ? 'selected' : '') ?>>MENSAL</option>
														<option value="M3" <?= (($obrTipoData == 'M3') ? 'selected' : '') ?>>TRIMESTRAL</option>
														<option value="A1" <?= (($obrTipoData == 'A1') ? 'selected' : '') ?>>ANUAL</option>
														<option value="E"  <?= (($obrTipoData != 'M1' && $obrTipoData != 'M3' && $obrTipoData != 'A1' ) ? 'selected' : '') ?>>OUTRAS DATAS</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div id="divDptRespObrigacao" class="form-group col-md-12">
										<label class="control-label col-md-2">Depto. Responsável</label>
										<div class="col-md-10">
											<div class="col-md-3 indent-small">
												<div class="form-group internal">
													<select id="slcDeptoResponsavel" name="slcDeptoResponsavel" type="text" class="form-control"
															title="Indica o departamento responsável por enviar esta obrigação ao cliente."
															<?= (($obrTipoObr == 'I') ? 'disabled' : '') ?>>
														<option value="11" <?= (($obrDptResp == '11') ? 'selected' : '') ?>>FISCAL</option>
														<option value="21" <?= (($obrDptResp == '21') ? 'selected' : '') ?>>CONTÁBIL</option>
														<option value="31" <?= (($obrDptResp == '31') ? 'selected' : '') ?>>PESSOAL</option>
														<option value="41" <?= (($obrDptResp == '41') ? 'selected' : '') ?>>CERTIDÕES/ALVARÁS</option>
														<option value="51" <?= (($obrDptResp == '51') ? 'selected' : '') ?>>DECLARAÇÕES - DEP. FISCAL</option>
														<option value="52" <?= (($obrDptResp == '52') ? 'selected' : '') ?>>DECLARAÇÕES - DEP. CONTÁBIL</option>
														<option value="53" <?= (($obrDptResp == '53') ? 'selected' : '') ?>>DECLARAÇÕES - DEP. PESSOAL</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div id="divDataLimiteObrigacao" class="form-group col-md-12">
										<label class="control-label col-md-2">
											<?php if ($obrTipoData == 'M1') { ?>Dia <?php } else { ?>Próx. Data <?php } ?>Limite
										</label>
										<div class="col-md-10">
											<div class="col-md-3 indent-small">
												<div class="form-group internal">
													<input id="txtDataLimiteObrigacao" name="txtDataLimiteObrigacao" type="text" class="form-control"
															title="Indica o dia ou data limite para o envio desta obrigação."
															onKeyPress="mascararDataLimiteObrigacao(event);" value="<?= $obrDataLimite ?>" />
												</div>
											</div>
										</div>
									</div>
									<div id="divDataMovelObrigacao" class="form-group col-md-12">
										<label class="control-label col-md-2">
											Data Móvel?
										</label>
										<div class="col-md-10">
											<div class="col-md-1 indent-small">
												<div class="form-group internal">
													<input id="cbDataMovelObrigacao" name="cbDataMovelObrigacao" type="checkbox"
															title="Indica se a data se repetirá a cada ano ou a cada 365 dias. Válido somente para obrigações anuais ou de outras datas."
															<?= $obrDataMovelChecked ?> <?= (($obrTipoObr == 'I') ? 'disabled' : '') ?> />
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<!-- Modal de preferências -->
				            <div class="modal fade" id="mdlConfirmarGravacaoObrigacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				                <div class="modal-dialog" role="document">
				                    <div class="modal-content">
				                        <div class="modal-header alert-warning">
				                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				                            <h4 class="modal-title" id="myModalLabel">Atenção!</h4>
				                        </div>
			                            <div class="modal-body">
			                                Ao alterar a data limite, <b>todas as ocorrências</b> desta obrigação no cadastro das entidades também terão suas datas limite
			                                alteradas, a fim de refletir esta mudança. Você <b>realmente</b> tem certeza que deseja continuar com a alteração?<br><br>
			                                (Dica: para alterar a data limite desta obrigação para entidades específicas, faça a alteração diretamente na entidade.)
			                            </div>
			                            <div class="modal-footer">
			                                <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
			                                <button type="submit" class="btn btn-success">Sim</button>
			                            </div>
				                    </div>
				                </div>
				            </div> <!-- ./Modal de preferências -->
						</form>
	                    <br>
	                </div><!-- /.box -->
	            </div><!-- /.col -->
	        </div><!-- /.row -->
	        
	    </section><!-- /.content -->
	</div>
	
	<script src="<?= base_url() ?>static/js/tributacao/obrigacao.js?v=2"></script>
	<script src="<?= base_url() ?>static/js/utilidades/validador.js"></script>
	
<?php } ?>