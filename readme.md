## Aplicação para verificação de teste de conhecimento

Este repositório contém código para uma aplicação de teste de conhecimento. A descrição da tarefa pode ser encontrada [aqui](https://github.com/gustavosf/php-test/blob/master/readme.md).

A solução descrita neste repositório foi a construção de um novo framework que provesse a separação entre as camadas de controle, modelo e visualização, bem como incluísse mecanismos de abstração da fonte de dados (que poderia ser um arquivo XML ou um banco de dados qualquer). 

Foi optado pela construção de um novo framework - e não a utilização de um já existente - pois foi considerado que seria uma tarefa mais desafiadora, que exporia melhor os meus conhecimentos como desenvolvedor, que creio seja o objetivo deste teste.

### Framework

O framework sobre o qual a aplicação foi montada foi desenvolvido especialmente para este fim, tendo como inspiração diversos frameworks open-source da linguagem como Laravel, Silex, Fat-free e Symfony.

Ele é composto dos seguintes componentes:

- **Application**  
  Responsável pela inicialização da aplicação, controle de rotas, configuração e ambientes
- **Model**  
  Responsável pela interação entre a aplicação e a camada de dados
- **View**  
  Responsável pela geração da interface

O sistema foi desenvolvido pensando em manter os três componentes independentes. Assim, mesmo que estes façam parte do mesmo pacote, o acoplamento em código entre eles é 0, permitindo que um componente seja substituido por outro - de outro pacote qualquer - sem prejuíso ao funcionamento do framework.

O código fonte do kernel do framework encontra-se [neste repositório](https://github.com/gustavosf/the-simple-php-framework-kernel). O relatório de cobertura de código dos testes unitários [encontra-se aqui](http://seganfredo.net/test/coverage). Relatórios do sistema de CI podem ser vistos [neste link](https://travis-ci.org/gustavosf/the-simple-php-framework-kernel).

Um esqueleto foi disponibilizado para novas aplicações [neste repositório](https://github.com/gustavosf/the-simple-php-framework).

### Aplicação

A aplicação, montada sobre o esqueleto acima consiste basicamente na criação de um controller, um model e uma view, bem como a indicação das fontes de dados através de uma arquivo de configuração.

O controller pode ser encontrado no arquivo ```routes.php```, e é basicamente as linhas de código abaixo:

```php
$app->get('/', function() { 
	$users = Model\User::all();
	return View::forge('users', ['users' => $users]);
});
```
O controller recebe uma requisição, busca a lista de usuários na fonte de dados, processa uma view e retorna para a aplicação exibir.

A definição do model usuário foi feita no arquivo ```models/user.php```. A linha abaixo representa a definição do model.

```php
namespace Model;
class User extends \Framework\Model {}
```

O nome da tabela, ou arquivo fonte dos dados é deduzida do nome da classe. Neste caso específico ,o model irá procurar por uma tabela users ou um arquivo users.xml.

Por fim, os dados dos usuários são repassados à view, que processa na seguinte esturutra (arquivo ```views/users.php```)

```html
<table>
	<thead>
		<tr>
			<?php foreach (current($users)->getAttributes() as $key): ?>
				<th><?php echo $key ?></th>
			<?php endforeach ?>
		</tr>
	</thead>
	<thead>
		<tr>
			<?php foreach ($users as $user): ?>
				<tr><td><?php echo implode('</td><td>', $user->asArray()) ?></td></tr>
			<?php endforeach ?>
		</tr>
	</thead>
</table>
```

A configuração da fonte de dados é feita através de arquivos de configuração, e é escolhida a fonte determinando o ambiente da aplicação. Por exemplo, para processar um arquivo XML, o arquivo ```config/usexml/database.php``` foi configurado da seguinte maneira:

```php
return [
	'driver' => 'xml',
	'path'   => __DIR__.'/../../storage/database',
];

```

O driver é uma indicação necessária para a classe de abstração de conexão ao banco de dados (```Framework\Database```). Caso se queira utilizar um banco de dados (a exemplo, sqlite), deve-se configurar da seguinte maneira:

```php
return [
	'driver' => 'pdo',
	'dsn' => 'sqlite:'__DIR__.'/../../storage/database/database.sqlite',
    // 'username' => '',
    // 'password' => '',
];
```
*username* e *password* são utilizados apenas para banco de dados que possuem autenticação.

A indicação de qual ambiente o sistema deve utilizar é feita na instanciação da aplicação, que pode ser encontrada no arquivo ```boot.php```, que consiste basicamente nas seguintes linhas de código:

```php
# Cria uma aplicação utilizando um sqlite como fonte de dados
# usedb = usar sqlite, usexml = usar xml
$app = new Framework\Application('usedb');

# Informa a aplicação da esturutra de arquivos escolhida pelo usuário
$app->registerPaths(include __DIR__.'/paths.php');

# Carrega as configurações de banco de dados (driver, dns, etc)
Framework\Database::configure($app->getConfig('database'));

# Carrega as configurações da view (path com as views)
Framework\View::configure($app->getConfig('view'));

# Inclui os controllers
require 'routes.php';

return $app;

```

Após estas configurações, o comando ```$app->run()``` deve executar a aplicação.

### Requisitos Mínimos

- PHP 5.4+ com PDO e driver para sqlite
- Composer

### Instalação do aplicativo teste

```
git clone https://github.com/gustavosf/php-test.git
cd php-test
git checkout master
composer update
composer dump-autoload -o
php -S localhost:4567 server.php

```

O sistema irá, out-of-the-box funcionar carregando os dados de arquivos xml encontrados na pasta ```storage/database```. Para alterar o comportamento, basta mudar o ambiente do sistema para ```usedb```. Assim, ele irá buscar os dados de um arquivo sqlite que pode ser encontrado na mesma pasta. Para fins de melhor visualização, os dados dos usuários foram truncados no arquivo sqlite (devem aparecer apenas uns 5 registros).

### Testes

O sistema também contém um teste funcional (bem) simples para verificar o seu correto funcionamento. Para executar o teste funcional, siga os passos abaixo:

```
php -S localhost:4567 server.php &
app/vendor/bin/behat --config .behat.yml
pkill php
```

### Trabalhos futuros

O framework foi desenvolvido pensando na extensibilidade. Uma lista de ideias para uma versão futura seriam as seguintes:  

- Permitir retorno dos dados em xml, json ou outra forma de dados diferentes de html
- Incluir os outros métodos do protocolo HTTP (o framework só implmeneta GET e POST)
- Permitir json_encode e serialize sobre uma instância do model
- Incluir drivers para outros parsers na view, como Twig, Haml e afins (o framework só faz parse em php)
- Incluir melhor tratamento de excessões na classe Application, logar erros, etc
- Melhorar segurança no output das views