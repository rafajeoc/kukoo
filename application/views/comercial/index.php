<!DOCTYPE HTML>
<html>
	<head>
		<title>Kukoo</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<!-- Links -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/ionicons.min.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/form-elements.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/style3.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/index.css" />
		
		<!-- Scripts -->
		<script src="<?= base_url() ?>static/js/jquery.min.js"></script>
		<script src="<?= base_url() ?>static/js/jquery.dropotron.min.js"></script>
		<script src="<?= base_url() ?>static/js/jquery.scrollgress.min.js"></script>
		<script src="<?= base_url() ?>static/js/skel.min.js"></script>
		<script src="<?= base_url() ?>static/js/util.js"></script>
		<script src="<?= base_url() ?>static/js/main.js"></script>
		<script src="<?= base_url() ?>static/js/bootstrap.min.js"></script>
		<script src="<?= base_url() ?>static/js/jquery.backstretch.min.js"></script>
		<script src="<?= base_url() ?>static/js/scripts.js"></script>
	</head>
	
	<body class="landing">
		<header id="header" class="alt">
			<nav id="nav">
				<ul>
	                <li><a href="#inicio">Início</a></li>
	                <li><a href="#sobre">Sobre</a></li>
	                <li><a href="#planos">Planos</a></li>
	                <li><a href="" data-toggle="modal" data-target="#mdlContato" class="launch-modal">Contato</a></li>
	                <li><a href="" data-toggle="modal" data-target="#mdlLogin" class="login-button launch-modal">Entrar</a></li>
				</ul>
			</nav>
		</header>
		<section id="banner">
			<div class="inner">
				<h2>Oi. Nós somos o Kukoo.</h2>
				<p>Nossa experiência está na criação de soluções que ofereçam<br>
				inteligência nas rotinas de seu escritório de contabilidade.</p>
				<ul class="actions">
					<li><a href="#sobre" class="button special big">O que fazemos?</a></li>
				</ul>
			</div>
			<div class="browser-mockup">
				<div class="chrome">
					<span class="url">http://www.kukoo.com.br/dashboard</span>
				</div>
				<img src="<?= base_url() ?>static/dist/img/kukoo-chrome.png" alt="" />
			</div>
		</section>
		<section id="sobre" class="wrapper style1">
			<div class="container">
				<div class="row">
					<div class="4u 12u$(medium)">
						<h3 class="icon fa-tasks">Gestão de tarefas</h3>
						<p>Você não vai mais ficar sem saber o que fazer primeiro. É só cadastrar seus clientes e impostos e nós cuidaremos da agenda para você.</p>
					</div>
					<div class="4u 12u$(medium)">
						<h3 class="icon fa-users">Controle de rotinas</h3>
						<p>Não se preocupe com a divisão de tarefas. Nós garantimos que cada colaborador visualizará somente as tarefas da sua área, seja esta fiscal, contábil ou pessoal.</p>
					</div>
					<div class="4u$ 12u$(medium)">
						<h3 class="icon fa-file-o">Troca de arquivos</h3>
						<p>Cansado de enviar dezenas de e-mails por dia? Deixe o trabalho duro para a gente. Tudo o que você precisa é anexar o arquivo da guia e nós mandaremos para o seu cliente.</p>
					</div>
				</div>
			</div>
		</section>
		<section id="two" class="wrapper style2">
			<div class="container">
				<section class="spotlight left">
					<div class="row 200%">
						<div class="4u 12u$(medium)">
							<i class="fa fa-file-text fa-5x" aria-hidden="true"></i>
						</div>
						<div class="8u$ 12u$(medium)">
							<h2>Protocolo de Entrega</h2>
							<p>Tem receio de se perder com papeis e mais papeis? Não corra o 
							risco de não saber onde determinado protocolo ficou guardado. 
							Nós controlamos a entrega de documentos, emitindo um recibo, em 
							duas vias, com a relação de todos os documentos entregues a seus 
							clientes. Acha que acabou ou quer saber a parte melhor disto tudo? <br>
							<b>Eles ficarão disponíveis para reimpressão durante quanto tempo você quiser.</b></p>
						</div>
					</div>
				</section>
			</div>
		</section>
		<section id="three" class="wrapper style3">
			<div class="container">
				<div class="row 200%">
					<div class="4u 12u$(medium)">
						<h2>Por que usar o Kukoo?</h2>
						<p>Porque você...</p>
					</div>
					<div class="8u$ 12u$(medium)">
						<div class="row 200%">
							<div class="6u 12u$(xsmall)">
								<ul class="check">
									<li>Não corre o risco de se esquecer de datas</li>
									<li>Não perde tempo mandando e-mails</li>
									<li>Não perde produtividade com planilhas</li>
									<li>Não gasta tempo buscando dados a esmo</li>
								</ul>
							</div>
							<div class="6u$ 12u$(xsmall)">
								<ul class="check">
									<li>Otimiza o seu tempo</li>
									<li>Ganha velocidade de execução</li>
									<li>Mantém seus dados centralizados</li>
									<li>Automatiza o seu trabalho</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="planos" class="wrapper style4 special">
			<div class="container">
				<header class="major">
					<h2>Qual é o investimento?</h2>
					<p>Contamos com planos e preços <b>mensais</b> para todo tipo de escritório contábil.<br>
					   E a melhor parte é que eles <b>não têm custo de implantação</b>.</p>
				</header>
				<div class="plans">
					<div class="row 200% uniform">
						<div class="4u 12u$(medium)">
							<div class="plan">
								<h3>Plano K</h3>
								<ul>
									<li><strong>Cadastros e agenda contábil</strong></li>
									<li>Gerenciamento de protocolos</li>
									<li>Você se comunica com seus clientes</li>
								</ul>
								<span class="price"><strong>R$69,90</strong> / mês</span>
								<a href="" data-toggle="modal" data-target="#mdlContato" class="launch-modal button special big fit">Saiba mais</a>
							</div>
						</div>
						<div class="4u 12u$(medium)">
							<div class="plan">
								<h3>Plano K-Pro</h3>
								<ul>
									<li><strong>Cadastros e agenda contábil</strong></li>
									<li><strong>Gerenciamento de protocolos</strong></li>
									<li>Você se comunica com seus clientes</li>
								</ul>
								<span class="price"><strong>R$74,90</strong> / mês</span>
								<a href="" data-toggle="modal" data-target="#mdlContato" class="launch-modal button special big fit">Saiba mais</a>
							</div>
						</div>
						<div class="4u 12u$(medium)">
							<div class="plan">
								<h3>Plano K-Sup</h3>
								<ul>
									<li><strong>Cadastros e agenda contábil</strong></li>
									<li><strong>Gerenciamento de protocolos</strong></li>
									<li><strong>Você se comunica com seus clientes</strong></li>
								</ul>
								<span class="price"><strong>R$99,90</strong> / mês</span>
								<a href="#" class="button special big fit disabled">Em breve</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div id="footer">
			<div class="container">
				<div class="row 200%">
					<section class="8u 6u(medium) 12u$(xsmall)">
						<h3>News</h3>
						<ul class="updates">
							<li>
								<p><a href="#">Phasellus tortor magna, convallis sed felis tempor volutpat lorem quam. Phasellus lacinia.</a></p>
								<span class="timestamp">3 de Outubro de 2016</span>
							</li>
						</ul>
					</section>
					<section class="4u$ 6u$(medium) 12u$(xsmall)">
						<h3>Contato</h3>
						<ul class="labeled-icons">
							<li>
								<h4 class="icon fa-home"><span class="label">Endereço</span></h4>
								Av. Madame Curie 973 cj. 301B<br />Guarulhos | CEP 07093-040
							</li>
							<li>
								<h4 class="icon fa-phone"><span class="label">Telefone</span></h4>
								(11) xxxx-xxxx
							</li>
							<li>
								<h4 class="icon fa-facebook"><span class="label">Facebook</span></h4>
								<a href="http://www.facebook.com/kukoobr">facebook.com/kukoo</a>
							</li>
						</ul>
					</section>
				</div>
			</div>
			<ul class="copyright">
				<li>&copy; Kukoo 2016. Todos os direitos reservados.</li>
				<li><a href="" data-toggle="modal" data-target="#mdlPoliticaPriv" class="launch-modal">Política de Privacidade</a></li>
				<li><a href="" data-toggle="modal" data-target="#mdlContato" class="launch-modal">Contate-nos</a></li>
			</ul>
		</div>

        <div class="modal fade" id="mdlLogin" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        				<h3 class="modal-title" id="modal-login-label">Acesse o ambiente do seu escritório</h3>
        				<p>Entre com seu nome de usuário e sua senha:</p>
        			</div>
        			<div class="modal-body">
	                    <form method="post" action="<?= base_url() ?>validar-escritorio" class="login-form">
	                    	<div class="form-group">
	                    		<label class="sr-only" for="form-username">Username</label>
	                        	<input type="text" name="txtEscritorio" placeholder="Nome de usuário" class="form-username form-control" id="txtEscritorio">
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="form-password">Password</label>
	                        	<input type="password" name="txtSenha" placeholder="Senha" class="form-password form-control" id="txtSenha">
	                        </div>
	                        <button type="submit" class="btn">Entrar</button>
	                    </form>
        			</div>
        		</div>
        	</div>
        </div>
        <div class="modal fade" id="mdlContato" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        				<h3 class="modal-title" id="modal-login-label">Quer saber mais?</h3>
        				<p>Deixe suas informações e nós entraremos em contato em breve!</p>
        			</div>
        			<div class="modal-body">
	                    <form method="post" action="<?= base_url() ?>enviar-informacoes-inicio" class="login-form">
	                    	<div class="form-group">
	                    		<label class="sr-only" for="form-username">Seu nome</label>
	                        	<input type="text" name="txtNome" placeholder="Seu nome" class="form-username form-control" id="txtEscritorio">
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="form-password">Seu telefone</label>
	                        	<input type="text" name="txtTelefone" placeholder="Seu telefone" class="form-password form-control" id="txtSenha">
	                        </div>
	                        <div class="form-group">
	                    		<label class="sr-only" for="form-username">Seu endereço de e-mail</label>
	                        	<input type="text" name="txtEmail" placeholder="Seu endereço de e-mail" class="form-username form-control" id="txtEmail">
	                        </div>
	                        <button type="submit" class="btn">Enviar</button>
	                    </form>
        			</div>
        		</div>
        	</div>
        </div>
        <div class="modal fade" id="mdlPoliticaPriv" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        				<h3 class="modal-title" id="modal-login-label">Nós levamos a sua privacidade a sério.</h3>
        			</div>
        			<div class="modal-body" style="height: 350px; overflow-y: auto;">
        				<p>Para isso, criamos esta página, que você pode consultar sempre que tiver 
					    alguma dúvida a respeito da forma como seus dados são utilizados por nós. Da 
					    mesma forma, reconhecemos e garantimos que, em hipótese alguma, serão divulgados 
					    quaisquer informações eventualmente enviadas ao nosso site, seja por formulário, 
					    e-mail, ou qualquer outro meio.</p>
					    <p>1. Do contato - Na página inicial, disponibilizamos um formulário para 
					    entrarmos em contato a fim de sanarmos as eventuais dúvidas da parte do 
					    CONTRATANTE. Tais dados são usados somente para o estabelecimento deste contato e 
					    para relatórios e fins estatísticos desta empresa. Usaremos os dados desta forma, 
					    também, para melhorarmos a rapidez, a eficiência e a qualidade do nosso serviço.</p>
					    <p>2. Dos acessos - Todos os acessos ao nosso sistema (daqui em diante, 
					    chamado apenas de Kukoo) são registrados através de nome de usuário e endereço 
					    IP. Tais dados são guardados para fins estatísticos e de segurança, de forma que 
					    possamos garantir que as contas de usuário registradas no Kukoo estão sendo 
					    acessadas de forma segura. Usamos os dados desta forma para que você seja 
					    notificado caso suspeitemos de qualquer atividade anormal na sua conta.</p>
					    <p>3. Do sistema: guias - De acordo com as funcionalidades oferecidas, os 
					    arquivos de guias enviados para o Kukoo serão automaticamente removidos após um ano, 
					    sendo responsabilidade do CONTRATANTE manter estes arquivos guardados em seu próprio 
					    poder. As guias enviadas são utilizadas para serem redirecionadas aos clientes do 
					    CONTRATANTE, de forma que, após um ano, o Kukoo manterá somente o histórico de envio, 
					    sem a existência do arquivo propriamente dito.</p>
					    <p>4. Do sistema: protocolos - De acordo com as funcionalidades oferecidas, 
					    os protocolos gerados no Kukoo serão automaticamente removidos após a data definida 
					    pelo CONTRATANTE, sendo responsabilidade deste manter estes arquivos guardados em seu 
					    próprio poder após a remoção por parte do Kukoo. Nós não nos responsabilizamos por 
					    eventuais remoções não realizadas automaticamente pelo sistema, tendo o CONTRATANTE, 
					    desta forma, total responsabilidade sobre a operação do sistema.</p>
					    <p>5. Da solicitação de informações - Nós nunca entraremos em contato para 
					    solicitar informações confidenciais, tais como cartões de crédito, senhas de usuários e 
					    informações pessoais de usuários.</p>
					    <p>6. Dúvidas - Em caso de dúvidas, você pode nos contatar através do nosso 
					    telefone (11) xxxx-xxxx, ou através do endereço de e-mail xxx@xxxx.xxx.xxx.</p>
        			</div>
        		</div>
        	</div>
        </div>
	</body>
	
</html>
