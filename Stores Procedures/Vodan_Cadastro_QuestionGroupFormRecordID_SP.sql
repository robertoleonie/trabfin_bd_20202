DELIMITER ;
DROP PROCEDURE IF EXISTS `Vodan_Cadastro_QuestionGroupFormRecordID_SP`;
DELIMITER $$
CREATE PROCEDURE `Vodan_Cadastro_QuestionGroupFormRecordID_SP`(input  JSON)
BEGIN

DECLARE IDQuestionGroupFormRecordID INT;
DECLARE IDFormRecordID INT;
DECLARE IDCrfFormsID INT;
DECLARE IDQuestionID INT;
DECLARE IDListofValuesID INT;
DECLARE DSAnswer VARCHAR(500);


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
		SET IDQuestionGroupFormRecordID = VODAN_EXTRACT_INT(input,IND,'SQ_QuestionGroupFormRecord');
        SET IDFormRecordID = VODAN_EXTRACT_INT(input,IND,'SQ_FormRecord');
        SET IDCrfFormsID = VODAN_EXTRACT_INT(input,IND,'SQ_CrfForms');
        SET IDQuestionID = VODAN_EXTRACT_INT(input,IND,'SQ_Question');
        SET IDListofValuesID = VODAN_EXTRACT_INT(input,IND,'SQ_ListofValues');
        SET DSAnswer = VODAN_EXTRACT_TXT(input,IND,'DS_Answer');

        -- validacoes
		IF Acao != 'INCLUIR' AND Acao != 'ALTERAR' AND Acao != 'EXCLUIR'  THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionGroupFormRecordID_SP Acao vazia  ';  /* RETORNAR ERRO */
		END IF;
        IF Acao IS NULL OR Acao = '' THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionGroupFormRecordID_SP Acao vazia  ';  /* RETORNAR ERRO */
        END IF;

		IF IDFormRecordID IS NOT NULL THEN
            SET IDFormRecordID = (SELECT formRecordID FROM tb_formrecord
                                    WHERE formRecordID = IDFormRecordID);
            IF IDFormRecordID IS NULL THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionGroupFormRecordID_SP SQ_FormRecord nao existe  ';  /* RETORNAR ERRO */
            END IF;
		ELSEIF Acao = 'INCLUIR' THEN
		    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionGroupFormRecordID_SP SQ_FormRecord obrigatorio  ';  /* RETORNAR ERRO */
        END IF;

		IF IDCrfFormsID IS NOT NULL THEN
            SET IDCrfFormsID = (SELECT crfFormsID FROM tb_crfforms
                                    WHERE crfFormsID = IDCrfFormsID);
            IF IDCrfFormsID IS NULL THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionGroupFormRecordID_SP SQ_CrfForms nao existe  ';  /* RETORNAR ERRO */
            END IF;
		ELSEIF Acao = 'INCLUIR' THEN
		    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionGroupFormRecordID_SP SQ_CrfForms obrigatorio  ';  /* RETORNAR ERRO */
        END IF;

		IF IDQuestionID IS NOT NULL THEN
            SET IDQuestionID = (SELECT questionID FROM tb_questions
                                    WHERE questionID = IDQuestionID);
            IF IDQuestionID IS NULL THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionGroupFormRecordID_SP SQ_Question nao existe  ';  /* RETORNAR ERRO */
            END IF;
		ELSEIF Acao = 'INCLUIR' THEN
		    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionGroupFormRecordID_SP SQ_Question obrigatorio  ';  /* RETORNAR ERRO */
        END IF;

		IF IDListofValuesID IS NOT NULL THEN
            SET IDListofValuesID = (SELECT listOfValuesID FROM tb_listofvalues
                                    WHERE listOfValuesID = IDListofValuesID);
            IF IDListofValuesID IS NULL THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionGroupFormRecordID_SP SQ_ListofValues nao existe  ';  /* RETORNAR ERRO */
            END IF;
		ELSEIF Acao = 'INCLUIR' THEN
		    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionGroupFormRecordID_SP SQ_ListofValues obrigatorio  ';  /* RETORNAR ERRO */
        END IF;

		IF  Acao != 'INCLUIR' THEN
			SET IDQuestionGroupFormRecordID = (SELECT questionGroupFormRecordID FROM tb_questiongroupformrecord
						WHERE questionGroupFormRecordID = IDQuestionGroupFormRecordID);
			IF IDQuestionGroupFormRecordID IS NULL THEN
				SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionGroupFormRecordID_SP SQ_QuestionGroupFormRecord não localizado na base';
			END IF;
		END IF;

		IF Acao = 'INCLUIR' THEN

			INSERT INTO tb_questiongroupformrecord(
				 formRecordID
				, crfFormsID
				, questionID
				, listOfValuesID
				, answer)
			VALUES(
				IDFormRecordID
				,IDCrfFormsID
				,IDQuestionID
				,IDListofValuesID
				,DSAnswer
			);

			SET LAST_ID = LAST_INSERT_ID();

		ELSEIF Acao = 'ALTERAR' THEN

			UPDATE tb_questiongroupformrecord
			SET
				formRecordID = COALESCE(IDFormRecordID, formRecordID)
			    ,crfFormsID = COALESCE(IDCrfFormsID, crfFormsID)
			    ,questionID = COALESCE(IDQuestionID, questionID)
			    ,listOfValuesID = COALESCE(IDListofValuesID, listOfValuesID)
			    ,answer = COALESCE(DSAnswer, answer)
			WHERE questionGroupFormRecordID = IDQuestionGroupFormRecordID;

			SET LAST_ID = LAST_INSERT_ID();

		ELSEIF Acao = 'EXCLUIR' THEN

			DELETE from tb_questiongroupformrecord
			WHERE questionGroupFormRecordID = questionGroupFormRecordID;

			SET LAST_ID = LAST_INSERT_ID();

		END IF;
     SET ind:= ind +1;
    END WHILE ;
END IF;
COMMIT;
SELECT '1' AS  Resultado, 'Sucesso' AS Mensagem, LAST_ID AS LastIDInserted;
END $$
DELIMITER ;
