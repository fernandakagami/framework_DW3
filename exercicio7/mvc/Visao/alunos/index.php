<?php if ($sucesso) : ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= $sucesso ?>
    </div>
<?php endif ?>

<form action="<?= URL_RAIZ . 'alunos' ?>" method="post" class="margin-bottom">
    <div class="form-group <?= $this->getErroCss('nome') ?>">
        <label class="control-label" for="nome">Nome *</label>
        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'Nome']) ?>
        <input id="nome" name="nome" class="form-control" type="text">        
    </div>
    <div class="form-group <?= $this->getErroCss('nota') ?>">
        <label class="control-label" for="nota">Nota *</label>
        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'nota']) ?>
        <input id="nota" name="nota" class="form-control" type="text">
    </div>    
    <button type="submit" class="btn btn-primary center-block">Cadastrar Nota</button>
</form>
