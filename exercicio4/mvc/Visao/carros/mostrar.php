<div class="center-block site">
    <h1 class="text-center">Mostrando o Veículo</h1>
    <nav>
        <a href="<?= URL_RAIZ . 'carros' ?>" class="btn btn-default">Voltar para a listagem</a>
    </nav>
    <form>
        <div class="form-group">
            <label class="control-label" for="modelo">Modelo</label>
            <input id="modelo" name="modelo" class="form-control" disabled="disabled" value="<?= $carro->getModelo() ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="precoDeCompra">Preço de Compra</label>
            <input id="precoDeCompra" name="precoDeCompra" class="form-control" disabled="disabled" value="<?= $carro->getPrecoDeCompra() ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="precoDeVenda">Preço de Venda</label>
            <input id="precoDeVenda" name="precoDeVenda" class="form-control" disabled="disabled" value="<?= $carro->getPrecoDeVenda() ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="descricao">Descrição</label>
            <input id="descricao" name="descricao" class="form-control" disabled="disabled" value="<?= $carro->getDescricao() ?>">
        </div>
    </form>
</div>
