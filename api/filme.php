<?php
$apiKey = '4406f27f';
$imdbId = 'tt3896198'; // ID do filme que você quer buscar
$titulo = "Batman";
//$url = "http://www.omdbapi.com/?i=$imdbId&apikey=$apiKey";//Busca por ID
$url = "http://www.omdbapi.com/?r=xml&t=".urlencode($titulo)."&apikey=$apiKey";//Busca por titulo
// Inicializa o CURL
$ch = curl_init($url);
//configura para guardar o conteúdo da resposta
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//executa a requisição e armazena a resposta na variável
$respota = curl_exec($ch);
//fecha a sessão
curl_close($ch);
//converte dados JSON em Array associativo
// $dados = json_decode($respota, true);
// echo "<h1>" . $dados['Title'] . "</h1>";
// echo "<p><strong>Year:</strong> " . $dados['Year'] . "</p>";
// echo "<p><strong>Genre:</strong> " . $dados['Genre'] . "</p>";
// echo "<p><strong>Plot:</strong> " . $dados['Plot'] . "</p>";
// echo "<img src='" . $dados['Poster'] . "' alt='".$dados['Title']."'>";
// Carrega a resposta XML
$xml = simplexml_load_string($respota);
// Verifica se o filme foi encontrado
if ($xml->attributes()->response == 'True') {
    echo "<h1>" . $xml->movie['title'] . "</h1>";
    echo "<p><strong>Year:</strong> " . $xml->movie['year'] . "</p>";
    echo "<p><strong>Genre:</strong> " . $xml->movie['genre'] . "</p>";
    echo "<p><strong>Plot:</strong> " . $xml->movie['plot'] . "</p>";
    echo "<img src='" . $xml->movie['poster'] . "' alt='Poster do filme'>";
} else {
    echo "<p>Filme não encontrado.</p>";
}
?>