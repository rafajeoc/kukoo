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
            <h1 class="pull-left">Usuários</h1>
            <form method="post" action="<?= base_url() ?>dados-usuario/novo">
                <button name="btnDadosUsuario" type="submit" value="i" class="btn btn-success pull-right">
                    <i class="fa fa-user fa-fw"></i> Novo Usuário
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
                            <input type="text" id="txtPesquisaUsuario" class="form-control" placeholder="Digite algum dado a ser buscado..." />
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="tblUsuarios" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome Completo</th>
                                        <th>CPF</th>
                                        <th>Endereço de E-mail</th>
                                        <th>Ativo?</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                    	            <?php
                    		            foreach ($usuarios as $usuario) {
        	                  		        echo '<tr>';
        	                    	        echo '<td>' . $usuario->usrId . '</td>';
        	                    	        echo '<td>' . mb_strtoupper(($usuario->usrNome), 'UTF-8') . '</td>';
        	                    	        echo '<td>' . substr_replace(substr_replace((substr_replace($usuario->usrCPF, '.', 3, 0)), '.', 7, 0), '-', 11, 0) . '</td>';
        	                    	        echo '<td>' . mb_strtoupper(($usuario->usrEmail), 'UTF-8') . '</td>';
                	                    	
        	                    	        if ($usuario->usrAtivo == 1) echo '<td><i class="fa fa-check"></i></td>';
        	                    	        else echo '<td><i class="fa fa-close"></i></td>';
        	                    	        
        	                    	        echo '<td><a href="' . (base_url().'dados-usuario/' . $usuario->usrId) . '"><i class="fa fa-edit"></i></a></td>';
        	                  		        echo '</tr>';
                      	                }
                                    ?>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
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
                        <form action="<?php echo base_url().'inativar-usuario/'.$user['usrId']; ?>" method="post">
                            <input id="idUsuario" type="hidden" value="" />
                            <div id='modal-body' class="modal-body">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                                <button type="button" class="btn btn-success">Sim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </section><!-- /.content -->
    </div>
    
    <script type="text/javascript">
        $(document).ready(function() {
            var rows = $('#tblUsuarios tbody tr');
            $('#txtPesquisaUsuario').keyup(function() {
                var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
        
                rows.show().filter(function() {
                    var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                    return !~text.indexOf(val);
                }).hide();
            });
        });
    </script>
<?php } ?>