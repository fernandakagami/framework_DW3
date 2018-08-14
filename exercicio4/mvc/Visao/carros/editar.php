<div class="center-block site">
    <h1 class="text-center">Edição de Veículo</h1>
    <nav>
        <a href="<?= URL_RAIZ . 'carros' ?>" class="btn btn-default">Voltar para a listagem</a>
    </nav>
    <form action="<?= URL_RAIZ . 'carros/' . $carro->getId() ?>" method="post">
        <input type="hidden" name="_metodo" value="PATCH">
        <div class="form-group">
            <label class="control-label" for="modelo">Modelo</label>
            <input id="modelo" name="modelo" class="form-control" value="<?= $carro->getModelo() ?>" autofocus>
        </div>
        <div class="form-group">
            <label class="control-label" for="precoDeCompra">Preço de Compra</label>
            <input id="precoDeCompra" name="precoDeCompra" class="form-control" value="<?= $carro->getPrecoDeCompra() ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="precoDeVenda">Preço de Venda</label>
            <input id="precoDeVenda" name="precoDeVenda" class="form-control" value="<?= $carro->getPrecoDeVenda() ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="descricao">Descrição</label>
            <input id="descricao" name="descricao" class="form-control" value="<?= $carro->getdescricao() ?>">
        </div>
        <button type="submit" class="btn btn-primary center-block">Editar</button>
    </form>
</div>
