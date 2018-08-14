<div class="center-block site">
    <div class="col-sm-6 col-sm-offset-3">
        <h1 class="text-center">Cadastre-se no Chat!</h1>
        <form action="<?= URL_RAIZ . 'usuarios' ?>" method="post" class="margin-bottom" enctype="multipart/form-data">
            <div class="form-group <?= $this->getErroCss('email') ?>">
                <label class="control-label" for="nome">Nome</label>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'nome']) ?>
                <input id="nome" name="nome" class="form-control" autofocus value="<?= $this->getPost('nome') ?>">
            </div>
            <div class="form-group <?= $this->getErroCss('senha') ?>">
                <label class="control-label" for="senha">Senha</label>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'senha']) ?>
                <input id="senha" name="senha" class="form-control" type="password">
            </div>            
            <button type="submit" class="btn btn-primary center-block">Cadastrar-se</button>
        </form>
        <p class="text-center">
            <a href="<?= URL_RAIZ . 'login' ?>">Voltar para a tela de Login</a>
        </p>
    </div>
</div>
