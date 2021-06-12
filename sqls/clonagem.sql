#===================================
# Procedure para clonar lista de respostas
#====================================

START TRANSACTION;

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
COMMIT;
