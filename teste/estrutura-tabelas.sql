--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: banner; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE banner (
    id integer NOT NULL,
    id_arquivo integer,
    titulo character varying(256) NOT NULL,
    data_inicio date NOT NULL,
    data_fim date NOT NULL,
    legenda character varying(256),
    link character varying(256),
    tipo_posicao character(3) NOT NULL,
    ordem smallint,
    ativo boolean DEFAULT false NOT NULL,
    nova_guia boolean DEFAULT false NOT NULL,
    data_criacao timestamp(0) without time zone,
    data_modificacao timestamp(0) without time zone
);


ALTER TABLE public.banner OWNER TO postgres;

--
-- Name: banner_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE banner_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.banner_id_seq OWNER TO postgres;

--
-- Name: banner_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE banner_id_seq OWNED BY banner.id;

--
-- Name: noticia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE noticia (
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


ALTER TABLE public.noticia OWNER TO postgres;

--
-- Name: noticia_categoria; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE noticia_categoria (
    id integer NOT NULL,
    slug character varying(256),
    nome character varying(256) NOT NULL,
    data_criacao timestamp(0) without time zone,
    data_modificacao timestamp(0) without time zone
);


ALTER TABLE public.noticia_categoria OWNER TO postgres;

--
-- Name: noticia_categoria_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE noticia_categoria_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.noticia_categoria_id_seq OWNER TO postgres;

--
-- Name: noticia_categoria_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE noticia_categoria_id_seq OWNED BY noticia_categoria.id;


--
-- Name: noticia_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE noticia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.noticia_id_seq OWNER TO postgres;

--
-- Name: noticia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE noticia_id_seq OWNED BY noticia.id;


--
-- Name: midia_foto; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE midia_foto (
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

-- Name: midia_foto_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE midia_foto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.midia_foto_id_seq OWNER TO postgres;

--
-- Name: midia_foto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER TABLE public.midia_foto OWNER TO postgres;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY banner ALTER COLUMN id SET DEFAULT nextval('banner_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY noticia ALTER COLUMN id SET DEFAULT nextval('noticia_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY noticia_categoria ALTER COLUMN id SET DEFAULT nextval('noticia_categoria_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY midia_foto ALTER COLUMN id SET DEFAULT nextval('midia_foto_id_seq'::regclass);