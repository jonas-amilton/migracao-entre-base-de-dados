<?php
// echo 'executando funções auxiliares...';

/**
 * Gera um slug a partir de um título
 *
 * @param string $titulo
 */
function gerarSlug($titulo)
{
    // Converte o título para minúsculas
    $slug = strtolower($titulo);

    // Substitui espaços por hífens
    $slug = str_replace(' ', '-', $slug);

    // Remove caracteres especiais, mantendo letras, números e hífens
    $slug = preg_replace('/[^a-z0-9-]/', '', $slug);

    // Remove hífens duplicados
    $slug = preg_replace('/-+/', '-', $slug);

    // Remove hífens no início e no final do slug
    $slug = trim($slug, '-');

    return $slug;
}

/**
 * Cria uma tabela no PostgreSQL
 * 
 * @param PDO $postgres
 * @param string $sql
 */
function criaTabelaNoPostgres($postgres, $sql)
{
    try {
        // Cria a tabela no PostgreSQL, se não existir
        $postgres->exec($sql);
        echo "Tabela criada ou já existente no PostgreSQL.\n";
    } catch (Exception $e) {
        // Debug em caso de erro
        echo "Erro na criação da tabela: " . $e->getMessage() . "\n";
    }
}

/**
 * Consulta uma tabela no MariaDB e retorna seus registros
 * 
 * @param PDO $mariadb
 * @param string $tabela
 */
function consultaTabelaNoMariaDB($mariadb, $tabela)
{
    $queryMariaDB = $mariadb->query("SELECT * FROM {$tabela}");

    return $queryMariaDB->fetchAll();
}