SET GLOBAL log_bin_trust_function_creators = 1;
use vodan_br_bd;

DROP TABLE if exists `tb_QuestionsType`;
CREATE TABLE `tb_questionstype` (
	`questionTypeID` int NOT NULL AUTO_INCREMENT,
	`description` varchar(255) NOT NULL COMMENT '(pt-br) Descrição.\r\n(en) description.',
	 PRIMARY KEY (`questionTypeID`)
);

ALTER TABLE `tb_questions`
	ADD FOREIGN KEY (`questionTypeID`) REFERENCES `tb_questionstype` (`questionTypeID`),
	ADD FOREIGN KEY (`listTypeID`) REFERENCES `tb_listofvalues` (`listTypeID`),
	ADD FOREIGN KEY (`questionGroupID`) REFERENCES `tb_questiongroup` (`questionGroupID`);
    
ALTER TABLE `tb_questiongroupform`
	ADD FOREIGN KEY (`crfFormsID`) REFERENCES `tb_crfforms` (`crfFormsID`),
	ADD FOREIGN KEY (`questionID`) REFERENCES `tb_questions` (`questionID`);
    
ALTER TABLE `tb_listofvalues`
	ADD FOREIGN KEY (`listtypeID`) REFERENCES `tb_listtype` (`listtypeID`);
    
ALTER TABLE `tb_assessmentquestionnaire`
	ADD FOREIGN KEY (`participantID`) REFERENCES `tb_participant` (`participantID`),
	ADD FOREIGN KEY (`hospitalUnitID`) REFERENCES `tb_hospitalunit` (`hospitalUnitID`),
	ADD FOREIGN KEY (`questionnaireID`) REFERENCES `tb_questionnaire` (`questionnaireID`);

ALTER TABLE `tb_formrecord`
	ADD FOREIGN KEY (`participantID`) REFERENCES `tb_participant` (`participantID`),
    ADD FOREIGN KEY (`hospitalUnitID`) REFERENCES `tb_hospitalunit` (`hospitalUnitID`),
    ADD FOREIGN KEY (`questionnaireID`) REFERENCES `tb_questionnaire` (`questionnaireID`),
    ADD FOREIGN KEY (`crfFormsID`) REFERENCES `tb_crfforms` (`crfFormsID`);
    
ALTER TABLE `tb_questiongroupformrecord`
	ADD FOREIGN KEY (`crfFormsID`) REFERENCES `tb_crfforms` (`crfFormsID`),
	ADD FOREIGN KEY (`questionID`) REFERENCES `tb_questions` (`questionID`),
    ADD FOREIGN KEY (`listOfValuesID`) REFERENCES `tb_listofvalues` (`listOfValuesID`);
    
ALTER TABLE `tb_multilanguage`
	ADD FOREIGN KEY (`languageID`) REFERENCES `tb_language` (`languageID`);
    
ALTER TABLE `tb_grouprolepermission`
	ADD FOREIGN KEY (`groupRoleID`) REFERENCES `tb_grouprole` (`groupRoleID`),
    ADD FOREIGN KEY (`permissionID`) REFERENCES `tb_permission` (`permissionID`);
    
ALTER TABLE `tb_userrole`
	ADD FOREIGN KEY (`userID`) REFERENCES `tb_user` (`userID`),
    ADD FOREIGN KEY (`groupRoleID`) REFERENCES `tb_grouprole` (`groupRoleID`),
    ADD FOREIGN KEY (`hospitalUnitID`) REFERENCES `tb_hospitalunit` (`hospitalUnitID`);
    
ALTER TABLE `tb_notificationrecord`
	ADD FOREIGN KEY (`userID`) REFERENCES `tb_user` (`userID`),
	ADD FOREIGN KEY (`profileid`) REFERENCES `tb_grouprole` (`groupRoleID`),
    ADD FOREIGN KEY (`hospitalUnitID`) REFERENCES `tb_hospitalunit` (`hospitalUnitID`);
