# Framework DW3

Exercício de PHP utilizando framework DW3:

- https://github.com/guilhermedacsilva/web3

Exercício:

Sistema para pedir lanches na mesa.
Primeira página:
• O garçom deve informar a mesa, o lanche e a quantidade. O lanche deve ser um campo de
seleção, que traz os lanches cadastrados no banco de dados.
Segunda página:
• Listar todos os pedidos, com mesa, lanche e quantidade.
Terceira página:
• O usuário da cozinha pode cadastrar os lanches disponíveis.

Observações:
• As alterações do banco de dados não devem estar no arquivo antigo. Você deve criar um
arquivo SQL com as alterações do banco de dados. Sempre que possível use “id” para a
chave primária da tabela. Sempre que possível, use “nome_da_tabela_id” para a chave
estrangeira.
• Crie mais uma classe de modelo para os lanches.
• Inclua na classe Pedido o método “getLanche()”. Esse método deve retornar um objeto do
tipo Lanche. Esse objeto terá as informações do lanche que está relacionado com o pedido.•
Na visão do pedido, use a marcação <select> para criar a caixa de seleção do lanche. Exiba
para o usuário os nomes dos lanches, porém envie para o servidor o id do lanche. Use o
atributo “value” da marcação <option>.
