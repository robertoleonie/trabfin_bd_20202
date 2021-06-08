
DELIMITER ;
DROP PROCEDURE IF EXISTS `Vodan_Consulta_Language_SP`;
DELIMITER $$
CREATE  PROCEDURE `Vodan_Consulta_Language_SP`(
    ID_Language INT
    ,DS_Search VARCHAR(255)
	)
BEGIN

	IF ID_Language <= 0 THEN
		SET ID_Language = NULL;
	END IF;

    IF DS_Search IS NULL THEN
			SET DS_Search = '';
	END IF;

    SET DS_Search = CONCAT('%', DS_Search, '%');
	select languageID
        , description
	from tb_language
	where 1=1
	    AND languageID <=> COALESCE(ID_Language,languageID)
        AND ( description LIKE DS_Search);

END $$
DELIMITER ;
