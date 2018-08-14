<div class="container">
  <div class="clearfix margin-bottom">
    <form action="<?= URL_RAIZ ?>" method="post" class="form-signin">
      <h4>Sistema de Pedido de Lanches</h4>
      <br>
      <div class="form-group">
          Mesa:<input id="mesa" name="mesa" class="form-control campo-form" placeholder="Mesa">
      </div>
        <br>
        <div class="form-group">
            Quantidade de lanches:<input id="quantidade" name="quantidade" class="form-control campo-form" placeholder="Lanches">
        </div>
        <br>
        <button type="submit" class="btn btn-default">Enviar pedido</button>
    </form>
  </div>
</div>
