INSERT INTO
    noticia (
        id,
        slug,
        titulo,
        resumo,
        descricao,
        credito_noticia,
        credito_imagem,
        credito_fonte,
        credito_link,
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
        :resumo,
        :descricao,
        :credito_noticia,
        :credito_imagem,
        :credito_fonte,
        :credito_link,
        :ativo,
        :destaque,
        :data_publicacao,
        :data_criacao,
        :data_modificacao
    );