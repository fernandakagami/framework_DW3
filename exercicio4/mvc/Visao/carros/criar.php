<div class="center-block site">
    <h1 class="text-center">Cadastro de Veículo</h1>
    <nav>
        <a href="<?= URL_RAIZ . 'carros' ?>" class="btn btn-default">Voltar para a listagem</a>
    </nav>
    <form action="<?= URL_RAIZ . 'carros' ?>" method="post">
        <div class="form-group">
            <label class="control-label" for="modelo">Modelo *</label>
            <input id="modelo" name="modelo" class="form-control" autofocus>
        </div>
        <div class="form-group">
            <label class="control-label" for="precoDeCompra">Preço de Compra *</label>
            <input id="precoDeCompra" name="precoDeCompra" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label" for="precoDeVenda">Preço de Venda *</label>
            <input id="precoDeVenda" name="precoDeVenda" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label" for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary center-block">Cadastrar</button>
    </form>
</div>
