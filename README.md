# Teste de Conhecimento PHP/yii2

### Configuração Inicial do Projeto

- Como pré-requisito, precisamos ter o **[Composer](https://getcomposer.org/)** instalado na máquina, ele é responsável por gerenciar as dependências do projeto em php. *Documentação para instalação [aqui](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos).*

- Após instalação do composer, precisamos baixar as dependências do projeto, executando o comando `composer install` no diretório onde está localizado os arquivos.

- Executar os migrations
`php yii migrate`

- Agora podemos iniciar o servidor com a linha de comando abaixo:
`php yii serve --port=8888`

*obs: mude a porta caso já esteja em uso*

### Objetivo

Criar uma página na *web* para listar as receitas possíveis de serem realizadas a partir dos ingredientes disponíveis. Ex.:
Temos os ingredientes disponíveis:
- 3 tomates
- 2 cebolas

e as receitas:
- Molho de Tomate, que utiliza:
	- 2 tomates
	- 1 cebola
- Molho de Tomate Especial, que utiliza:
	- 4 tomates
	- 2 cebolas

O sistema deverá listar somente a receita "Molho de Tomate", caso seja adicionado mais 1 tomate aos ingredientes disponíveis, ficaria com o total de 4 tomates disponíveis, o sistema agora irá listar as receitas "Molho de Tomate" e "Molho de Tomate Especial".

### Conceito Inicial
Criamos a estrutura inicial do projeto utilizando o *framework Yii2*.

O projeto é baseado no conceito de *Programação Orientada a Objetos* e utiliza a arquitetura MVC *(Model View Controller)*.

Quando mencionados o acrônimo *CRUD (Create, Read, Update, Delete)*, estamos nos referindo a criação dos métodos de *Criar, Exibir, Atualizar e Deletar* do Modelo.

Utilizamos como banco de dados o SQLite e já criamos as tabelas que serão utilizadas na resolução.

Dentro do código fonte criamos a estrutura dos Controladores e Modelos disponíveis, devem ser utilizados para a implementação da solução.

### Objetivos do Desenvolvimento
- Criar o cadastro *(CRUD)* do "Ingrediente", com o nome do ingrediente e a quantidade disponível;
- Criar o cadastro da "Receita", com o nome da receita;
- Criar o cadastro para vincular o "Ingrediente" a "Receita" com a quantidade necessária do ingrediente para realizar a receita.
*obs: a receita poderá ter mais de um ingrediente vinculado*
- Adicionar no mínimo 5 (cinco) receitas;
- Adicionar no mínimo 3 (três) ingredientes;
- Exibir/Listar na página inicial todas as receitas disponíveis para criação, respeitando os requisitos de ingredientes necessários cadastrados para cada receita, considerando a quantidade disponível de cada ingrediente.

### Avaliação
Será realizada a avaliação utilizando os seguintes critérios:
- Estruturação do código fonte;
- Utilização dos métodos existentes no *framework* para desenvolver a resolução do problema proposto;
- Apresentação da Interface gráfica na web;

### Dicas e Observações
Leia a documentação do *framework*, nem tudo precisa ser desenvolvido do zero!
