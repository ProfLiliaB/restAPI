<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumindo APIs</title>
</head>

<body>
    <h1>Consumindo APIs</h1>
    <h2>O que é API</h2>
    <p>
        <b>API</b> (Application Programming Interface) define um <b>conjunto de regras</b> para que uma aplicação acesse dados de outras aplicações, independente da forma que elas foram implementadas.
        <br>Na prática, a API atua como uma <b>ponte entre softwares</b>, facilitando a troca de informações de forma segura e controlada.
    </p>
    <h2>REST</h2>
    <p>REST: é o conjunto de conceitos ou princípios arquiteturais que define como uma API deve ser estruturada.</p>
    <p>APIs REST faz requisições HTTP (<a href="get.php">GET</a>, <a href="post.php">POST</a>, <a href="put.php">PUT</a> e <a href="del.php">DELETE</a>) que retorna em formato <b>JSON</b>.</p>
    <h3>Funções nativas do PHP</h3>
    <h4>file_get_contents()</h4>
    <p>Pegar conteúdo de um arquivo</p>
    <h4>cURL (cliente URL)</h4>
    <p>Ferramenta de linha de comando usada para transferir dados de ou para um servidor, utilizando diversos protocolos, como HTTP, HTTPS, FTP, entre outros. É amplamente utilizada para fazer requisições web, testar APIs e automatizar interações com servidores web.<br>É mais flexível e recomendado para integrações complexas. </p>
    <h4>json_decode()</h4>
    <p>Função que converte dados JSON em objetos ou arrays PHP.</p>
    <h3>Cabeçalhos (headers)</h3>
    <p> são informações adicionais enviadas na requisição, essenciais para autenticação (ex.: Bearer Token) ou para definir o tipo de conteúdo.</p>
    <h3>Códigos de erro mais comuns</h3>
    <ul>
        <li>200 requisição bem sucedida</li>
        <li>400 requisição mal sucedida</li>
        <li>404 não encontrado</li>
        <li>500 erro no servidor</li>
    </ul>
    <!-- https://www.sptrans.com.br/desenvolvedores/api-do-olho-vivo-guia-de-referencia/documentacao-api/ -->
    <!-- https://api.weatherapi.com/v1/current.json?key=86c93563d489440d80a211352232606&q=Ubatuba&aqi=no -->
    <!-- https://www.php.net/manual/pt_BR/book.curl.php -->
</body>

</html>