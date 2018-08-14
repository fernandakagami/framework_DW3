<div class="center-block site">
  <h1 class="text-center">Edição de Pedido</h1>
  <nav>
      <a href="<?= URL_RAIZ . 'pedidos' ?>" class="btn btn-default">Voltar</a>
  </nav>
  <form action="<?= URL_RAIZ . 'pedidos/' . $pedido->getId() ?>" method="post">
    <input type="hidden" name="_metodo" value="PATCH">
    <div class="form-group">
      <label class="control-label" for="mesa">Mesa:</label>
      <input id="mesa" name="mesa" class="form-control" value="<?= $pedido->getMesa() ?>" autofocus>
    </div>
    <div class="form-group">
      <label class="control-label" for="lancheId">Tipo do lanche:</label>
      <select id="lancheId" name="lancheId" class="form-control">
        <?php foreach ($lanches as $lanche) : ?>
          <?php $selected = $pedido->getLancheId() == $lanche->getId() ? ' selected' : ''; ?>
          <option<?= $selected ?> value="<?= $lanche->getId() ?>"><?= $lanche->getNome() ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label class="control-label" for="quantidade">Quantidade de lanche:</label>
      <input id="quantidade" name="quantidade" class="form-control" value="<?= $pedido->getquantidade() ?>">
    </div>
    <button type="submit" class="btn btn-primary center-block">Alterar Pedido</button>
  </form>
</div>
