DROP TABLE TESTE_ASSINATURAS;

CREATE TABLE TESTE_ASSINATURAS
(
  cd_atendimento INT not null,
  nm_paciente    VARCHAR2(200) not null,
  dt_atendimento DATE not null,
  nm_convenio    VARCHAR2(200) not null,
  nome_anexo     VARCHAR2(200),
  blob_anexo     BLOB
);

SELECT * FROM TESTE_ASSINATURAS;
