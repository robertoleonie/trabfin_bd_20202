DROP PROCEDURE IF EXISTS `ps_clonar_questionnaire`;

DELIMITER // 
CREATE PROCEDURE `ps_deletar_questionnaire`(IN ps_questionnaire_id INT,OUT success BOOLEAN) BEGIN
	SET success = FALSE;
	IF EXISTS(SELECT * FROM tb_formrecord WHERE tb_formrecord.questionnaireID = ps_questionnaire_id) THEN
		SET success = TRUE;
		DELETE FROM tb_questionnaire WHERE tb_questionnaire.questionnaireID = ps_questionnaire_id;
	END IF;
END //
DELIMITER ;
