      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Dashboard</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Small boxes com os impostos referentes aos períodos: dia, semana e mês -->
          <div class="row">
            
            <!-- Impostos do dia -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>4 <sup style="font-size: 20px">Impostos</sup></h3>
                  <p>Para Enviar Hoje</p><br>
                </div>
                <a href="#" data-toggle="modal" data-target="#mdlImpostosHoje" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            
            <!-- Impostos da semana -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>14 <sup style="font-size: 20px">Impostos</sup></h3>
                  <p>Para Enviar Esta Semana</p><br>
                </div>
                <a href="#" data-toggle="modal" data-target="#mdlImpostosSemana" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            
            <!-- Impostos da semana -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>46 <sup style="font-size: 20px">Impostos</sup></h3>
                  <p>Para Enviar Este Mês</p><br>
                </div>
                <a href="#" data-toggle="modal" data-target="#mdlImpostosMes" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px">%</sup></h3>
                  <p>É o que você completou do seu mês até agora</p>
                </div>
                <a href="#" data-toggle="modal" data-target="#mdlPorcentagemMes" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            
          </div><!-- /.row -->
          
          <!-- Modals -->
          <div class="modal fade" id="mdlImpostosHoje" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Impostos restantes para hoje</h4>
                      </div>
                      <div class="modal-body">
                          Este quadro indica quantos impostos restam para entregar hoje, de acordo com a sua agenda.<br><br>
                          Para visualizar sua agenda, acesse, no menu à esquerda, o caminho <b>"Contabilidade > Agenda"</b>.
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Ok, entendi!</button>
                      </div>
                  </div>
              </div>
          </div>
          
          <div class="modal fade" id="mdlImpostosSemana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Impostos restantes para esta semana</h4>
                      </div>
                      <div class="modal-body">
                          Este quadro indica quantos impostos restam para entregar nesta semana, de acordo com a sua agenda.<br><br>
                          Para visualizar sua agenda, acesse, no menu à esquerda, o caminho <b>"Contabilidade > Agenda"</b>.
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Ok, entendi!</button>
                      </div>
                  </div>
              </div>
          </div>
          
          <div class="modal fade" id="mdlImpostosMes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Impostos restantes para este mês</h4>
                      </div>
                      <div class="modal-body">
                          Este quadro indica quantos impostos restam para entregar neste mês, de acordo com a sua agenda.<br><br>
                          Para visualizar sua agenda, acesse, no menu à esquerda, o caminho <b>"Contabilidade > Agenda"</b>.
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Ok, entendi!</button>
                      </div>
                  </div>
              </div>
          </div>
          
          <div class="modal fade" id="mdlPorcentagemMes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Porcentagem de conclusão do mês</h4>
                      </div>
                      <div class="modal-body">
                          Este quadro indica, em porcentagem, qual é o seu nível de conclusão deste mês.<br><br>
                          O cálculo que o Kukoo faz para chegar neste valor é composto pelo <b>total de impostos enviados</b>
                          dividido pelo <b>total de impostos para todos os seus clientes</b>.
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Ok, entendi!</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- /Modals -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->