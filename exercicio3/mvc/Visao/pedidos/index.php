<div class="center-block site">
  <h1 class="text-center">Listagem dos Pedidos</h1>
  <nav>
    <a href="<?= URL_RAIZ . 'lanches' ?>" class="btn btn-primary">Ir para a Relação de Lanches</a>
    <a href="<?= URL_RAIZ . 'pedidos/criar' ?>" class="btn btn-primary">Cadastrar novo pedido</a>
  </nav>
  <table class="table">
    <tr>
      <th>Ações</th>
      <th>Mesa</th>
      <th>Tipo de Lanche</th>
      <th>Quantidade de Lanches</th>
    </tr>
    <?php if (empty($pedidos)) : ?>
      <tr>
        <td colspan="99" class="text-center">Nenhum pedido cadastrado.</td>
      </tr>
    <?php endif ?>
    <?php foreach ($pedidos as $pedido) : ?>
      <tr>
        <td>
          <a href="<?= URL_RAIZ . 'pedidos/' . $pedido->getId() . '/editar' ?>" class="btn btn-primary btn-xs" title="Editar">
            <span class="glyphicon glyphicon-pencil"></span>
          </a>
          <form action="<?= URL_RAIZ . 'pedidos/' . $pedido->getId() ?>" method="post" class="inline">
            <input type="hidden" name="_metodo" value="DELETE">
            <a href="" class="btn btn-danger btn-xs" title="Deletar" onclick="event.preventDefault(); this.parentNode.submit()">
                <span class="glyphicon glyphicon-trash"></span>
            </a>
          </form>
        </td>
        <td><?= $pedido->getMesa() ?></td>
        <td><?= $pedido->getLanche()->getNome() ?></td>
        <td><?= $pedido->getQuantidade() ?></td>
      </tr>
    <?php endforeach ?>
  </table>
</div>
