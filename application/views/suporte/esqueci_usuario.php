        <form class="formEsqueciUsuario">
            <?php if (isset($_POST['rbUsuario']) && ($_POST['rbUsuario'] == 'nomeUsuario')) { ?>
                <h2>Certo, vamos buscar esse nome de usuário...</h2><br>
                <p>Vou buscar na minha base de dados o seu nome de usuário. Para isso, preciso do seu CPF.</p>
                <p>Você vai encontrar uma caixa de texto logo abaixo. Por favor, insira o CPF ali.</p><br>
                <p><input type="text" id="txtCPF" placeholder="CPF" onKeyPress="mascararCampo(event)"></p>
                <input type="submit" name="btnAvancar" class="btn btn-primary" value="Avançar">
            <?php } else if (isset($_POST['rbUsuario']) && ($_POST['rbUsuario'] == 'senhaUsuario')) { ?>
                <h2>Certo, vamos buscar essa senha...</h2><br>
                <p>Vou buscar na minha base de dados a sua senha. Para isso, preciso do seu endereço de e-mail.</p>
                <p>Você vai encontrar uma caixa de texto logo abaixo. Por favor, insira o endereço de e-mail ali.</p><br>
                <p><input type="text" id="txtEmail" placeholder="Endereço de e-mail"></p>
                <input type="submit" name="btnAvancar" class="btn btn-primary" value="Avançar">
            <?php } else if (isset($_POST['rbUsuario']) && ($_POST['rbUsuario'] == 'infosCertas')) { ?>
                <h2>Certo, vamos buscar essa senha...</h2><br>
                <p>Vou buscar na minha base de dados a sua senha. Para isso, preciso do seu endereço de e-mail.</p>
                <p>Você vai encontrar uma caixa de texto logo abaixo. Por favor, insira o endereço de e-mail ali.</p><br>
                <p><input type="text" id="txtEmail" placeholder="Endereço de e-mail"></p>
                <input type="submit" name="btnAvancar" class="btn btn-primary" value="Avançar">
            <?php } else if (isset($_POST['rbUsuario']) && ($_POST['rbUsuario'] == 'botaoSemAcao')) { ?>
                <h2>Certo, vamos buscar essa senha...</h2><br>
                <p>Vou buscar na minha base de dados a sua senha. Para isso, preciso do seu endereço de e-mail.</p>
                <p>Você vai encontrar uma caixa de texto logo abaixo. Por favor, insira o endereço de e-mail ali.</p><br>
                <p><input type="text" id="txtEmail" placeholder="Endereço de e-mail"></p>
                <input type="submit" name="btnAvancar" class="btn btn-primary" value="Avançar">
            <?php } else if (isset($_POST['rbUsuario']) && ($_POST['rbUsuario'] == 'outros')) { ?>
                <h2>Certo, vamos buscar essa senha...</h2><br>
                <p>Vou buscar na minha base de dados a sua senha. Para isso, preciso do seu endereço de e-mail.</p>
                <p>Você vai encontrar uma caixa de texto logo abaixo. Por favor, insira o endereço de e-mail ali.</p><br>
                <p><input type="text" id="txtEmail" placeholder="Endereço de e-mail"></p>
                <input type="submit" name="btnAvancar" class="btn btn-primary" value="Avançar">
            <?php } ?>
        </form>