SET GLOBAL log_bin_trust_function_creators = 1;
use vodan_br_bd;

ALTER TABLE `tb_Questions`
	ADD FOREIGN KEY (`questionTypeID`) REFERENCES `tb_QuestionsType` (`questionTypeID`),
	ADD FOREIGN KEY (`listTypeID`) REFERENCES `tb_ListOfValues` (`listTypeID`),
	ADD FOREIGN KEY (`questionGroupID`) REFERENCES `tb_QuestionGroup` (`questionGroupID`);
    
ALTER TABLE `tb_QuestionGroupForm`
	ADD FOREIGN KEY (`crfFormsID`) REFERENCES `tb_CRFForms` (`crfFormsID`),
	ADD FOREIGN KEY (`questionID`) REFERENCES `tb_Questions` (`questionID`);
    
ALTER TABLE `tb_ListOfValues`
	ADD FOREIGN KEY (`listtypeID`) REFERENCES `tb_ListType` (`listtypeID`);
    
ALTER TABLE `tb_AssessmentQuestionnaire`
	ADD FOREIGN KEY (`participantID`) REFERENCES `tb_Participant` (`participantID`),
	ADD FOREIGN KEY (`hospitalUnitID`) REFERENCES `tb_HospitalUnit` (`hospitalUnitID`),
	ADD FOREIGN KEY (`questionnaireID`) REFERENCES `tb_Questionnaire` (`questionnaireID`);

ALTER TABLE `tb_FormRecord`
	ADD FOREIGN KEY (`participantID`) REFERENCES `tb_Participant` (`participantID`),
    ADD FOREIGN KEY (`hospitalUnitID`) REFERENCES `tb_HospitalUnit` (`hospitalUnitID`),
    ADD FOREIGN KEY (`questionnaireID`) REFERENCES `tb_Questionnaire` (`questionnaireID`),
    ADD FOREIGN KEY (`crfFormsID`) REFERENCES `tb_CRFForms` (`crfFormsID`);
    
ALTER TABLE `tb_QuestionGroupFormRecord`
	ADD FOREIGN KEY (`crfFormsID`) REFERENCES `tb_CRFForms` (`crfFormsID`),
	ADD FOREIGN KEY (`questionID`) REFERENCES `tb_Questions` (`questionID`),
    ADD FOREIGN KEY (`listOfValuesID`) REFERENCES `tb_ListOfValues` (`listOfValuesID`);
    
ALTER TABLE `tb_MultiLanguage`
	ADD FOREIGN KEY (`languageID`) REFERENCES `tb_Language` (`languageID`);
    
ALTER TABLE `tb_GroupRolePermission`
	ADD FOREIGN KEY (`groupRoleID`) REFERENCES `tb_GroupRole` (`groupRoleID`),
    ADD FOREIGN KEY (`permissionID`) REFERENCES `tb_Permission` (`permissionID`);
    
ALTER TABLE `tb_UserRole`
	ADD FOREIGN KEY (`userID`) REFERENCES `tb_User` (`userID`),
    ADD FOREIGN KEY (`groupRoleID`) REFERENCES `tb_GroupRole` (`groupRoleID`),
    ADD FOREIGN KEY (`hospitalUnitID`) REFERENCES `tb_HospitalUnit` (`hospitalUnitID`);
    
ALTER TABLE `tb_NotificationRecord`
	ADD FOREIGN KEY (`userID`) REFERENCES `tb_User` (`userID`),
	ADD FOREIGN KEY (`profileid`) REFERENCES `tb_GroupRole` (`groupRoleID`),
    ADD FOREIGN KEY (`hospitalUnitID`) REFERENCES `tb_HospitalUnit` (`hospitalUnitID`);