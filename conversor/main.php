<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de moedas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Conversor de moedas</h1>
    </header>
    <main id="main_retorno">
        <?php 
                date_default_timezone_set('America/Sao_Paulo');
                $inicio = date("m-d-Y", strtotime("-7 days"));
                $fim = date("m-d-Y");
                $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''. $inicio .'\'&@dataFinalCotacao=\'' . $fim . '\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

                $dados = json_decode(file_get_contents($url), true);
                $cotacao = $dados["value"][0]["cotacaoCompra"];
                $real = $_GET["real"];

                if($real == "" or $real < 0){
                    $real = 0;
                }
            
                function calculo($cotacao, $reais){
                    $dolar = $reais / $cotacao;
                    return $dolar;
                }

                echo "<p>R$ $real considerando a cotação atual valem: $ " . round(calculo($cotacao, $real), 2) . " doláres.</p>";
        ?>
        <a href="index.html" class="botao" id="botao_retorno">Voltar</a>
    </main>
</body>
</html>