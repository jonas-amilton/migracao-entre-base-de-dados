INSERT INTO
    banner (
        id,
        titulo,
        data_inicio,
        data_fim,
        link,
        tipo_posicao,
        ordem,
        ativo,
        data_criacao,
        data_modificacao
    )
VALUES
    (
        :id,
        :titulo,
        :data_inicio,
        :data_fim,
        :link,
        :tipo_posicao,
        :ordem,
        :ativo,
        :data_criacao,
        :data_modificacao
    );