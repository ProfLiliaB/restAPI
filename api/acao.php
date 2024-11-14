<?php
$cep = $_POST['cep'] ?? '';
$url = "https://viacep.com.br/ws/$cep/json/";
// $json = file_get_contents($url);
// $dados = json_decode($json, true);
// $endereco = $dados['logradouro'] . ', ' . $dados['bairro'] . ', ' . $dados['localidade'] . ' - ' . $dados['uf'];
// echo $endereco;
//Inicia a requisição curl, guarda dentro da variável
$curl = curl_init($url);
//seta a opçao de que deve armazenar retorno para uso posterior
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//executa a requisição e armazena o retorno dentr da variável
$retorno = curl_exec($curl);
echo "<pre>";
print_r($retorno);
?>
