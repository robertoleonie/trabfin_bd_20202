DROP TABLE IF EXISTS `tb_Participant`;
CREATE TABLE `tb_Participant` (
	`participantID` int(10) NOT NULL AUTO_INCREMENT,
	`medicalRecord` varchar(500) NOT NULL COMMENT '(pt-br) prontuário do paciente. \r\n(en) patient medical record.',
    PRIMARY KEY (`participantID`)
);

DROP TABLE IF EXISTS `tb_hospitalunit`;
CREATE TABLE IF NOT EXISTS `tb_hospitalunit` (
  `hospitalUnitID` int(10) NOT NULL AUTO_INCREMENT,
  `hospitalUnitName` varchar(500) NOT NULL COMMENT '(pt-br) Nome da unidade hospitalar.\r\n(en) Name of the hospital unit.',
  PRIMARY KEY (`hospitalUnitID`)
);

DROP TABLE IF EXISTS `tb_Questionnaire`;
CREATE TABLE IF NOT EXISTS `tb_questionnaire` (
  `questionnaireID` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`questionnaireID`)
);

DROP TABLE IF EXISTS `tb_crfforms`;
CREATE TABLE IF NOT EXISTS `tb_crfforms` (
  `crfFormsID` int(10) NOT NULL AUTO_INCREMENT,
  `questionnaireID` int(10) NOT NULL,
  `description` varchar(255) NOT NULL COMMENT '(pt-br) Descrição .\r\n(en) description.',
  PRIMARY KEY (`crfFormsID`),
  KEY `FKtb_CRFForm860269` (`questionnaireID`)
);

DROP TABLE IF EXISTS `tb_questiontype`;
CREATE TABLE IF NOT EXISTS `tb_questiontype` (
  `questionTypeID` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL COMMENT '(pt-br) Descrição.\r\n(en) description.',
  PRIMARY KEY (`questionTypeID`)
);

DROP TABLE IF EXISTS `tb_questiongroup`;
CREATE TABLE IF NOT EXISTS `tb_questiongroup` (
  `questionGroupID` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL COMMENT '(pt-br) Descrição.\r\n(en) description.',
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`questionGroupID`)
);

DROP TABLE IF EXISTS `tb_questions`;
CREATE TABLE IF NOT EXISTS `tb_questions` (
  `questionID` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL COMMENT '(pt-br) Descrição.\r\n(en) description.',
  `questionTypeID` int(10) NOT NULL COMMENT '(pt-br) Chave estrangeira para tabela tb_QuestionsTypes.\r\n(en) Foreign key for the tp_QuestionsTypes table.',
  `listTypeID` int(10) DEFAULT NULL,
  `questionGroupID` int(10) DEFAULT NULL,
  `subordinateTo` int(10) DEFAULT NULL,
  `isAbout` int(10) DEFAULT NULL,
  PRIMARY KEY (`questionID`),
  #KEY `FKtb_Questio240796` (`listTypeID`),
  #KEY `FKtb_Questio684913` (`questionTypeID`),
  #KEY `FKtb_Questio808495` (`questionGroupID`),
  #KEY `SubordinateTo` (`subordinateTo`),
  #KEY `isAbout` (`isAbout`),
  FOREIGN KEY (`questionTypeID`) REFERENCES `tb_QuestionsType` (`questionTypeID`),
  FOREIGN KEY (`listTypeID`) REFERENCES `tb_ListOfValues` (`listTypeID`),
  FOREIGN KEY (`questionGroupID`) REFERENCES `tb_QuestionGroup` (`questionGroupID`)
);

DROP TABLE IF EXISTS `tb_questiongroupform`;
CREATE TABLE IF NOT EXISTS `tb_questiongroupform` (
  `crfFormsID` int(10) NOT NULL,
  `questionID` int(10) NOT NULL,
  `questionOrder` int(10) NOT NULL,
  PRIMARY KEY (`crfFormsID`,`questionID`),
  #KEY `FKtb_Questio124287` (`questionID`),
  FOREIGN KEY (`crfFormsID`) REFERENCES `tb_CRFForms` (`crfFormsID`),
  FOREIGN KEY (`questionID`) REFERENCES `tb_Questions` (`questionID`);
);

DROP TABLE IF EXISTS `tb_listtype`;
CREATE TABLE IF NOT EXISTS `tb_listtype` (
  `listTypeID` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL COMMENT '(pt-br) Descrição.\r\n(en) description.',
  PRIMARY KEY (`listTypeID`)
);

DROP TABLE IF EXISTS `tb_listofvalues`;
CREATE TABLE IF NOT EXISTS `tb_listofvalues` (
  `listOfValuesID` int(10) NOT NULL AUTO_INCREMENT,
  `listTypeID` int(10) NOT NULL,
  `description` varchar(255) NOT NULL COMMENT '(pt-br) Descrição.\r\n(en) description.',
  PRIMARY KEY (`listOfValuesID`),
  #KEY `FKtb_ListOfV184108` (`listTypeID`)
  FOREIGN KEY (`listtypeID`) REFERENCES `tb_ListType` (`listtypeID`);
);

DROP TABLE IF EXISTS `tb_assessmentquestionnaire`;
CREATE TABLE IF NOT EXISTS `tb_assessmentquestionnaire` (
  `participantID` int(10) NOT NULL COMMENT '(pt-br)  Chave estrangeira para a tabela tb_Patient.\r\n(en) Foreign key to the tb_Patient table.',
  `hospitalUnitID` int(10) NOT NULL COMMENT '(pt-br) Chave estrangeira para tabela tb_HospitalUnit.\r\n(en) Foreign key for the tp_HospitalUnit table.',
  `questionnaireID` int(10) NOT NULL,
  PRIMARY KEY (`participantID`,`hospitalUnitID`,`questionnaireID`),
  #KEY `FKtb_Assessm665217` (`hospitalUnitID`),
  #KEY `FKtb_Assessm419169` (`questionnaireID`)
  FOREIGN KEY (`participantID`) REFERENCES `tb_Participant` (`participantID`),
  FOREIGN KEY (`hospitalUnitID`) REFERENCES `tb_HospitalUnit` (`hospitalUnitID`),
  FOREIGN KEY (`questionnaireID`) REFERENCES `tb_Questionnaire` (`questionnaireID`);
);

DROP TABLE IF EXISTS `tb_formrecord`;
CREATE TABLE IF NOT EXISTS `tb_formrecord` (
  `formRecordID` int(10) NOT NULL AUTO_INCREMENT,
  `participantID` int(10) NOT NULL,
  `hospitalUnitID` int(10) NOT NULL,
  `questionnaireID` int(10) NOT NULL,
  `crfFormsID` int(10) NOT NULL,
  `dtRegistroForm` timestamp NOT NULL,
  PRIMARY KEY (`formRecordID`),
  #KEY `FKtb_FormRec2192` (`crfFormsID`),
  #KEY `FKtb_FormRec984256` (`participantID`,`hospitalUnitID`,`questionnaireID`)
  FOREIGN KEY (`participantID`) REFERENCES `tb_Participant` (`participantID`),
  FOREIGN KEY (`hospitalUnitID`) REFERENCES `tb_HospitalUnit` (`hospitalUnitID`),
  FOREIGN KEY (`questionnaireID`) REFERENCES `tb_Questionnaire` (`questionnaireID`),
  FOREIGN KEY (`crfFormsID`) REFERENCES `tb_CRFForms` (`crfFormsID`);
);

DROP TABLE IF EXISTS `tb_questiongroupformrecord`;
CREATE TABLE IF NOT EXISTS `tb_questiongroupformrecord` (
  `questionGroupFormRecordID` int(10) NOT NULL AUTO_INCREMENT,
  `formRecordID` int(10) NOT NULL,
  `crfFormsID` int(10) NOT NULL,
  `questionID` int(10) NOT NULL,
  `listOfValuesID` int(10) DEFAULT NULL,
  `answer` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`questionGroupFormRecordID`),
  #KEY `FKtb_Questio928457` (`listOfValuesID`),
  #KEY `FKtb_Questio489549` (`crfFormsID`,`questionID`),
  #KEY `FKtb_Questio935723` (`formRecordID`)
  FOREIGN KEY (`crfFormsID`) REFERENCES `tb_CRFForms` (`crfFormsID`),
  FOREIGN KEY (`questionID`) REFERENCES `tb_Questions` (`questionID`),
  FOREIGN KEY (`listOfValuesID`) REFERENCES `tb_ListOfValues` (`listOfValuesID`)
);

DROP TABLE IF EXISTS `tb_language`;
CREATE TABLE IF NOT EXISTS `tb_language` (
  `languageID` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`languageID`)
);

DROP TABLE IF EXISTS `tb_multilanguage`;
CREATE TABLE IF NOT EXISTS `tb_multilanguage` (
  `languageID` int(11) NOT NULL,
  `description` varchar(300) NOT NULL,
  `descriptionLang` varchar(500) NOT NULL,
  PRIMARY KEY (`languageID`,`description`),
  FOREIGN KEY (`languageID`) REFERENCES `tb_Language` (`languageID`);
);

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE IF NOT EXISTS `tb_user` (
  `userID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `regionalCouncilCode` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `eMail` varchar(255) DEFAULT NULL,
  `foneNumber` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userID` (`userID`),
  UNIQUE KEY `login` (`login`)
);

DROP TABLE IF EXISTS `tb_grouprole`;
CREATE TABLE IF NOT EXISTS `tb_grouprole` (
  `groupRoleID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`groupRoleID`),
  UNIQUE KEY `groupRoleID` (`groupRoleID`)
);

DROP TABLE IF EXISTS `tb_permission`;
CREATE TABLE IF NOT EXISTS `tb_permission` (
  `permissionID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`permissionID`),
  UNIQUE KEY `permissionID` (`permissionID`)
);

DROP TABLE IF EXISTS `tb_grouprolepermission`;
CREATE TABLE IF NOT EXISTS `tb_grouprolepermission` (
  `groupRoleID` int(11) NOT NULL,
  `permissionID` int(11) NOT NULL,
  PRIMARY KEY (`groupRoleID`,`permissionID`),
  #KEY `FKtb_GroupRo893005` (`permissionID`)
  FOREIGN KEY (`groupRoleID`) REFERENCES `tb_GroupRole` (`groupRoleID`),
  FOREIGN KEY (`permissionID`) REFERENCES `tb_Permission` (`permissionID`)
);

DROP TABLE IF EXISTS `tb_userrole`;
CREATE TABLE IF NOT EXISTS `tb_userrole` (
  `userID` int(11) NOT NULL,
  `groupRoleID` int(11) NOT NULL,
  `hospitalUnitID` int(11) NOT NULL,
  `creationDate` timestamp NOT NULL,
  `expirationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`userID`,`groupRoleID`,`hospitalUnitID`),
  #KEY `FKtb_UserRol864770` (`groupRoleID`),
  #KEY `FKtb_UserRol324331` (`hospitalUnitID`)
  FOREIGN KEY (`userID`) REFERENCES `tb_User` (`userID`),
  FOREIGN KEY (`groupRoleID`) REFERENCES `tb_GroupRole` (`groupRoleID`),
  FOREIGN KEY (`hospitalUnitID`) REFERENCES `tb_HospitalUnit` (`hospitalUnitID`)
);

DROP TABLE IF EXISTS `tb_notificationrecord`;
CREATE TABLE IF NOT EXISTS `tb_notificationrecord` (
  `userID` int(11) NOT NULL,
  `profileID` int(11) NOT NULL,
  `hospitalUnitID` int(11) NOT NULL,
  `tableName` varchar(255) NOT NULL,
  `rowdID` int(11) NOT NULL,
  `changedOn` timestamp NOT NULL,
  `operation` varchar(1) NOT NULL,
  `log` text,
  PRIMARY KEY (`userID`,`profileID`,`hospitalUnitID`,`tableName`,`rowdID`,`changedOn`,`operation`),
  FOREIGN KEY (`userID`) REFERENCES `tb_User` (`userID`),
  FOREIGN KEY (`profileid`) REFERENCES `tb_GroupRole` (`groupRoleID`),
  FOREIGN KEY (`hospitalUnitID`) REFERENCES `tb_HospitalUnit` (`hospitalUnitID`)
);