
DELIMITER ;
DROP PROCEDURE IF EXISTS `Vodan_Consulta_QuestionType_SP`;
DELIMITER $$
CREATE  PROCEDURE `Vodan_Consulta_QuestionType_SP`(
    ID_QuestionType INT
    ,DS_Search VARCHAR(255)
	)
BEGIN

	IF ID_QuestionType <= 0 THEN
		SET ID_QuestionType = NULL;
	END IF;

    IF DS_Search IS NULL THEN
			SET DS_Search = '';
	END IF;

    SET DS_Search = CONCAT('%', DS_Search, '%');
	select questionTypeID
        , description
	from tb_questiontype
	where 1=1
	    AND questionTypeID <=> COALESCE(ID_QuestionType,questionTypeID)
        AND ( description LIKE DS_Search);

END $$
DELIMITER ;
