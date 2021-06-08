
DELIMITER ;
DROP PROCEDURE IF EXISTS `Vodan_Consulta_QuestionGroup_SP`;
DELIMITER $$
CREATE  PROCEDURE `Vodan_Consulta_QuestionGroup_SP`(
    ID_QuestionGroup INT
    ,DS_Search VARCHAR(255)
	)
BEGIN

	IF ID_QuestionGroup <= 0 THEN
		SET ID_QuestionGroup = NULL;
	END IF;

    IF DS_Search IS NULL THEN
			SET DS_Search = '';
	END IF;

    SET DS_Search = CONCAT('%', DS_Search, '%');
	select questionGroupID
        , description
	    ,comment
	from tb_questiongroup
	where 1=1
	    AND questionGroupID <=> COALESCE(ID_QuestionGroup,questionGroupID)
        AND ( description LIKE DS_Search);

END $$
DELIMITER ;
