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
            <h1 class="pull-left">Clientes</h1>
            <form method="post" action="<?php echo base_url();?>dados-cliente/novo">
                <button id="btnDadosCliente" name="btnDadosCliente" type="submit" value="i" class="btn btn-success pull-right">
                    <i class="fa fa-user fa-fw"></i> Novo Cliente
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
                            <input type="text" id="txtPesquisaCliente" class="form-control" placeholder="Digite algum dado a ser buscado..." />
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tblClientes" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Razão Social</th>
                                        <th>CNPJ</th>
                                        <th>Regime de Tributação</th>
                                        <th>Ativo?</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                    	            <?php
                    	                if (count($clientes) != 0) { // Verifica se não está vazio
                        		            foreach ($clientes as $cliente) {
            	                  		        echo '<tr>';
            	                    	        echo '<td>' . $cliente->cliId . '</td>';
            	                    	        echo '<td>' . mb_strtoupper($cliente->cliRazaoSocial, 'UTF-8') . '</td>';
            	                    	        echo '<td>' . substr_replace(substr_replace(substr_replace((substr_replace($cliente->cliCPFCNPJ, '.', 2, 0)), '.', 6, 0), '/', 10, 0), '-', 15, 0) . '</td>';
            	                    	        echo '<td>' . mb_strtoupper($cliente->rgtNome, 'UTF-8') . '</td>';
                    	                    	
            	                    	        if ($cliente->cliAtivo == 1) echo '<td><i class="fa fa-check"></i></td>';
            	                    	        else echo '<td><i class="fa fa-close"></i></td>';
            	                    	        
            	                    	        echo '<td><a href="' . (base_url().'dados-cliente/' . $cliente->cliId) . '"><i class="fa fa-edit"></i></a></td>';
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
            var rows = $('#tblClientes tbody tr');
            $('#txtPesquisaCliente').keyup(function() {
                var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
        
                rows.show().filter(function() {
                    var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                    return !~text.indexOf(val);
                }).hide();
            });
        });
    </script>
<?php } ?>