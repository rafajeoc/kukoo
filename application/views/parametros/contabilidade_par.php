<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="pull-left">Parâmetros - Contabilidade</h1>
        <form method="post" action="<?php echo base_url();?>usuarios">
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
					<form id="frmParametrosContabilidade" method="post" action="<?php echo base_url();?>gravar-parametros-contabilidade" class="form-horizontal" role="form">
		    			<div class="panel panel-default dialog-panel">
		    				<!-- Corpo do painel -->
		    				<div class="panel-body">
		    				    
		    				    <!-- Menu -->
		    				    <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#parametrosAgenda" role="tab" data-toggle="tab">Agenda</a></li>
                                </ul>
								
								<div class="tab-content">
                                    <div class="tab-pane active" id="parametrosAgenda">
                                        <br>
                                        <!-- Agenda -->
        								<div class="form-group">
        									<div class="col-md-11 col-md-offset-1">
        										<div class="col-md-11 indent-small">
        											<div class="form-group internal">
        												Mês de carga da Agenda:
        												<select id="slcMesCargaAgenda">
        												    <option value="A">Atual</option>
        												    <option value="E">Escolher na abertura</option>
        												</select>
        											</div>
        										</div>
        									</div>
        								</div>
                                    </div>
                                    
                                    <div class="form-group">
    									<div class="col-md-11 col-md-offset-1">
    										<div class="col-md-11 indent-small">
    											<div class="form-group internal">
    						            			<button type="submit" class="btn btn-success">Gravar</button>
    						            		</div>
    						            	</div>
    						            </div>
    								</div>
                                </div>
							
							<div class="tab-pane"></div>
						</div>
					</form>
                    	
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
        
    </section><!-- /.content -->
</div>