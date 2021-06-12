#===================================
# Procedure para clonar lista de respostas
#====================================
USE vodan_original;
START TRANSACTION;

DROP PROCEDURE IF EXISTS `ps_clonar_listtype`;
CREATE PROCEDURE `ps_clonar_listtype`(
	IN ps_list_type_id int
)
BEGIN
	SET @ps_temp := SELECT description FROM tb_listtype WHERE tb_listtype.listTypeID = ps_list_type_id,
	INSERT INTO tb_listtype (`description`) 
	VALUES (CONCAT(
			@ps_temp,
			"_Clone"
		)
	);

# Clonando valores

	DECLARE curs CURSOR FOR SELECT listOfValuesID,description FROM tb_listofvalues WHERE tb_listofvalues.listTypeID = ps_list_type_id;
	DECLARE ps_listTypeID INT;
	DECLARE ps_description VARCHAR(255);
	DECLARE done INT DEFAULT FALSE;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

	OPEN curs;
	cloning_sons: LOOP
		FETCH curs INTO ps_listTypeID, ps_description;
		IF done THEN
			LEAVE cloning_sons;
		END IF;
		INSERT INTO tb_listofvalues (listTypeID,description) VALUES (ps_listTypeID,ps_description);
	END LOOP;
	CLOSE curs;


COMMIT;
