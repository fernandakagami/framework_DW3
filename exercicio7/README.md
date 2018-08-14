# Framework DW3

Exercício de PHP utilizando framework DW3:

- https://github.com/guilhermedacsilva/web3

Exercício - Faça uma aplicação que gere relatórios sobre os alunos de uma disciplina.

- Não precisa ter login, pois somente o professor usará a aplicação. O professor poderá cadastrar os alunos e suas notas. A nota é de 0,0 a 10,0. Todos os campos do cadastro precisam ser validados. Não precisará cadastrar a disciplina, portanto o sistema terá somente uma tabela: alunos. A aplicação terá um relatório que lista os alunos e suas notas. A ordem dos alunos será por nota,
sendo as maiores primeiro. O professor poderá filtrar por nota mínima e máxima. No final do relatório mostre a quantidade de alunos aprovados e reprovados, sendo que a nota mínima é 6,0.

- Crie mais um campo no filtro, indicando a ordenação dos registros: crescente ou decrescente.

- Crie no filtro o campo nome, que filtrará os alunos pelo nome. O campo não deve diferenciar maiúsculas de minúsculas na busca. Ele também deverá procurar a palavra em qualquer lugar do nome. Dica: se você usar um conjunto de caracteres case insensitive no banco de dados, ele não diferenciará maiúsculas de minúsculas na busca.

- Faça testes automatizados.
