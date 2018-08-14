<div class="center-block site">
    <h1 class="text-center">Ranking das Fotos</h1>
    <form action="<?= URL_RAIZ . 'fotos' ?>" method="get">
        <button type="submit" class="btn btn-default">Voltar</button>
    </form>
    <?php if (empty($fotos)) : ?>
        <div class="text-center">
            Nenhuma foto rankeada.
        </div>
    <?php endif ?>
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
        </fieldset>        
    <?php endforeach ?>