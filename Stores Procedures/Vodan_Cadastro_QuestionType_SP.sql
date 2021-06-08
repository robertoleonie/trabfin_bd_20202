DELIMITER ;
DROP PROCEDURE IF EXISTS `Vodan_Cadastro_QuestionType_SP`;
DELIMITER $$
CREATE PROCEDURE `Vodan_Cadastro_QuestionType_SP`(input  JSON)
BEGIN

DECLARE DSDescricao VARCHAR(100);
DECLARE IDQuestionType INT;

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
		SET IDQuestionType = VODAN_EXTRACT_INT(input,ind, 'SQ_QuestionType');
		SET DSDescricao = VODAN_EXTRACT_TXT(input,ind,'DS_Descricao');

		IF Acao != 'INCLUIR' AND Acao != 'ALTERAR' AND Acao != 'EXCLUIR'  THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionType_SP Acao vazia  ';  /* RETORNAR ERRO */
		END IF;
        IF Acao IS NULL OR Acao = '' THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionType_SP Acao vazia  ';  /* RETORNAR ERRO */
        END IF;

		IF DSDescricao IS NULL AND  Acao = 'INCLUIR' THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionType_SP DS_Descricao não preenchida  ';  /* RETORNAR ERRO */
		END IF;

		IF DSDescricao IS NOT NULL THEN
			IF DSDescricao = '' THEN
				SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionType_SP DS_Descricao não preenchida';
			ELSE
				SET liCount = (SELECT COUNT(*) FROM tb_questiontype
						WHERE  DSDescricao =  DSDescricao
						AND questionTypeID != IDQuestionType
						);
				IF liCount > 0  AND  Acao = 'INCLUIR' THEN
					SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionType_SP DS_Descricao já existe';
				END IF;
			END IF;
		END IF;

		IF  Acao != 'INCLUIR' THEN
			SET IDQuestionType = (SELECT questionTypeID FROM tb_questiontype
						WHERE questionTypeID = IDQuestionType);
			IF IDQuestionType IS NULL THEN
				SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na Vodan_Cadastro_QuestionType_SP SQ_QuestionType não localizado na base';
			END IF;
		END IF;

		IF Acao = 'INCLUIR' THEN

			INSERT INTO tb_questiontype(
				description)
			VALUES(
				DSDescricao
			);

			SET LAST_ID = LAST_INSERT_ID();

		ELSEIF Acao = 'ALTERAR' THEN

			UPDATE tb_questiontype
			SET
				description = COALESCE(DSDescricao, description)
			WHERE questionTypeID = IDQuestionType;

			SET LAST_ID = LAST_INSERT_ID();

		ELSEIF Acao = 'EXCLUIR' THEN

			DELETE from tb_questiontype
			WHERE questionTypeID = IDQuestionType;

			SET LAST_ID = LAST_INSERT_ID();

		END IF;
     SET ind:= ind +1;
    END WHILE ;
END IF;
COMMIT;
SELECT '1' AS  Resultado, 'Sucesso' AS Mensagem, LAST_ID AS LastIDInserted;
END $$
DELIMITER ;
