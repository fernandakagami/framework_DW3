<div class="container">
  <div class= "form-signin">
    <h2 class="form-signin-heading">Pedido</h2>
    <br>
    <?php foreach ($mensagens as $mensagem) : ?>
        <ul>
            <li><strong>Mesa: </strong><?= $mensagem->getMesa() ?></li>
              <p>Quantidade de lanches: <?= $mensagem->getQuantidade() ?></p>
            <br>
        </ul>
    <?php endforeach ?>
  </div>
</div>
