<?php
// Configurações dos Bancos
$configs = [
    'mariadb' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'teste',
        'username' => 'root',
        'password' => 'root',
    ],
    'postgres' => [
        'driver' => 'pgsql',
        'host' => 'localhost',
        'database' => 'postgres',
        'username' => 'postgres',
        'password' => 'root',
    ]
];

// Função para criar conexões PDO
function criarConexao(array $config): PDO
{
    // Monta a string DSN para a conexão
    $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['database']}";

    // Cria a conexão PDO
    $pdo = new PDO($dsn, $config['username'], $config['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Define a codificação para UTF-8
    $pdo->exec("SET NAMES 'utf8'");

    return $pdo;
}