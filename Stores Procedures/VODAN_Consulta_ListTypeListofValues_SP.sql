
DELIMITER ;
DROP PROCEDURE IF EXISTS `Vodan_Consulta_ListTypeListofValues_SP`;
DELIMITER $$
CREATE  PROCEDURE `Vodan_Consulta_ListTypeListofValues_SP`(
    ID_ListType INT
	)
BEGIN

	IF ID_ListType <= 0 THEN
		SET ID_ListType = NULL;
	END IF;

	select tl.listTypeID, tl.description,
        json_array(JSON_OBJECTAGG(tl2.listOfValuesID,tl2.description)) as ListofValues
        from tb_listofvalues tl2
    inner join tb_listtype tl on tl2.listTypeID = tl.listTypeID
    WHERE case when ID_ListType is not null then 
        tl.listTypeID = ID_ListType
	else
	    1=1
	end
    group by tl.listTypeID, tl.description;

END $$
DELIMITER ;
