# Consumindo APIs

## O que é API

**API** (Application Programming Interface) define um **conjunto de regras** para que uma aplicação acesse dados de outras aplicações, independente da forma que elas foram implementadas.  
Na prática, a API atua como uma **ponte entre softwares**, facilitando a troca de informações de forma segura e controlada.

## REST

REST: é o conjunto de conceitos ou princípios arquiteturais que define como uma API deve ser estruturada.  
APIs REST fazem requisições HTTP (GET, POST, PUT e DELETE) que retornam em formato **JSON**.

### Funções nativas do PHP

#### file_get_contents()

Pegar conteúdo de um arquivo.

#### cURL (cliente URL)

Ferramenta de linha de comando usada para transferir dados de ou para um servidor, utilizando diversos protocolos, como HTTP, HTTPS, FTP, entre outros. É amplamente utilizada para fazer requisições web, testar APIs e automatizar interações com servidores web.  
É mais flexível e recomendado para integrações complexas.

#### json_decode()

Função que converte dados JSON em objetos ou arrays PHP.

### Cabeçalhos (headers)

São informações adicionais enviadas na requisição, essenciais para autenticação (ex.: Bearer Token) ou para definir o tipo de conteúdo.

### Códigos de erro mais comuns

- **200**: requisição bem sucedida
- **400**: requisição mal sucedida
- **404**: não encontrado
- **500**: erro no servidor