DELIMITER ;
DROP PROCEDURE IF EXISTS `Vodan_Consulta_QuestionGroupFormRecordID_SP`;
DELIMITER $$
CREATE  PROCEDURE `Vodan_Consulta_QuestionGroupFormRecordID_SP`(
    ID_QuestionGroupFormRecordID INT
    ,DS_Search VARCHAR(255)
	)
BEGIN

	IF ID_QuestionGroupFormRecordID <= 0 THEN
		SET ID_QuestionGroupFormRecordID = NULL;
	END IF;

    IF DS_Search IS NULL THEN
			SET DS_Search = '';
	END IF;

    SET DS_Search = CONCAT('%', DS_Search, '%');
	select questionGroupFormRecordID
	     , formRecordID
	     , crfFormsID
	     , questionID
	     , listOfValuesID
	     , answer
	from tb_questiongroupformrecord
	where 1=1
	    AND questionGroupFormRecordID <=> COALESCE(ID_QuestionGroupFormRecordID,questionGroupFormRecordID)
        AND ( answer LIKE DS_Search);

END $$
DELIMITER ;
