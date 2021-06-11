DELIMITER ;
DROP PROCEDURE IF EXISTS `Vodan_Cadastro_Questions_SP`;
DELIMITER $$
CREATE PROCEDURE `Vodan_Cadastro_Questions_SP`(input  JSON)
BEGIN

DECLARE IDQuestionID INT;
DECLARE DSDescription  VARCHAR(255);
DECLARE IDQuestionType INT;
DECLARE IDListType INT;
DECLARE IDQuestionGroup INT;
DECLARE IDsubordinateto INT;
DECLARE IDisAbout INT;



DECLARE Acao VARCHAR(20);

DECLARE LAST_ID INT;
DECLARE liCount INT;
DECLARE liDados INT;
DECLARE ind BIGINT UNSIGNED DEFAULT 0;
DECLARE code VARCHAR(100);
DECLARE error_string VARCHAR(500);
DECLARE erro VARCHAR(500);

DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN
	 GET DIAGNOSTICS CONDITION 1
     code = RETURNED_SQLSTATE, error_string = MESSAGE_TEXT;
      SET erro = error_string;
    ROLLBACK;
    SELECT '-1' AS resultado, CONCAT(code, ': ', erro) AS Mensagem, NULL AS LastIDInserted;
END;

START TRANSACTION;

SET liDados= JSON_LENGTH(input);
IF liDados > 0 THEN
	SET ind = 0;
	WHILE ind < liDados DO

		SET Acao = VODAN_EXTRACT_TXT(input,ind,'Acao');
        SET IDQuestionID = VODAN_EXTRACT_INT(input,IND,'SQ_Question');
        SET DSDescription = VODAN_EXTRACT_TXT(input,ind,'DS_Description');
        SET IDQuestionType = VODAN_EXTRACT_INT(input,ind,'SQ_QuestionType');
        SET IDListType = VODAN_EXTRACT_INT(input,ind,'SQ_ListType');
        SET IDQuestionGroup = VODAN_EXTRACT_INT(input,ind,'SQ_QuestionGroup');
        SET IDsubordinateto = VODAN_EXTRACT_INT(input,ind,'SQ_SubordinateTo');
        SET IDisAbout = VODAN_EXTRACT_INT(input,ind,'SQ_IsAbout');

        -- validacoes
		IF Acao != 'INCLUIR' AND Acao != 'ALTERAR' AND Acao != 'EXCLUIR'  THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_Questions_SP Acao vazia  ';  /* RETORNAR ERRO */
		END IF;
        IF Acao IS NULL OR Acao = '' THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_Questions_SP Acao vazia  ';  /* RETORNAR ERRO */
        END IF;

		IF DSDescription IS NULL AND Acao ='INCLUIR' THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_Questions_SP DS_Description vazia  ';  /* RETORNAR ERRO */
        END IF;

		IF IDQuestionType IS NOT NULL THEN
            SET IDQuestionType = (SELECT questionTypeID FROM tb_questiontype
                                    WHERE questionTypeID = IDQuestionType);
            IF IDQuestionType IS NULL THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_Questions_SP SQ_QuestionType nao existe  ';  /* RETORNAR ERRO */
            END IF;
		ELSEIF Acao = 'INCLUIR' THEN
		    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_Questions_SP SQ_QuestionType obrigatorio  ';  /* RETORNAR ERRO */
        END IF;

		IF IDListType IS NOT NULL THEN
            SET IDListType = (SELECT listTypeID FROM tb_listtype
                                    WHERE listTypeID = IDListType);
            IF IDListType IS NULL THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_Questions_SP SQ_ListType nao existe  ';  /* RETORNAR ERRO */
            END IF;
        END IF;

		IF IDQuestionGroup IS NOT NULL THEN
            SET IDQuestionGroup = (SELECT questionGroupID FROM tb_questiongroup
                                    WHERE questionGroupID = IDQuestionGroup);
            IF IDQuestionGroup IS NULL THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_Questions_SP SQ_ListofValues nao existe  ';  /* RETORNAR ERRO */
            END IF;
        END IF;

		-- falta validar subordinateto e isAbout

		IF  Acao != 'INCLUIR' THEN
			SET IDQuestionID = (SELECT questionID FROM tb_questions
                                    WHERE questionID = IDQuestionID);
            IF IDQuestionID IS NULL THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_Questions_SP SQ_QuestionGroup nao existe  ';  /* RETORNAR ERRO */
            END IF;
		END IF;

		IF Acao = 'INCLUIR' THEN

			INSERT INTO tb_questions(
				 description
				 , questionTypeID
				 , listTypeID
				 , questionGroupID
				 , subordinateTo
				 , isAbout)
			VALUES(
				DSDescription
				,IDQuestionType
				,IDListType
				,IDQuestionGroup
				,IDsubordinateto
				,IDisAbout
			);

			SET LAST_ID = LAST_INSERT_ID();

		ELSEIF Acao = 'ALTERAR' THEN

			UPDATE tb_questions
			SET
				description = COALESCE(DSDescription, description)
			    ,questionTypeID = COALESCE(IDQuestionType, questionTypeID)
			    ,listTypeID = COALESCE(IDListType, listTypeID)
			    ,questionGroupID = COALESCE(IDQuestionGroup, questionGroupID)
			    ,subordinateTo = COALESCE(IDsubordinateto, subordinateTo)
			    ,isAbout = COALESCE(IDisAbout, isAbout)
			WHERE questionID = IDQuestionID;

			SET LAST_ID = LAST_INSERT_ID();

		ELSEIF Acao = 'EXCLUIR' THEN

			DELETE from tb_questions
			WHERE questionID = IDQuestionID;

			SET LAST_ID = LAST_INSERT_ID();

		END IF;
     SET ind:= ind +1;
    END WHILE ;
END IF;
COMMIT;
SELECT '1' AS  Resultado, 'Sucesso' AS Mensagem, LAST_ID AS LastIDInserted;
END $$
DELIMITER ;
