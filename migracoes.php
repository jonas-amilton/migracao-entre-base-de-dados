<?php
// echo 'executando migração...';

function executaMigracao($tabelasMariaDB, $postgres)
{
    // Inseri os dados do MariaDB no PostgreSQL
    migraBannerParaPostgres($tabelasMariaDB, $postgres);
    migrarBlogPostParaPostgres($tabelasMariaDB, $postgres);
    migrarBlogCategoriaParaPostgres($tabelasMariaDB, $postgres);
    migrarGaleriaFotoParaPostgres($tabelasMariaDB, $postgres);
}

function migraBannerParaPostgres($tabelasMariaDB, $postgres)
{
    $tabelaBannerMariaDb = $tabelasMariaDB['banner'];
    $tabelaBlogPost = $tabelasMariaDB['blogpost'];
    $tabelaGaleriafoto = $tabelasMariaDB['galeriafoto'];

    // Início de uma transação para garantir consistência
    $postgres->beginTransaction();

    $sqlInsereBanner = file_get_contents('sql/insere_banner.sql');

    $stmtPostgres = $postgres->prepare($sqlInsereBanner);

    foreach ($tabelaBannerMariaDb as $item) {

        $stmtPostgres->execute([
            ':id' => $item['id'],
            ':titulo' => $item['titulo'],
            ':data_inicio' => $item['inicio'],
            ':data_fim' => $item['fim'],
            // Limita o tamanho da string a 256 caracteres
            ':link' => substr($item['link'], 0, 256),
            // Reduz para as primeiras 3 letras
            ':tipo_posicao' => substr($item['tipo'], 0, 3),
            // Reduz o valor por uma função de módulo para caber em smallint
            ':ordem' => intval($item['ordenamento'] % 32768),
            ':ativo' => $item['ativo'],
            ':data_criacao' => $item['created'],
            ':data_modificacao' => $item['modified'],
        ]);
    }

    $sqlAtualizaIdArquivo = file_get_contents('sql/atualiza_id_arquivo_banner.sql');

    $stmtPostgres = $postgres->prepare($sqlAtualizaIdArquivo);

    foreach ($tabelaGaleriafoto as $item) {
        $stmtPostgres->execute([
            ':id_arquivo' => $item['id'],
        ]);
    }

    $sqlAtualizaLegenda = file_get_contents('sql/atualiza_legenda_banner.sql');

    // atualiza_legenda_banner.php
    $stmtPostgres = $postgres->prepare($sqlAtualizaLegenda);

    foreach ($tabelaBlogPost as $item) {
        $stmtPostgres->execute([
            ':legenda' => substr($item['texto'], 0, 256),
            ':id' => $item['id'],
        ]);
    }

    // Confirmar a transação
    $postgres->commit();

    echo "Migração da tabela banner concluída com sucesso para a tabela banner!\n";
}

function migrarBlogPostParaPostgres($tabelasMariaDB, $postgres)
{
    $tabelaBlogPost = $tabelasMariaDB['blogpost'];
    $tabelaBlogcategoria = $tabelasMariaDB['blogcategoria'];

    // Início de uma transação para garantir consistência
    $postgres->beginTransaction();

    $sqlInsereNoticia = file_get_contents('sql/insere_noticia.sql');

    $stmtPostgres = $postgres->prepare($sqlInsereNoticia);

    foreach ($tabelaBlogPost as $item) {
        $stmtPostgres->execute([
            ':id' => $item['id'],
            ':slug' => gerarSlug($item['titulo']),
            ':titulo' => $item['titulo'],
            ':resumo' => substr($item['texto'], 0, 512),
            ':descricao' => $item['texto'],
            ':credito_noticia' => $item['fonte'],
            ':credito_imagem' => $item['fonte'],
            ':credito_fonte' => $item['fonte'],
            ':credito_link' => $item['fonte'],
            ':ativo' => $item['ativo'],
            ':destaque' => $item['destaque'],
            ':data_publicacao' => $item['data'],
            ':data_criacao' => $item['created'],
            ':data_modificacao' => $item['modified'],
        ]);
    }
    $sqlAtualizarIdNoticiaCategoria = file_get_contents('sql/atualiza_id_noticia_categoria_noticia.sql');
    // atualiza_id_noticia_categoria_noticia.sql
    $stmtPostgres = $postgres->prepare($sqlAtualizarIdNoticiaCategoria);

    foreach ($tabelaBlogcategoria as $item) {

        if ($item['deleted'] == 0) {
            $stmtPostgres->execute([
                ':id_noticia_categoria' => $item['id'],
            ]);
        }
    }

    // Confirmar a transação
    $postgres->commit();

    echo "Migração da tabela blogpost concluída com sucesso para a tabela noticia!\n";
}

function migrarBlogCategoriaParaPostgres($tabelasMariaDB, $postgres)
{
    $tabelaBlogcategoria = $tabelasMariaDB['blogcategoria'];

    // Início de uma transação para garantir consistência
    $postgres->beginTransaction();

    $sqlInsereNoticia = file_get_contents('sql/insere_noticia_categoria.sql');

    $stmtPostgres = $postgres->prepare($sqlInsereNoticia);

    foreach ($tabelaBlogcategoria as $item) {
        $stmtPostgres->execute([
            ':id' => $item['id'],
            ':slug' => gerarSlug($item['titulo']),
            ':nome' => $item['titulo'],
            ':data_criacao' => $item['created'],
            ':data_modificacao' => $item['modified'],
        ]);
    }

    // Confirmar a transação
    $postgres->commit();

    echo "Migração da tabela blogpost concluída com sucesso para a tabela noticia_categoria!\n";
}

function migrarGaleriaFotoParaPostgres($tabelasMariaDB, $postgres)
{
    $tabelaGaleriafoto = $tabelasMariaDB['galeriafoto'];
    $tabelaBannerMariaDb = $tabelasMariaDB['banner'];
    $tabelaBlogPost = $tabelasMariaDB['blogpost'];

    $postgres->beginTransaction();

    $sqlInsereMidiaFoto = file_get_contents('sql/insere_midia_foto.sql');

    $stmtPostgres = $postgres->prepare($sqlInsereMidiaFoto);

    foreach ($tabelaGaleriafoto as $item) {
        $stmtPostgres->execute([
            ':id' => $item['id'],
            ':slug' => gerarSlug($item['titulo']),
            ':titulo' => $item['titulo'],
            ':ativo' => $item['ativo'],
            ':destaque' => $item['destaque'],
            ':data_publicacao' => $item['data'],
            ':data_criacao' => $item['created'],
            ':data_modificacao' => $item['modified']
        ]);
    }

    $sqlAtualizaMidiaFoto = file_get_contents('sql/atualiza_link_midia_foto.sql');

    $stmtPostgres = $postgres->prepare($sqlAtualizaMidiaFoto);

    foreach ($tabelaBannerMariaDb as $item) {
        $stmtPostgres->execute([
            ':id' => $item['id'],
            ':link' => $item['link'],
        ]);
    }

    $sqlAtualizaResumoDescricaoCreditoMidiaFoto = file_get_contents('sql/atualiza_resumo_descricao_credito_midia_foto.sql');

    $stmtPostgres = $postgres->prepare($sqlAtualizaResumoDescricaoCreditoMidiaFoto);

    foreach ($tabelaBlogPost as $item) {
        $stmtPostgres->execute([
            ':id' => $item['id'],
            ':resumo' => substr($item['texto'], 0, 512),
            ':descricao' => $item['texto'],
            ':credito' => substr($item['fonte'], 0, 256),
        ]);
    }

    // Confirmar a transação
    $postgres->commit();

    echo "Migração da tabela galeriafoto concluída com sucesso para a tabela midia_foto!\n";
}