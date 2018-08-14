<div class="center-block site">
  <h1 class="text-center">Cadastro de Novos Pedidos</h1>
  <nav>
      <a href="<?= URL_RAIZ . 'pedidos' ?>" class="btn btn-default">Voltar</a>
  </nav>
  <form action="<?= URL_RAIZ . 'pedidos' ?>" method="post">
    <div class="form-group">
      <label class="control-label" for="mesa">Mesa</label>
      <input id="mesa" name="mesa" class="form-control" autofocus>
    </div>
    <br>
    <div class="form-group">
      <label class="control-label" for="lancheId">Tipo do lanche:</label>
      <select id="lancheId" name="lancheId" class="form-control">
        <option value="">Selecione o lanche</option>
        <?php foreach ($lanches as $lanche) : ?>
          <option value="<?= $lanche->getId() ?>"><?= $lanche->getNome() ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <br>
    <div class="form-group">
        <label class="control-label" for="quantidade">Quantidade de lanche:</label>
        <input id="quantidade" name="quantidade" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary center-block">Enviar Pedido</button>
  </form>
</div>
