CREATE TABLE IF NOT EXISTS midia_foto (
    id integer NOT NULL,
    slug character varying(256),
    titulo character varying(256) NOT NULL,
    resumo character varying(512),
    descricao text,
    credito character varying(256),
    link character varying(256),
    ativo boolean DEFAULT false NOT NULL,
    destaque boolean DEFAULT false NOT NULL,
    data_publicacao timestamp(0) without time zone,
    data_criacao timestamp(0) without time zone,
    data_modificacao timestamp(0) without time zone
);