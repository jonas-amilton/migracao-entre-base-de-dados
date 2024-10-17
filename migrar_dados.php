<?php
// Inclui o arquivo de configuração dos Bancos
require 'config.php';
// Inclui o arquivo de funções auxiliares
require 'funcoes_auxiliares.php';
// Inclui o arquivo de migração
require 'migracoes.php';

// Inicia as conexões com MariaDB e PostgreSQL
try {
    $mariadb = criarConexao($configs['mariadb']);
    $postgres = criarConexao($configs['postgres']);

    echo "Conexões estabelecidas com sucesso!\n";
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

try {
    // Cria a tabela no PostgreSQL, se não existir
    // Lê os arquivos SQL
    $sqlBanner = file_get_contents('sql/cria_tabela_banner.sql');
    $sqlNoticia = file_get_contents('sql/cria_tabela_noticia.sql');
    $sqlNoticiaCategoria = file_get_contents('sql/cria_tabela_noticia_categoria.sql');
    $sqlMidiaFoto = file_get_contents('sql/cria_tabela_midia_foto.sql');

    // Chama a função para criar as tabelas: banner, noticia, noticia_categoria, midia_foto
    criaTabelaNoPostgres($postgres, $sqlBanner);
    criaTabelaNoPostgres($postgres, $sqlNoticia);
    criaTabelaNoPostgres($postgres, $sqlNoticiaCategoria);
    criaTabelaNoPostgres($postgres, $sqlMidiaFoto);

    // Tabelas para migrar: banner, blogpost, galeriafoto e blogcategoria
    $tabelasMariaDB = [
        'banner' => consultaTabelaNoMariaDB($mariadb, 'banner'),
        'blogpost' => consultaTabelaNoMariaDB($mariadb, 'blogpost'),
        'galeriafoto' => consultaTabelaNoMariaDB($mariadb, 'galeriafoto'),
        'blogcategoria' => consultaTabelaNoMariaDB($mariadb, 'blogcategoria'),
    ];

    // Inicia a migração
    executaMigracao($tabelasMariaDB, $postgres);
} catch (Exception $e) {
    // Reverter a transação em caso de erro
    $postgres->rollBack();
    echo "Erro na migração: " . $e->getMessage() . "\n";
}

// comando: php migrar_dados.php