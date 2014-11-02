# Tarefa
Desenvolver um sistema web de visualização de usuários em PHP.

# Descrição
Desenvolver um sistema para visualizar uma lista de usuários passada no XML, este sistema deve ser estruturado em 3 camadas:

* Persitência:  
  Deve ser feito uma persistência para lêr do XML passado e uma para lêr os mesmos dados de um banco de dados (banco a sua escolha).
* Controle:  
  Deve se fazer uma camada para as regras de negócio deste sistema, devemos listar apenas os usuários com status = 1.
* Apresentação:  
  Deve ser feita uma camada para mostrar os dados do XML ou BANCO.  
  A seleção de qual persistência vai ser usada deve estar em um arquivo de configuração de fácil acesso e alteração.  
  Devemos ter um objeto representando os usuários que seja entendido e utilizado por todo o sistema.

```xml
<?xml version="1.0" encoding="iso-8859-1"?>
<userList>
	<user id="1" name="Dalana" lastName="Jenkins" username="dalana" password="asdf" email="dalana@inmemorian.com" status="1"/>
	<user id="2" name="Bauhar" lastName="Vontofell" username="bauhar" password="fdsa" email="bauhar@inmemorian.com" status="1"/>
	<user id="3" name="Tinkker" lastName="Warrniff" username="tinkker" password="1234asdf" email="tinkker@inmemorian.com" status="0"/>
	<user id="4" name="Fulano" lastName="De Tal" username="fulano" password="onaluf" email="fulano@detal.com" status="1"/>
	<user id="5" name="Tianatus" lastName="Dore" username="tianatus" password="plokiqaws" email="algonovo@teste.com.br" status="1"/>
	<user id="6" name="Bertrand" lastName="Nascimento" username="bertrand" password="qawsed" email="seila@terra.com.br" status="0"/>
	<user id="7" name="Seewick" lastName="Walock" username="seewick" password="frvdgr" email="ahpoiseh@site.com" status="1"/>
	<user id="8" name="Tevarus" lastName="Nassal" username="tevarus" password="s125w4" email="dunno@terra.com" status="0"/>
	<user id="9" name="Vonnan" lastName="Niato" username="vonnan" password="3212dd" email="mail@mail.com.br" status="1"/>
</userList>
```
