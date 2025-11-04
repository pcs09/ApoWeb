$(document).ready(function() {
    
    //função dos botoes
    function atualizarBotoesRemover(selector) {
        if ($(selector).find('.bloco-experiencia, .bloco-formacao').length === 1) {
            $(selector).find('.btn-danger').prop('disabled', true);
        } else {
            $(selector).find('.btn-danger').prop('disabled', false);
        }
    }
    
    // bloco experiencia proficional dinamico
    $('#adicionar-experiencia').on('click', function() {
        const novoBlocoExperiencia = `
            <div class="bloco-experiencia mt-3">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Cargo:</label><input type="text" name="cargo[]" class="form-control" placeholder="Ex: Analista de Marketing Sênior"></div>
                    <div class="col-md-6"><label class="form-label">Empresa:</label><input type="text" name="empresa[]" class="form-control" placeholder="Nome da Empresa"></div>
                    <div class="col-md-3"><label class="form-label">Início:</label><input type="text" name="inicio[]" class="form-control" placeholder="Ex: 01/2020"></div>
                    <div class="col-md-3"><label class="form-label">Fim:</label><input type="text" name="fim[]" class="form-control" placeholder="Ex: 12/2023 ou Atual"></div>
                    <div class="col-md-4"><label class="form-label">Local:</label><input type="text" name="local[]" class="form-control" placeholder="Cidade-UF"></div>
                    <div class="col-md-2 d-flex align-items-end"><button type="button" class="btn btn-danger w-100 remover-experiencia"><i class="fas fa-trash"></i></button></div>
                    <div class="col-12"><label class="form-label">Responsabilidades (Use pontos de lista):</label><textarea name="responsabilidades[]" class="form-control" rows="3" placeholder="* Responsabilidade A&#10;* Conquista B"></textarea></div>
                </div>
            </div>
        `;
        $('#experiencia-container').append(novoBlocoExperiencia);
        atualizarBotoesRemover('#experiencia-container');
    });

    $('#experiencia-container').on('click', '.remover-experiencia', function() {
        if ($('.bloco-experiencia').length > 1) {
            $(this).closest('.bloco-experiencia').remove();
            atualizarBotoesRemover('#experiencia-container');
        }
    });
    
    // bloco formaçao academica dinamico
    $('#adicionar-formacao').on('click', function() {
        const novoBloco = `
            <div class="bloco-formacao mt-3">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Curso:</label><input type="text" name="curso[]" class="form-control" placeholder="Ex: Bacharelado em... " required></div>
                    <div class="col-md-6"><label class="form-label">Instituição:</label><input type="text" name="instituicao[]" class="form-control" placeholder="Ex: Universidade XYZ" required></div>
                    <div class="col-md-4"><label class="form-label">Grau:</label><select name="grau[]" class="form-select" required><option value="" disabled selected>Selecione o Grau</option><option value="Graduação">Graduação</option><option value="Mestrado">Mestrado</option><option value="Técnico">Técnico</option></select></div>
                    <div class="col-md-3"><label class="form-label">Início:</label><input type="text" name="inicio_formacao[]" class="form-control" placeholder="Ex: 03/2018" required></div>
                    <div class="col-md-3"><label class="form-label">Conclusão:</label><input type="text" name="conclusao_formacao[]" class="form-control" placeholder="Ex: 12/2022 ou Cursando" required></div>
                    <div class="col-md-2 d-flex align-items-end"><button type="button" class="btn btn-danger w-100 remover-formacao"><i class="fas fa-trash"></i></button></div>
                </div>
            </div>
        `;
        $('#formacao-academica-container').append(novoBloco);
        atualizarBotoesRemover('#formacao-academica-container');
    });

    $('#formacao-academica-container').on('click', '.remover-formacao', function() {
        if ($('.bloco-formacao').length > 1) {
            $(this).closest('.bloco-formacao').remove();
            atualizarBotoesRemover('#formacao-academica-container');
        }
    });

    
    atualizarBotoesRemover('#experiencia-container');
    atualizarBotoesRemover('#formacao-academica-container');
});