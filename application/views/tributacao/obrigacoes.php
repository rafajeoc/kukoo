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
            <h1 class="pull-left">Obrigações</h1>
            <form method="post" action="<?php echo base_url();?>dados-obrigacao/novo">
                <button name="btnDadosObrigacao" type="submit" value="i" class="btn btn-success pull-right">
                    <i class="fa fa-file-text-o fa-fw"></i> Nova Obrigação
                </button>
            </form>
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
                                        <th>Tipo da Obrigação</th>
                                        <th>Tipo de Data</th>
                                        <th>Departamento Responsável</th>
                                        <th>Editar</th>
                                        <th>Apagar</th>
                                    </tr>
                                </thead>
                                <tbody>
                    	            <?php
                    	                if (count($obrigacoes) != -1) { // Verifica se não está vazio
                        		            foreach ($obrigacoes as $obrigacao) {
            	                  		        echo '<tr>';
            	                  		        echo '<td>'.$obrigacao->obrId.'</td>';
            	                    	        echo '<td>'.mb_strtoupper($obrigacao->obrNome, 'UTF-8').'</td>';
            	                    	        
            	                    	        if ($obrigacao->obrTipoObr == 'I') {
            	                    	            echo '<td>IMPOSTO</td>';
            	                    	        } else {
            	                    	            echo '<td>ESPECÍFICA</td>';
            	                    	        }
            	                    	        
            	                    	        if ($obrigacao->obrPeriodo == 'M') {
            	                    	            if ($obrigacao->obrRepeticao == 1) {
            	                    	                echo '<td>MENSAL</td>';
            	                    	            } else {
            	                    	                echo '<td>TRIMESTRAL</td>';
            	                    	            }
            	                    	        } else {
            	                    	            if ($obrigacao->obrRepeticao == 1) {
            	                    	                echo '<td>ANUAL</td>';
            	                    	            } else {
            	                    	                echo '<td>OUTRAS DATAS</td>';
            	                    	            }
            	                    	        }
            	                    	        
            	                    	        if ($obrigacao->obrDptResp == 11) {
            	                    	            echo '<td>FISCAL</td>';
            	                    	        } else if ($obrigacao->obrDptResp == 21) {
            	                    	            echo '<td>CONTÁBIL</td>';
            	                    	        } else if ($obrigacao->obrDptResp == 31) {
            	                    	            echo '<td>PESSOAL</td>';
            	                    	        } else if ($obrigacao->obrDptResp == 41) {
            	                    	            echo '<td>CERTIDÕES/ALVARÁS</td>';
            	                    	        } else if ($obrigacao->obrDptResp == 51) {
            	                    	            echo '<td>DECLARAÇÕES - DEP. FISCAL</td>';
            	                    	        } else if ($obrigacao->obrDptResp == 52) {
            	                    	            echo '<td>DECLARAÇÕES - DEP. CONTÁBIL</td>';
            	                    	        } else if ($obrigacao->obrDptResp == 53) {
            	                    	            echo '<td>DECLARAÇÕES - DEP. PESSOAL</td>';
            	                    	        }
            	                    	        
            	                    	        echo '<td><a href="'.(base_url().'dados-obrigacao/'.$obrigacao->obrId).'"><i class="fa fa-edit"></i></a></td>';
            	                    	        
            	                    	        if ($obrigacao->obrTipoObr != 'I') {
            	                    	            echo '<td><a href="'.(base_url().'apagar-obrigacao/'.$obrigacao->obrId).'"><i class="fa fa-close"></i></a></td>';
            	                    	        } else {
            	                    	            echo '<td></td>';
            	                    	        }
            	                    	        
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
