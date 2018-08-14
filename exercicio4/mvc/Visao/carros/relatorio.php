<div class="container">
  <h1 class="text-center">Relatório de Vendas</h1>
  <nav>
    <a href="<?= URL_RAIZ . 'carros' ?>" class="btn btn-default">Voltar para a listagem</a>
  </nav>
  <table class="table">
    <tr>
      <th>Modelo</th>
      <th>Preço de Compra</th>
      <th>Preço de Venda</th>
      <th>Lucro da Venda</th>
      <th>Descrição</th>
    </tr>
    <?php if (empty($carros)) : ?>
      <tr>
        <td colspan="99" class="text-center">Nenhum carro vendido.</td>
      </tr>
    <?php endif ?>
    <?php foreach ($carros as $carro) : ?>
      <tr>        
        <td><?= $carro->getModelo() ?></td>
        <td><?= $carro->getPrecoDeCompra() ?></td>
        <td><?= $carro->getPrecoDeVenda() ?></td>
        <td><?= $carro->getLucro() ?></td>
        <td><?= $carro->getDescricao() ?></td>
    </tr>
    <?php endforeach ?>
  </table>
</div>
