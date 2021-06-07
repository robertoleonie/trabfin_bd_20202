
DELIMITER ;
DROP PROCEDURE IF EXISTS `Vodan_Consulta_ListType_SP`;
DELIMITER $$
CREATE  PROCEDURE `Vodan_Consulta_ListType_SP`(
    ID_ListType INT
    ,DS_Search VARCHAR(255)
	)
BEGIN

	IF ID_ListType <= 0 THEN
		SET ID_ListType = NULL;
	END IF;

    IF DS_Search IS NULL THEN
			SET DS_Search = '';
	END IF;

    SET DS_Search = CONCAT('%', DS_Search, '%');
	select listTypeID
        , description
	from tb_listtype
	where 1=1
	    AND listTypeID <=> COALESCE(ID_ListType,listTypeID)
        AND ( description LIKE DS_Search);

END $$
DELIMITER ;
