CREATE TABLE IF NOT EXISTS noticia_categoria (
    id integer NOT NULL,
    slug character varying(256),
    nome character varying(256) NOT NULL,
    data_criacao timestamp(0) without time zone,
    data_modificacao timestamp(0) without time zone
);