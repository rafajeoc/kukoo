<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Kukoo</title>
        
        <!-- Responsivo -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        
        <!-- Scripts -->
        <script src="<?= base_url() ?>static/js/jQuery-2.1.4.min.js"></script>
        
        <!-- Links -->
        <link rel="stylesheet" href="<?= base_url() ?>static/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/css/ionicons.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/dist/css/skins/skin-blue.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/css/jasny-bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/css/geral.css">
        
        <!-- Plugins -->
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/iCheck/flat/blue.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/morris/morris.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        
        <div class="wrapper">
            
            <!-- Header -->
            <header class="main-header">
                
                <!-- Logo -->
                <a href="<?= base_url() ?>dashboard" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>K</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Kukoo</b></span>
                </a><!-- ./Logo -->
                
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                        <!-- Control Sidebar Toggle Button -->
                            <li><a href="" data-toggle="modal" data-target="#mdlAjuda"><i class="fa fa-question"></i> Ajuda</a></li>
                            <li><a href="" data-toggle="modal" data-target="#mdlPreferencias"><i class="fa fa-gears"></i> Alterar Senha</a></li>
                            <li><a href="" data-toggle="modal" data-target="#mdlSair"><i class="fa fa-sign-out"></i> Sair</a></li>
                        </ul>
                    </div>
                </nav>
                
            </header>
            
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?= base_url() ?>static/dist/img/avatar3.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                          <?= ucwords(strtolower($usuarioAtual->usrNome)) ?><br>
                          <a href=""><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    
                    <!-- MENU -->
                    <ul class="sidebar-menu">
                        
                        <!-- Header -->
                        <li class="header">MENU</li>
                
                        <!-- DASHBOARD -->
                        <li id="liDashboard" class="active treeview">
                            <a href="<?= base_url() ?>dashboard" onclick="mudarClasseActive('liDashboard');">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                
                        <!-- ADMINISTRATIVO -->
                        <?php if ($usuarioAtual->prmAdministrador == 1 || $usuarioAtual->prmGerClientes == 1) { ?>
                            <li id="liAdministrativo" class="treeview">
                                <a href="#">
                                    <i class="fa fa-user"></i> <span>Administrativo</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php if ($usuarioAtual->prmAdministrador == 1) { ?>
                                        <li>
                                            <a href="<?= base_url() ?>usuarios" onclick="mudarClasseActive('liAdministrativo');">
                                                <i class="fa fa-circle-o"></i> Usuários
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if ($usuarioAtual->prmAdministrador == 1 || $usuarioAtual->prmGerClientes == 1) { ?>
                                        <li>
                                            <a href="<?= base_url() ?>clientes" onclick="mudarClasseActive('liAdministrativo');">
                                                <i class="fa fa-circle-o"></i> Clientes
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                
                        <!-- TRIBUTAÇÃO -->
                        <?php if ($usuarioAtual->prmAdministrador == 1 || $usuarioAtual->prmGerObrigacoes == 1) { ?>
                            <li id="liTributacao" class="treeview">
                                <a href="#">
                                    <i class="fa fa-file-text-o"></i> <span>Tributação</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="<?= base_url() ?>obrigacoes" onclick="mudarClasseActive('liTributacao');">
                                            <i class="fa fa-circle-o"></i> Obrigações
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        
                        <!-- CONTABILIDADE -->
                        <li id="liContabilidade" class="treeview">
                            <a href="#">
                                <i class="fa fa-pencil"></i> <span>Contabilidade</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?= base_url() ?>agenda" onclick="mudarClasseActive('liContabilidade');">
                                        <i class="fa fa-circle-o"></i> Agenda
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>obrigacoes-enviadas" onclick="mudarClasseActive('liContabilidade');">
                                        <i class="fa fa-circle-o"></i> Obrigações Enviadas
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- PROTOCOLO -->
                        <?php if ($usuarioAtual->prmAdministrador == 1 || $usuarioAtual->prmGerProtocolos == 1) { ?>
                            <li id="liProtocolo" class="treeview">
                                <a href="#">
                                    <i class="fa fa-files-o"></i> <span>Protocolo</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="<?= base_url() ?>protocolos" onclick="mudarClasseActive('liProtocolo');">
                                            <i class="fa fa-circle-o"></i> Protocolos
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        
                        <!-- PARÂMETROS -->
                        <!--
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-gears"></i> <span>Parâmetros</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="< ?= base_url() ?>parametros-contabilidade">
                                        <i class="fa fa-circle-o"></i> Contabilidade
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
      
            <!-- Modal de logout -->
            <div class="modal fade" id="mdlSair" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Sair</h4>
                        </div>
                        <div class="modal-body">
                            Tem certeza que deseja sair do sistema?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                            <a href="<?php echo base_url().'sair'; ?>"><button type="button" class="btn btn-success">Sim</button></a>
                        </div>
                    </div>
                </div>
            </div> <!-- ./Modal de logout -->