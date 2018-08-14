<div class="container">
  <h1 class="text-center">Classificados de Automóveis</h1>
  <nav>
    <a href="<?= URL_RAIZ . 'carros/relatorio' ?>" class="btn btn-primary">Relatório de Lucro</a>  
    <a href="<?= URL_RAIZ . 'carros/criar' ?>" class="btn btn-primary">Cadastrar novo veículo</a>
  </nav>
  <table class="table">
      <tr>
          <th>Ações</th>
          <th>Modelo</th>
          <th>Preço de Compra</th>
          <th>Preço de Venda</th>
          <th>Descrição</th>
          <th>Marcar como Vendido</th>
      </tr>
      <?php if (empty($carros)) : ?>
          <tr>
              <td colspan="99" class="text-center">Nenhum carro para venda.</td>
          </tr>
      <?php endif ?>
      <?php foreach ($carros as $carro) : ?>
          <tr>
              <td>
                  <a href="<?= URL_RAIZ . 'carros/' . $carro->getId() ?>" class="btn btn-default btn-xs" title="Mostrar">
                      <span class="glyphicon glyphicon-eye-open"></span>
                  </a>

                  <a href="<?= URL_RAIZ . 'carros/' . $carro->getId() . '/editar' ?>" class="btn btn-primary btn-xs" title="Editar">
                      <span class="glyphicon glyphicon-pencil"></span>
                  </a>

                  <form action="<?= URL_RAIZ . 'carros/' . $carro->getId() ?>" method="post" class="inline">
                      <input type="hidden" name="_metodo" value="DELETE">
                      <a href="" class="btn btn-danger btn-xs" title="Deletar" onclick="event.preventDefault(); this.parentNode.submit()">
                          <span class="glyphicon glyphicon-trash"></span>
                      </a>
                  </form>
              </td>
              <td><?= $carro->getModelo() ?></td>
              <td><?= $carro->getPrecoDeCompra() ?></td>
              <td><?= $carro->getPrecoDeVenda() ?></td>
              <td><?= $carro->getDescricao() ?></td>
              <td>
                <?php if ($carro->getVendido()) : ?>
                  Vendido
                <?php else : ?>
                  <form action="<?= URL_RAIZ . 'carros/' . $carro->getId() . '/vender' ?>" method="post" class="inline">
                      <input type="hidden" name="_metodo" value="PATCH">
                      <a href="" class="btn btn-primary btn-sm" title="Vender" onclick="event.preventDefault(); this.parentNode.submit()">
                        Marcar como Vendido
                      </a>
                  </form>
                <?php endif ?>
              </td>
          </tr>
      <?php endforeach ?>
  </table>
</div>
