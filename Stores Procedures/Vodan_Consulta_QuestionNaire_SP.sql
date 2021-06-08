
DELIMITER ;
DROP PROCEDURE IF EXISTS `Vodan_Consulta_QuestionNaire_SP`;
DELIMITER $$
CREATE  PROCEDURE `Vodan_Consulta_QuestionNaire_SP`(
    ID_QuestionNaire INT
    ,DS_Search VARCHAR(255)
	)
BEGIN

	IF ID_QuestionNaire <= 0 THEN
		SET ID_QuestionNaire = NULL;
	END IF;

    IF DS_Search IS NULL THEN
			SET DS_Search = '';
	END IF;

    SET DS_Search = CONCAT('%', DS_Search, '%');
	select questionnaireID
        , description
	from tb_questionnaire
	where 1=1
	    AND questionnaireID <=> COALESCE(ID_QuestionNaire,questionnaireID)
        AND ( description LIKE DS_Search);

END $$
DELIMITER ;
