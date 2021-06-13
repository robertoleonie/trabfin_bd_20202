#===================================
# Procedure para clonar lista de respostas
#===================================

# START TRANSACTION;
SET @_db_name = 'vodan_br_bd';
DROP PROCEDURE IF EXISTS `ps_clonar_listtype`;

DELIMITER // 
CREATE PROCEDURE `ps_clonar_listtype`(IN ps_list_type_id INT) BEGIN
	DECLARE ps_new_list_type_id INT;
	DECLARE ps_description VARCHAR(255);
	DECLARE done INT DEFAULT FALSE;
	DECLARE curs_list_of_value CURSOR FOR SELECT `description` FROM tb_listofvalues WHERE tb_listofvalues.listTypeID = ps_list_type_id; 
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

	SET @ps_temp := (SELECT `description` FROM tb_listtype WHERE `tb_listtype`.`listTypeID` = ps_list_type_id);
	INSERT INTO `tb_listtype` (`description`) VALUES(CONCAT(@ps_temp,"_Clone"));

# Clonando valores
	SELECT LAST_INSERT_ID() INTO ps_new_list_type_id;
	OPEN curs_list_of_value;
	cloning_sons: LOOP
		FETCH curs_list_of_value INTO ps_description;
		IF done THEN
			LEAVE cloning_sons;
		END IF;
		INSERT INTO tb_listofvalues (listTypeID,`description`) VALUES (ps_new_list_type_id,ps_description);
	END LOOP;
	CLOSE curs_list_of_value;
END //
DELIMITER ;


#===================================
# Comando para adicionar coluna versoes ao questionnaires
#===================================

SET @sql = (SELECT IF(
	(SELECT COUNT(*)
		FROM INFORMATION_SCHEMA.COLUMNS WHERE
		table_schema= @_db_name
		AND table_name='tb_questionnaire' AND column_name='version'
	) > 0,
	"SELECT 'version column exists already'",
	"ALTER TABLE tb_questionnaire ADD COLUMN `version` INT NOT NULL DEFAULT 1;"
));

PREPARE stmt FROM @sql;
EXECUTE stmt;

# COMMIT;
#===================================
# Procedure para clonar modulos
#===================================

DROP PROCEDURE IF EXISTS `ps_clonar_crfform`;

DELIMITER // 
CREATE PROCEDURE `ps_clonar_crfform`(IN ps_crfform_id INT, IN ps_questionnaire_fk INT) BEGIN
	DECLARE ps_new_crfform_id INT;
	DECLARE ps_description VARCHAR(255);
	DECLARE ps_question_order INT;
	DECLARE ps_question_id INT;
	DECLARE done INT DEFAULT FALSE;
	DECLARE curs_crfform CURSOR FOR SELECT questionOrder,questionID FROM tb_questiongroupform WHERE tb_questiongroupform.crfFormsID = ps_crfform_id; 
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

	SELECT `description` INTO ps_description FROM tb_crfforms WHERE tb_crfforms.crfFormsID = ps_crfform_id;
	INSERT INTO `tb_crfforms` (`description`,questionnaireID) VALUES(ps_description,ps_questionnaire_fk);

# Clonando valores
	SELECT LAST_INSERT_ID() INTO ps_new_crfform_id;
	OPEN curs_crfform;
	cloning_sons: LOOP
		FETCH curs_crfform INTO ps_question_order,ps_question_id;
		IF done THEN
			LEAVE cloning_sons;
		END IF;
		INSERT INTO tb_questiongroupform (crfFormsID,questionID,questionOrder) VALUES(ps_new_crfform_id,ps_question_id,ps_question_order);
	END LOOP;
	CLOSE curs_crfform;
END //
DELIMITER ;

#===================================
# Procedure para clonar questionnaires
#===================================

DROP PROCEDURE IF EXISTS `ps_clonar_questionnaire`;

DELIMITER // 
CREATE PROCEDURE `ps_clonar_questionnaire`(IN ps_questionnaire_id INT) BEGIN
	DECLARE ps_new_questionnaire_id INT;
	DECLARE ps_crfform_id INT;
	DECLARE ps_version INT;
	DECLARE ps_description VARCHAR(255);
	DECLARE done INT DEFAULT FALSE;
	DECLARE curs_crfform CURSOR FOR SELECT `crfFormsID` FROM tb_crfforms WHERE tb_crfforms.questionnaireID = ps_questionnaire_id; 
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

	SELECT `version`,`description` INTO ps_version,ps_description FROM tb_questionnaire WHERE tb_questionnaire.questionnaireID = ps_questionnaire_id;
	SET ps_version = ps_version + 1;
	INSERT INTO `tb_questionnaire` (`description`,`version`) VALUES(ps_description,ps_version);

# Clonando filhos
	SELECT LAST_INSERT_ID() INTO ps_new_questionnaire_id;
	OPEN curs_crfform;
	cloning_sons: LOOP
		FETCH curs_crfform INTO ps_crfform_id;
		IF done THEN
			LEAVE cloning_sons;
		END IF;
		Call ps_clonar_crfform(ps_crfform_id,ps_new_questionnaire_id);
	END LOOP;
	CLOSE curs_crfform;
END //
DELIMITER ;

#===================================
# Procedure para deletar questionnaires
#===================================

DROP PROCEDURE IF EXISTS `ps_deletar_questionnaire`;

DELIMITER // 
CREATE PROCEDURE `ps_deletar_questionnaire`(IN ps_questionnaire_id INT,OUT success BOOLEAN) BEGIN
	SET success = FALSE;
	IF NOT EXISTS(SELECT * FROM tb_formrecord WHERE tb_formrecord.questionnaireID = ps_questionnaire_id) THEN
		SET success = TRUE;
		DELETE FROM tb_questionnaire WHERE tb_questionnaire.questionnaireID = ps_questionnaire_id;
	END IF;
END //
DELIMITER ;

