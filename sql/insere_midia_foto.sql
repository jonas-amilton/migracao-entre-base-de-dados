INSERT INTO
    midia_foto (
        id,
        slug,
        titulo,
        ativo,
        destaque,
        data_publicacao,
        data_criacao,
        data_modificacao
    )
VALUES
    (
        :id,
        :slug,
        :titulo,
        :ativo,
        :destaque,
        :data_publicacao,
        :data_criacao,
        :data_modificacao
    );