
DELIMITER ;
DROP PROCEDURE IF EXISTS `Vodan_Consulta_HospitalUnit_SP`;
DELIMITER $$
CREATE  PROCEDURE `Vodan_Consulta_HospitalUnit_SP`(
    ID_HospitalUnit INT
    ,DS_Search VARCHAR(255)
	)
BEGIN

	IF ID_HospitalUnit <= 0 THEN
		SET ID_HospitalUnit = NULL;
	END IF;

    IF DS_Search IS NULL THEN
			SET DS_Search = '';
	END IF;

    SET DS_Search = CONCAT('%', DS_Search, '%');
	select hospitalUnitID, hospitalUnitName
	from tb_hospitalunit
	where 1=1
	    AND hospitalUnitID <=> COALESCE(ID_HospitalUnit,hospitalUnitID)
        AND ( hospitalUnitName LIKE DS_Search);

END $$
DELIMITER ;
