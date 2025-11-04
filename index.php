<?php 

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Currículos</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-file-alt"></i> Gerador CV
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">📝 Preencher Dados</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5">
    <form action="gerar.php" method="POST" class="shadow-sm">
        <h1 class="text-center mb-4 text-primary">Gerador de Currículos</h1>

        <fieldset class="mb-4">
            <legend class="text-primary"><i class="fas fa-user-alt"></i> Dados Pessoais e Contato</legend>
            <div class="row g-3">
                
                <div class="col-md-8">
                    <label for="nome" class="form-label">Nome Completo:</label>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Seu nome" required>
                </div>
                
                <div class="col-md-4">
                    <label for="data_nascimento" class="form-label">Data de Nasc.:</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" required>
                </div>
                
                <div class="col-md-6">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="seu.email@exemplo.com" required>
                </div>
                <div class="col-md-6">
                    <label for="telefone" class="form-label">Telefone/Celular:</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" placeholder="(DDD) XXXXX-XXXX">
                </div>
                
                <div class="col-md-6">
                    <label for="nacionalidade" class="form-label">Nacionalidade/Estado Civil:</label>
                    <input type="text" name="nacionalidade" id="nacionalidade" class="form-control" placeholder="Brasileiro(a), Solteiro(a)">
                </div>

                <div class="col-md-6">
                    <label for="endereco" class="form-label">Endereço (Cidade-UF):</label>
                    <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Cidade-UF">
                </div>
            </div>
        </fieldset>
        
        <fieldset class="mb-4">
            <legend class="text-primary"><i class="fas fa-bullseye"></i> Objetivo Profissional</legend>
            <textarea name="objetivo" id="objetivo" class="form-control" rows="3" placeholder="Ex: Atuar na área..."></textarea>
        </fieldset>

        <fieldset class="mb-4">
            <legend class="text-primary"><i class="fas fa-briefcase"></i> Experiência Profissional</legend>
            <div id="experiencia-container">
                <div class="bloco-experiencia">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Cargo:</label><input type="text" name="cargo[]" class="form-control" placeholder="Ex: Analista de Marketing Sênior"></div>
                        <div class="col-md-6"><label class="form-label">Empresa:</label><input type="text" name="empresa[]" class="form-control" placeholder="Nome da Empresa"></div>
                        <div class="col-md-3"><label class="form-label">Início:</label><input type="text" name="inicio[]" class="form-control" placeholder="Ex: 01/2020"></div>
                        <div class="col-md-3"><label class="form-label">Fim:</label><input type="text" name="fim[]" class="form-control" placeholder="Ex: 12/2023 ou Atual"></div>
                        <div class="col-md-4"><label class="form-label">Local:</label><input type="text" name="local[]" class="form-control" placeholder="Cidade-UF"></div>
                        <div class="col-md-2 d-flex align-items-end"><button type="button" class="btn btn-danger w-100 remover-experiencia" disabled><i class="fas fa-trash"></i></button></div>
                        <div class="col-12"><label class="form-label">Responsabilidades (Use pontos de lista):</label><textarea name="responsabilidades[]" class="form-control" rows="3" placeholder="* Responsabilidade A&#10;* Conquista B"></textarea></div>
                    </div>
                </div>
            </div>
            <button type="button" id="adicionar-experiencia" class="btn btn-success mt-3"><i class="fas fa-plus-circle"></i> Adicionar Experiência</button>
        </fieldset>

        <fieldset class="mb-4">
            <legend class="text-primary"><i class="fas fa-graduation-cap"></i> Formação Acadêmica</legend>
            <div id="formacao-academica-container">
                <div class="bloco-formacao">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Curso:</label><input type="text" name="curso[]" class="form-control" placeholder="Ex: Bacharelado em... " required></div>
                        <div class="col-md-6"><label class="form-label">Instituição:</label><input type="text" name="instituicao[]" class="form-control" placeholder="Ex: Universidade XYZ" required></div>
                        <div class="col-md-4"><label class="form-label">Grau:</label><select name="grau[]" class="form-select" required><option value="" disabled selected>Selecione o Grau</option><option value="Graduação">Graduação</option><option value="Mestrado">Mestrado</option><option value="Técnico">Técnico</option></select></div>
                        <div class="col-md-3"><label class="form-label">Início:</label><input type="text" name="inicio_formacao[]" class="form-control" placeholder="Ex: 03/2018" required></div>
                        <div class="col-md-3"><label class="form-label">Conclusão:</label><input type="text" name="conclusao_formacao[]" class="form-control" placeholder="Ex: 12/2022 ou Cursando" required></div>
                        <div class="col-md-2 d-flex align-items-end"><button type="button" class="btn btn-danger w-100 remover-formacao" disabled><i class="fas fa-trash"></i></button></div>
                    </div>
                </div>
            </div>
            <button type="button" id="adicionar-formacao" class="btn btn-success mt-3"><i class="fas fa-plus-circle"></i> Adicionar Formação</button>
        </fieldset>

        <fieldset class="mb-4">
            <legend class="text-primary"><i class="fas fa-cogs"></i> Habilidades / Cursos Complementares</legend>
            <textarea name="habilidades" id="habilidades" class="form-control" rows="4" placeholder="* Habilidade 1 (Ex: Excel, Inglês Avançado)&#10;* Curso Complementar (Ex: Curso de PHP - 80h)"></textarea>
        </fieldset>
        
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-file-pdf"></i> Gerar Currículo</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="script.js"></script>

</body>
</html>