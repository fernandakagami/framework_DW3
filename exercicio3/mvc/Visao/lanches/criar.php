<div class="center-block site">
  <h1 class="text-center">Cadastro de Novos Lanches</h1>
  <nav>
    <a href="<?= URL_RAIZ . 'lanches' ?>" class="btn btn-default">Voltar</a>
  </nav>
  <form action="<?= URL_RAIZ . 'lanches' ?>" method="post">
    <div class="form-group">
      <label class="control-label" for="nome">Nome *</label>
      <input id="nome" name="nome" class="form-control" autofocus>
    </div>
    <button type="submit" class="btn btn-primary center-block">Cadastrar</button>
  </form>
</div>
