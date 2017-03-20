 DROP TABLE bcl.kardex;

CREATE TABLE bcl.kardex
(
  id bigserial NOT NULL,
  entrada_saida integer NOT NULL, -- entrada...
  itens_movimentacao_fk bigint,
  valor numeric(12,2),
  qnt integer,
  data_inclusao date DEFAULT ('now'::text)::date,
  custo numeric(12,2),
  CONSTRAINT kardex_pk PRIMARY KEY (id),
  CONSTRAINT itens_movimentacao_kardex_fk FOREIGN KEY (itens_movimentacao_fk)
      REFERENCES bcl.itens_movimentacao (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE bcl.kardex
  OWNER TO postgres;
COMMENT ON COLUMN bcl.kardex.entrada_saida IS 'entrada
saida';



DROP TABLE bcl.balancete;

CREATE TABLE bcl.balancete
(
  id bigint NOT NULL,
  entrada numeric(12,2),
  saida numeric(12,2),
  total numeric(12,2),
  lucro numeric(12,2),
  mes_ano character(7),
  CONSTRAINT pk_balancete PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE bcl.balancete
  OWNER TO postgres;
