
DELIMITER ;
DROP PROCEDURE IF EXISTS `Vodan_Consulta_GroupRole_SP`;
DELIMITER $$
CREATE  PROCEDURE `Vodan_Consulta_GroupRole_SP`(
    ID_GroupRole INT
    ,DS_Search VARCHAR(255)
	)
BEGIN

	IF ID_GroupRole <= 0 THEN
		SET ID_GroupRole = NULL;
	END IF;

    IF DS_Search IS NULL THEN
			SET DS_Search = '';
	END IF;

    SET DS_Search = CONCAT('%', DS_Search, '%');
	select groupRoleID
        , description
	from tb_grouprole
	where 1=1
	    AND groupRoleID <=> COALESCE(ID_GroupRole,groupRoleID)
        AND ( description LIKE DS_Search);

END $$
DELIMITER ;
