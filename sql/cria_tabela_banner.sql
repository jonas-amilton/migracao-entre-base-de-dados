CREATE TABLE IF NOT EXISTS banner (
    id integer PRIMARY KEY,
    id_arquivo integer,
    titulo varchar(256) NOT NULL,
    data_inicio date NOT NULL,
    data_fim date NOT NULL,
    legenda varchar(256),
    link varchar(256),
    tipo_posicao char(3) NOT NULL,
    ordem smallint,
    ativo boolean DEFAULT false NOT NULL,
    nova_guia boolean DEFAULT false NOT NULL,
    data_criacao timestamp(0) without time zone,
    data_modificacao timestamp(0) without time zone
);