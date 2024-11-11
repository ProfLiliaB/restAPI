<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usando APIs</title>
</head>

<body>
    <h1>Usando APIs com PHP</h1>
    <form method="post" id="formulario">
        <div>
            <label>CEP:</label>
            <input type="text" name="cep" id="cep">
        </div>
        <div id="resposta"></div>
    </form>
    <script>
        const div = document.getElementById('resposta');
        const formulario = document.getElementById('formulario');
        formulario.addEventListener('input', (evento) => {
            let value = document.getElementById('cep').value;
            if (value.length == 8) {
                evento.preventDefault();
                let dados = new FormData(formulario);
                fetch('acao.php', {
                        method: 'POST',
                        body: dados
                    })
                    .then((resposta) => {
                        if (resposta.ok) {
                            return resposta.text()
                        }
                    })
                    .then((dados) => {
                        div.innerHTML = dados;
                    });
            }
        });
    </script>
</body>

</html>