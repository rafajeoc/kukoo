            <!-- Modal de preferências -->
            <div class="modal fade" id="mdlPreferencias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Alterar Senha</h4>
                        </div>
                        <form action="<?= base_url() ?>alterar-senha" method="post">
                            <div class="form-group modal-body">
                                <div class="form-group">
									<label class="control-label col-md-4">Senha Antiga</label>
									<div class="col-md-3">
										<div class="col-md-3 indent-small">
											<div class="form-group internal">
												<input id="txtSenhaAntiga" name="txtSenhaAntiga" type="password" />
											</div>
										</div>
									</div>
								</div><br>
								<div class="form-group">
									<label class="control-label col-md-4">Senha Nova</label>
									<div class="col-md-3">
										<div class="col-md-3 indent-small">
											<div class="form-group internal">
												<input id="txtSenhaNova" name="txtSenhaNova" type="password" />
											</div>
										</div>
									</div>
								</div><br>
								<div class="form-group">
									<label class="control-label col-md-4">Repetir Senha Nova</label>
									<div class="col-md-3">
										<div class="col-md-3 indent-small">
											<div class="form-group internal">
												<input id="txtRepetirSenhaNova" name="txtRepetirSenhaNova" type="password" />
											</div>
										</div>
									</div>
								</div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-success">Gravar</button>
                            </div>
                          </form>
                    </div>
                </div>
            </div> <!-- ./Modal de preferências -->
            
            <!-- Modal de ajuda -->
            <div class="modal fade" id="mdlAjuda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Oi! Eu sou o Kukoo e estou aqui para te ajudar!</h4>
                        </div>
                        <div class="modal-body">
                            Pelo que vi, você precisa de ajuda. Vamos lá, deixe-me explicar o que temos em nossas mãos.<br><br>
                            <strong>Do lado esquerdo,</strong> nós temos o nosso menu. No menu, encontramos o módulo de Contabilidade (onde está a Agenda),
                            e para os que são administradores, a parte Administrativa (de cadastros) e a Parametrização do sistema.<br><br>
                            <strong>Na barra azul aí de cima</strong> (a qual provavelmente está um pouco coberta por essa janela), temos esse link que
                            você clicou para abrir esta janela, um link para alteração da sua senha e um link para sair. Todas as ações desta barra azul
                            superior irão abrir uma janela como esta quando forem executadas.<br><br>
                            <strong>Lá embaixo temos o rodapé</strong>, no qual estão os direitos reservados (precisamos garantir que não vão copiar a gente!) e
                            um link para algumas considerações de uso.<br><br>
                            <strong>Na parte central</strong> é que está a área com a qual você vai interagir na maior parte do tempo. Cada link que você abrir
                            a partir do menu (ali na esquerda) vai carregar na área central.<br><br>
                            Caso tenha alguma dúvida a mais, algo que queira sugerir, ou algo que seja mais complexo, não hesite em nos contatar!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Ok, entendi!</button>
                        </div>
                    </div>
                </div>
            </div> <!-- ./Modal de ajuda -->
            
            <!-- Modal de licenças -->
            <div class="modal fade" id="mdlUso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Oi! Eu sou o Kukoo e quero te falar algumas coisas.</h4>
                        </div>
                        <div class="modal-body">
                            
                        </div>
                    </div>
                </div>
            </div> <!-- ./Modal de licenças -->
          
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Versão</b> 1.0
                </div>
                <strong>Copyright &copy; 2016 Kukoo.</strong> Todos os direitos reservados.
                <a data-toggle="modal" data-target="#mdlUso" style="cursor: pointer">Clique aqui para ver os termos de uso.</a>
            </footer>
        </div><!-- ./wrapper -->
        
        <!-- Scripts no final da página para carregar mais rápido -->
        <script src="<?= base_url() ?>static/js/utilidades/utilidades.js"></script>
        <script src="<?= base_url() ?>static/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="<?= base_url() ?>static/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script src="<?= base_url() ?>static/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="<?= base_url() ?>static/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="<?= base_url() ?>static/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <script src="<?= base_url() ?>static/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?= base_url() ?>static/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="<?= base_url() ?>static/plugins/knob/jquery.knob.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="<?= base_url() ?>static/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="<?= base_url() ?>static/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="<?= base_url() ?>static/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <script src="<?= base_url() ?>static/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="<?= base_url() ?>static/plugins/fastclick/fastclick.min.js"></script>
        <script src="<?= base_url() ?>static/dist/js/app.min.js"></script>
        <script src="<?= base_url() ?>static/js/jasny-bootstrap.min.js"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?= base_url() ?>static/dist/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?= base_url() ?>static/dist/js/demo.js"></script>
    </body>
</html>
