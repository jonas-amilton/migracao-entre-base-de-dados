# Instruções:

Criei o script com a ideia de que já exista um MariaDB legado rodando, ele vai criar as tabelas no PostgreSQL e migrar os dados.

- Utilizei o Dbeaver como gerenciador, instalei a versão 10.5 do MariaDB e o PostgreSQL versão 16.
- Conectei no DBeaver os dois bancos, executei aquele SQL do MariaDB apenas para criar o banco legado no DBeaver, após isso criei o script em PHP.
- Ele vai copiar os dados do banco de dados 'teste' do MariaDB para o banco de dados 'postgres' do PostgreSQL.

### Conectar nos bancos de dados:

```
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
```

### Executar comando:

```
php migrar_dados.php
```
