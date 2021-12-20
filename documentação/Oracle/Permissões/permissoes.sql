--TABELA
DROP TABLE painelexames.PERMISSAO;
CREATE TABLE painelexames.PERMISSAO (
  CD_PERMISSAO INT NOT NULL,
  TP_PERMISSAO VARCHAR(1) NOT NULL, -- (A) ADMINISTRADOR / (P) PAGINA / (S) SETOR / (I) INDICADOR
  DS_PERMISSAO VARCHAR2(50) NULL,
  CD_USUARIO VARCHAR2(20) NOT NULL, 
  SN_LEITURA VARCHAR2(1) NULL,
  SN_ALTERACAO VARCHAR2(1) NULL,
  SN_GRAVACAO VARCHAR2(1) NULL,
  CD_USUARIO_ULTIMA_ALTERACAO VARCHAR2(20) NOT NULL,
  HR_ULTIMA_ALTERACAO TIMESTAMP NOT NULL
);

--SEQUENCE
DROP SEQUENCE painelexames.SEQ_CD_PERMISSAO;
CREATE SEQUENCE painelexames.SEQ_CD_PERMISSAO  
MINVALUE 1 MAXVALUE 9999999999
INCREMENT BY 1 START WITH 1;

--CONSTRAINTS
ALTER TABLE painelexames.PERMISSAO
ADD CONSTRAINT CK_PERMISSAO_TP_PERMISSAO
CHECK (TP_PERMISSAO IN ('A','L'));

--COMENTARIOS
COMMENT ON COLUMN permissao.CD_PERMISSAO 
IS 'SEQ_CD_PERMISSAO';

COMMENT ON COLUMN permissao.TP_PERMISSAO 
IS '(A) ADMINISTRADOR / (L) LANCAMENTO';

/*****/
/*LOG*/
/*****/

--TABELA
DROP TABLE painelexames.LOG_PERMISSAO;
CREATE TABLE painelexames.LOG_PERMISSAO (
  CD_LOG_PERMISSAO INT NOT NULL,
  CD_PERMISSAO INT NOT NULL,
  TP_PERMISSAO VARCHAR(1) NOT NULL, -- (A) ADMINISTRADOR / (P) PAGINA / (S) SETOR / (I) INDICADOR
  DS_PERMISSAO VARCHAR2(50) NULL,
  CD_USUARIO VARCHAR2(20) NOT NULL, 
  SN_LEITURA VARCHAR2(1) NULL,
  SN_ALTERACAO VARCHAR2(1) NULL,
  SN_GRAVACAO VARCHAR2(1) NULL,
  CD_USUARIO_ULTIMA_ALTERACAO VARCHAR2(20) NOT NULL,
  HR_ULTIMA_ALTERACAO TIMESTAMP NOT NULL,
  --INFORMACOES LOG
  TP_ALTERACAO VARCHAR(1), -- (I) INSERT / (U) UPDATE / (D) DELETE
  TP_UPDATE VARCHAR(1), -- (A) ANTES / (D) DEPOIS
  HR_LOG TIMESTAMP,
  CD_USUARIO_DB_LOG VARCHAR(20) NOT NULL
);

--SEQUENCE
DROP SEQUENCE painelexames.SEQ_CD_LOG_PERMISSAO;
CREATE SEQUENCE painelexames.SEQ_CD_LOG_PERMISSAO  
MINVALUE 1 MAXVALUE 9999999999
INCREMENT BY 1 START WITH 1;

--CONSTRAINTS
ALTER TABLE painelexames.LOG_PERMISSAO
ADD CONSTRAINT CK_LOG_PERMISSAO_TP_PERMISSAO
CHECK (TP_PERMISSAO IN ('A','L'));

ALTER TABLE painelexames.LOG_PERMISSAO
ADD CONSTRAINT CK_LOG_PERMISSAO_TP_ALTERACAO
CHECK (TP_ALTERACAO IN ('I','U','D'));

ALTER TABLE painelexames.LOG_PERMISSAO
ADD CONSTRAINT CK_LOG_PERMISSAO_TP_UPDATE
CHECK (TP_UPDATE IN ('A','D'));

--COMENTARIOS
COMMENT ON COLUMN log_permissao.CD_LOG_PERMISSAO 
IS 'SEQ_CD_LOG_PERMISSAO';

COMMENT ON COLUMN log_permissao.TP_PERMISSAO 
IS '(A) ADMINISTRADOR / (L) LANCAMENTO';

COMMENT ON COLUMN log_permissao.TP_ALTERACAO 
IS '(I) INSERT / (U) UPDATE / (D) DELETE';

COMMENT ON COLUMN log_permissao.TP_UPDATE 
IS '(A) ANTES / (D) DEPOIS';

/*************/
/*TRIGGER LOG*/
/*************/

CREATE OR REPLACE TRIGGER TRG_LOG_PERMISSAO
BEFORE UPDATE OR INSERT OR DELETE
ON painelexames.PERMISSAO
REFERENCING NEW AS NEW OLD AS OLD
  FOR EACH ROW
BEGIN

   IF Inserting THEN

     --INSERT
     INSERT INTO painelexames.LOG_PERMISSAO
     SELECT SEQ_CD_LOG_PERMISSAO.NEXTVAL, :new.CD_PERMISSAO, :new.TP_PERMISSAO, :new.DS_PERMISSAO, :new.CD_USUARIO,
     :new.SN_LEITURA, :new.SN_ALTERACAO, :new.SN_GRAVACAO,
     :new.CD_USUARIO_ULTIMA_ALTERACAO, :new.HR_ULTIMA_ALTERACAO,
     --INFORMACOES LOG
     'I' AS TP_ALTERACAO, NULL TP_UPDATE, SYSTIMESTAMP AS HR_LOG, USER AS CD_USUARIO_DB_LOG
     FROM DUAL;

   ELSIF Updating THEN

     --UPDATE (ANTES)
     INSERT INTO painelexames.LOG_PERMISSAO
     SELECT SEQ_CD_LOG_PERMISSAO.NEXTVAL, :old.CD_PERMISSAO, :old.TP_PERMISSAO, :old.DS_PERMISSAO, :old.CD_USUARIO,
     :old.SN_LEITURA, :old.SN_ALTERACAO, :old.SN_GRAVACAO,
     :old.CD_USUARIO_ULTIMA_ALTERACAO, :old.HR_ULTIMA_ALTERACAO,
     --INFORMACOES LOG
     'U' AS TP_ALTERACAO, 'A' TP_UPDATE, SYSTIMESTAMP AS HR_LOG, USER AS CD_USUARIO_DB_LOG
     FROM DUAL;

     --UPDATE (DEPOIS)
     INSERT INTO painelexames.LOG_PERMISSAO
     SELECT SEQ_CD_LOG_PERMISSAO.NEXTVAL, :new.CD_PERMISSAO, :new.TP_PERMISSAO, :new.DS_PERMISSAO, :new.CD_USUARIO,
     :new.SN_LEITURA, :new.SN_ALTERACAO, :new.SN_GRAVACAO,
     :new.CD_USUARIO_ULTIMA_ALTERACAO, :new.HR_ULTIMA_ALTERACAO,
     --INFORMACOES LOG
     'U' AS TP_ALTERACAO, 'D' TP_UPDATE, SYSTIMESTAMP AS HR_LOG, USER AS CD_USUARIO_DB_LOG
     FROM DUAL;

   ELSIF Deleting THEN

     --DELETE
     INSERT INTO painelexames.LOG_PERMISSAO
     SELECT SEQ_CD_LOG_PERMISSAO.NEXTVAL, :old.CD_PERMISSAO, :old.TP_PERMISSAO, :old.DS_PERMISSAO, :old.CD_USUARIO,
     :old.SN_LEITURA, :old.SN_ALTERACAO, :old.SN_GRAVACAO,
     :old.CD_USUARIO_ULTIMA_ALTERACAO, :old.HR_ULTIMA_ALTERACAO,
     --INFORMACOES LOG
     'D' AS TP_ALTERACAO, NULL TP_UPDATE, SYSTIMESTAMP AS HR_LOG, USER AS CD_USUARIO_DB_LOG
     FROM DUAL;

   END IF;

END;
/

/***********/
/*VALIDACAO*/
/***********/

----------
--INSERT--
----------

INSERT INTO painelexames.PERMISSAO
SELECT SEQ_CD_PERMISSAO.NEXTVAL AS CD_PERMISSAO, 'A' AS TP_PERMISSAO, 'ADMIN' AS DS_PERMISSAO,
'HSSAMPAIO' AS CD_USUARIO, 'S' AS SN_LEITURA, 'S' AS SN_ALTERACAO, 'S' AS SN_GRAVACAO,
'painelexames' AS CD_USUARIO_ULTIMA_ALTERACAO, SYSTIMESTAMP AS HR_ULTIMA_ALTERACAO
FROM DUAL;

COMMIT;

INSERT INTO painelexames.PERMISSAO
SELECT SEQ_CD_PERMISSAO.NEXTVAL AS CD_PERMISSAO, 'A' AS TP_PERMISSAO, 'ADMIN' AS DS_PERMISSAO,
'AVVMELO' AS CD_USUARIO, 'S' AS SN_LEITURA, 'S' AS SN_ALTERACAO, 'S' AS SN_GRAVACAO,
'painelexames' AS CD_USUARIO_ULTIMA_ALTERACAO, SYSTIMESTAMP AS HR_ULTIMA_ALTERACAO
FROM DUAL;

COMMIT;

INSERT INTO painelexames.PERMISSAO
SELECT SEQ_CD_PERMISSAO.NEXTVAL AS CD_PERMISSAO, 'A' AS TP_PERMISSAO, 'ADMIN' AS DS_PERMISSAO,
'TESTE' AS CD_USUARIO, 'S' AS SN_LEITURA, 'S' AS SN_ALTERACAO, 'S' AS SN_GRAVACAO,
'painelexames' AS CD_USUARIO_ULTIMA_ALTERACAO, SYSTIMESTAMP AS HR_ULTIMA_ALTERACAO
FROM DUAL;

COMMIT;

--VALIDA PERMISSAO
SELECT *
FROM painelexames.PERMISSAO pe;

--VALIDA LOG
SELECT *
FROM painelexames.LOG_PERMISSAO pe
WHERE pe.TP_ALTERACAO = 'I';

----------
--UPDATE--
----------

UPDATE painelexames.PERMISSAO pe
SET pe.DS_PERMISSAO = 'SUPER ADMIN'
WHERE pe.CD_USUARIO IN ('HSSAMPAIO','AVVMELO');

COMMIT;

--VALIDA PERMISSAO
SELECT *
FROM painelexames.PERMISSAO pe;

--VALIDA LOG
SELECT *
FROM painelexames.LOG_PERMISSAO pe
WHERE pe.TP_ALTERACAO = 'U';

----------
--DELETE--
----------

UPDATE painelexames.PERMISSAO pe
SET pe.CD_USUARIO_ULTIMA_ALTERACAO = 'painelexames DELETE', pe.HR_ULTIMA_ALTERACAO = SYSTIMESTAMP
WHERE pe.CD_USUARIO = 'TESTE';

DELETE 
FROM painelexames.PERMISSAO pe
WHERE pe.CD_USUARIO = 'TESTE';

COMMIT;

--VALIDA PERMISSAO
SELECT *
FROM painelexames.PERMISSAO pe;

--VALIDA LOG
SELECT *
FROM painelexames.LOG_PERMISSAO pe
WHERE pe.TP_ALTERACAO = 'D';
