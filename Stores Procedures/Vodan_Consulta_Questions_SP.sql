DELIMITER ;
DROP PROCEDURE IF EXISTS `Vodan_Consulta_Questions_SP`;
DELIMITER $$
CREATE  PROCEDURE `Vodan_Consulta_Questions_SP`(
    ID_Question INT
    ,DS_Search VARCHAR(255)
	)
BEGIN

	IF ID_Question <= 0 THEN
		SET ID_Question = NULL;
	END IF;

    IF DS_Search IS NULL THEN
			SET DS_Search = '';
	END IF;

    SET DS_Search = CONCAT('%', DS_Search, '%');
	select questionID
	     , description
	     , questionTypeID
	     , listTypeID
	     , questionGroupID
	     , subordinateTo
	     , isAbout
	from tb_questions
	where 1=1
	    AND questionID <=> COALESCE(ID_Question,questionID)
        AND ( description LIKE DS_Search);

END $$
DELIMITER ;
