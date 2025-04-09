<?php
function obterSigno($dataNascimento) {
    $data = DateTime::createFromFormat('Y-m-d', $dataNascimento);
    $dia = (int)$data->format('d');
    $mes = (int)$data->format('m');

    $signos = simplexml_load_file('signos.xml');

    foreach ($signos->signo as $signo) {
        list($diaInicio, $mesInicio) = explode('/', $signo->dataInicio);
        list($diaFim, $mesFim) = explode('/', $signo->dataFim);

        $dataInicio = DateTime::createFromFormat('d/m', "$diaInicio/$mesInicio");
        $dataFim = DateTime::createFromFormat('d/m', "$diaFim/$mesFim");

        $dataComparar = DateTime::createFromFormat('d/m', "$dia/$mes");

        // Verifica se a data está entre início e fim (levando em conta virada de ano)
        if (
            ($mesInicio < $mesFim) || ($mesInicio == $mesFim && $diaInicio <= $diaFim)
        ) {
            if ($dataComparar >= $dataInicio && $dataComparar <= $dataFim) {
                return $signo;
            }
        } else {
            if ($dataComparar >= $dataInicio || $dataComparar <= $dataFim) {
                return $signo;
            }
        }
    }

    return null;
}

$signoEncontrado = obterSigno($_POST['data_nascimento']);

include('layouts/header.php');

if ($signoEncontrado):
    $nomeSigno = strtolower((string)$signoEncontrado->signoNome);
    $imagem = "assets/img/{$nomeSigno}.jpg";
?>
    <h2 class="mb-3"><?= $signoEncontrado->signoNome ?></h2>

    <?php if (file_exists($imagem)): ?>
        <img src="<?= $imagem ?>" alt="<?= $signoEncontrado->signoNome ?>" class="img-fluid rounded mb-4" style="max-height: 300px;">
    <?php endif; ?>

    <p class="lead"><?= $signoEncontrado->descricao ?></p>

    <a href="index.php" class="btn btn-outline-light mt-4">Voltar</a>

<?php else: ?>
    <p class="text-danger">Não foi possível determinar o signo. Verifique a data informada.</p>
    <a href="index.php" class="btn btn-outline-light mt-4">Tentar novamente</a>
<?php endif; ?>

</div> <!-- fecha .container -->
</body>
</html>
