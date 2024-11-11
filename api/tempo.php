<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precisão do tempo</title>
</head>

<body>
    <h1>API Previsão do Tempo</h1>
    <form method="post" id="formulario">
        <div>
            <label>Cidade:</label>
            <input type="text" name="cit" id="cit">
        </div>
        <div>
            <button type="submit">VER</button>
        </div>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cit = urlencode($_POST['cit']) ?? "Ubatuba";
        $key = "SUA_CHAVE_AQUI";
        $url = "http://api.weatherapi.com/v1/current.json?key=$key&q=$cit&aqi=no&lang=pt";
        //$response = file_get_contents($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Erro:' . curl_error($ch);
        } else {
            // echo "<pre>";
            // echo $response;
            //-------------------------------------
            $dados = json_decode($response, true);
            $local = $dados['location'];
            $condicao = $dados['current'];
            echo "Cidade: " . $local['name'] . '/' . $local['region'];
            echo "<br>Tempo: " . $condicao['temp_c'] . '°';
            echo "<br>" . $condicao['condition']['text'];
            $img = $condicao['condition']['icon'];
            echo "<br><img src='$img' alt='Tempo'>";
        }
        curl_close($ch);
    }
    ?>
</body>

</html>