CREATE TABLE IF NOT EXISTS noticia (
    id integer NOT NULL,
    slug character varying(256),
    titulo character varying(256) NOT NULL,
    resumo character varying(512) NOT NULL,
    descricao text NOT NULL,
    credito_noticia character varying(256),
    credito_imagem character varying(256),
    credito_fonte character varying(512),
    credito_link character varying(256),
    ativo boolean DEFAULT false NOT NULL,
    destaque boolean DEFAULT false NOT NULL,
    data_publicacao timestamp(0) without time zone NOT NULL,
    data_criacao timestamp(0) without time zone,
    data_modificacao timestamp(0) without time zone,
    id_noticia_categoria integer
);