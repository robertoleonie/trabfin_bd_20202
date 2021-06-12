-- Inserção das novas perguntas do questionário:

INSERT INTO `tb_questions` (`questionID`, `description`, `questionTypeID`, `listTypeID`, `questionGroupID`, `subordinateTo`, `isAbout`) VALUES 
(256, 'Recebeu a Vacina covid - 19', 1, 3, 9, 44, NULL ), 
(257, 'data da 1ª dose', 1, 3, 15, 256, NULL), 
(258,  data 2ª dose, 1, 3, 15, 257, NULL), 
(259, 'Laboratorio produtor', 7, 3, 16, 256, NULL), 
(260, 'Lote da 1ª dose', 7, 3, 16, 257 , NULL ), 
(261, 'Lote da 2ª dose', 7, 3, 16, 258, NULL );


-- Inserção dos novos tipos de grupo:

INSERT INTO `tb_QuestionGroup` (`questionGroupID`, `description`, `comment`) VALUES 
(15, 'Tomou Vacina', 'O paciente tomou algumas das doses da vacina'), 
(16,  'Dados do Laboratorio',  'NULL' ); 

-- Definindo a ordem das novas questões no formuçário:

INSERT INTO `tb_questiongroupform` (`crfFormsID`, `questionID`, `questionOrder`) VALUES 
(1,256, 10924), 
(1, 257, 10925), 
(1, 258, 10926), 
(1, 259, 10927), 
(1, 260, 10928), 
(1, 261, 10929);
