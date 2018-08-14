<form method="get" class="margin-bottom">
    <div class="form-group">
        <label class="control-label" for="nomePesquisa">Nome</label>
        <br>
        <input id="nomePesquisa" name="nomePesquisa" class="form-control" autofocus value="<?= $this->getGet('nomePesquisa') ?>" placeholder="Nome">        
    </div>
	<div class="form-group">
        <label class="control-label" for="notaMin">Nota</label>
        <br>
        <input id="notaMin" name="notaMin" class="form-control campo-metade" value="<?= $this->getGet('notaMin') ?>" placeholder="Mínima">
        <input id="notaMax" name="notaMax" class="form-control campo-metade" value="<?= $this->getGet('notaMax') ?>" placeholder="Máxima">
    </div>
    <div class="form-group"> 
        <label class="control-label" for="orientacaoAsc">Ordenar dados</label>
        <select name="orientacao" class="form-control" autofocus>
            <?php
            $asc = 'selected';
            $desc = '';
            if ($this->getGet('orientacao') == 'desc') {
                $asc = '';
                $desc = 'selected';
            }
            ?>
            <option value="asc" <?= $asc ?>>Crescente</option>
            <option value="desc" <?= $desc ?>>Descrescente</option>
        </select>
    </div>    
    <button type="submit" class="btn btn-primary center-block largura100">Filtrar</button>
</form>

<hr>

<table class="table table-condensed table-bordered">
	<tr class="active">
		<th>Nome do Aluno</th>
		<th>Nota</th>		
	</tr>
	<?php for ($i = 0; $i < count($registros); $i++) : ?>
		<tr>
			<td><?= $registros[$i]['nome'] ?></td>
			<td class="text-right"><?= number_format($registros[$i]['nota'], 1, ',', '.') ?></td>
		</tr>
	<?php endfor ?>
	<tr class="active negrito">
		<td>APROVADOS</td>
		<td class="text-right"><?= number_format($aprovados) ?></td>
	</tr>
    <tr class="active negrito">
        <td>REPROVADOS</td>
        <td class="text-right"><?= number_format($reprovados) ?></td>
    </tr>
    <tr class="active negrito">
        <td>TOTAL DE ALUNOS</td>
        <td class="text-right"><?= number_format($total) ?></td>
    </tr>
</table>