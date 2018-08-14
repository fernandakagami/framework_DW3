<div class="center-block site">
    <h1 class="text-center">Fotoblog</h1>
    
    <?php if ($mensagemFlash) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $mensagemFlash ?>
        </div>
    <?php endif ?>
    
    <h4>Envie uma foto</h4>
    <div class="margin-bottom">
        <form action="<?= URL_RAIZ . 'fotos' ?>" method="post" class="form-inline pull-left margin-right" enctype="multipart/form-data">
            <div class="form-group <?= $this->getErroCss('foto') ?>">
                <label class="control-label" for="foto">Foto (somente PNG)</label>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'foto']) ?>
                <input id="foto" name="foto" class="form-control" type="file">
            </div>
            <button type="submit" class="btn btn-default">Enviar foto</button>            
        </form>
         <form action="<?= URL_RAIZ . 'fotos/ranking' ?>" method="get">
            <button type="submit" class="btn btn-info">Ver Ranking</button>
        </form>
        <form action="<?= URL_RAIZ . 'login' ?>" method="post">
            <input type="hidden" name="_metodo" value="DELETE">
            <button type="submit" class="btn btn-danger">Sair</button>
        </form>
    </div>

    <h2 class="text-center">Fotos</h2>
    <?php foreach ($fotos as $foto) : ?>
        <fieldset>
            <legend></legend>
            <div class="text-center">
                <img src="<?= URL_IMG . $foto->getImagem() ?>" alt="Imagem">
            </div>            
            <div>
            <label class="control-label">Média das Notas:</label>
            <?= $foto->getMedia() ?>
            </div>
            <div>         
                <form action="<?= URL_RAIZ . 'fotos/' . $foto->getId() ?>" method="post" class="form-inline pull-left margin-right">
                    <div class="form-group <?= $this->getErroCss('nota') ?>">
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'nota']) ?>
                        <input id="nota" name="nota" class="form-control" type="text" >
                    </div>
                    <button type="submit" class="btn btn-primary">Votar</button>            
                </form>
            </div>    
        </fieldset>        
        <br>
    <?php endforeach ?>
    <div>
        <?php if ($pagina > 1) : ?>
            <a href="<?= URL_RAIZ . 'fotos?p=' . ($pagina-1) ?>" class="btn btn-default">Página anterior</a>
        <?php endif ?>
        <?php if ($pagina < $ultimaPagina) : ?>
            <a href="<?= URL_RAIZ . 'fotos?p=' . ($pagina+1) ?>" class="btn btn-default">Próxima página</a>
        <?php endif ?>
    </div>
</div>
