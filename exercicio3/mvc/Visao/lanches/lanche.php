<div class="center-block site">
  <h1 class="text-center">Lanches Disponíveis na Cozinha</h1>
  <nav>
    <a href="<?= URL_RAIZ . 'pedidos' ?>" class="btn btn-primary">Ir para a Listagem de Pedidos</a>
    <a href="<?= URL_RAIZ . 'lanches/criar' ?>" class="btn btn-primary">Cadastrar Lanche Novo</a>
  </nav>
  <table class="table">
    <tr>
      <th>Excluir Lanche</th>
      <th>Nome</th>
    </tr>
    <?php if (empty($lanches)) : ?>
      <tr>
        <td colspan="99" class="text-center">Nenhum lanche feito na cozinha.</td>
      </tr>
    <?php endif ?>
    <?php foreach ($lanches as $lanche) : ?>
      <tr>
        <td>
          <form action="<?= URL_RAIZ . 'lanches/' . $lanche->getId() ?>" method="post" class="inline">
            <input type="hidden" name="_metodo" value="DELETE">
            <a href="" class="btn btn-danger btn-xs" title="Deletar" onclick="event.preventDefault(); this.parentNode.submit()">
              <span class="glyphicon glyphicon-trash"></span>
            </a>
          </form>
        </td>
        <td><?= $lanche->getNome() ?></td>
      </tr>
    <?php endforeach ?>
  </table>
</div>
