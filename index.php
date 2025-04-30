<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Lista de PDFs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      color: black;
    }
  </style>
</head>
<body class="container mt-5">

  <div class="text-center mb-4">
    <img src="img/logo.png" alt="Logo" class="img-fluid" style="max-width: 350px;">
  </div>

  <ul class="list-group small">
    <?php
      $diretorio = '.'; // pasta atual
      $arquivosPdf = [];

      if (is_dir($diretorio)) {
        if ($dh = opendir($diretorio)) {
          while (($arquivo = readdir($dh)) !== false) {
            if (pathinfo($arquivo, PATHINFO_EXTENSION) === 'pdf') {
              // Armazena nome e data de modificação
              $arquivosPdf[$arquivo] = filemtime($arquivo);
            }
          }
          closedir($dh);

          // Ordena do mais recente para o mais antigo
          arsort($arquivosPdf);

          if (!empty($arquivosPdf)) {
            foreach ($arquivosPdf as $arquivo => $data) {
              echo "<li class='list-group-item'>
                      <a href='$arquivo' target='_blank'>
                        📄 $arquivo
                      </a>
                    </li>";
            }
          } else {
            echo "<li class='list-group-item'>Nenhum PDF encontrado.</li>";
          }

        }
      } else {
        echo "<li class='list-group-item'>Diretório não encontrado.</li>";
      }
    ?>
  </ul>

  <footer class="mx-auto p-3 text-center mt-5">
    <div class="container">
      <span class="text-muted">&copy; <?php echo date("Y"); ?> Magnum Construtora</span>
    </div>
  </footer>

</body>
</html>
