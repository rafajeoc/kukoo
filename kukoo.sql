-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------
-- --------------------------------------------------                                                                        -----------------------------------------
-- --------------------------------------------------           SCRIPT   : kukooDBP.sql                                      -----------------------------------------
-- --------------------------------------------------           DESCRIÇÃO: Criação da estrutura inicial do sistema           -----------------------------------------
-- --------------------------------------------------                                                                        -----------------------------------------
-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------


-- ----------------------------------------------------
-- 1) CREATE DATABASE                             -----
-- ----------------------------------------------------
CREATE DATABASE IF NOT EXISTS kukooDBP;
USE kukooDBP;


-- ----------------------------------------------------
-- 2) CREATE TABLES - GERAL                       -----
-- ----------------------------------------------------
/*
 * TABELA   : admEscritorio
 * DESCRIÇÃO: Tabela que guarda os escritórios.
 */
CREATE TABLE IF NOT EXISTS kukooDBP.admEscritorio (
	escId           BIGINT       NOT NULL,
	escCPFCNPJ      VARCHAR(14)  NOT NULL,
	escRazaoSocial  VARCHAR(200) NOT NULL,
	escNomeFantasia VARCHAR(200) NOT NULL,
	escTelefone1    VARCHAR(15)  NOT NULL,
	escTelefone2    VARCHAR(15),
	escEndereco     VARCHAR(150) NOT NULL,
	escNumero       INT          NOT NULL,
	escComplemento  VARCHAR(50)  NOT NULL,
	escBairro       VARCHAR(60)  NOT NULL,
	escMunicipio    VARCHAR(60)  NOT NULL,
	escUF           CHAR(2)      NOT NULL,
	escAtivo        TINYINT(1)   NOT NULL,
	PRIMARY KEY (escId),
	UNIQUE (escCPFCNPJ)
);


/*
 * TABELA   : segEH
 * DESCRIÇÃO: Guarda as senhas de cada escritório juntamente com o hash de identificação.
 */
CREATE TABLE IF NOT EXISTS kukooDBP.segEH (
	e BIGINT      NOT NULL,
	p VARCHAR(64) NOT NULL,
	h VARCHAR(10) NOT NULL,
	PRIMARY KEY (e),
	UNIQUE (h)
);


/*
 * TABELA   : triRegimeTributacao
 * DESCRIÇÃO: Guarda os regimes de tributação existentes no sistema.
 */
CREATE TABLE IF NOT EXISTS kukooDBP.triRegimeTributacao (
	rgtId   INT         NOT NULL,
	rgtNome VARCHAR(50) NOT NULL,
	PRIMARY KEY (rgtId)
);


-- Insere um escritório novo.
INSERT INTO kukooDBP.admEscritorio VALUES (1, '19965002000143', 'ESCRITÓRIO 1 LTDA', 'ESCRITÓRIO 1', 
'1140247542', '', 'RUA GERSON MENDES', 126, 'SALA 2', 'ITU NOVO CENTRO', 'ITU', 'SP', 1);

-- Insere na tabela seg_eh o par chave/valor.
INSERT INTO kukooDBP.segEH VALUES (1, SHA2('kukoo', 256), SUBSTR(SHA2('1', 256), 1, 10));

-- Aqui vai começar a montar as tabelas de acordo com o usuário.
SET @e_h = CONCAT('_', (SELECT h FROM kukooDBP.segEH ORDER BY e DESC LIMIT 1));


-- ----------------------------------------------------
-- 3) CREATE TABLES - ESPECÍFICAS                 -----
-- ----------------------------------------------------
/*
 * TABELA   : admUsuario
 * DESCRIÇÃO: Guarda os usuários existentes no sistema.
 */
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS kukooDBP.admUsuario', @e_h, ' (
	usrId    INT          NOT NULL,
	usrNome  VARCHAR(150) NOT NULL,
	usrCPF   VARCHAR(11)  NOT NULL,
	usrEmail VARCHAR(100) NOT NULL,
	usrSenha VARCHAR(64)  NOT NULL,
	usrAtivo TINYINT(1)          NOT NULL,
	PRIMARY KEY (usrId),
	UNIQUE (usrCPF),
	UNIQUE (usrEmail)
);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;


/*
 * TABELA: admDepartamentoUsuario
 * DESCRIÇÃO: Guarda os departamentos aos quais cada usuário pertence.
 */
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS kukooDBP.admDepartamentoUsuario', @e_h, ' (
	usrId       INT NOT NULL,
	dptFiscal   TINYINT(1) NOT NULL,
	dptContabil TINYINT(1) NOT NULL,
	dptPessoal  TINYINT(1) NOT NULL,
	dptCertAlv  TINYINT(1) NOT NULL,
	dptDecFis   TINYINT(1) NOT NULL,
	dptDecCtb   TINYINT(1) NOT NULL,
	dptDecPes   TINYINT(1) NOT NULL,
	PRIMARY KEY (usrId),
	FOREIGN KEY (usrId) REFERENCES kukooDBP.admUsuario', @e_h, ' (usrId) ON DELETE CASCADE
);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;


/*
 * TABELA: admPermissaoUsuario
 * DESCRIÇÃO: Guarda as permissões de cada usuário.
 */
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS kukooDBP.admPermissaoUsuario', @e_h, ' (
	usrId            INT NOT NULL,
	prmAdministrador TINYINT(1) NOT NULL,
	prmGerObrigacoes TINYINT(1) NOT NULL,
	prmGerClientes  TINYINT(1) NOT NULL,
	prmGerProtocolos TINYINT(1) NOT NULL,
	PRIMARY KEY (usrId),
	FOREIGN KEY (usrId) REFERENCES kukooDBP.admUsuario', @e_h, ' (usrId) ON DELETE CASCADE
);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;


-- Insere um usuário novo.
INSERT INTO kukooDBP.admUsuario_6b86b273ff VALUES (1, 'RAFAEL CANTONI AUGUSTO', '21322448809', 'RCAUGUSTO@OUTLOOK.COM', SHA2('1', 256), 1);
INSERT INTO kukooDBP.admDepartamentoUsuario_6b86b273ff VALUES (1, 1, 1, 1, 1, 1, 1, 1);
INSERT INTO kukooDBP.admPermissaoUsuario_6b86b273ff VALUES (1, 1, 1, 1, 1);


/*
 * TABELA   : triObrigacao
 * DESCRIÇÃO: Guarda a definição dos impostos existentes no sistema.
 *
 * Tipos de obrigação: (I - Imposto / E - Específica)
 * Tipos de período:   (M - Mês / A - Ano)
 */
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS kukooDBP.triObrigacao', @e_h, ' (
	obrId        INT          NOT NULL,
	obrNome      VARCHAR(100) NOT NULL,
	obrTipoObr   CHAR(1)      NOT NULL,
	obrPeriodo   CHAR(1)      NOT NULL,
	obrRepeticao INT          NOT NULL,
	obrDptResp   INT          NOT NULL,
	obrDataMovel TINYINT(1)   NOT NULL,
	PRIMARY KEY (obrId)
);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;


/*
 * TABELA   : triRegimeTributacaoObrigacao
 * DESCRIÇÃO: Guarda quais impostos estão contemplados em determinado regime de tributação.
 */
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS kukooDBP.triRegimeTributacaoObrigacao', @e_h, ' (
	rgtobrId INT NOT NULL,
	rgtId    INT NOT NULL,
	obrId    INT NOT NULL,
	PRIMARY KEY (rgtobrId),
	FOREIGN KEY (rgtId) REFERENCES kukooDBP.triRegimeTributacao (rgtId) ON DELETE CASCADE,
	FOREIGN KEY (obrId) REFERENCES kukooDBP.triObrigacao', @e_h, ' (obrId) ON DELETE CASCADE
);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;


/*
 * TABELA: admCliente
 * DESCRIÇÃO: Guarda as entidades existentes no sistema.
 */
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS kukooDBP.admCliente', @e_h, ' (
	cliId           BIGINT       NOT NULL,
	cliRazaoSocial  VARCHAR(200) NOT NULL,
	cliNomeFantasia VARCHAR(200) NOT NULL,
	cliCPFCNPJ      VARCHAR(14)  NOT NULL,
	cliEmail        VARCHAR(100) NOT NULL,
	cliTelefone1    VARCHAR(11)  NOT NULL,
	cliTelefone2    VARCHAR(11),
	cliCEP          VARCHAR(8)   NOT NULL,
	cliLogradouro   VARCHAR(200) NOT NULL,
	cliNumero       INT          NOT NULL,
	cliComplemento  VARCHAR(50)  NOT NULL,
	cliBairro       VARCHAR(100) NOT NULL,
	cliMunicipio    VARCHAR(100) NOT NULL,
	cliUF           CHAR(2)      NOT NULL,
	cliAtivo        TINYINT(1)          NOT NULL,
	rgtId           INT          NOT NULL,
	PRIMARY KEY (cliId),
	FOREIGN KEY (rgtId) REFERENCES kukooDBP.triRegimeTributacao (rgtId) ON DELETE CASCADE,
	UNIQUE (cliCPFCNPJ)
);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;


/*
 * TABELA: tri_impostodatavariavel
 * DESCRIÇÃO: Guarda os dias limite dos impostos de data variável.
 *
 * Obs.: Só preenche a coluna de mês limite caso o imposto seja anual ou outra data específica.
 */
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS kukooDBP.triObrigacaoData', @e_h, ' (
	obrId        INT NOT NULL,
	odtDiaLimite INT NOT NULL,
	odtMesLimite INT,
	odtAnoLimite INT,
	PRIMARY KEY (obrId),
	FOREIGN KEY (obrId) REFERENCES kukooDBP.triObrigacao', @e_h, ' (obrId) ON DELETE CASCADE
);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;


/*
 * TABELA: admClienteObrigacaoData
 * DESCRIÇÃO: Indica quais entidades pagam quais obrigações.
 *
 * Obs.: Só preenche as colunas de mês limite e próximo mês limite caso o imposto seja anual ou outra data específica.
 *       O motivo de existir próximo dia limite é para que os impostos que têm data móvel (365 dias corridos, em vez de 1 ano) sejam calculados facilmente.
 */
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS kukooDBP.admClienteObrigacaoData', @e_h, ' (
	cliodtId            BIGINT NOT NULL,
	cliId               BIGINT NOT NULL,
	obrId               INT    NOT NULL,
	cliodtDiaLimite     INT    NOT NULL,
	cliodtMesLimite     INT,
	cliodtAnoLimite     INT,
	cliodtProxDiaLimite INT    NOT NULL,
	cliodtProxMesLimite INT,
	cliodtProxAnoLimite INT,
	PRIMARY KEY(cliodtId),
	FOREIGN KEY(cliId) REFERENCES kukooDBP.admCliente', @e_h, ' (cliId) ON DELETE CASCADE,
	FOREIGN KEY(obrId) REFERENCES kukooDBP.triObrigacaoData', @e_h, ' (obrId) ON DELETE CASCADE,
	UNIQUE(cliId, obrId)
);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;


/*
 * TABELA   : ctbObrigacaoClienteOdt
 * DESCRIÇÃO: Guarda as obrigações de cada Cliente.
 */
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS kukooDBP.ctbObrigacaoClienteOdt', @e_h, ' (
	obrcodId         BIGINT       NOT NULL,
	cliodtId         BIGINT       NOT NULL,
	obrcodHashDoc    VARCHAR(64)  NOT NULL,
	obrcodMesRef     INT          NOT NULL,
	obrcodCaminhoArq VARCHAR(256) NOT NULL,
	PRIMARY KEY(obrcodId),
	FOREIGN KEY(cliodtId) REFERENCES kukooDBP.admClienteObrigacaoData', @e_h, ' (cliodtId) ON DELETE CASCADE,
	UNIQUE(obrcodHashDoc)
);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;


/*
 * TABELA   : ctbAgendaObrigacao
 * DESCRIÇÃO: Guarda a agenda para o mês corrente.
 *
 * Status possíveis (agn_statusimp):
 *   0 = Não enviado (em dia)
 *   1 = Enviado (não acessado)
 *   2 = Enviado (acessado)
 *   3 = Não enviado (dia limite vencido)
 */
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS kukooDBP.ctbAgendaObrigacao', @e_h, ' (
	agnobrId          BIGINT   NOT NULL,
	obrcodId          BIGINT   NOT NULL,
	agnobrStatusObr   TINYINT(1)      NOT NULL,
	agnobrDtHrEnvio   DATETIME NOT NULL,
	agnobrDtHrAcesso  DATETIME,
	agnobrDtHrAcesso2 DATETIME,
	PRIMARY KEY (agnobrId),
	FOREIGN KEY (obrcodId) REFERENCES kukooDBP.ctbObrigacaoClienteOdt', @e_h, ' (obrcodId) ON DELETE CASCADE
);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;


/*
 * TABELA: proProtocolo
 * DESCRIÇÃO: Guarda os protocolos.
 */
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS kukooDBP.proProtocolo', @e_h, ' (
	proId          BIGINT        NOT NULL,
	cliId          BIGINT        NOT NULL,
	proDtHrEmissao DATETIME      NOT NULL,
	proImpresso    TINYINT(1)           NOT NULL,
	proAssunto     VARCHAR(256)  NOT NULL,
	proDescricao   VARCHAR(1000) NOT NULL,
	PRIMARY KEY (proId),
	FOREIGN KEY (cliId) REFERENCES kukooDBP.admCliente', @e_h, ' (cliId) ON DELETE CASCADE
);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;


/*
 * TABELA: seg_detalhesLoginUsuarios
 * DESCRIÇÃO: Guarda os detalhes de login dos usuários.
 */
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS kukooDBP.segDetLoginUsuario', @e_h, ' (
	usrId           INT         NOT NULL,
	dluUltimoLogin  DATETIME,
	dluIpUltLogin   VARCHAR(15),
	dluLogado       TINYINT(1)         NOT NULL,
	PRIMARY KEY(usrId),
	FOREIGN KEY(usrId) REFERENCES kukooDBP.admUsuario', @e_h, ' (usrId) ON DELETE CASCADE
);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;
INSERT INTO kukooDBP.segDetLoginUsuario_6b86b273ff VALUES (1, NULL, '', 0);


/*
 * TABELA: segModulos
 * DESCRIÇÃO: Guarda os módulos existentes no sistema.
 */
CREATE TABLE IF NOT EXISTS kukooDBP.segModulo (
	modId   INT         NOT NULL AUTO_INCREMENT,
	modNome VARCHAR(40) NOT NULL,
	PRIMARY KEY (modId)
);
INSERT INTO kukooDBP.segModulo (modNome) values('CONTABILIDADE');
INSERT INTO kukooDBP.segModulo (modNome) values('PROTOCOLO');
INSERT INTO kukooDBP.segModulo (modNome) values('SUPORTE');
INSERT INTO kukooDBP.segModulo (modNome) values('FINANCEIRO');


/*
 * TABELA: segEscritorioModulo
 * DESCRIÇÃO: Guarda os usuários existentes no sistema.
 */
SET @query = CONCAT('CREATE TABLE IF NOT EXISTS kukooDBP.segEscritorioModulo', @e_h, ' (
	escId       BIGINT NOT NULL,
	modId       INT    NOT NULL,
	escmodAtivo TINYINT(1)    NOT NULL,
	FOREIGN KEY (escId) REFERENCES kukooDBP.admEscritorio (escId) ON DELETE CASCADE,
	FOREIGN KEY (modId) REFERENCES kukooDBP.segModulo (modId) ON DELETE CASCADE
);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;
SET @esc = 1;
SET @query = CONCAT('INSERT INTO kukooDBP.segEscritorioModulo', @e_h, ' (escId, modId, escmodAtivo) VALUES (', @esc, ', 1, 1), (', @esc, ', 2, 0), (', @esc, ', 3, 0), (', @esc, ', 4, 0);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;


-- ---------------------------
-- 3) INSERT INTO
-- ---------------------------


-- TABELA: triRegimeTributacao
INSERT INTO kukooDBP.triRegimeTributacao
VALUES (1, 'MEI'), (2, 'SIMPLES NACIONAL'), (3, 'LUCRO PRESUMIDO'), (4, 'LUCRO REAL');


-- TABELA: triObrigacao
SET @query = CONCAT('INSERT INTO kukooDBP.triObrigacao', @e_h, ' VALUES 
	-- Fiscal
	(1, \'COFINS\', \'I\', \'M\', 1, 11, 0),
	(2, \'CSLL (RET. PIS, COFINS, CSLL)\', \'I\', \'M\', 1, 11, 0),
	(3, \'DAS\', \'I\', \'M\', 1, 11, 0),
	(4, \'ICMS-ST\', \'I\', \'M\', 1, 11, 0), 
	(5, \'ICMS DIF. ALÍQUOTA\', \'I\', \'M\', 1, 11, 0), 
	(6, \'IPI 1\', \'I\', \'M\', 1, 11, 0),
	(7, \'IPI 2\', \'I\', \'M\', 1, 11, 0),
	(8, \'IPI 3\', \'I\', \'M\', 1, 11, 0),
	(9, \'ISS\', \'I\', \'M\', 1, 11, 0),
	(10, \'PIS/PASEP\', \'I\', \'M\', 1, 11, 0),
	
	-- Contábil
	(11, \'CIDE-COMBUSTÍVEL\', \'I\', \'M\', 1, 21, 0),
	(12, \'CSLL (Mensal)\', \'I\', \'M\', 1, 21, 0),
	(13, \'CSLL (Trimestral)\', \'I\', \'M\', 3, 21, 0),
	(14, \'I.E.\', \'I\', \'M\', 1, 21, 0),
	(15, \'IOF\', \'I\', \'M\', 1, 21, 0),
	(16, \'IRPJ (Mensal)\', \'I\', \'M\', 1, 21, 0),
	(17, \'IRPJ (Trimestral)\', \'I\', \'M\', 3, 21, 0),
	(18, \'IRRF\', \'I\', \'M\', 1, 21, 0),
	
	-- Pessoal
	(19, \'CARTÃO DE PONTO\', \'I\', \'M\', 1, 31, 0),
	(20, \'FOLHA DE PAGAMENTO\', \'I\', \'M\', 1, 31, 0),
	(21, \'GPS\', \'I\', \'M\', 1, 31, 0),
	(22, \'GPS AUTÔNOMO\', \'I\', \'M\', 1, 31, 0),
	(23, \'HOLERITES\', \'I\', \'M\', 1, 31, 0),
	(24, \'INSS RETIDO NA FONTE\', \'I\', \'M\', 1, 31, 0),
	(25, \'IRRF\', \'I\', \'M\', 1, 31, 0),
	(26, \'PIS S/ FOLHA\', \'I\', \'M\', 1, 31, 0),
	(27, \'SEFIP\', \'I\', \'M\', 1, 31, 0),
	(28, \'VALE TRANSPORTE\', \'I\', \'M\', 1, 31, 0),
	(29, \'VALE REFEIÇÃO\', \'I\', \'M\', 1, 31, 0),
	(30, \'VALE CESTA BÁSICA\', \'I\', \'M\', 1, 31, 0),

	-- Certidões e Alvarás
	(31, \'AVCB\', \'I\', \'A\', 1, 41, 1),
	(32, \'CERTIFICADO DIGITAL A1\', \'I\', \'A\', 1, 41, 1),
	(33, \'CERTIFICADO DIGITAL A3\', \'I\', \'A\', 3, 41, 1),
	(34, \'CRF\', \'I\', \'A\', 1, 41, 1),
	(35, \'CTM\', \'I\', \'A\', 1, 41, 1),
	(36, \'DÉBITOS TRABALHISTAS\', \'I\', \'A\', 1, 41, 1),
	(37, \'DÉBITOS TRIBUTÁRIOS\', \'I\', \'A\', 1, 41, 1),
	(38, \'FALÊNCIA E CONCORDATA\', \'I\', \'A\', 1, 41, 1),
	(39, \'LICENÇA FUNCIONAMENTO\', \'I\', \'A\', 1, 41, 1),
	(40, \'TRIBUTOS FEDERAIS\', \'I\', \'A\', 1, 41, 1),
	
	-- Declarações - Dep. Fiscal
	(41, \'DASN - SIMEI\', \'I\', \'A\', 1, 51, 1),
	(42, \'DCP\', \'I\', \'A\', 1, 51, 1),
	(43, \'DIPI\', \'I\', \'A\', 1, 51, 1),
	(44, \'DSN\', \'I\', \'A\', 1, 51, 1),
	(45, \'EFD\', \'I\', \'A\', 1, 51, 1),
	(46, \'GIA\', \'I\', \'M\', 1, 51, 0),
	(47, \'GIA ST\', \'I\', \'M\', 1, 51, 0),
	(48, \'PDGAS-D\', \'I\', \'A\', 1, 51, 1),

	-- Declarações - Dep. Contábil
	(49, \'BALANCETE\', \'I\', \'M\', 1, 52, 0),
	(50, \'BALANÇO\', \'I\', \'M\', 1, 52, 0),
	(51, \'DCTF\', \'I\', \'M\', 1, 52, 0),
	(52, \'DEREX\', \'I\', \'M\', 1, 52, 0),
	(53, \'DIRF\', \'I\', \'M\', 1, 52, 0),
	(54, \'DOI\', \'I\', \'M\', 1, 52, 0),
	(55, \'DPREV\', \'I\', \'M\', 1, 52, 0),
	(56, \'ECD\', \'I\', \'M\', 1, 52, 0),
	(57, \'ECF\', \'I\', \'M\', 1, 52, 0),
	(58, \'EFD - CONTRIBUIÇÕES\', \'I\', \'M\', 1, 52, 0),
	(59, \'FCONT\', \'I\', \'M\', 1, 52, 0),
	(60, \'IRPF\', \'I\', \'M\', 1, 52, 0),
	(61, \'IRPJ\', \'I\', \'M\', 1, 52, 0),
	(62, \'PJ-INATIVA\', \'I\', \'M\', 1, 52, 0),
	
	-- Declarações - Dep. Pessoal
	(63, \'CAGED\', \'I\', \'A\', 1, 53, 0),
	(64, \'e-SOCIAL\', \'I\', \'A\', 1, 53, 0),
	(65, \'RAIS\', \'I\', \'A\', 1, 53, 0),
	(66, \'RAIS NEGATIVA\', \'I\', \'A\', 1, 53, 0);
');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;

	
	
-- TABELA: triRegimeTributacao_imposto
SET @query = CONCAT('INSERT INTO kukooDBP.triRegimeTributacaoObrigacao', @e_h, ' VALUES
	-- MEI
	(1, 1, 3), (2, 1, 19), (3, 1, 20), (4, 1, 21), (5, 1, 22), (6, 1, 23), (7, 1, 24), (8, 1, 25), (9, 1, 26),
	(10, 1, 27), (11, 1, 28), (12, 1, 29), (13, 1, 30), (14, 1, 41), (15, 1, 63), (16, 1, 64), (17, 1, 65), (18, 1, 66),
	
	-- Simples Nacional
	(19, 2, 3), (20, 2, 4), (21, 2, 5), (22, 2, 9), (23, 2, 19), (24, 2, 20), (25, 2, 21), (26, 2, 22), (27, 2, 23), (28, 2, 24), (29, 2, 25), 
	(30, 2, 26), (31, 2, 27), (32, 2, 28), (33, 2, 29), (34, 2, 30), (35, 2, 31), (36, 2, 32), (37, 2, 34), (38, 2, 35), (39, 2, 36), (40, 2, 37), 
	(41, 2, 38), (42, 2, 39), (43, 2, 40), (44, 2, 41), (45, 2, 47), (46, 2, 48), (47, 2, 63), (48, 2, 64), (49, 2, 65), (50, 2, 66),
	
	-- Lucro Presumido
	(51, 3, 1), (52, 3, 2), (53, 3, 4), (54, 3, 5), (55, 3, 6), (56, 3, 7), (57, 3, 8), (58, 3, 9), (59, 3, 10), (60, 3, 11),
	(61, 3, 12), (62, 3, 13), (63, 3, 14), (64, 3, 15), (65, 3, 16), (66, 3, 17), (67, 3, 18), (68, 3, 19), (69, 3, 20), (70, 3, 21),
	(71, 3, 22), (72, 3, 23), (73, 3, 24), (74, 3, 25), (75, 3, 26), (76, 3, 27), (77, 3, 28), (78, 3, 29), (79, 3, 30), (80, 3, 31),
	(81, 3, 32), (82, 3, 34), (83, 3, 35), (84, 3, 36), (85, 3, 37), (86, 3, 38), (87, 3, 39), (88, 3, 40), (89, 3, 42), (90, 3, 43), 
	(91, 3, 44), (92, 3, 45), (93, 3, 46), (94, 3, 47), (95, 3, 49), (96, 3, 50), (97, 3, 51), (98, 3, 52), (99, 3, 53), (100, 3, 54), 
	(101, 3, 55), (102, 3, 56), (103, 3, 57), (104, 3, 58), (105, 3, 59), (106, 3, 60), (107, 3, 61), (108, 3, 62), (109, 3, 63), 
	(110, 3, 64), (111, 3, 65), (112, 3, 66),
	
	-- Lucro Real
	(113, 4, 1), (114, 4, 2), (115, 4, 4), (116, 4, 5), (117, 4, 6), (118, 4, 7), (119, 4, 8), (120, 4, 9), 
	(121, 4, 10), (122, 4, 11), (123, 4, 12), (124, 4, 14), (125, 4, 15), (126, 4, 16), (127, 4, 18), (128, 4, 19), (129, 4, 20), (130, 4, 21), 
	(131, 4, 22), (132, 4, 23), (133, 4, 24), (134, 4, 25), (135, 4, 26), (136, 4, 27), (137, 4, 28), (138, 4, 29), (139, 4, 30), (140, 4, 31), 
	(141, 4, 32), (142, 4, 34), (143, 4, 35), (144, 4, 36), (145, 4, 37), (146, 4, 38), (147, 4, 39), (148, 4, 40), (149, 4, 42), (150, 4, 43), 
	(151, 4, 44), (152, 4, 45), (153, 4, 46), (154, 4, 47), (155, 4, 49), (156, 4, 50), (157, 4, 51), (158, 4, 52), (159, 4, 53), (160, 4, 54), 
	(161, 4, 55), (162, 4, 56), (163, 4, 57), (164, 4, 58), (165, 4, 59), (166, 4, 60), (167, 4, 61), (168, 4, 62), (169, 4, 63), (170, 4, 64), 
	(171, 4, 65), (172, 4, 66);
');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;


-- TABELA: kukooDBP.triObrigacaoData
SET @query = CONCAT('INSERT INTO kukooDBP.triObrigacaoData', @e_h, ' VALUES
	(1, 1, null, null), (2, 1, null, null), (3, 1, null, null), (4, 1, null, null), (5, 1, null, null),
	(6, 1, null, null), (7, 1, null, null), (8, 1, null, null), (9, 1, null, null), (10, 1, null, null),
	(11, 1, null, null), (12, 1, null, null), (13, 1, null, null), (14, 1, null, null), (15, 1, null, null),
	(16, 1, null, null), (17, 1, null, null), (18, 1, null, null), (19, 1, null, null), (20, 1, null, null),
	(21, 1, null, null), (22, 1, null, null), (23, 1, null, null), (24, 1, null, null), (25, 1, null, null),
	(26, 1, null, null), (27, 1, null, null), (28, 1, null, null), (29, 1, null, null), (30, 1, null, null),
	(31, 1, 1, null), (32, 1, 1, null), (33, 1, 1, null), (34, 1, 1, null), (35, 1, 1, null), 
	(36, 1, 1, null), (37, 1, 1, null), (38, 1, 1, null), (39, 1, 1, null), (40, 1, 1, null), 
	(41, 1, 1, null), (42, 1, 1, null), (43, 1, 1, null), (44, 1, 1, null), (45, 1, 1, null),
	(46, 1, null, null), (47, 1, null, null), (48, 1, 1, null), (49, 1, null, null), (50, 1, null, null),
	(51, 1, null, null), (52, 1, null, null), (53, 1, null, null), (54, 1, null, null), (55, 1, null, null),
	(56, 1, null, null), (57, 1, null, null), (58, 1, null, null), (59, 1, null, null), (60, 1, null, null),
	(61, 1, null, null), (62, 1, null, null), (63, 1, 1, null), (64, 1, 1, null), (65, 1, 1, null), (66, 1, 1, null);');
PREPARE stmt1 FROM @query;
EXECUTE stmt1;
DEALLOCATE PREPARE stmt1;
