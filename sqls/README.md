
### Resumo dos arquivos
##### SQLs_Integradas.sql
Possui as procedures essenciais para clonar algumas tabelas e as relacionadas a ela. Insere uma coluna de versão no questionario que deve ser aumentada sempre que o usuário cloná-la. Possui também procedure pra deleção de questionário. Tudo relativamente auto-explicativo.
##### arquivo.sql
Possui atualizações necessárias para rodar o Script original no windows, possui também as relações para as tabelas.
##### sqls_script_renomacao.sh
Usado para renomear todas tabelas e colunas identificadoras de qualquer script, para adequar-se a [nomenclatura do cake](https://book.cakephp.org/3/en/intro/conventions.html).
***
##### query_relacionamento.sql
Arquivo mais antigo que foi usado para fazer as relações entre as tabelas
##### dump
Arquivo mais antigo, usado para rodar no windwos também. Não possui tanta diferença ao Script original
-- Inserção das novas perguntas do questionário:
***
##### Text_Gestão_de_Questões
Texto contendo a adequação para a criação dos modulos e para as inserções dos formulários

```
INSERT INTO `tb_questions` (`questionID`, `description`, `questionTypeID`, `listTypeID`, `questionGroupID`, `subordinateTo`, `isAbout`) VALUES 
(256, 'Recebeu a Vacina covid - 19', 1, 3, 9, 44, NULL ), 
(257, 'data da 1ª dose', 1, 3, 15, 256, NULL), 
(258,  data 2ª dose, 1, 3, 15, 257, NULL), 
(259, 'Laboratorio produtor', 7, 3, 16, 256, NULL), 
(260, 'Lote da 1ª dose', 7, 3, 16, 257 , NULL ), 
(261, 'Lote da 2ª dose', 7, 3, 16, 258, NULL );
```

-- Inserção dos novos tipos de grupo:
```
INSERT INTO `tb_QuestionGroup` (`questionGroupID`, `description`, `comment`) VALUES 
(15, 'Tomou Vacina', 'O paciente tomou algumas das doses da vacina'), 
(16,  'Dados do Laboratorio',  'NULL' ); 
```
-- Definindo a ordem das novas questões no formulário:
```
INSERT INTO `tb_questiongroupform` (`crfFormsID`, `questionID`, `questionOrder`) VALUES 
(1,256, 10924), 
(1, 257, 10925), 
(1, 258, 10926), 
(1, 259, 10927), 
(1, 260, 10928), 
(1, 261, 10929);
```
