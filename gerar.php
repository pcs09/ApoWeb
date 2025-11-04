<?php

// função para limpar e receber dados

function limpar_entrada($data) {
    if (is_array($data)) {
        return array_map('limpar_entrada', $data); 
    }
    return htmlspecialchars(stripslashes(trim($data)));
}

// função para formatar o período

function formatar_periodo($inicio, $fim) {
    $fim_lower = strtolower($fim);
    if (empty($fim) || $fim_lower == 'cursando' || $fim_lower == 'atual' || $fim_lower == 'presente') {
        return $inicio . ' – Atual';
    }
    return $inicio . ' – ' . $fim;
}


// Dados pessoais
$nome = limpar_entrada($_POST['nome'] ?? 'Nome do Candidato');
$nacionalidade = limpar_entrada($_POST['nacionalidade'] ?? '');
$email = limpar_entrada($_POST['email'] ?? '');
$telefone = limpar_entrada($_POST['telefone'] ?? '');
$endereco = limpar_entrada($_POST['endereco'] ?? '');
$objetivo = limpar_entrada($_POST['objetivo'] ?? '');
$habilidades = limpar_entrada($_POST['habilidades'] ?? '');

// Experiência profissional 

$experiencia_profissional = [];
if (isset($_POST['cargo']) && is_array($_POST['cargo'])) {
    $cargos = limpar_entrada($_POST['cargo']);
    $empresas = limpar_entrada($_POST['empresa']);
    $inicios = limpar_entrada($_POST['inicio']);
    $fins = limpar_entrada($_POST['fim']);
    $locais = limpar_entrada($_POST['local']);
    $responsabilidades = limpar_entrada($_POST['responsabilidades']);

    $num_experiencias = count($cargos);

    for ($i = 0; $i < $num_experiencias; $i++) {
        if (!empty($cargos[$i])) {
            $experiencia_profissional[] = [
                'cargo' => $cargos[$i],
                'empresa' => $empresas[$i],
                'inicio' => $inicios[$i],
                'fim' => $fins[$i],
                'local' => $locais[$i],
                'responsabilidades' => array_filter(explode("\n", $responsabilidades[$i]))
            ];
        }
    }
}

// Formação Acadêmica 
$formacao_academica = [];
if (isset($_POST['curso']) && is_array($_POST['curso'])) {
    $cursos = limpar_entrada($_POST['curso']);
    $instituicoes = limpar_entrada($_POST['instituicao']);
    $graus = limpar_entrada($_POST['grau']);
    $inicios = limpar_entrada($_POST['inicio_formacao']);
    $conclusoes = limpar_entrada($_POST['conclusao_formacao']);

    $num_formacoes = count($cursos);

    for ($i = 0; $i < $num_formacoes; $i++) {
        if (!empty($cursos[$i])) {
            $formacao_academica[] = [
                'curso' => $cursos[$i],
                'instituicao' => $instituicoes[$i],
                'grau' => $graus[$i],
                'inicio' => $inicios[$i],
                'conclusao' => $conclusoes[$i],
            ];
        }
    }
}


// Exibiçao do curriculo em html

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currículo de <?php echo $nome; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm noprint">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-file-alt"></i> Gerador CV</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">↩️ Editar Dados</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5 cv-container">
    <div class="card shadow-sm p-4">
        
        <header class="text-center pb-3 mb-4 border-bottom">
            <h1 class="display-5 text-primary mb-1"><?php echo $nome; ?></h1>
            <p class="mb-2 text-muted small">
                <?php echo $nacionalidade; ?> | <?php echo $endereco; ?>
            </p>
            <p class="mb-0">
                <span class="me-3"><i class="fas fa-envelope me-1"></i> <?php echo $email; ?></span>
                <span><i class="fas fa-phone me-1"></i> <?php echo $telefone; ?></span>
            </p>
        </header>

        <?php if (!empty($objetivo)): ?>
            <section class="mb-4">
                <h4 class="text-secondary"><i class="fas fa-bullseye me-2"></i> OBJETIVO PROFISSIONAL</h4>
                <p><?php echo nl2br($objetivo); ?></p>
            </section>
        <?php endif; ?>

        <?php if (!empty($experiencia_profissional)): ?>
            <section class="mb-4">
                <h4 class="text-secondary"><i class="fas fa-briefcase me-2"></i> EXPERIÊNCIA PROFISSIONAL</h4>
                <ul class="list-unstyled">
                    <?php 
                    $experiencia_ordenada = array_reverse($experiencia_profissional); 
                    foreach ($experiencia_ordenada as $exp): 
                    ?>
                        <li class="mb-3">
                            <h5 class="mb-0"><?php echo $exp['cargo']; ?></h5>
                            <p class="mb-1 text-muted">
                                <?php echo $exp['empresa']; ?> | <?php echo formatar_periodo($exp['inicio'], $exp['fim']); ?> | <?php echo $exp['local']; ?>
                            </p>
                            <ul class="list-unstyled ms-3 small">
                                <?php foreach ($exp['responsabilidades'] as $resp): ?>
                                    <li><i class="fas fa-check-circle me-1 text-success"></i> <?php echo ltrim($resp, '* '); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if (!empty($formacao_academica)): ?>
            <section class="mb-4">
                <h4 class="text-secondary"><i class="fas fa-graduation-cap me-2"></i> FORMAÇÃO ACADÊMICA</h4>
                <ul class="list-unstyled">
                    <?php 
                    $formacao_academica_ordenada = array_reverse($formacao_academica);
                    foreach ($formacao_academica_ordenada as $formacao): 
                    ?>
                        <li class="mb-3">
                            <h5 class="mb-0"><?php echo $formacao['curso']; ?></h5>
                            <p class="mb-1 text-muted">
                                <?php echo $formacao['grau']; ?> na <?php echo $formacao['instituicao']; ?>
                            </p>
                            <p class="mb-0 small text-dark">
                                Período: <?php echo formatar_periodo($formacao['inicio'], $formacao['conclusao']); ?>
                            </p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if (!empty($habilidades)): ?>
            <section>
                <h4 class="text-secondary"><i class="fas fa-cogs me-2"></i> HABILIDADES / CURSOS</h4>
                <ul class="list-unstyled ms-3 small">
                    <?php 
                    $habilidades_lista = array_filter(explode("\n", $habilidades));
                    foreach ($habilidades_lista as $h): ?>
                        <li><i class="fas fa-star me-1 text-warning"></i> <?php echo ltrim($h, '* '); ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>

    </div>
    
    <div class="text-center mt-4 noprint">
        <button onclick="window.print()" class="btn btn-primary btn-lg"><i class="fas fa-print"></i> Imprimir / Gerar PDF</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>