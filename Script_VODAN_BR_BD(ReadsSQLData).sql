-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 20-Maio-2021 às 20:00
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

-- drop database vodandb;

-- create database vodan_br_bd;

use vodan_br_bd;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vodan_br_bd_disciplina`
--

DELIMITER $$
--
-- Procedimentos
--
DROP PROCEDURE IF EXISTS `CreateUserAdmin`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateUserAdmin` (OUT `p_msg_retorno` VARCHAR(500))  sp:BEGIN

declare v_userid integer;
DECLARE EXIT HANDLER FOR SQLEXCEPTION, 1062 
BEGIN
	ROLLBACK;
	SELECT 'Ocorreu um erro durante a execução do procedimento. Contacte o administrador!' Message; 
END;
  

START TRANSACTION;

# criação do administrador do sistema
Insert into tb_user
(login, firstName, lastName, regionalCouncilcode, password, email, fonenumber)
values ('Admin', 'Administrador', 'Sistema', 'CRM/CRF', 'admin', 'adminsys@gmail.com', '5555-5555');

set v_userid = LAST_INSERT_ID();

If v_userid is null then
   ROLLBACK;
   leave sp;
end if;

## associando o usuario administrador para cada um dos hospitais cadastrados no sistema
Insert into tb_userrole (userid, grouproleid, hospitalunitid, creationDate)
select v_userid, 1, hospitalunitid, now() from tb_hospitalUnit;

set p_msg_retorno = 'Cadastro realizado com sucesso';

COMMIT;

 END$$

DROP PROCEDURE IF EXISTS `getcrfForms`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getcrfForms` (`p_questionnaireID` INTEGER)  BEGIN
#========================================================================================================================
#== Procedure criada para retornar os modulos associados a um Questionario de Avaliação (Pesquisa Clinica)
#== Criada em 25 jan 2021
#========================================================================================================================
  select t1.crfFormsId, translate('pt-br', t1.description) as description
  from tb_crfforms t1, tb_questionnaire t2
  where t1.questionnaireID = t2.questionnaireID and
        t2.questionnaireID = p_questionnaireID;
END$$

DROP PROCEDURE IF EXISTS `getModulesMedicalRecord`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getModulesMedicalRecord` (`p_MedicalRecord` VARCHAR(255), `p_hospitalUnitId` INTEGER)  BEGIN
#========================================================================================================================
#== Procedure criada para retornos os modulos existentes para um paciente no sistema
#== Alterada em 23 Fev de 2021
#== Tratar os novos prontuarios - nao possuem nenhum módulo lançado
#== 27 dez 2020
#== inserido tratamento para verificar se o numero do prontuario está cadastrado para o hospital
#== caso nao esteja procedure retorna msg informando o problema.
#========================================================================================================================

DECLARE v_msg_retorno varchar(500);
DECLARE v_participantId integer;

sp:Begin
	    set v_participantID = null;
        
        select participantID into v_participantId from tb_participant
               where medicalRecord = p_MedicalRecord;
 
		if v_participantId is null then
			set v_msg_retorno = 'Prontuario Médico não cadastrado para o Hospital. Verifique!';
            select v_msg_retorno as msgRetorno from DUAL;
            leave sp;
        end if;

		select t2.participantID, t2.medicalRecord, t1.formrecordid, t1.crfformsid, t3.description as Modulo, 
				( select t4.answer from tb_QuestionGroupFormRecord t4 where
						t4.formRecordId = t1.formRecordId and
						t4.crfFormsID = t1.crfFormsID and
						t4.questionid in (167,168,124) ) as dataRefer, #avaliando datas de cada formulário
						t1.dtRegistroForm as dtRegistroSystem,
						(select count(*) from tb_questiongroupform t5 where
										  t5.crfFormsID = t1.crfFormsID) as questionTot,
						(select count(*) from tb_questiongroupformRecord t6 where
										  t6.crfFormsID = t1.crfFormsID and
                                          t6.formRecordID = t1.formRecordID  ) as questionAnswerTot
		from 
			tb_participant t2
			left join tb_formrecord t1 on t1.participantid = t2.participantid and
									      t1.hospitalUnitID = p_hospitalUnitId
            left join  tb_crfforms T3 on t3.crfFormsID = t1.crfFormsID
		where 
			t2.medicalRecord = p_medicalRecord
		order by dataRefer, t1.crfformsID;
END; # fim do sp:

END$$

DROP PROCEDURE IF EXISTS `getqst_rsp_modulo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getqst_rsp_modulo` (`p_crfformid` INTEGER)  BEGIN
#========================================================================================================================
#== Procedure criada para retornar todas as questoes de um modulo 
#== As questões podem estar associadas diretamente ao modulo ou a um agrupamento
#== Alterada em 16 dez 2020
#== Criada em 19 nov 2020
#========================================================================================================================

 select crfformsid as modId, questionid as qstId,
	      translate('pt-br', questionGroup) as dsc_qst_grp,
		 translate('pt-br', question) as dsc_qst,
	 		    questionType as qst_type,
	            (select  GROUP_CONCAT(translate('pt-br',tlv.description)) as listofvalue from tb_listofvalues tlv
                 where listtypeid = tb_Questionario.listtypeid
                 order by tlv.listOfValuesID) as rsp_pad,
	            (select  GROUP_CONCAT(convert(tlv1.listOfValuesID, char)) as listofvalueID from tb_listofvalues tlv1
                 where tlv1.listtypeid = tb_Questionario.listtypeid
                 order by tlv1.listOfValuesID) as rsp_padId,
                 cast(IdQuestaoSubordinada_A as UNSIGNED ) as idsub_qst,
	             translate('pt-br', questaosubordinada_a) as sub_qst
		from (
			select crfformsid, questionid, questionorder, 
				   formulario, 
				   (case when questiongroup is null then '' else questiongroup end) as questionGroup,
				   (case when commentquestiongroup is null then '' else commentquestiongroup end) as commentquestiongroup,
				   Question,
				   QuestionType, listTypeResposta, listTypeID, IdQuestaoSubordinada_A, QuestaoSubordinada_A, QuestaoReferente_A
			from (
			select t5.crfformsid, t1.questionid, t9.questionorder,
				   t5.description as formulario,
				   (select t2.description from tb_questiongroup t2 where t2.questiongroupid = t1.questiongroupid) as questionGroup,
				   (select t2.comment from tb_questiongroup t2 where t2.questiongroupid = t1.questiongroupid) as commentquestionGroup,
					t1.description as question,
				   (select t3.description as questionType from tb_questiontype t3 where t3.questiontypeid = t1.questiontypeid) as questionType,
				   (select t6.description from tb_listType t6 where t6.listtypeid = t1.listtypeid) as listTypeResposta,
				   t1.listtypeid,
                   (select t7.questionid from tb_questions t7 where t7.questionId = t1.subordinateTo) as IdQuestaoSubordinada_A,
				   (select description from tb_questions t7 where t7.questionId = t1.subordinateTo) as QuestaoSubordinada_A,
				   (select description from tb_questions t8 where t8.questionId = t1.isabout) as QuestaoReferente_A
			from tb_questions t1,  tb_crfForms t5, tb_questionGroupForm t9
			where t5.crfformsid = p_crfformid and
			t9.crfformsid = t5.crfformsid and t9.questionid = t1.questionid
			) as tabela_Formulario ) as tb_Questionario
			Order by crfformsid, questionorder;	
END$$

DROP PROCEDURE IF EXISTS `getqst_rsp_modulo_medicalRecord`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getqst_rsp_modulo_medicalRecord` (`p_formRecordId` INTEGER)  BEGIN
#========================================================================================================================
#== Procedure criada para retornar as respostas de um módulo já inserido no sistema
#== Atençao ao retorno das questões respondidas. Importante verificar se a resposta esta associada a uma list type ou não
#== Atenção as questões referentes a laboratório. Resultado pode conter o valor anormal medido ou o texto 'Não feito'
#== Criada em 07 dez 2020
#========================================================================================================================
DECLARE v_crfformsid integer;

# Capturando o modulo que será retornado
set v_crfformsid = 0;
    
select crfFormsID into v_crfformsid from tb_formrecord  
           where formRecordID = p_formRecordId;
           
select   tb_Qst.crfformsid as modId, tb_Qst.questionid as qstId,
				translate('pt-br', tb_Qst.questionGroup) as dsc_qst_grp,
				translate('pt-br', tb_Qst.question) as dsc_qst,
				tb_Qst.questionType as qst_type,
				tb_rspt.listOfvaluesid, translate('pt-br', tb_rspt.listofvalue) as rsp_listofvalue,
				tb_rspt.answer,
					   # (select  GROUP_CONCAT(translate('pt-br',tlv.description), ' | ') as listofvalue from tb_listofvalues tlv
					   #  where listtypeid = tb_Questionario.listtypeid ) as rsp_pad,
				cast(tb_Qst.IdQuestaoSubordinada_A as UNSIGNED ) as idsub_qst,
				translate('pt-br', tb_Qst.questaosubordinada_a) as sub_qst
				from (
					select crfformsid, questionid, questionorder, 
						   formulario, 
						   (case when questiongroup is null then '' else questiongroup end) as questionGroup,
#						   (case when commentquestiongroup is null then '' else commentquestiongroup end) as commentquestiongroup,
						   Question,
						   QuestionType, listTypeResposta, listTypeID, IdQuestaoSubordinada_A, QuestaoSubordinada_A, QuestaoReferente_A
					from (
					select t5.crfformsid, t1.questionid, t9.questionorder,
						   t5.description as formulario,
						   (select t2.description from tb_questiongroup t2 where t2.questiongroupid = t1.questiongroupid) as questionGroup,
						   t1.description as question,
						   (select t3.description as questionType from tb_questiontype t3 where t3.questiontypeid = t1.questiontypeid) as questionType,
						   (select t6.description from tb_listType t6 where t6.listtypeid = t1.listtypeid) as listTypeResposta,
						   t1.listtypeid,
						   (select t7.questionid from tb_questions t7 where t7.questionId = t1.subordinateTo) as IdQuestaoSubordinada_A,
						   (select description from tb_questions t7 where t7.questionId = t1.subordinateTo) as QuestaoSubordinada_A,
						   (select description from tb_questions t8 where t8.questionId = t1.isabout) as QuestaoReferente_A
					from tb_questions t1,  tb_crfForms t5, tb_questionGroupForm t9
					where t5.crfformsid = v_crfformsid and
					t9.crfformsid = t5.crfformsid and t9.questionid = t1.questionid
					) as tabela_Formulario ) as tb_Qst
                    left join
                    ( Select t1.formRecordId, t1.participantid, t1.hospitalunitid,
							 t1.crfformsid, t2.questiongroupformRecordId, t2.questionId,
							 t2.listOfvaluesid, (select description from tb_listofvalues t3 where t3.listofvaluesid = t2.listofvaluesid) as listofvalue,
							 t2.answer
						from tb_formrecord t1, tb_questiongroupformrecord t2
							  where t2.formRecordID = t1.formRecordID and
								    t1.crfformsid = v_crfformsid and
                                    t1.formrecordid = p_formrecordid ) as tb_Rspt
					on tb_rspt.questionId = tb_qst.questionid
					Order by tb_qst.crfformsid, tb_qst.questionorder;	
END$$

DROP PROCEDURE IF EXISTS `getuser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getuser` (`p_login` VARCHAR(255), `p_password` VARCHAR(255))  BEGIN
#========================================================================================================================
#== Procedure criada para validar um usuário no sistema
#== Se Login e password estiverem corretas retorna
#== UserId, FirstName, LastName, HospitalUnitId, HospitalUnitName, expirationDate,
#== situation, grouproleid, userrole
#== Atenção: Retornará todos os hospitais para os quais o usuário tenha um papel associado, podendo apresentar acesso expirado.
#== Alterada em 07 dez 2020
#========================================================================================================================
 		   select t1.userid, 
                 t1.firstname, 
                 t1.lastname, 
                 t3.hospitalunitid, 
                 t3.hospitalunitname as hospitalName, 
                 t2.expirationdate,
				case when (t3.hospitalunitid is not null) and (t2.expirationdate) is null then 'Ativo'
                     when (t3.hospitalunitid is null) and (t2.expirationdate) is null then 'Usuário Ativo, sem hospital associado.'
				else 'Acesso expirado. Contacte o Administrador.' end as situation,
				t4.grouproleid, 
                t4.description as userrole
				from tb_user t1 left join tb_userRole t2 on t2.userid = t1.userid
                left join tb_HospitalUnit t3 on  t3.hospitalunitid = t2.hospitalunitid
                left join tb_grouprole t4 on t4.grouproleid = t2.grouproleid
			where  t1.login = p_login and
				   t1.password = p_password;
END$$

DROP PROCEDURE IF EXISTS `postgrouproleforuserhospital`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `postgrouproleforuserhospital` (`p_adminid` INTEGER, `p_adminGroupRoleid` INTEGER, `p_adminHospitalUnitid` INTEGER, `p_userid` INTEGER, `p_groupRole` VARCHAR(255), OUT `p_msg_retorno` VARCHAR(500))  sp:BEGIN
#========================================================================================================================
#== Procedure criada para a inclusão/alteração de roles para usuários no sistema
#== Cria a associação de um usuário a um hospital exercendo um papel
#== Atenção o usuario será associado ao hospital ao qual o administrador esta associado
#== Se esse papel já existe, restabelece ou cancela o acesso por meio da data de expiração
#== Criada em 07 dez 2020
#========================================================================================================================

DECLARE v_Exist integer;
DECLARE v_grouproleId integer;
DECLARE v_hospitalUnitName varchar(500);
DECLARE v_expiration timestamp;
DECLARE v_alteracao text;

	DECLARE EXIT HANDLER FOR SQLEXCEPTION, 1062 
    BEGIN
		ROLLBACK;
        SELECT 'Ocorreu um erro durante a execução do procedimento. Contacte o administrador!' Message; 
    END;
    
    set p_groupRole = rtrim(ltrim(p_groupRole));
    set v_hospitalUnitName = '';
 	
    # verificando preenchimento dos campos considerados obrigatórios
	if ( p_userid is null or p_userid = 0 or p_groupRole = '' ) then
	    set p_msg_retorno = 'Campos obrigatórios devem ser preenchidos. Verifique.';
        leave sp;
	end if;
	
    # identificando o hospital para associação do usuário
    select hospitalUnitName into v_hospitalUnitName from tb_HospitalUnit
           where HospitalUnitId = p_adminHospitalUnitid ;
	
    if v_hospitalUnitName is null then
	    set p_msg_retorno = 'Verifique o Hospital.';
        leave sp;
	end if;
    
    # Identificando o papel do usuário para o hospital
    select groupRoleID into v_grouproleId from tb_grouprole 
           where description = p_groupRole;
    
    if v_groupRoleId is null then
	    set p_msg_retorno = 'Verifique o papel selecionado. ';
        leave sp;
	end if;

   # verificando se o usuário já existe no sistema associado ao hospital/papel
   select 1 into v_exist from tb_userrole where 
				userid = p_userid and grouproleid = v_grouproleid and hospitalunitid = p_adminHospitalUnitid;
   
   START TRANSACTION;
	# se usuário existir 
    if v_Exist = 1 then
			# verificar data de expiração 	
			set v_expiration = null;
			
			select expirationDate into v_expiration from tb_userrole where 
				userid = p_userid and grouproleid = v_grouproleid and hospitalunitid = p_adminHospitalunitid;

			if v_expiration is null then
                # Suspende acesso do usuário ao hospital no referido papel 
				Update tb_userrole
				set expirationDate = now()
				where userid = p_userid and grouproleid = v_grouproleid and hospitalunitid = p_adminHospitalunitid;
                
                set v_alteracao = CONCAT( 'Suspenso acesso do usuário', CONVERT(p_userid, char), ' ao hospital ', v_hospitalUnitName);
			else 
				# libera usuário para acesso ao hospital no papel 
					Update tb_userrole
					set expirationDate = null
					where userid = p_userid and grouproleid = v_grouproleid and hospitalunitid = p_adminHospitalunitid;
                    
                    set v_alteracao = CONCAT( 'Retorno de acesso do usuário', CONVERT(p_userid, char), ' ao hospital ', v_hospitalUnitName);
			end if;
            
			set p_msg_retorno =  'Procedimento realizado com sucesso.';
	else 
		# Inserindo o registro do papel associado a um hospital             
		INSERT INTO tb_UserRole (
					userId, grouproleId, hospitalUnitId, creationDate )
				VALUES ( p_userid, v_grouproleid, p_adminHospitalUnitid, now() );

	    set v_alteracao = CONCAT( 'Concessão de acesso do usuário', CONVERT(p_userid, char), ' ao hospital ', v_hospitalUnitName);
		
        set p_msg_retorno = CONCAT ('Usuário registrado com sucesso para o hospital: ',  v_hospitalUnitName);
        
	end if;
    
    # registrando a informação de notificação de Ajuste de papel/hospital 
    INSERT INTO tb_notificationrecord (
			userid, profileid, hospitalunitid, tablename, rowdid, changedon, operation, log)
            values (p_adminid, p_admingrouproleid, p_adminhospitalunitid, 'tb_userrole', 0, now(), 'A', v_alteracao);

    
	COMMIT;
		
END$$

DROP PROCEDURE IF EXISTS `postMedicalRecord`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `postMedicalRecord` (`p_userid` INTEGER, `p_groupRoleid` INTEGER, `p_hospitalUnitid` INTEGER, `p_questionnaireId` INTEGER, `p_medicalRecord` VARCHAR(255))  BEGIN
#========================================================================================================================
#== Procedure criada para o registro de um participant associado a um hospital para futuro lançamento dos modulos do formulario
#== Cria o registro na tb_participant e na tb_AssessmentQuestionnaire
#== retorna um registro contendo o participantId e a msg de retorno
#== Alterada em 22 dez 2020
#== Criada em 21 dez 2020
#========================================================================================================================

DECLARE v_Exist integer;
DECLARE p_participantId integer;
DECLARE p_msg_retorno varchar(500);

sp:BEGIN 

	DECLARE EXIT HANDLER FOR SQLEXCEPTION, 1062 
    BEGIN
		ROLLBACK;
        SELECT 'Ocorreu um erro durante a execução do procedimento. Contacte o administrador!' Message; 
    END;
    
	set p_medicalrecord = rtrim(ltrim(p_medicalRecord));

	if (p_medicalRecord is null) or ( p_medicalRecord = '')  then
 	    set p_msg_retorno = 'Informe o numero do prontuário eletronico para cadastro. ';
        leave sp;   
    end if;
    
    set p_participantId = null;
                         
	# verificando se já existe registro criado para o paciente no hospital para registro desse questionario
    Select t1.participantID into p_participantId from tb_assessmentquestionnaire t1, tb_participant t2
		where t1.participantID = t2.participantid and
			  hospitalUnitID = p_hospitalunitid and
              questionnaireID = p_questionnaireid and
              t2.medicalRecord = p_medicalRecord;
                         
 	if ( p_participantId is not null ) then
	    set p_msg_retorno = 'Prontuário já registrado para o Hospital.';
        leave sp;
	end if;
	
   START TRANSACTION;
	# Inserindo o registro do participante      
	INSERT INTO tb_participant (
			    medicalRecord)
                values (p_medicalRecord);
	set p_participantid = LAST_INSERT_ID();
    
	if p_participantid is NULL then
       ROLLBACK;
	    set p_msg_retorno = 'Erro no registro do Prontuario Medico. Verifique!';
        leave sp;
	end if;
    
    INSERT INTO tb_assessmentquestionnaire (
				participantID, hospitalUnitId, questionnaireId )
		    VALUES ( p_participantid, p_hospitalUnitid, p_questionnaireId );


    # registrando a informação de notificação para a inclusao do modulo 
    INSERT INTO tb_notificationrecord (
			userid, profileid, hospitalunitid, tablename, rowdid, changedon, operation, log)
            values (p_userid, p_grouproleid, p_hospitalunitid, 'tb_participant', p_participantid, now(), 'I', CONCAT('Inclusão de paciente: ', p_medicalRecord));

    # registrando a informação de notificação para a inclusao da questão referente a data do modulo
    INSERT INTO tb_notificationrecord (
			userid, profileid, hospitalunitid, tablename, rowdid, changedon, operation, log)
            values (p_userid, p_grouproleid, p_hospitalunitid, 'tb_assessmentquestionnaire', 0, now(), 'I', CONCAT('Inclusão do registro referente ao paciente: ', CONVERT(p_participantId, char), ' para o hospital: ', CONVERT(p_hospitalunitid, char)));
    
	COMMIT;

    set p_msg_retorno = 'Registro do Prontuario Medico com Sucesso';

END sp;	

## select inserido para tratar limitaçao do retorno de procedures no Laravel
Select p_participantid as participantId, p_msg_retorno as msgRetorno FROM DUAL;
  
END$$

DROP PROCEDURE IF EXISTS `postMedicalRecord_ComOutput`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `postMedicalRecord_ComOutput` (`p_userid` INTEGER, `p_groupRoleid` INTEGER, `p_hospitalUnitid` INTEGER, `p_questionnaireId` INTEGER, `p_medicalRecord` VARCHAR(255), OUT `p_participantid` INTEGER, OUT `p_msg_retorno` VARCHAR(500))  sp:BEGIN
#========================================================================================================================
#== Procedure criada para o registro de um participant associado a um hospital para futuro lançamento dos modulos do formulario
#== Cria o registro na tb_participant e na tb_AssessmentQuestionnaire
#== Criada em 21 dez 2020
#========================================================================================================================

DECLARE v_Exist integer;
 

	DECLARE EXIT HANDLER FOR SQLEXCEPTION, 1062 
    BEGIN
		ROLLBACK;
        SELECT 'Ocorreu um erro durante a execução do procedimento. Contacte o administrador!' Message; 
    END;
    
	set p_medicalrecord = rtrim(ltrim(p_medicalRecord));

	if (p_medicalRecord is null) or ( p_medicalRecord = '')  then
 	    set p_msg_retorno = 'Informe o numero do prontuário eletronico para cadastro. ';
        leave sp;   
    end if;
                         
	# verificando se já existe registro criado para o paciente no hospital para registro desse questionario
    Select 1 into v_Exist from tb_assessmentquestionnaire t1, tb_participant t2
		where t1.participantID = t2.participantid and
			  hospitalUnitID = p_hospitalunitid and
              questionnaireID = p_questionnaireid and
              t2.medicalRecord = p_medicalRecord;
                         
 	if ( v_Exist = 1 ) then
	    set p_msg_retorno = 'Prontuário já registrado para o Hospital.';
        leave sp;
	end if;
	
   START TRANSACTION;
	# Inserindo o registro do participante      
	INSERT INTO tb_participant (
			    medicalRecord)
                values (p_medicalRecord);
	set p_participantid = LAST_INSERT_ID();
    
	if p_participantid is NULL then
       ROLLBACK;
	    set p_msg_retorno = 'Erro no registro do Prontuario Medico. Verifique!';
        leave sp;
	end if;
    
    INSERT INTO tb_assessmentquestionnaire (
				participantID, hospitalUnitId, questionnaireId )
		    VALUES ( p_participantid, p_hospitalUnitid, p_questionnaireId );


    # registrando a informação de notificação para a inclusao do modulo 
    INSERT INTO tb_notificationrecord (
			userid, profileid, hospitalunitid, tablename, rowdid, changedon, operation, log)
            values (p_userid, p_grouproleid, p_hospitalunitid, 'tb_participant', p_participantid, now(), 'I', CONCAT('Inclusão de paciente: ', p_medicalRecord));

    # registrando a informação de notificação para a inclusao da questão referente a data do modulo
    INSERT INTO tb_notificationrecord (
			userid, profileid, hospitalunitid, tablename, rowdid, changedon, operation, log)
            values (p_userid, p_grouproleid, p_hospitalunitid, 'tb_assessmentquestionnaire', 0, now(), 'I', CONCAT('Inclusão do registro referente ao paciente: ', CONVERT(p_participantId, char), ' para o hospital: ', CONVERT(p_hospitalunitid, char)));
    
	COMMIT;
		
END$$

DROP PROCEDURE IF EXISTS `postmoduloMedicalRecord`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `postmoduloMedicalRecord` (`p_userid` INTEGER, `p_groupRoleid` INTEGER, `p_hospitalUnitid` INTEGER, `p_participantid` INTEGER, `p_questionnaireId` INTEGER, `p_crfFormId` INTEGER, `p_dataEvento` DATE, OUT `p_formRecordId` INTEGER, OUT `p_msg_retorno` VARCHAR(500))  BEGIN
#========================================================================================================================
#== Procedure criada para a inclusão de um módulo de um formulario no sistema para um participante
#== Cria o registro base do formulario e notifica o responsavel por essa inclusão
#== Alterada em 08 dez 2020
#========================================================================================================================

DECLARE v_Exist integer;
DECLARE v_questionid integer;
DECLARE v_questionGroupFormid integer;
 

sp:BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION, 1062 
    BEGIN
		ROLLBACK;
        SELECT 'Ocorreu um erro durante a execução do procedimento. Contacte o administrador!' Message; 
    END;
    
	if p_dataEvento is null then
 	    set p_msg_retorno = 'Informar a data associada ao evento. Verifique.';
        leave sp;   
    end if;
    
    set v_questionid = case p_crfformid when  1 then 167  # data de admissão
										when  2 then 168  # data de acompanhamento
										else 124    #data do desfecho
					   end;
                     
	# verificando se já existe registro criado para a data informada
    Select 1 into v_Exist from tb_formrecord t1
		where participantID = p_participantid and
			  hospitalUnitID = p_hospitalunitid and
              crfFormsID = p_crfformid and
              exists (select 1 from tb_QuestionGroupFormRecord t2 
                   where t1.formrecordid = t2.formrecordid and
                         t2.questionid = v_questionid and
                         CONVERT(t2.answer, date) = p_dataevento);
                         
    # verificando preenchimento dos campos considerados obrigatórios
	if ( v_Exist = 1 ) then
	    set p_msg_retorno = 'Já existe módulo criado para esta data. Verifique.';
        leave sp;
	end if;
	
   START TRANSACTION;
	# Inserindo o registro do form e a questão associada a data             
	INSERT INTO tb_FormRecord (
				participantID, hospitalUnitId, questionnaireId, crfFormsID, dtRegistroForm )
		    VALUES ( p_participantid, p_hospitalUnitid, p_questionnaireId, p_crfformid, now() );

	set p_formRecordid = LAST_INSERT_ID();
    
    if p_formRecordid is NULL then
       ROLLBACK;
	    set p_msg_retorno = 'Erro na inclusão do registro. Verifique!';
        leave sp;
	end if;
    
    INSERT INTO tb_questiongroupformrecord (
             formRecordID, crfFormsID, questionid, answer)
             values (p_formRecordId, p_crfFormId, v_questionid, CONVERT(p_dataEvento, CHAR));
             
	set v_questionGroupFormid = LAST_INSERT_ID();
    
	if v_questionGroupFormid is NULL then
       ROLLBACK;
	    set p_msg_retorno = 'Erro na inclusão do registro. Verifique!';
        leave sp;
	end if;

    # registrando a informação de notificação para a inclusao do modulo 
    INSERT INTO tb_notificationrecord (
			userid, profileid, hospitalunitid, tablename, rowdid, changedon, operation, log)
            values (p_userid, p_grouproleid, p_hospitalunitid, 'tb_formRecord', p_formrecordid, now(), 'I', CONCAT('Inclusão de Modulo para paciente: ', CONVERT(p_participantId, char)));

    # registrando a informação de notificação para a inclusao da questão referente a data do modulo
    INSERT INTO tb_notificationrecord (
			userid, profileid, hospitalunitid, tablename, rowdid, changedon, operation, log)
            values (p_userid, p_grouproleid, p_hospitalunitid, 'tb_questiongroupformrecord', v_questionGroupFormid, now(), 'I', CONCAT('Inclusão da questão referente a data do Modulo para paciente: ', CONVERT(p_participantId, char)));
    
	COMMIT;
    
    set p_msg_retorno = 'Inclusão com sucesso.';

END sp;
 ## select inserido para tratar limitaçao do retorno de procedures no Laravel
select p_formrecordid as formRecordId, p_msg_retorno as msgRetorno from DUAL;
		
END$$

DROP PROCEDURE IF EXISTS `postqstmoduloMedicalRecord`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `postqstmoduloMedicalRecord` (`p_userid` INTEGER, `p_groupRoleid` INTEGER, `p_hospitalUnitid` INTEGER, `p_participantid` INTEGER, `p_questionnaireId` INTEGER, `p_crfFormId` INTEGER, `p_stringquestions` TEXT, OUT `p_formRecordId` INTEGER, OUT `p_msg_retorno` VARCHAR(500))  BEGIN
#========================================================================================================================
#== Procedure criada para incluir um modulo e registrar suas questoes e respostas de um módulo de um formulario no sistema para um participante
#== Criada em 21 dez 2020
#== Alterada em 24 jan 2021 - tratamento do idioma respostas padronizadas
#========================================================================================================================

DECLARE v_Exist integer;
DECLARE v_question varchar(50);
DECLARE v_answer varchar(500);
DECLARE v_questionid integer;
DECLARE v_listOfValuesid integer;
DECLARE v_listtypeid integer;
DECLARE v_questionGroupFormid integer;
DECLARE v_lista text;
DECLARE v_apoio varchar(500);
DECLARE v_resposta varchar(500);
DECLARE v_listofvaluesid_ant integer;
DECLARE v_answer_ant varchar(500);
DECLARE v_operacao varchar(01);
 

	DECLARE EXIT HANDLER FOR SQLEXCEPTION, 1062 
    BEGIN
		ROLLBACK;
        SELECT 'Ocorreu um erro durante a execução do procedimento. Contacte o administrador!' Message; 
    END;
    
sp:BEGIN		
   START TRANSACTION;
   	# Inserindo o registro do form/modulo para o paciente             
	INSERT INTO tb_FormRecord (
				participantID, hospitalUnitId, questionnaireId, crfFormsID, dtRegistroForm )
		    VALUES ( p_participantid, p_hospitalUnitid, p_questionnaireId, p_crfformid, now() );

	set p_formRecordid = LAST_INSERT_ID();
    
    if p_formRecordid is NULL then
       ROLLBACK;
	    set p_msg_retorno = 'Erro na inclusão do módulo. Verifique!';
        leave sp;
	end if;
    
	# registrando a informação de notificação para a inclusao do modulo 
    INSERT INTO tb_notificationrecord (
			userid, profileid, hospitalunitid, tablename, rowdid, changedon, operation, log)
            values (p_userid, p_grouproleid, p_hospitalunitid, 'tb_formRecord', p_formrecordid, now(), 'I', CONCAT('Inclusão de Modulo para paciente: ', CONVERT(p_participantId, char)));

	# Inserindo/Alterando as questoes registro do form e a questão associada a data    
    
    set v_lista = concat(p_stringquestions, ',') ;
    
    while length(v_lista) > 1 DO
		set v_apoio = substring(v_lista, 1, position(',' in v_lista));
		set v_question = substring(v_apoio, 1, position(':' in v_apoio) - 1);
		set v_answer     = substring(v_apoio, position(':' in v_apoio) + 1, position(',' in v_apoio) - 1);
        set v_answer     = REPLACE(v_answer, ',', '');
		set v_questionid = CONVERT(v_question, SIGNED);
	
        # verificando se a questão exige um tipo de resposta padronizada
        set v_listtypeid = null;
        set v_listofvaluesid = null;
        Select listtypeid into v_listtypeid from tb_questions
							where questionid = v_questionid;

		#select v_question, v_listtypeid, v_answer; 
		if (v_listtypeid is not NULL) then
               SELECT listofvaluesid into v_listOfValuesid 
                    from tb_listtype t1, tb_listofvalues t2
                    where t1.listTypeID = v_listtypeid and
						  t2.listTypeID = t1.listTypeID and
                          translate('pt-br', rtrim(ltrim(t2.description))) = rtrim(ltrim(v_answer)); 
                          
			   if v_listOfvaluesid is not null then
			         set v_resposta = concat('Resposta da ', v_question, ':', v_answer, ' - ', convert (v_listtypeid, char), ':', convert(v_listofvaluesid, char));
					 set v_answer = '';
			   else # não foi localizada resposta para a questão - nao será inserida
                     set v_resposta = '';
                     set v_answer = '';
			   end if;
	    else
			   set v_resposta = concat('Resposta da ', v_question, ':', v_answer);
               set v_listofvaluesid = null;
        end if;
 
		# select v_resposta, v_question, v_answer;

        if v_resposta <> '' then
        
				# verificar se a questão já havia sido respondido e o valor foi alterado
                select listofvaluesid, answer into v_listofvaluesid_ant, v_answer_ant
					    from tb_questiongroupformrecord
                        where formRecordID = p_formRecordid and questionid = v_question;
				
                # se questão ainda nao foi respondida
                if v_listofvaluesid_ant is null and v_answer_ant is null then
                        set v_operacao = 'I';
                        set v_resposta = CONCAT('Inclusão de ', v_resposta);
                        
						INSERT INTO tb_questiongroupformrecord (
							formRecordID, crfFormsID, questionid, listofvaluesid, answer)
							values (p_formRecordId, p_crfFormId, v_questionid, v_listofvaluesid, v_answer);
				
						set v_questionGroupFormid = LAST_INSERT_ID();
    
						if v_questionGroupFormid is NULL then
							ROLLBACK;
							set p_msg_retorno = 'Erro na inclusão do registro. Verifique!';
							leave sp;
						end if;
				else
                        set v_operacao = 'A';
                        set v_resposta = CONCAT('Exclusão da Resposta: ', convert(v_listofvaluesid_ant, char), ' - ', v_answer_ant, ' para Inclusão de ', v_resposta);

						select questionGroupFormRecordID into v_questionGroupFormid 
                            from tb_questiongroupformrecord
                        	where formRecordID = p_formrecordid and questionid = v_questionid;     

						Update tb_questiongroupformrecord 
                            set listofvaluesid = v_listofvaluesid,
                                answer = v_answer
							where questionGroupFormRecordID = v_questionGroupFormid;
                        
                
                end if;
				# registrando a informação de notificação para a inclusao/Alteração da questão referente a data do modulo
				INSERT INTO tb_notificationrecord (
						userid, profileid, hospitalunitid, tablename, rowdid, changedon, operation, log)
						values (p_userid, p_grouproleid, p_hospitalunitid, 'tb_questiongroupformrecord', v_questionGroupFormid, now(), v_operacao, v_resposta);
 
	    end if;
        
  #      SELECT v_lista, length(v_lista), position(',' in v_lista);
        if position(',' in v_lista) < length(v_lista) then
	  	   set v_lista = substring(v_lista,  position(',' in v_lista) + 1, length(v_lista));
		else 
           set v_lista = '';
		end if;
	
	End While;
	    
	COMMIT;
END;

	select p_formRecordid, p_msg_retorno from DUAL;
		
END$$

DROP PROCEDURE IF EXISTS `postuser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `postuser` (`p_adminid` INTEGER, `p_adminGroupRoleid` INTEGER, `p_adminHospitalUnitid` INTEGER, `p_login` VARCHAR(255), `p_firstname` VARCHAR(100), `p_lastname` VARCHAR(100), `p_regionalcouncilcode` VARCHAR(255), `p_password` VARCHAR(255), `p_email` VARCHAR(255), `p_fonenumber` VARCHAR(255), `p_groupRole` VARCHAR(255), OUT `p_userid` INTEGER, OUT `p_msg_retorno` VARCHAR(500))  sp:BEGIN
#========================================================================================================================
#== Procedure criada para a inclusão de usuários no sistema
#== Durante a inclusão realiza a associação do usuário a um Hospital, definindo o papel que ele exercerá
#== Atenção o usuario será associado ao hospital do administrador
#== Alterada em 09 dez 2020
#========================================================================================================================

DECLARE v_Exist integer;
DECLARE v_grouproleId integer;
DECLARE v_hospitalUnitName varchar(500);

	DECLARE EXIT HANDLER FOR SQLEXCEPTION, 1062 
    BEGIN
		ROLLBACK;
        SELECT 'Ocorreu um erro durante a execução do procedimento. Contacte o administrador!' Message; 
    END;
    
    set p_login = rtrim(ltrim(p_login));
    set p_firstName = rtrim(ltrim(p_firstName));
    set p_email = rtrim(ltrim(p_email));
    set p_fonenumber = rtrim(ltrim(p_fonenumber));
    set p_groupRole = rtrim(ltrim(p_groupRole));
    
    # verificando preenchimento dos campos considerados obrigatórios
	if (p_login = '' or p_firstName = '' or p_lastName = '' or p_email = '' or p_fonenumber = '' or p_groupRole = '' ) then
	    set p_msg_retorno = 'Campos obrigatórios devem ser preenchidos. Verifique.';
        leave sp;
	end if;
	
    # identificando o hospital para associação do usuário
    select hospitalUnitName into v_hospitalUnitName from tb_HospitalUnit
           where HospitalUnitid = p_adminHospitalUnitid;
	
    if v_hospitalUnitName is null then
	    set p_msg_retorno = 'Hospital não identificado no cadastro. Verifique.';
        leave sp;
	end if;
    
    # Identificando o papel do usuário para o hospital
    select groupRoleID into v_grouproleId from tb_grouprole 
           where description = rtrim(ltrim(p_groupRole));
    
    if v_groupRoleId is null then
	    set p_msg_retorno = 'Selecione um papel a ser exercido junto ao Hospital. ';
        leave sp;
	end if;
    
    # verificando se o usuário já existe no sistema
	select 1 into v_Exist from tb_user where login = p_login;
	
	if v_Exist = 1 then
	   set p_msg_retorno =  'Login já existe. Verifique.';
       leave sp;
	end if;
	
	select 1 into v_Exist from tb_user where email = p_email;
	if v_Exist = 1 then
	   set p_msg_retorno =  'e-mail já cadastrado no sistema. Verifique.';
       leave sp;
	end if;
    
    START TRANSACTION;
	
    # Inserindo o registro do usuário
	INSERT INTO tb_user(
		 login, firstname, lastname, regionalcouncilcode, password, email, fonenumber)
	VALUES ( p_login, p_firstName, p_lastName, p_regionalCouncilCode, p_Password, 
			 p_email, p_fonenumber);
             
    set p_userid = LAST_INSERT_ID();
    
    if p_userid is null then
       ROLLBACK;
	   set p_msg_retorno =  'Problemas na inclusão de informações. Verifique.';
       leave sp;
	end if;

    # Inserindo o registro do papel associado a um hospital             
	INSERT INTO tb_UserRole (
		  userId, grouproleId, hospitalUnitId, creationDate )
	VALUES ( p_userid, v_grouproleid, p_adminHospitalUnitId, now() );

	set p_msg_retorno = CONCAT ('Usuário registrado com sucesso para o hospital: ' , v_hospitalUnitName);
    
	# registrando a informação de notificação de inclusão do usuario 
    INSERT INTO tb_notificationrecord (
			userid, profileid, hospitalunitid, tablename, rowdid, changedon, operation, log)
            values (p_adminid, p_admingrouproleid, p_adminhospitalunitid, 'tb_user', p_userid, now(), 'I', CONCAT('Inclusão de dados do Usuario: ', p_login));

 
    
    COMMIT;
	
		
END$$

DROP PROCEDURE IF EXISTS `putMedicalRecord`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `putMedicalRecord` (`p_userid` INTEGER, `p_groupRoleid` INTEGER, `p_hospitalUnitid` INTEGER, `p_questionnaireId` INTEGER, `p_participantId` INTEGER, `p_medicalRecordNew` VARCHAR(255), OUT `p_msg_retorno` VARCHAR(500))  BEGIN
#========================================================================================================================
#== Procedure criada para o atualizar o registro de um participant associado a um hospital para futuro lançamento dos modulos do formulario
#== Altera o numero do Prontuario na tb_participant
#== Alterada em 21 dez 2020
#========================================================================================================================

DECLARE v_MedicalRecordExist varchar(255);
DECLARE v_alteracao varchar(700);
 
sp:BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION, 1062 
    BEGIN
		ROLLBACK;
        SELECT 'Ocorreu um erro durante a execução do procedimento. Contacte o administrador!' Message; 
    END;
    
	set p_medicalrecordNew = rtrim(ltrim(p_medicalRecordNew));

	if (p_medicalrecordNew is null) or ( p_medicalrecordNew = '')  then
 	    set p_msg_retorno = 'Informe o numero do prontuário eletronico para a atualização. ';
        leave sp;   
    end if;
                         
	# Confirmando o registro criado para o paciente no hospital para registro desse questionario
    Select t2.medicalRecord into v_MedicalRecordExist from tb_assessmentquestionnaire t1, tb_participant t2
		where t1.participantID = t2.participantid and
			  t1.hospitalUnitID = p_hospitalunitid and
              t1.questionnaireID = p_questionnaireid and
              t2.participantID = p_participantId;
                         
 	if ( v_MedicalRecordExist is null or v_MedicalRecordExist = '' ) then
	    set p_msg_retorno = 'Verifique o Participante.';
        leave sp;
	end if;
    
    if v_medicalRecordExist = p_medicalRecordNew then
	    set p_msg_retorno = 'Não há alteração no Número do Prontuario.';
        leave sp;    
    end if;
    
    set v_alteracao = CONCAT( '- Prontuario de: ', v_MedicalRecordExist, ' para ', p_medicalRecordNew);
	
   START TRANSACTION;
	# Inserindo o registro do participante      
	UPDATE  tb_participant
           SET  medicalRecord = p_medicalRecordNew
    where participantId = p_participantId;
    
	
 
    # registrando a informação de notificação para a Alteração do Prontuario Medico 
    INSERT INTO tb_notificationrecord (
			userid, profileid, hospitalunitid, tablename, rowdid, changedon, operation, log)
            values (p_userid, p_grouproleid, p_hospitalunitid, 'tb_participant', p_participantid, now(), 'A', CONCAT('Alteração ' ,  v_alteracao));

    if  LAST_INSERT_ID() is NULL then
         ROLLBACK;
	     set p_msg_retorno = 'Erro na notificação da atualização do Prontuario Medico. Verifique!';
         leave sp;
	end if;
    
    set p_msg_retorno = 'Alteração realizada com sucesso.';

    COMMIT;
END sp;

 ## select inserido para tratar limitaçao do retorno de procedures no Laravel	
 select p_msg_retorno as msgRetorno from DUAL;
		
END$$

DROP PROCEDURE IF EXISTS `putqstmoduloMedicalRecord`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `putqstmoduloMedicalRecord` (`p_userid` INTEGER, `p_groupRoleid` INTEGER, `p_hospitalUnitid` INTEGER, `p_participantid` INTEGER, `p_questionnaireId` INTEGER, `p_crfFormId` INTEGER, `p_formRecordId` INTEGER, `p_stringquestions` TEXT, OUT `p_msg_retorno` VARCHAR(500))  BEGIN
#========================================================================================================================
#== Procedure criada para o registro das questoes e respostas de um módulo de um formulario no sistema para um participante
#== Criada em 21 dez 2020
#== Alterada em 24 jan 2021 - ajuste da traduçao das respostas padronizadas
#========================================================================================================================

DECLARE v_Exist integer;
DECLARE v_question varchar(50);
DECLARE v_answer varchar(500);
DECLARE v_questionid integer;
DECLARE v_listOfValuesid integer;
DECLARE v_listtypeid integer;
DECLARE v_questionGroupFormid integer;
DECLARE v_lista text;
DECLARE v_apoio varchar(500);
DECLARE v_resposta varchar(500);
DECLARE v_listofvaluesid_ant integer;
DECLARE v_answer_ant varchar(500);
DECLARE v_operacao varchar(01);
 

	DECLARE EXIT HANDLER FOR SQLEXCEPTION, 1062 
    BEGIN
		ROLLBACK;
        SELECT 'Ocorreu um erro durante a execução do procedimento. Contacte o administrador!' Message; 
    END;
    
sp:BEGIN		
   START TRANSACTION;
	# Inserindo/Alterando as questoes registro do form e a questão associada a data    
    
    set v_lista = concat(p_stringquestions, ',') ;
    
    while length(v_lista) > 1 DO
		set v_apoio = substring(v_lista, 1, position(',' in v_lista));
		set v_question = substring(v_apoio, 1, position(':' in v_apoio) - 1);
		set v_answer     = substring(v_apoio, position(':' in v_apoio) + 1, position(',' in v_apoio) - 1);
        set v_answer     = REPLACE(v_answer, ',', '');
		set v_questionid = CONVERT(v_question, SIGNED);
	
        # verificando se a questão exige um tipo de resposta padronizada
        set v_listtypeid = null;
        set v_listofvaluesid = null;
        Select listtypeid into v_listtypeid from tb_questions
							where questionid = v_questionid;

		#select v_question, v_listtypeid, v_answer; 
		if (v_listtypeid is not NULL) then
               SELECT listofvaluesid into v_listOfValuesid 
                    from tb_listtype t1, tb_listofvalues t2
                    where t1.listTypeID = v_listtypeid and
						  t2.listTypeID = t1.listTypeID and
                          translate('pt-br', rtrim(ltrim(t2.description))) = rtrim(ltrim(v_answer)); 
                          
			   if v_listOfvaluesid is not null then
			         set v_resposta = concat('Resposta da ', v_question, ':', v_answer, ' - ', convert (v_listtypeid, char), ':', convert(v_listofvaluesid, char));
					 set v_answer = '';
			   else # não foi localizada resposta para a questão - nao será inserida
                     set v_resposta = '';
                     set v_answer = '';
			   end if;
	    else
			   set v_resposta = concat('Resposta da ', v_question, ':', v_answer);
               set v_listofvaluesid = null;
        end if;

        if v_resposta <> '' then
        
                set v_listofvaluesid_ant = null;
                set v_answer_ant = null;
        
				# verificar se a questão já havia sido respondido e o valor foi alterado
                select listofvaluesid, answer into v_listofvaluesid_ant, v_answer_ant
					    from tb_questiongroupformrecord
                        where formRecordID = p_formRecordid and questionid = v_question;
                if v_answer_ant = '' then
                   set v_answer_ant = null;
				end if;
                
                # se questão ainda nao foi respondida
                if v_listofvaluesid_ant is null and v_answer_ant is null then
                        set v_operacao = 'I';
                        set v_resposta = CONCAT('Inclusão de ', v_resposta);
                        
						INSERT INTO tb_questiongroupformrecord (
							formRecordID, crfFormsID, questionid, listofvaluesid, answer)
							values (p_formRecordId, p_crfFormId, v_questionid, v_listofvaluesid, v_answer);
				
						set v_questionGroupFormid = LAST_INSERT_ID();
    
						if v_questionGroupFormid is NULL then
							ROLLBACK;
							set p_msg_retorno = 'Erro na inclusão do registro. Verifique!';
							leave sp;
						end if;
				else
						# select v_listofvaluesid_ant, v_answer_ant, v_listofvaluesid, v_answer;
                        if (v_listofvaluesid_ant is not null and v_listofvaluesid_ant = v_listofvaluesid) or
                           (v_answer_ant is not null and v_answer_ant = v_answer) then
                           set v_operacao = '';
                           set v_resposta = '';
						else 
							#select 'A', v_listofvaluesid_ant, v_answer_ant, v_listofvaluesid, v_answer;
							set v_operacao = 'A';
                            if v_listofvaluesid_ant is not null then
							   set v_resposta = CONCAT('Exclusão da Resposta: ', convert(v_listofvaluesid_ant, char), ' para Inclusão de ', v_resposta);
							end if;
                            
                            if v_answer_ant is not null then
							   set v_resposta = CONCAT('Exclusão da Resposta: ', v_answer_ant, ' para Inclusão de ', v_resposta);
							end if;
                            
							select questionGroupFormRecordID into v_questionGroupFormid 
								from tb_questiongroupformrecord
								where formRecordID = p_formrecordid and questionid = v_questionid;     

							Update tb_questiongroupformrecord 
								set listofvaluesid = v_listofvaluesid,
									answer = v_answer
								where questionGroupFormRecordID = v_questionGroupFormid;
						end if;	
                
                end if;
                
                if v_operacao <> '' then
					# registrando a informação de notificação para a inclusao/Alteração da questão referente a data do modulo
					INSERT INTO tb_notificationrecord (
							userid, profileid, hospitalunitid, tablename, rowdid, changedon, operation, log)
							values (p_userid, p_grouproleid, p_hospitalunitid, 'tb_questiongroupformrecord', v_questionGroupFormid, now(), v_operacao, v_resposta);
			    end if;
		end if;
        
        if position(',' in v_lista) < length(v_lista) then
	  	   set v_lista = substring(v_lista,  position(',' in v_lista) + 1, length(v_lista));
		else 
           set v_lista = '';
		end if;
          
	End While;
    
	COMMIT;
END;

   select p_msg_retorno from DUAL;
		
END$$

DROP PROCEDURE IF EXISTS `puttuser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `puttuser` (`p_adminid` INTEGER, `p_adminGroupRoleid` INTEGER, `p_adminHospitalUnitid` INTEGER, `p_userid` INTEGER, `p_login` VARCHAR(255), `p_firstname` VARCHAR(100), `p_lastname` VARCHAR(100), `p_regionalcouncilcode` VARCHAR(255), `p_password` VARCHAR(255), `p_email` VARCHAR(255), `p_fonenumber` VARCHAR(255), OUT `p_msg_retorno` VARCHAR(500))  sp:BEGIN
#========================================================================================================================
#== Procedure criada para realizar a alteração de dados do usuário no sistema
#== Alterada em 09 dez 2020
#========================================================================================================================

DECLARE v_Exist integer;
DECLARE v_dadosOriginais text;
DECLARE v_dadosAlterados text;

	DECLARE EXIT HANDLER FOR SQLEXCEPTION, 1062 
    BEGIN
		ROLLBACK;
        SELECT 'Ocorreu um erro durante a execução do procedimento. Contacte o administrador!' Message; 
    END;
    
    set p_login = rtrim(ltrim(p_login));
    set p_firstName = rtrim(ltrim(p_firstName));
    set p_email = rtrim(ltrim(p_email));
    set p_fonenumber = rtrim(ltrim(p_fonenumber));
    
    # verificando preenchimento dos campos considerados obrigatórios
	if (p_login = '' or p_firstName = '' or p_lastName = '' or p_email = '' or p_fonenumber = '' ) then
	    set p_msg_retorno = 'Campos obrigatórios devem ser preenchidos. Verifique.';
        leave sp;
	end if;
	
    # verificando se o e-mail já existe no sistema para outro usuario
	select 1 into v_Exist from tb_user where email = p_email and userid <> p_userid;
	if v_Exist = 1 then
	   set p_msg_retorno =  'e-mail já cadastrado no sistema. Verifique.';
       leave sp;
	end if;
    
    START TRANSACTION;
	
    # Coletando as informações existentes do usuário
    
    select CONCAT ( 'Login: ', login, ' FirstName: ', firstname, ' LastName: ', lastname, 
                    ' Regional Council Code: ', regionalcouncilcode, ' email: ',  email, ' FoneNumber: ', fonenumber)
			into v_dadosOriginais
	from tb_user where userid = p_userid;
    
    set v_dadosAlterados = CONCAT ( 'Login: ', p_login, ' FirstName: ', p_firstname, ' LastName: ', p_lastname, 
                    ' Regional Council Code: ', p_regionalcouncilcode, ' email: ',  p_email, ' FoneNumber: ', p_fonenumber);
    
	Update tb_user
    set firstname = p_firstName, 
		lastname = p_lastName, 
        regionalcouncilcode = p_regionalCouncilCode, 
        password = p_Password,  
        email = p_email, 
        fonenumber = p_fonenumber;
        
    # registrando a informação de notificação de alteração do usuario 
    INSERT INTO tb_notificationrecord (
			userid, profileid, hospitalunitid, tablename, rowdid, changedon, operation, log)
            values (p_adminid, p_admingrouproleid, p_adminhospitalunitid, 'tb_user', p_userid, now(), 'A', CONCAT('Alteraçao de dados de Usuario de ', v_dadosOriginais, ' para ', v_dadosAlterados));

             
    COMMIT;
	
		
END$$

--
-- Funções
--
DROP FUNCTION IF EXISTS `getTotalMedicalRecordHospitalUnit`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `getTotalMedicalRecordHospitalUnit` (`p_hospitalUnitid` INTEGER, `p_questionnaireid` INTEGER) RETURNS INT(11) DETERMINISTIC BEGIN
#========================================================================================================================
#== Função criada para verificar se já existem prontuários/registros associados a um determinado hospital
#== Retornar o total de questionários lançados até a data
#== Criada em 07 dez 2020
#========================================================================================================================

declare v_totalRecord integer;

	select count(*) into v_totalRecord from tb_AssessmentQuestionnaire
				where hospitalUnitId = p_hospitalUnitId and
					  questionnaireid = p_questionnaireId;
                      
	if v_totalRecord is null then
       set v_totalRecord = 0;
	end if;
       
	RETURN v_totalRecord;
END$$

DROP FUNCTION IF EXISTS `TRANSLATE`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `TRANSLATE` (`lng` VARCHAR(255), `val` VARCHAR(500)) RETURNS VARCHAR(500) CHARSET utf8 DETERMINISTIC BEGIN

   declare descriptionLNG varchar (500);

 

	

      select t1.descriptionlang into descriptionLNG

      from tb_multilanguage t1, tb_language t2 

	  where t2.description = lng and t1.languageId = t2.languageID and upper(t1.description) = upper(val);

  

      if (descriptionLNG is null) then  

	    SET descriptionLNG = '';

	  END IF;

	  

      RETURN descriptionLNG;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_assessmentquestionnaire`
--

DROP TABLE IF EXISTS `tb_assessmentquestionnaire`;
CREATE TABLE IF NOT EXISTS `tb_assessmentquestionnaire` (
  `participantID` int(10) NOT NULL COMMENT '(pt-br)  Chave estrangeira para a tabela tb_Patient.\r\n(en) Foreign key to the tb_Patient table.',
  `hospitalUnitID` int(10) NOT NULL COMMENT '(pt-br) Chave estrangeira para tabela tb_HospitalUnit.\r\n(en) Foreign key for the tp_HospitalUnit table.',
  `questionnaireID` int(10) NOT NULL,
  PRIMARY KEY (`participantID`,`hospitalUnitID`,`questionnaireID`),
  KEY `FKtb_Assessm665217` (`hospitalUnitID`),
  KEY `FKtb_Assessm419169` (`questionnaireID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_crfforms`
--

DROP TABLE IF EXISTS `tb_crfforms`;
CREATE TABLE IF NOT EXISTS `tb_crfforms` (
  `crfFormsID` int(10) NOT NULL AUTO_INCREMENT,
  `questionnaireID` int(10) NOT NULL,
  `description` varchar(255) NOT NULL COMMENT '(pt-br) Descrição .\r\n(en) description.',
  PRIMARY KEY (`crfFormsID`),
  KEY `FKtb_CRFForm860269` (`questionnaireID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='(pt-br)\r\ntb_CRFForms identifica o tipo do formulario refere-se ao Questionnaire Subsection da Ontologia:\r\nAdmissão - Modulo 1\r\nAcompanhamento - Modulo 2\r\nDesfecho - Modulo 3\r\n(en)\r\ntb_CRFForms identifies the type of the form refers to the Questionnaire Subsection of Ontology: Admission - Module 1 Monitoring - Module 2 Outcome - Module 3';

--
-- Extraindo dados da tabela `tb_crfforms`
--

INSERT INTO `tb_crfforms` (`crfFormsID`, `questionnaireID`, `description`) VALUES
(1, 1, 'Admission form'),
(2, 1, 'Follow-up'),
(3, 1, 'Discharge/death form');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_formrecord`
--

DROP TABLE IF EXISTS `tb_formrecord`;
CREATE TABLE IF NOT EXISTS `tb_formrecord` (
  `formRecordID` int(10) NOT NULL AUTO_INCREMENT,
  `participantID` int(10) NOT NULL,
  `hospitalUnitID` int(10) NOT NULL,
  `questionnaireID` int(10) NOT NULL,
  `crfFormsID` int(10) NOT NULL,
  `dtRegistroForm` timestamp NOT NULL,
  PRIMARY KEY (`formRecordID`),
  KEY `FKtb_FormRec2192` (`crfFormsID`),
  KEY `FKtb_FormRec984256` (`participantID`,`hospitalUnitID`,`questionnaireID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_grouprole`
--

DROP TABLE IF EXISTS `tb_grouprole`;
CREATE TABLE IF NOT EXISTS `tb_grouprole` (
  `groupRoleID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`groupRoleID`),
  UNIQUE KEY `groupRoleID` (`groupRoleID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_grouprole`
--

INSERT INTO `tb_grouprole` (`groupRoleID`, `description`) VALUES
(1, 'Administrador'),
(2, 'ETL - Arquivos'),
(3, 'ETL - BD a BD'),
(4, 'Gestor de Ontologia'),
(5, 'Gestor de Repositório'),
(6, 'Notificador Médico'),
(7, 'Notificador Profissional de Saúde');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_grouprolepermission`
--

DROP TABLE IF EXISTS `tb_grouprolepermission`;
CREATE TABLE IF NOT EXISTS `tb_grouprolepermission` (
  `groupRoleID` int(11) NOT NULL,
  `permissionID` int(11) NOT NULL,
  PRIMARY KEY (`groupRoleID`,`permissionID`),
  KEY `FKtb_GroupRo893005` (`permissionID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_hospitalunit`
--

DROP TABLE IF EXISTS `tb_hospitalunit`;
CREATE TABLE IF NOT EXISTS `tb_hospitalunit` (
  `hospitalUnitID` int(10) NOT NULL AUTO_INCREMENT,
  `hospitalUnitName` varchar(500) NOT NULL COMMENT '(pt-br) Nome da unidade hospitalar.\r\n(en) Name of the hospital unit.',
  PRIMARY KEY (`hospitalUnitID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='(pt-br) Tabela para identificação de unidades hospitalares.\r\n(en) Table for hospital units identification.';

--
-- Extraindo dados da tabela `tb_hospitalunit`
--

INSERT INTO `tb_hospitalunit` (`hospitalUnitID`, `hospitalUnitName`) VALUES
(1, 'Hospital Universitário Gaffrée e Guinle - HUGG'),
(2, 'Hospital municipal São José');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_language`
--

DROP TABLE IF EXISTS `tb_language`;
CREATE TABLE IF NOT EXISTS `tb_language` (
  `languageID` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`languageID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_language`
--

INSERT INTO `tb_language` (`languageID`, `description`) VALUES
(1, 'pt-br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_listofvalues`
--

DROP TABLE IF EXISTS `tb_listofvalues`;
CREATE TABLE IF NOT EXISTS `tb_listofvalues` (
  `listOfValuesID` int(10) NOT NULL AUTO_INCREMENT,
  `listTypeID` int(10) NOT NULL,
  `description` varchar(255) NOT NULL COMMENT '(pt-br) Descrição.\r\n(en) description.',
  PRIMARY KEY (`listOfValuesID`),
  KEY `FKtb_ListOfV184108` (`listTypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=308 DEFAULT CHARSET=utf8 COMMENT='(pt-br) Representa todos os valores padronizados do formulário.\r\n(en) Represents all standard values on the form.';

--
-- Extraindo dados da tabela `tb_listofvalues`
--

INSERT INTO `tb_listofvalues` (`listOfValuesID`, `listTypeID`, `description`) VALUES
(1, 1, 'Interferon alpha'),
(2, 1, 'Interferon beta'),
(3, 1, 'Lopinavir/Ritonavir'),
(4, 1, 'Neuraminidase inhibitor'),
(5, 1, 'Ribavirin'),
(6, 2, 'Alert'),
(7, 2, 'Pain'),
(8, 2, 'Unresponsive'),
(9, 2, 'Verbal'),
(10, 3, 'MERS-CoV'),
(11, 3, 'SARS-CoV-2'),
(12, 4, 'Inhaled'),
(13, 4, 'Intravenous'),
(14, 4, 'Oral'),
(15, 5, 'Afghanistan'),
(16, 5, 'Aland Islands'),
(17, 5, 'Albania'),
(18, 5, 'Algeria'),
(19, 5, 'American Samoa'),
(20, 5, 'Andorra'),
(21, 5, 'Angola'),
(22, 5, 'Anguilla'),
(23, 5, 'Antarctica'),
(24, 5, 'Antigua and Barbuda'),
(25, 5, 'Argentina'),
(26, 5, 'Armenia'),
(27, 5, 'Aruba'),
(28, 5, 'Australia'),
(29, 5, 'Austria'),
(30, 5, 'Azerbaijan'),
(31, 5, 'Bahamas'),
(32, 5, 'Bahrain'),
(33, 5, 'Bangladesh'),
(34, 5, 'Barbados'),
(35, 5, 'Belarus'),
(36, 5, 'Belgium'),
(37, 5, 'Belize'),
(38, 5, 'Benin'),
(39, 5, 'Bermuda'),
(40, 5, 'Bhutan'),
(41, 5, 'Bolivia, Plurinational State of'),
(42, 5, 'Bosnia and Herzegovina'),
(43, 5, 'Botswana'),
(44, 5, 'Bouvet Island'),
(45, 5, 'Brazil'),
(46, 5, 'British Indian Ocean Territory'),
(47, 5, 'Brunei Darussalam'),
(48, 5, 'Bulgaria'),
(49, 5, 'Burkina Faso'),
(50, 5, 'Burundi'),
(51, 5, 'Cambodia'),
(52, 5, 'Cameroon'),
(53, 5, 'Canada'),
(54, 5, 'Cape Verde'),
(55, 5, 'Cayman Islands'),
(56, 5, 'Central African Republic'),
(57, 5, 'Chad'),
(58, 5, 'Chile'),
(59, 5, 'China'),
(60, 5, 'Christmas Island'),
(61, 5, 'Cocos (Keeling) Islands'),
(62, 5, 'Colombia'),
(63, 5, 'Comoros'),
(64, 5, 'Congo'),
(65, 5, 'Congo, the Democratic Republic of the'),
(66, 5, 'Cook Islands'),
(67, 5, 'Costa Rica'),
(68, 5, 'Cote d\'Ivoire'),
(69, 5, 'Croatia'),
(70, 5, 'Cuba'),
(71, 5, 'Cyprus'),
(72, 5, 'Czech Republic'),
(73, 5, 'Denmark'),
(74, 5, 'Djibouti'),
(75, 5, 'Dominica'),
(76, 5, 'Dominican Republic'),
(77, 5, 'Ecuador'),
(78, 5, 'Egypt'),
(79, 5, 'El Salvador'),
(80, 5, 'Equatorial Guinea'),
(81, 5, 'Eritrea'),
(82, 5, 'Estonia'),
(83, 5, 'Ethiopia'),
(84, 5, 'Falkland Islands (Malvinas)'),
(85, 5, 'Faroe Islands'),
(86, 5, 'Fiji'),
(87, 5, 'Finland'),
(88, 5, 'France'),
(89, 5, 'French Guiana'),
(90, 5, 'French Polynesia'),
(91, 5, 'French Southern Territories'),
(92, 5, 'Gabon'),
(93, 5, 'Gambia'),
(94, 5, 'Georgia'),
(95, 5, 'Germany'),
(96, 5, 'Ghana'),
(97, 5, 'Gibraltar'),
(98, 5, 'Greece'),
(99, 5, 'Greenland'),
(100, 5, 'Grenada'),
(101, 5, 'Guadeloupe'),
(102, 5, 'Guam'),
(103, 5, 'Guatemala'),
(104, 5, 'Guernsey'),
(105, 5, 'Guinea'),
(106, 5, 'Guinea-Bissau'),
(107, 5, 'Guyana'),
(108, 5, 'Haiti'),
(109, 5, 'Heard Island and McDonald Islands'),
(110, 5, 'Holy See (Vatican City State)'),
(111, 5, 'Honduras'),
(112, 5, 'Hong Kong'),
(113, 5, 'Hungary'),
(114, 5, 'Iceland'),
(115, 5, 'India'),
(116, 5, 'Indonesia'),
(117, 5, 'Iran, Islamic Republic of'),
(118, 5, 'Iraq'),
(119, 5, 'Ireland'),
(120, 5, 'Isle of Man'),
(121, 5, 'Israel'),
(122, 5, 'Italy'),
(123, 5, 'Jamaica'),
(124, 5, 'Japan'),
(125, 5, 'Jersey'),
(126, 5, 'Jordan'),
(127, 5, 'Kazakhstan'),
(128, 5, 'Kenya'),
(129, 5, 'Kiribati'),
(130, 5, 'Korea, Democratic People\'\'s Republic of'),
(131, 5, 'Korea, Republic of'),
(132, 5, 'Kuwait'),
(133, 5, 'Kyrgyzstan'),
(134, 5, 'Lao People\'s Democratic Republic'),
(135, 5, 'Latvia'),
(136, 5, 'Lebanon'),
(137, 5, 'Lesotho'),
(138, 5, 'Liberia'),
(139, 5, 'Libyan Arab Jamahiriya'),
(140, 5, 'Liechtenstein'),
(141, 5, 'Lithuania'),
(142, 5, 'Luxembourg'),
(143, 5, 'Macao'),
(144, 5, 'Macedonia, the former Yugoslav Republic of'),
(145, 5, 'Madagascar'),
(146, 5, 'Malawi'),
(147, 5, 'Malaysia'),
(148, 5, 'Maldives'),
(149, 5, 'Mali'),
(150, 5, 'Malta'),
(151, 5, 'Marshall Islands'),
(152, 5, 'Martinique'),
(153, 5, 'Mauritania'),
(154, 5, 'Mauritius'),
(155, 5, 'Mayotte'),
(156, 5, 'Mexico'),
(157, 5, 'Micronesia, Federated States of'),
(158, 5, 'Moldova, Republic of'),
(159, 5, 'Monaco'),
(160, 5, 'Mongolia'),
(161, 5, 'Montenegro'),
(162, 5, 'Montserrat'),
(163, 5, 'Morocco'),
(164, 5, 'Mozambique'),
(165, 5, 'Myanmar'),
(166, 5, 'Namibia'),
(167, 5, 'Nauru'),
(168, 5, 'Nepal'),
(169, 5, 'Netherlands'),
(170, 5, 'Netherlands Antilles'),
(171, 5, 'New Caledonia'),
(172, 5, 'New Zealand'),
(173, 5, 'Nicaragua'),
(174, 5, 'Niger'),
(175, 5, 'Nigeria'),
(176, 5, 'Niue'),
(177, 5, 'Norfolk Island'),
(178, 5, 'Northern Mariana Islands'),
(179, 5, 'Norway'),
(180, 5, 'Oman'),
(181, 5, 'Pakistan'),
(182, 5, 'Palau'),
(183, 5, 'Palestinian Territory, Occupied'),
(184, 5, 'Panama'),
(185, 5, 'Papua New Guinea'),
(186, 5, 'Paraguay'),
(187, 5, 'Peru'),
(188, 5, 'Philippines'),
(189, 5, 'Pitcairn'),
(190, 5, 'Poland'),
(191, 5, 'Portugal'),
(192, 5, 'Puerto Rico'),
(193, 5, 'Qatar'),
(194, 5, 'Reunion ﻿ Réunion'),
(195, 5, 'Romania'),
(196, 5, 'Russian Federation'),
(197, 5, 'Rwanda'),
(198, 5, 'Saint Barthélemy'),
(199, 5, 'Saint Helena'),
(200, 5, 'Saint Kitts and Nevis'),
(201, 5, 'Saint Lucia'),
(202, 5, 'Saint Martin (French part)'),
(203, 5, 'Saint Pierre and Miquelon'),
(204, 5, 'Saint Vincent and the Grenadines'),
(205, 5, 'Samoa'),
(206, 5, 'San Marino'),
(207, 5, 'Sao Tome and Principe'),
(208, 5, 'Saudi Arabia'),
(209, 5, 'Senegal'),
(210, 5, 'Serbia'),
(211, 5, 'Seychelles'),
(212, 5, 'Sierra Leone'),
(213, 5, 'Singapore'),
(214, 5, 'Slovakia'),
(215, 5, 'Slovenia'),
(216, 5, 'Solomon Islands'),
(217, 5, 'Somalia'),
(218, 5, 'South Africa'),
(219, 5, 'South Georgia and the South Sandwich Islands'),
(220, 5, 'Spain'),
(221, 5, 'Sri Lanka'),
(222, 5, 'Sudan'),
(223, 5, 'Suriname'),
(224, 5, 'Svalbard and Jan Mayen'),
(225, 5, 'Swaziland'),
(226, 5, 'Sweden'),
(227, 5, 'Switzerland'),
(228, 5, 'Syrian Arab Republic'),
(229, 5, 'Taiwan, Province of China'),
(230, 5, 'Tajikistan'),
(231, 5, 'Tanzania, United Republic of'),
(232, 5, 'Thailand'),
(233, 5, 'Timor-Leste'),
(234, 5, 'Togo'),
(235, 5, 'Tokelau'),
(236, 5, 'Tonga'),
(237, 5, 'Trinidad and Tobago'),
(238, 5, 'Tunisia'),
(239, 5, 'Turkey'),
(240, 5, 'Turkmenistan'),
(241, 5, 'Turks and Caicos Islands'),
(242, 5, 'Tuvalu'),
(243, 5, 'Uganda'),
(244, 5, 'Ukraine'),
(245, 5, 'United Arab Emirates'),
(246, 5, 'United Kingdom'),
(247, 5, 'United States'),
(248, 5, 'United States Minor Outlying Islands'),
(249, 5, 'Uruguay'),
(250, 5, 'Uzbekistan'),
(251, 5, 'Vanuatu'),
(252, 5, 'Venezuela, Bolivarian Republic of'),
(253, 5, 'Viet Nam'),
(254, 5, 'Virgin Islands, British'),
(255, 5, 'Virgin Islands, U.S.'),
(256, 5, 'Wallis and Futuna'),
(257, 5, 'Western Sahara'),
(258, 5, 'Yemen'),
(259, 5, 'Zambia'),
(260, 5, 'Zimbabwe'),
(261, 6, 'No'),
(262, 6, 'Unknown'),
(263, 6, 'Yes-not on ART'),
(264, 6, 'Yes-on ART'),
(265, 7, 'CPAP/NIV mask'),
(266, 7, 'HF nasal cannula'),
(267, 7, 'Mask'),
(268, 7, 'Mask with reservoir'),
(269, 7, 'Unknown'),
(270, 8, '>15 L/min'),
(271, 8, '1-5 L/min'),
(272, 8, '11-15 L/min'),
(273, 8, '6-10 L/min'),
(274, 8, 'Unknown'),
(275, 9, 'Death'),
(276, 9, 'Discharged alive'),
(277, 9, 'Hospitalized'),
(278, 9, 'Palliative discharge'),
(279, 9, 'Transfer to other facility'),
(280, 9, 'Unknown'),
(281, 10, 'Oxygen therapy'),
(282, 10, 'Room air'),
(283, 10, 'Unknown'),
(284, 13, 'Female'),
(285, 13, 'Male'),
(286, 13, 'Not Specified'),
(287, 14, 'Concentrator'),
(288, 14, 'Cylinder'),
(289, 14, 'Piped'),
(290, 14, 'Unknown'),
(291, 11, 'Not done'),
(292, 12, 'Better'),
(293, 12, 'Same as before illness'),
(294, 12, 'Unknown'),
(295, 12, 'Worse'),
(296, 15, 'No'),
(297, 15, 'Unknown'),
(298, 15, 'Yes'),
(299, 16, 'N/A'),
(300, 16, 'No'),
(301, 16, 'Unknown'),
(302, 16, 'Yes'),
(303, 11, 'Negative'),
(304, 11, 'Positive'),
(305, 1, 'Azithromycin'),
(306, 1, 'Chloroquine/hydroxychloroquine'),
(307, 1, 'Favipiravir');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_listtype`
--

DROP TABLE IF EXISTS `tb_listtype`;
CREATE TABLE IF NOT EXISTS `tb_listtype` (
  `listTypeID` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL COMMENT '(pt-br) Descrição.\r\n(en) description.',
  PRIMARY KEY (`listTypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_listtype`
--

INSERT INTO `tb_listtype` (`listTypeID`, `description`) VALUES
(1, 'Antiviral list'),
(2, 'AVPU list'),
(3, 'Coronavirus list'),
(4, 'Corticosteroid list'),
(5, 'Country list'),
(6, 'HIV list'),
(7, 'Interface list'),
(8, 'O2 flow list'),
(9, 'Outcome list'),
(10, 'Outcome saturation list'),
(11, 'pnnotdone_list'),
(12, 'self_care_list'),
(13, 'sex at birth list'),
(14, 'Source of oxygen list'),
(15, 'ynu_list'),
(16, 'ynun_list');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_multilanguage`
--

DROP TABLE IF EXISTS `tb_multilanguage`;
CREATE TABLE IF NOT EXISTS `tb_multilanguage` (
  `languageID` int(11) NOT NULL,
  `description` varchar(300) NOT NULL,
  `descriptionLang` varchar(500) NOT NULL,
  PRIMARY KEY (`languageID`,`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_multilanguage`
--

INSERT INTO `tb_multilanguage` (`languageID`, `description`, `descriptionLang`) VALUES
(1, '>15 L/min', '> 15 L/min'),
(1, '1-5 L/min', '1-5 L/min'),
(1, '11-15 L/min', '11-15 L/min'),
(1, '6-10 L/min', '6-10 L/min'),
(1, 'A class of questions with date answers.', 'Uma classe de perguntas com respostas na forma de data.'),
(1, 'A history of self-reported feverishness or measured fever of ≥ 38 degrees Celsius', 'Um histórico de febre autorelatado ou febre medida de ≥ 38oC'),
(1, 'A question where the possible answers are: Yes, No or Unknown.', 'Uma pergunta onde a resposta pode ser: Sim, Não ou Desconhecido'),
(1, 'A single question of a questionaire. The rdfs:label of the sub-classes reflect the exact questions text from the WHO CRF.', 'Uma pergunta de um questionário. As propriedades rdfs:label das sub-classes refletem exatamente as perguntas definidas no FRC da OMS.'),
(1, 'A term used to indicate that information on a specific question or subject can not be provided because there is no relevance.', 'Termo usado para indicar que a resposta a uma pergunta ou a informação sobre um assunto não pode ser dada porque não é aplicável.'),
(1, 'Abdominal pain', 'Dor abdominal'),
(1, 'Ability to self-care at discharge versus before illness', 'Habilidade de autocuidado na alta em comparação com antes da doença'),
(1, 'Acute renal injury', 'Lesão renal aguda'),
(1, 'Acute Respiratory Distress Syndrome', 'Síndrome Respiratória Aguda'),
(1, 'Admission date at this facility', 'Data de admissão nesta unidade'),
(1, 'Admission form', 'Formulário de Admissão'),
(1, 'Afghanistan', 'Afghanistan'),
(1, 'Age', 'Idade'),
(1, 'Age (months)', 'Idade (meses)'),
(1, 'Age (years)', 'Idade (anos)'),
(1, 'Aland Islands', 'Aland Islands'),
(1, 'Albania', 'Albania'),
(1, 'Alert', 'Alerta'),
(1, 'Algeria', 'Algeria'),
(1, 'ALT/SGPT measurement', 'ALT/TGP'),
(1, 'Altered consciousness/confusion', 'Consciência alterada/confusão'),
(1, 'American Samoa', 'American Samoa'),
(1, 'Anaemia', 'Anemia'),
(1, 'Andorra', 'Andorra'),
(1, 'Angiotensin converting enzyme inhibitors (ACE inhibitors)', 'Inibidores da enzima de conversão da angiotensina (inibidores da ECA)'),
(1, 'Angiotensin II receptor blockers (ARBs)', 'Bloqueadores dos receptores de angiotensina II (BRAs)'),
(1, 'Angola', 'Angola'),
(1, 'Anguilla', 'Anguilla'),
(1, 'Antarctica', 'Antarctica'),
(1, 'Antibiotic', 'Antibiótico'),
(1, 'Antifungal agent', 'Agente antifungal'),
(1, 'Antigua and Barbuda', 'Antigua and Barbuda'),
(1, 'Antimalarial agent', 'Agente antimalárico'),
(1, 'Antiviral', 'Antiviral'),
(1, 'Antiviral list', 'Lista Antiviral'),
(1, 'APTT/APTR measurement', 'TTPA/APTR'),
(1, 'Argentina', 'Argentina'),
(1, 'Armenia', 'Armenia'),
(1, 'Aruba', 'Aruba'),
(1, 'Ashtma', 'Asma'),
(1, 'Asplenia', 'Asplenia'),
(1, 'AST/SGOT measurement', 'AST/TGO'),
(1, 'Australia', 'Australia'),
(1, 'Austria', 'Austria'),
(1, 'AVPU list', 'Lista AVDI'),
(1, 'AVPU scale', 'Escala A V D I'),
(1, 'Azerbaijan', 'Azerbaijan'),
(1, 'Azithromycin', 'Azitromicina'),
(1, 'Bacteraemia', 'Bacteremia'),
(1, 'Bahamas', 'Bahamas'),
(1, 'Bahrain', 'Bahrain'),
(1, 'Bangladesh', 'Bangladesh'),
(1, 'Barbados', 'Barbados'),
(1, 'Belarus', 'Belarus'),
(1, 'Belgium', 'Belgium'),
(1, 'Belize', 'Belize'),
(1, 'Benin', 'Benin'),
(1, 'Bermuda', 'Bermuda'),
(1, 'Better', 'Melhor'),
(1, 'Bhutan', 'Bhutan'),
(1, 'Bleeding', 'Sangramento (hemorragia)'),
(1, 'Bleeding (Haemorrhage)', 'Sangramento (hemorragia)'),
(1, 'Bolivia, Plurinational State of', 'Bolivia, Plurinational State of'),
(1, 'Boolean_Question', 'Questão booleana'),
(1, 'Bosnia and Herzegovina', 'Bosnia and Herzegovina'),
(1, 'Botswana', 'Botswana'),
(1, 'Bouvet Island', 'Bouvet Island'),
(1, 'BP (diastolic)', 'Pressão arterial (diastólica)'),
(1, 'BP (systolic)', 'Pressão arterial (sistólica)'),
(1, 'Brazil', 'Brazil'),
(1, 'British Indian Ocean Territory', 'British Indian Ocean Territory'),
(1, 'Bronchiolitis', 'Bronquiolite'),
(1, 'Brunei Darussalam', 'Brunei Darussalam'),
(1, 'Bulgaria', 'Bulgaria'),
(1, 'Burkina Faso', 'Burkina Faso'),
(1, 'Burundi', 'Burundi'),
(1, 'Cambodia', 'Cambodia'),
(1, 'Cameroon', 'Cameroon'),
(1, 'Canada', 'Canada'),
(1, 'Cape Verde', 'Cape Verde'),
(1, 'Cardiac arrest', 'Parada cardíaca'),
(1, 'Cardiac arrhythmia', 'Arritmia cardíaca'),
(1, 'Cardiomyopathy', 'Cardiomiopatia'),
(1, 'Cayman Islands', 'Cayman Islands'),
(1, 'Central African Republic', 'Central African Republic'),
(1, 'Chad', 'Chad'),
(1, 'Chest pain', 'Dor no peito'),
(1, 'Chest X-Ray /CT performed', 'Radiografia/tomografia computadorizada do tórax feita'),
(1, 'Chile', 'Chile'),
(1, 'China', 'China'),
(1, 'Chloroquine/hydroxychloroquine', 'Cloroquina / hidroxicloroquina'),
(1, 'Christmas Island', 'Christmas Island'),
(1, 'Chronic cardiac disease (not hypertension)', 'Doença cardíaca crônica (não hipertensão)'),
(1, 'Chronic kidney disease', 'Doença renal crônica'),
(1, 'Chronic liver disease', 'Doença hepática crônica'),
(1, 'Chronic neurological disorder', 'Doença neurológica crônica'),
(1, 'Chronic pulmonary disease', 'Doença pulmonar crônica'),
(1, 'Clinical inclusion criteria', 'Critérios Clínicos para Inclusão'),
(1, 'Clinical suspicion of ARI despite not meeting criteria above', 'Suspeita clínica de IRA apesar de não apresentar os sintomas acima'),
(1, 'Co-morbidities', 'Comorbidades'),
(1, 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands'),
(1, 'Colombia', 'Colombia'),
(1, 'Comoros', 'Comoros'),
(1, 'Complications', 'Complicações'),
(1, 'Concentrator', 'Concentrador'),
(1, 'Confusion', 'Confusão'),
(1, 'Congo', 'Congo'),
(1, 'Congo, the Democratic Republic of the', 'Congo, the Democratic Republic of the'),
(1, 'Conjunctivitis', 'Conjuntivite'),
(1, 'Cook Islands', 'Cook Islands'),
(1, 'Coronavirus', 'Coronavírus'),
(1, 'Coronavirus list', 'Lista Coronavirus'),
(1, 'Corticosteroid', 'Corticosteroide'),
(1, 'Corticosteroid list', 'Lista Corticosteroid'),
(1, 'Costa Rica', 'Costa Rica'),
(1, 'Cote d\'Ivoire', 'Cote d\'Ivoire'),
(1, 'Cough', 'Tosse'),
(1, 'Cough with haemoptysis', 'Tosse com hemóptise'),
(1, 'Cough with sputum', 'Tosse com expectoração'),
(1, 'Cough with sputum production', 'Tosse com expectoração'),
(1, 'Country', 'País'),
(1, 'Country list', 'Lista Paises'),
(1, 'CPAP/NIV mask', 'Máscara CPAP/VNI'),
(1, 'Creatine kinase measurement', 'Creatina quinase'),
(1, 'Creatinine measurement', 'Creatinina'),
(1, 'CRF section grouping questions about clinical inclusion criteria.', 'Parte do FRC que agrupa perguntas sobre os critérios clínicos para inclusão.'),
(1, 'Croatia', 'Croatia'),
(1, 'CRP measurement', 'PCR'),
(1, 'Cuba', 'Cuba'),
(1, 'Current smoking', 'Fumante'),
(1, 'Cylinder', 'Cilindro'),
(1, 'Cyprus', 'Cyprus'),
(1, 'Czech Republic', 'Czech Republic'),
(1, 'D-dimer measurement', 'Dimero D'),
(1, 'Daily clinical features', 'Sintomas diários'),
(1, 'Date of Birth', 'Data de nascimento'),
(1, 'Date of enrolment', 'Data de inscrição'),
(1, 'Date of follow up', 'Data do acompanhamento'),
(1, 'Date of ICU/HDU admission', 'Data de Admissão no CTI/UTI'),
(1, 'Date of onset and admission vital signs', 'Início da doença e sinais vitais na admissão'),
(1, 'Date question', 'Pergunta sobre data'),
(1, 'Death', 'Óbito'),
(1, 'Demographics', 'Dados demográficos'),
(1, 'Denmark', 'Denmark'),
(1, 'Diabetes', 'Diabete'),
(1, 'Diagnostic/pathogen testing', 'DIagnóstico/teste de patógenos'),
(1, 'Diarrhoea', 'Diarréia'),
(1, 'Discharge sub-section of the WHO COVID-19 CRF. This sub-section is provided when the patient is discharged from the health center or in the case of death.', 'Sub-seção de alta do FRC para o COVID-19 da OMS. Essa sub-seção é fornecida quando o paciente recebe alta do centro médica or em caso de óbito.'),
(1, 'Discharge/death form', 'Formulário de alta/óbito'),
(1, 'Discharged alive', 'Alta'),
(1, 'Djibouti', 'Djibouti'),
(1, 'Dominica', 'Dominica'),
(1, 'Dominican Republic', 'Dominican Republic'),
(1, 'duration in days', 'duração em dias'),
(1, 'duration in weeks', 'duração em semanas'),
(1, 'Dyspnoea (shortness of breath) OR Tachypnoea', 'Dispneia (falta de ar) ou Taquipneia'),
(1, 'e.g.BIPAP/CPAP', 'p.ex. BIPAP, CPAP'),
(1, 'Ecuador', 'Ecuador'),
(1, 'Egypt', 'Egypt'),
(1, 'El Salvador', 'El Salvador'),
(1, 'Endocarditis', 'Endocardite'),
(1, 'Equatorial Guinea', 'Equatorial Guinea'),
(1, 'Eritrea', 'Eritrea'),
(1, 'ESR measurement', 'VHS'),
(1, 'Estonia', 'Estonia'),
(1, 'Ethiopia', 'Ethiopia'),
(1, 'Existing conditions prior to admission.', 'Comorbidades existentes antes da admissão.'),
(1, 'Experimental agent', 'Agente experimental'),
(1, 'Extracorporeal (ECMO) support', 'Suporte extracorpóreo (ECMO)'),
(1, 'Facility name', 'Nome da Instalação'),
(1, 'Falciparum malaria', 'Malária Falciparum'),
(1, 'Falkland Islands (Malvinas)', 'Falkland Islands (Malvinas)'),
(1, 'Faroe Islands', 'Faroe Islands'),
(1, 'Fatigue/Malaise', 'Fadiga/mal estar'),
(1, 'Favipiravir', 'Favipiravir'),
(1, 'Female', 'Feminino'),
(1, 'Ferritin measurement', 'Ferritina'),
(1, 'Fiji', 'Fiji'),
(1, 'Finland', 'Finland'),
(1, 'FiO2 value', 'Fração de oxigênio inspirado'),
(1, 'first available data at presentation/admission', 'primeiros dados disponíveis na admissão'),
(1, 'Follow-up', 'Acompanhamento'),
(1, 'Follow-up sub-section of the WHO COVID-19 CRF. The completion frequency of this sub-section is determined by available resources.', 'Sub-seção do FRC para o COVID-19 da OMS. A frequência de preenchimento dessa sub-seção é determinada pelos recursos disponíveis.'),
(1, 'France', 'France'),
(1, 'French Guiana', 'French Guiana'),
(1, 'French Polynesia', 'French Polynesia'),
(1, 'French Southern Territories', 'French Southern Territories'),
(1, 'Gabon', 'Gabon'),
(1, 'Gambia', 'Gambia'),
(1, 'Georgia', 'Georgia'),
(1, 'Germany', 'Germany'),
(1, 'Gestational weeks assessment', 'Tempo de gravidez'),
(1, 'Ghana', 'Ghana'),
(1, 'Gibraltar', 'Gibraltar'),
(1, 'Glasgow Coma Score (GCS /15)', 'Escala de Coma de Glasgow (GCS /15)'),
(1, 'Greece', 'Greece'),
(1, 'Greenland', 'Greenland'),
(1, 'Grenada', 'Grenada'),
(1, 'Guadeloupe', 'Guadeloupe'),
(1, 'Guam', 'Guam'),
(1, 'Guatemala', 'Guatemala'),
(1, 'Guernsey', 'Guernsey'),
(1, 'Guinea', 'Guinea'),
(1, 'Guinea-Bissau', 'Guinea-Bissau'),
(1, 'Guyana', 'Guyana'),
(1, 'Haematocrit measurement', 'Hematócrito'),
(1, 'Haemoglobin measurement', 'Hemoglobina'),
(1, 'Haiti', 'Haiti'),
(1, 'Headache', 'Dor de cabeça'),
(1, 'Healthcare worker', 'Profissional de Saúde'),
(1, 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands'),
(1, 'Heart rate', 'Frequência cardíaca'),
(1, 'Height', 'Altura'),
(1, 'HF nasal cannula', 'Cânula nasal de alto fluxo'),
(1, 'History of fever', 'Histórico de febre'),
(1, 'HIV', 'HIV'),
(1, 'HIV list', 'Lista HIV'),
(1, 'Holy See (Vatican City State)', 'Holy See (Vatican City State)'),
(1, 'Honduras', 'Honduras'),
(1, 'Hong Kong', 'Hong Kong'),
(1, 'Hospitalized', 'Internado'),
(1, 'Hungary', 'Hungary'),
(1, 'Hypertension', 'Hipertensão'),
(1, 'Iceland', 'Iceland'),
(1, 'ICU or High Dependency Unit admission', 'UTI ou UCE'),
(1, 'ICU/HDU discharge date', 'Data de Alta do CTI/UTI'),
(1, 'If bleeding: specify site(s)', 'Caso afirmativo: especifique o(s) local(is)'),
(1, 'If yes, specify', 'Caso afirmativo, especifique'),
(1, 'IL-6 measurement', 'IL-6'),
(1, 'Inability to walk', 'Incapaz de andar'),
(1, 'India', 'India'),
(1, 'Indonesia', 'Indonesia'),
(1, 'Infiltrates present', 'Presença de infiltrados'),
(1, 'Influenza virus', 'Vírus influenza'),
(1, 'Influenza virus type', 'tipo de vírus influenza'),
(1, 'Inhaled', 'Inalatória'),
(1, 'Inotropes/vasopressors', 'Inotrópicos/vasopressores'),
(1, 'INR measurement', 'INR'),
(1, 'Interface list', 'Lista Interface de O2'),
(1, 'Interferon alpha', 'Interferon alfa'),
(1, 'Interferon beta', 'Interferon beta'),
(1, 'Intravenous', 'Intravenosa'),
(1, 'Intravenous fluids', 'Hidratação venosa'),
(1, 'Invasive ventilation', 'Ventilação invasiva'),
(1, 'Iran, Islamic Republic of', 'Iran, Islamic Republic of'),
(1, 'Iraq', 'Iraq'),
(1, 'Ireland', 'Ireland'),
(1, 'Is the patient CURRENTLY receiving any of the following?', 'O paciente esta recebendo algum dos seguintes ATUALMENTE?'),
(1, 'Isle of Man', 'Isle of Man'),
(1, 'Israel', 'Israel'),
(1, 'Italy', 'Italy'),
(1, 'Jamaica', 'Jamaica'),
(1, 'Japan', 'Japan'),
(1, 'Jersey', 'Jersey'),
(1, 'Joint pain (arthralgia)', 'Dor articular (artralgia)'),
(1, 'Jordan', 'Jordan'),
(1, 'Kazakhstan', 'Kazakhstan'),
(1, 'Kenya', 'Kenya'),
(1, 'Kiribati', 'Kiribati'),
(1, 'Korea, Democratic People\'s Republic of', 'Korea, Democratic People\'s Republic of'),
(1, 'Korea, Republic of', 'Korea, Republic of'),
(1, 'Kuwait', 'Kuwait'),
(1, 'Kyrgyzstan', 'Kyrgyzstan'),
(1, 'Laboratory question', 'Pergunta laboratorial'),
(1, 'Laboratory results', 'Resultados laboratoriais'),
(1, 'Laboratory Worker', 'Profissional de Laboratório'),
(1, 'Lactate measurement', 'Lactose'),
(1, 'Lao People\'s Democratic Republic', 'Lao People\'s Democratic Republic'),
(1, 'Latvia', 'Latvia'),
(1, 'LDH measurement', 'LDH'),
(1, 'Lebanon', 'Lebanon'),
(1, 'Lesotho', 'Lesotho'),
(1, 'Liberia', 'Liberia'),
(1, 'Libyan Arab Jamahiriya', 'Libyan Arab Jamahiriya'),
(1, 'Liechtenstein', 'Liechtenstein'),
(1, 'List of instances of the answers for the \'Sex at Birth\' question. In the WHO CRF, the three possible answers are: male, female or not specified.', 'Lista de instâncias das possíveis respostas para a pergunta \'Sexo as nascer\'. No FRC da OMS as três possíveis respostas são: masculino, feminino ou não especificado.'),
(1, 'List question', 'Questão com respostas em lista padronizada'),
(1, 'Lithuania', 'Lithuania'),
(1, 'Liver dysfunction', 'Disfunção hepática'),
(1, 'Lopinavir/Ritonavir', 'Lopinavir/Ritonavir'),
(1, 'Loss of smell', 'Perda do Olfato'),
(1, 'Loss of smell daily', 'Perda do Olfato'),
(1, 'Loss of smell signs', 'Perda do Olfato'),
(1, 'Loss of taste', 'Perda do paladar'),
(1, 'Loss of taste daily', 'Perda do paladar'),
(1, 'Loss of taste signs', 'Perda do paladar'),
(1, 'Lower chest wall indrawing', 'Retração toráxica'),
(1, 'Luxembourg', 'Luxembourg'),
(1, 'Lymphadenopathy', 'Linfadenopatia'),
(1, 'Macao', 'Macao'),
(1, 'Macedonia, the former Yugoslav Republic of', 'Macedonia, the former Yugoslav Republic of'),
(1, 'Madagascar', 'Madagascar'),
(1, 'Malawi', 'Malawi'),
(1, 'Malaysia', 'Malaysia'),
(1, 'Maldives', 'Maldives'),
(1, 'Male', 'Masculino'),
(1, 'Mali', 'Mali'),
(1, 'Malignant neoplasm', 'Neoplasma maligno'),
(1, 'Malnutrition', 'Desnutrição'),
(1, 'Malta', 'Malta'),
(1, 'Marshall Islands', 'Marshall Islands'),
(1, 'Martinique', 'Martinique'),
(1, 'Mask', 'Máscara'),
(1, 'Mask with reservoir', 'Máscara com reservatório'),
(1, 'Mauritania', 'Mauritania'),
(1, 'Mauritius', 'Mauritius'),
(1, 'Maximum daily corticosteroid dose', 'Dose diária máxima de corticosteroide'),
(1, 'Mayotte', 'Mayotte'),
(1, 'Medication', 'Medicação'),
(1, 'Meningitis/Encephalitis', 'Meningite/encefalite'),
(1, 'MERS-CoV', 'MERS-CoV'),
(1, 'Mexico', 'Mexico'),
(1, 'Micronesia, Federated States of', 'Micronesia, Federated States of'),
(1, 'Mid-upper arm circumference', 'Circunferência braquial'),
(1, 'Moldova, Republic of', 'Moldova, Republic of'),
(1, 'Monaco', 'Monaco'),
(1, 'Mongolia', 'Mongolia'),
(1, 'Montenegro', 'Montenegro'),
(1, 'Montserrat', 'Montserrat'),
(1, 'Morocco', 'Morocco'),
(1, 'Mozambique', 'Mozambique'),
(1, 'Muscle aches (myalgia)', 'Dor muscular (mialgia)'),
(1, 'Myanmar', 'Myanmar'),
(1, 'Myocarditis/Pericarditis', 'Miocardite/Pericardite'),
(1, 'N/A', 'Não informado'),
(1, 'Namibia', 'Namibia'),
(1, 'Nauru', 'Nauru'),
(1, 'Negative', 'Negativo'),
(1, 'Nepal', 'Nepal'),
(1, 'Netherlands', 'Netherlands'),
(1, 'Netherlands Antilles', 'Netherlands Antilles'),
(1, 'Neuraminidase inhibitor', 'Inibidor de neuraminidase'),
(1, 'New Caledonia', 'New Caledonia'),
(1, 'New Zealand', 'New Zealand'),
(1, 'Nicaragua', 'Nicaragua'),
(1, 'Niger', 'Niger'),
(1, 'Nigeria', 'Nigeria'),
(1, 'Niue', 'Niue'),
(1, 'No', 'Não'),
(1, 'Non-Falciparum malaria', 'Malária Não Falciparum'),
(1, 'Non-invasive ventilation', 'Ventilação não-invasiva'),
(1, 'Non-steroidal anti-inflammatory (NSAID)', 'Antiinflamatório não esteroide (AINE)'),
(1, 'Norfolk Island', 'Norfolk Island'),
(1, 'Northern Mariana Islands', 'Northern Mariana Islands'),
(1, 'Norway', 'Norway'),
(1, 'Not done', 'Não realizado'),
(1, 'Not known, not observed, not recorded, or refused.', 'Desconhecido, não observado, não registrato or recusado.'),
(1, 'Not Specified', 'Não especificado'),
(1, 'Number question', 'Pergunta numérica'),
(1, 'O2 flow', 'Vazão de O2'),
(1, 'O2 flow list', 'Lista fluxo de O2'),
(1, 'Oman', 'Oman'),
(1, 'Oral', 'Oral'),
(1, 'Oral/orogastric fluids', 'Hidratação oral/orogástrica'),
(1, 'Other co-morbidities', 'Outras comorbidades'),
(1, 'Other complication', 'Outra complicação'),
(1, 'Other corona virus', 'Outro coronavírus'),
(1, 'Other respiratory pathogen', 'Outro patógeno respiratório'),
(1, 'Other signs or symptoms', 'Outros'),
(1, 'Outcome', 'Desfecho'),
(1, 'Outcome date', 'Data do desfecho'),
(1, 'Outcome list', 'Lista de desfecho'),
(1, 'Outcome saturation list', 'Lista de Saturação de desfecho'),
(1, 'Oxygen interface', 'Interface de oxigenoterapia'),
(1, 'Oxygen saturation', 'Saturação de oxigênio'),
(1, 'Oxygen saturation expl', 'em'),
(1, 'Oxygen therapy', 'Oxigenoterapia'),
(1, 'PaCO2 value', 'Pressão parcial do CO2'),
(1, 'Pain', 'Dor'),
(1, 'Pakistan', 'Pakistan'),
(1, 'Palau', 'Palau'),
(1, 'Palestinian Territory, Occupied', 'Palestinian Territory, Occupied'),
(1, 'Palliative discharge', 'Alta paliativa'),
(1, 'Panama', 'Panama'),
(1, 'Pancreatitis', 'Pancreatite'),
(1, 'PaO2 value', 'Pressão parcial do O2'),
(1, 'Papua New Guinea', 'Papua New Guinea'),
(1, 'Paraguay', 'Paraguay'),
(1, 'PEEP value', 'Pressão expiratória final positiva'),
(1, 'Peru', 'Peru'),
(1, 'Philippines', 'Philippines'),
(1, 'Piped', 'Canalizado'),
(1, 'Pitcairn', 'Pitcairn'),
(1, 'Plateau pressure value', 'Pressão do plato'),
(1, 'Platelets measurement', 'Plaquetas'),
(1, 'Pneumonia', 'Pneumonia'),
(1, 'PNNot_done_Question', 'Questão com resposta Positivo Negativo ou não realizada'),
(1, 'pnnotdone_list', 'Lista PNNotDone'),
(1, 'Poland', 'Poland'),
(1, 'Portugal', 'Portugal'),
(1, 'Positive', 'Positivo'),
(1, 'Potassium measurement', 'Potássio'),
(1, 'Pre-admission & chronic medication', 'Pré-admissão e medicamentos de uso contínuo'),
(1, 'Pregnant', 'Grávida'),
(1, 'Procalcitonin measurement', 'Procalcitonina'),
(1, 'Prone position', 'Posição prona'),
(1, 'Proven or suspected infection with pathogen of Public Health Interest', 'Quadro de infecção comprovada ou suspeita com patógeno de interesse para a Saúde Pública'),
(1, 'PT measurement', 'TP'),
(1, 'Puerto Rico', 'Puerto Rico'),
(1, 'Qatar', 'Qatar'),
(1, 'Renal replacement therapy (RRT) or dialysis', 'Terapia de substituição renal ou diálise'),
(1, 'Respiratory rate', 'Frequência respiratória'),
(1, 'Reunion ﻿ Réunion', 'Reunion ﻿ Réunion'),
(1, 'Ribavirin', 'Ribavirina'),
(1, 'Romania', 'Romania'),
(1, 'Room air', 'ar ambiente'),
(1, 'Runny nose (rhinorrhoea)', 'Coriza (rinorréia)'),
(1, 'Russian Federation', 'Russian Federation'),
(1, 'Rwanda', 'Rwanda'),
(1, 'Saint Barthélemy', 'Saint Barthélemy'),
(1, 'Saint Helena', 'Saint Helena'),
(1, 'Saint Kitts and Nevis', 'Saint Kitts and Nevis'),
(1, 'Saint Lucia', 'Saint Lucia'),
(1, 'Saint Martin (French part)', 'Saint Martin (French part)'),
(1, 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon'),
(1, 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines'),
(1, 'Same as before illness', 'Como antes da doença'),
(1, 'Samoa', 'Samoa'),
(1, 'San Marino', 'San Marino'),
(1, 'Sao Tome and Principe', 'Sao Tome and Principe'),
(1, 'SARS-CoV-2', 'SARS-CoV-2'),
(1, 'Saudi Arabia', 'Saudi Arabia'),
(1, 'Seizures', 'Convulsões'),
(1, 'self_care_list', 'Lista cuidados'),
(1, 'Senegal', 'Senegal'),
(1, 'Serbia', 'Serbia'),
(1, 'Severe dehydration', 'Desidratação severa'),
(1, 'Sex at Birth', 'Sexo ao Nascer'),
(1, 'sex at birth list', 'Lista de sexo'),
(1, 'Seychelles', 'Seychelles'),
(1, 'Shock', 'Choque'),
(1, 'Shortness of breath', 'Falta de ar'),
(1, 'Sierra Leone', 'Sierra Leone'),
(1, 'Signs and symptoms on admission', 'Sinais e sintomas na hora da admissão'),
(1, 'Singapore', 'Singapore'),
(1, 'Site name', 'Localidade'),
(1, 'Skin rash', 'Erupções cutâneas'),
(1, 'Skin ulcers', 'Úlceras cutâneas'),
(1, 'Slovakia', 'Slovakia'),
(1, 'Slovenia', 'Slovenia'),
(1, 'Sodium measurement', 'Sódio'),
(1, 'Solomon Islands', 'Solomon Islands'),
(1, 'Somalia', 'Somalia'),
(1, 'Sore throat', 'Dor de garganta'),
(1, 'Source of oxygen', 'Fonte de Oxigênio'),
(1, 'Source of oxygen list', 'lista de fonte de O2'),
(1, 'South Africa', 'South Africa'),
(1, 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands'),
(1, 'Spain', 'Spain'),
(1, 'specific response', 'resposta específica'),
(1, 'Sri Lanka', 'Sri Lanka'),
(1, 'Sternal capillary refill time >2seconds', 'Tempo de enchimento capilar >2 segundos'),
(1, 'Sudan', 'Sudan'),
(1, 'Supportive care', 'Cuidados'),
(1, 'Suriname', 'Suriname'),
(1, 'Svalbard and Jan Mayen', 'Svalbard and Jan Mayen'),
(1, 'Swaziland', 'Swaziland'),
(1, 'Sweden', 'Sweden'),
(1, 'Switzerland', 'Switzerland'),
(1, 'Symptom onset (date of first/earliest symptom)', 'Início de Sintomas (data do primeiro sintoma)'),
(1, 'Syrian Arab Republic', 'Syrian Arab Republic'),
(1, 'Systemic anticoagulation', 'Anticoagulação sistêmica'),
(1, 'Taiwan, Province of China', 'Taiwan, Province of China'),
(1, 'Tajikistan', 'Tajikistan'),
(1, 'Tanzania, United Republic of', 'Tanzania, United Republic of'),
(1, 'Temperature', 'Temperatura'),
(1, 'Text_Question', 'Questão com resposta textual'),
(1, 'Thailand', 'Thailand'),
(1, 'The affirmative response to a question.', 'A resposta afirmativa à uma pergunta.'),
(1, 'The country where the medical center is located.', 'O país onde o centro médico está localizado.'),
(1, 'The identifier of the person as a participant (the subject) of the reported case. According to WHO, this identifier should be a combination of the site code (the unique code of the health center) and the participant number (generated by the health center). Health center can obtain the site code and ', 'O identificador da pessoa enquanto participante (o objeto) do case relatado pelo FRC. De acordo com a OMS, esse identificador deve ser criado a partir da junção do código da localidade (o código único do centro médico) e do número do participante (gerado pelo centro médico). Centros médicos podem obter o código da localidade e se registrarem no sistema de gestão de dados da OMS contatando edcarn@who.int.'),
(1, 'The name of the health center in which the participant is being treated.', 'O centro médico onde o participante está sendo tratado.'),
(1, 'The non-affirmative response to a question.', 'A resposta negativa à uma pergunta.'),
(1, 'The number of breaths (inhalation and exhalation) taken per minute time.', 'O número de respirações medidos a cada minuto.'),
(1, 'The number of heartbeats measured per minute time.', 'O número de batimentos cardíacos medidos a cada minuto.'),
(1, 'The Person that is the case subject of the WHO CRF.', 'A Pessoa que é o objeto do caso relatado pelo FRC da OMS.'),
(1, 'This class represents the Rapid version of the World Health Organisation\'s (WHO) Case Record Form (CRF) for the COVID-19 outbreak.', 'Esta classe representa a versão Rapid do Formulário de Relato de Caso (FRC) para a epidemia COVID-19, criada pela Organização Mundial de Saúde.'),
(1, 'time in weeks', 'tempo em semanas'),
(1, 'Timor-Leste', 'Timor-Leste'),
(1, 'Togo', 'Togo'),
(1, 'Tokelau', 'Tokelau'),
(1, 'Tonga', 'Tonga'),
(1, 'Total bilirubin measurement', 'Bilirrubina total'),
(1, 'Total duration ECMO', 'duração em dias'),
(1, 'Total duration ICU/HCU', 'duração em dias'),
(1, 'Total duration Inotropes/vasopressors', 'duração em dias'),
(1, 'Total duration Invasive ventilation', 'duração em dias'),
(1, 'Total duration Non-invasive ventilation', 'duração em dias'),
(1, 'Total duration Oxygen Therapy', 'duração em dias'),
(1, 'Total duration Prone position', 'duração em dias'),
(1, 'Total duration RRT or dyalysis', 'duração em dias'),
(1, 'Transfer to other facility', 'Transferência para outra unidade'),
(1, 'Trinidad and Tobago', 'Trinidad and Tobago'),
(1, 'Troponin measurement', 'Troponina'),
(1, 'Tuberculosis', 'Tuberculose'),
(1, 'Tunisia', 'Tunisia'),
(1, 'Turkey', 'Turkey'),
(1, 'Turkmenistan', 'Turkmenistan'),
(1, 'Turks and Caicos Islands', 'Turks and Caicos Islands'),
(1, 'Tuvalu', 'Tuvalu'),
(1, 'Uganda', 'Uganda'),
(1, 'Ukraine', 'Ukraine'),
(1, 'United Arab Emirates', 'United Arab Emirates'),
(1, 'United Kingdom', 'United Kingdom'),
(1, 'United States', 'United States'),
(1, 'United States Minor Outlying Islands', 'United States Minor Outlying Islands'),
(1, 'Unknown', 'Desconhecido'),
(1, 'Unresponsive', 'Indiferente'),
(1, 'Urea (BUN) measurement', 'Uréia (BUN)'),
(1, 'Uruguay', 'Uruguay'),
(1, 'Uzbekistan', 'Uzbekistan'),
(1, 'Vanuatu', 'Vanuatu'),
(1, 'Venezuela, Bolivarian Republic of', 'Venezuela, Bolivarian Republic of'),
(1, 'Ventilation question', 'Questão sobre Ventilação'),
(1, 'Verbal', 'Verbal'),
(1, 'Viet Nam', 'Viet Nam'),
(1, 'Viral haemorrhagic fever', 'Febre viral hemorrágica'),
(1, 'Virgin Islands, British', 'Virgin Islands, British'),
(1, 'Virgin Islands, U.S.', 'Virgin Islands, U.S.'),
(1, 'Vital signs', 'Sinais Vitais'),
(1, 'Vomiting/Nausea', 'Vômito/náusea'),
(1, 'Wallis and Futuna', 'Wallis and Futuna'),
(1, 'Was pathogen testing done during this illness episode', 'Esse teste foi realizado durante este episódio da doença'),
(1, 'WBC count measurement', 'Leucócitos'),
(1, 'Weight', 'Peso'),
(1, 'Were any of the following taken within 14 days of admission?', 'Marque os usados nos 14 dias antes da admissão'),
(1, 'Western Sahara', 'Western Sahara'),
(1, 'Wheezing', 'Respiração sibilante'),
(1, 'Which antibiotic', 'Antibiótico'),
(1, 'Which antifungal agent', 'Qual agente antifungal'),
(1, 'Which antimalarial agent', 'Qual agente antimalárico'),
(1, 'Which antiviral', 'Qual antiviral'),
(1, 'Which complication', 'Qual complicação'),
(1, 'Which coronavirus', 'Qual coronavírus'),
(1, 'Which corticosteroid route', 'Qual via do corticosteroide'),
(1, 'Which experimental agent', 'Qual agente experimental'),
(1, 'Which NSAID', 'Qual AINE'),
(1, 'Which other antiviral', 'Qual outro antiviral'),
(1, 'Which other co-morbidities', 'Outras comorbidades'),
(1, 'Which other pathogen of public health interest detected', 'Qual outro patógeno'),
(1, 'Which respiratory pathogen', 'Qual patógeno respiratório'),
(1, 'Which sign or symptom', 'Qual sinal ou sintoma'),
(1, 'Which virus', 'Qual vírus'),
(1, 'WHO COVID-19 Rapid Version CRF', 'OMS-COVID-19-Rapid-FRC'),
(1, 'Worse', 'Pior'),
(1, 'Yemen', 'Yemen'),
(1, 'Yes', 'Sim'),
(1, 'Yes-not on ART', 'Sim-não toma antivirais'),
(1, 'Yes-on ART', 'Sim-toma antivirais'),
(1, 'ynu_list', 'Lista YNU'),
(1, 'YNU_Question', 'Questão com resposta Sim Não Desconhecido'),
(1, 'ynun_list', 'Lista YNUN'),
(1, 'YNUN_Question', 'Questão com resposta Sim Não Desconhecido Não Informado'),
(1, 'Zambia', 'Zambia'),
(1, 'Zimbabwe', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_notificationrecord`
--

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
  PRIMARY KEY (`userID`,`profileID`,`hospitalUnitID`,`tableName`,`rowdID`,`changedOn`,`operation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_participant`
--

DROP TABLE IF EXISTS `tb_participant`;
CREATE TABLE IF NOT EXISTS `tb_participant` (
  `participantID` int(10) NOT NULL AUTO_INCREMENT,
  `medicalRecord` varchar(500) NOT NULL COMMENT '(pt-br) prontuário do paciente. \r\n(en) patient medical record.',
  PRIMARY KEY (`participantID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='(pt-br) Tabela para registros de pacientes.\r\n(en) Table for patient records.';

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_permission`
--

DROP TABLE IF EXISTS `tb_permission`;
CREATE TABLE IF NOT EXISTS `tb_permission` (
  `permissionID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`permissionID`),
  UNIQUE KEY `permissionID` (`permissionID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_permission`
--

INSERT INTO `tb_permission` (`permissionID`, `description`) VALUES
(1, 'Insert'),
(2, 'Update'),
(3, 'Delete'),
(4, 'ALL');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_questiongroup`
--

DROP TABLE IF EXISTS `tb_questiongroup`;
CREATE TABLE IF NOT EXISTS `tb_questiongroup` (
  `questionGroupID` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL COMMENT '(pt-br) Descrição.\r\n(en) description.',
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`questionGroupID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='Relacionado ao Question Group da ontologia relaciona as diversas sessoes existentes nos formularios do CRF COVID-19';

--
-- Extraindo dados da tabela `tb_questiongroup`
--

INSERT INTO `tb_questiongroup` (`questionGroupID`, `description`, `comment`) VALUES
(1, 'Clinical inclusion criteria', ''),
(2, 'Co-morbidities', 'Existing conditions prior to admission.'),
(3, 'Complications', ''),
(4, 'Daily clinical features', ''),
(5, 'Date of onset and admission vital signs', 'first available data at presentation/admission'),
(6, 'Demographics', ''),
(7, 'Diagnostic/pathogen testing', ''),
(8, 'Laboratory results', ''),
(9, 'Medication', 'Is the patient CURRENTLY receiving any of the following?'),
(10, 'Outcome', ''),
(11, 'Pre-admission & chronic medication', 'Were any of the following taken within 14 days of admission?'),
(12, 'Signs and symptoms on admission', ''),
(13, 'Supportive care', 'Is the patient CURRENTLY receiving any of the following?'),
(14, 'Vital signs', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_questiongroupform`
--

DROP TABLE IF EXISTS `tb_questiongroupform`;
CREATE TABLE IF NOT EXISTS `tb_questiongroupform` (
  `crfFormsID` int(10) NOT NULL,
  `questionID` int(10) NOT NULL,
  `questionOrder` int(10) NOT NULL,
  PRIMARY KEY (`crfFormsID`,`questionID`),
  KEY `FKtb_Questio124287` (`questionID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_questiongroupform`
--

INSERT INTO `tb_questiongroupform` (`crfFormsID`, `questionID`, `questionOrder`) VALUES
(1, 29, 10629),
(1, 33, 10710),
(1, 34, 10711),
(1, 35, 10703),
(1, 36, 10706),
(1, 37, 10713),
(1, 38, 10627),
(1, 39, 10802),
(1, 40, 10310),
(1, 47, 10102),
(1, 48, 10105),
(1, 49, 10101),
(1, 50, 10404),
(1, 51, 10412),
(1, 52, 10401),
(1, 53, 10405),
(1, 54, 10406),
(1, 55, 10407),
(1, 56, 10403),
(1, 57, 10410),
(1, 58, 10409),
(1, 59, 10408),
(1, 60, 10402),
(1, 61, 10413),
(1, 62, 10414),
(1, 63, 10104),
(1, 64, 10103),
(1, 65, 10411),
(1, 82, 10707),
(1, 87, 10708),
(1, 89, 10803),
(1, 90, 10805),
(1, 91, 10628),
(1, 92, 10804),
(1, 93, 10302),
(1, 94, 10316),
(1, 95, 10314),
(1, 96, 10315),
(1, 97, 10301),
(1, 98, 10317),
(1, 100, 10712),
(1, 101, 10704),
(1, 103, 10714),
(1, 104, 10705),
(1, 107, 10202),
(1, 108, 10205),
(1, 109, 10206),
(1, 110, 10207),
(1, 111, 10201),
(1, 113, 10208),
(1, 114, 10908),
(1, 115, 10905),
(1, 116, 10910),
(1, 117, 10709),
(1, 118, 10921),
(1, 119, 10702),
(1, 120, 10701),
(1, 127, 10619),
(1, 128, 10604),
(1, 129, 10611),
(1, 130, 10616),
(1, 132, 10601),
(1, 133, 10626),
(1, 134, 10610),
(1, 135, 10615),
(1, 136, 10625),
(1, 137, 10606),
(1, 138, 10623),
(1, 139, 10624),
(1, 140, 10607),
(1, 141, 10311),
(1, 143, 10630),
(1, 144, 10204),
(1, 145, 10919),
(1, 146, 10913),
(1, 147, 10917),
(1, 148, 10922),
(1, 149, 10815),
(1, 150, 10801),
(1, 151, 10814),
(1, 152, 10808),
(1, 153, 10806),
(1, 154, 10807),
(1, 155, 10816),
(1, 156, 10923),
(1, 157, 10903),
(1, 158, 10901),
(1, 159, 10924),
(1, 160, 10907),
(1, 161, 10912),
(1, 162, 10918),
(1, 163, 10904),
(1, 164, 10915),
(1, 165, 10916),
(1, 166, 10003),
(1, 167, 10004),
(1, 169, 10906),
(1, 170, 10914),
(1, 171, 10909),
(1, 172, 10920),
(1, 174, 10911),
(1, 189, 10308),
(1, 190, 10312),
(1, 191, 10304),
(1, 192, 10307),
(1, 193, 10313),
(1, 194, 10305),
(1, 195, 10306),
(1, 196, 10309),
(1, 198, 10303),
(1, 199, 10715),
(1, 200, 10716),
(1, 201, 10717),
(1, 202, 10501),
(1, 203, 10502),
(1, 204, 10503),
(1, 205, 10614),
(1, 206, 10620),
(1, 207, 10617),
(1, 208, 10621),
(1, 209, 10609),
(1, 210, 10602),
(1, 211, 10618),
(1, 212, 10203),
(1, 213, 10622),
(1, 214, 10608),
(1, 215, 10605),
(1, 225, 10603),
(1, 226, 10902),
(1, 227, 10415),
(1, 241, 10718),
(1, 242, 10002),
(1, 245, 10810),
(1, 246, 10813),
(1, 247, 10812),
(1, 248, 10811),
(1, 249, 10809),
(1, 252, 10613),
(1, 253, 10612),
(1, 254, 10504),
(1, 255, 10505),
(2, 28, 20214),
(2, 33, 20410),
(2, 34, 20411),
(2, 35, 20403),
(2, 36, 20406),
(2, 37, 20413),
(2, 39, 20504),
(2, 41, 20109),
(2, 82, 20407),
(2, 83, 20208),
(2, 87, 20408),
(2, 89, 20505),
(2, 90, 20507),
(2, 92, 20506),
(2, 100, 20412),
(2, 101, 20404),
(2, 103, 20414),
(2, 104, 20405),
(2, 112, 20110),
(2, 114, 20308),
(2, 115, 20305),
(2, 116, 20310),
(2, 117, 20409),
(2, 118, 20321),
(2, 119, 20402),
(2, 120, 20401),
(2, 142, 20215),
(2, 145, 20319),
(2, 146, 20313),
(2, 147, 20317),
(2, 148, 20322),
(2, 149, 20516),
(2, 150, 20501),
(2, 151, 20517),
(2, 152, 20510),
(2, 153, 20508),
(2, 154, 20509),
(2, 155, 20518),
(2, 156, 20323),
(2, 157, 20303),
(2, 158, 20301),
(2, 159, 20324),
(2, 160, 20307),
(2, 161, 20312),
(2, 162, 20318),
(2, 163, 20304),
(2, 164, 20315),
(2, 165, 20316),
(2, 168, 20002),
(2, 169, 20306),
(2, 170, 20314),
(2, 171, 20309),
(2, 172, 20320),
(2, 174, 20311),
(2, 177, 20204),
(2, 178, 20209),
(2, 182, 20210),
(2, 183, 20201),
(2, 184, 20203),
(2, 185, 20205),
(2, 186, 20211),
(2, 187, 20213),
(2, 188, 20212),
(2, 197, 20202),
(2, 199, 20415),
(2, 200, 20416),
(2, 201, 20417),
(2, 216, 20111),
(2, 217, 20101),
(2, 218, 20107),
(2, 219, 20105),
(2, 220, 20106),
(2, 221, 20102),
(2, 222, 20104),
(2, 223, 20108),
(2, 224, 20103),
(2, 226, 20302),
(2, 228, 20502),
(2, 229, 20503),
(2, 241, 20418),
(2, 245, 20512),
(2, 246, 20515),
(2, 247, 20514),
(2, 248, 20513),
(2, 249, 20511),
(2, 250, 20206),
(2, 251, 20207),
(3, 30, 30218),
(3, 31, 30101),
(3, 32, 30103),
(3, 33, 30311),
(3, 34, 30313),
(3, 35, 30303),
(3, 36, 30308),
(3, 37, 30315),
(3, 39, 30404),
(3, 42, 30109),
(3, 43, 30111),
(3, 44, 30106),
(3, 45, 30107),
(3, 46, 30104),
(3, 66, 30214),
(3, 67, 30209),
(3, 68, 30204),
(3, 69, 30210),
(3, 70, 30211),
(3, 71, 30208),
(3, 72, 30206),
(3, 73, 30205),
(3, 74, 30217),
(3, 75, 30212),
(3, 76, 30216),
(3, 77, 30203),
(3, 78, 30213),
(3, 79, 30215),
(3, 80, 30207),
(3, 81, 30201),
(3, 82, 30309),
(3, 84, 30114),
(3, 85, 30116),
(3, 86, 30102),
(3, 87, 30310),
(3, 88, 30115),
(3, 89, 30406),
(3, 90, 30408),
(3, 92, 30407),
(3, 99, 30312),
(3, 100, 30314),
(3, 101, 30304),
(3, 102, 30219),
(3, 103, 30316),
(3, 104, 30305),
(3, 105, 30113),
(3, 106, 30108),
(3, 117, 30306),
(3, 119, 30302),
(3, 120, 30301),
(3, 121, 30105),
(3, 122, 30503),
(3, 123, 30501),
(3, 124, 30502),
(3, 125, 30110),
(3, 126, 30112),
(3, 149, 30413),
(3, 150, 30401),
(3, 151, 30418),
(3, 152, 30411),
(3, 153, 30409),
(3, 154, 30415),
(3, 155, 30417),
(3, 176, 30202),
(3, 180, 30318),
(3, 199, 30317),
(3, 228, 30403),
(3, 232, 30307),
(3, 233, 30402),
(3, 234, 30405),
(3, 235, 30410),
(3, 236, 30412),
(3, 237, 30414),
(3, 238, 30416),
(3, 240, 30419);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_questiongroupformrecord`
--

DROP TABLE IF EXISTS `tb_questiongroupformrecord`;
CREATE TABLE IF NOT EXISTS `tb_questiongroupformrecord` (
  `questionGroupFormRecordID` int(10) NOT NULL AUTO_INCREMENT,
  `formRecordID` int(10) NOT NULL,
  `crfFormsID` int(10) NOT NULL,
  `questionID` int(10) NOT NULL,
  `listOfValuesID` int(10) DEFAULT NULL,
  `answer` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`questionGroupFormRecordID`),
  KEY `FKtb_Questio928457` (`listOfValuesID`),
  KEY `FKtb_Questio489549` (`crfFormsID`,`questionID`),
  KEY `FKtb_Questio935723` (`formRecordID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='(pt-br) Tabela para registro da resposta associada a uma questão de um agrupamento de um formulário referente a um questionario de avaliação.\r\n(en) Form record table.';

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_questionnaire`
--

DROP TABLE IF EXISTS `tb_questionnaire`;
CREATE TABLE IF NOT EXISTS `tb_questionnaire` (
  `questionnaireID` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`questionnaireID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_questionnaire`
--

INSERT INTO `tb_questionnaire` (`questionnaireID`, `description`) VALUES
(1, 'WHO COVID-19 Rapid Version CRF');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_questions`
--

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
  KEY `FKtb_Questio240796` (`listTypeID`),
  KEY `FKtb_Questio684913` (`questionTypeID`),
  KEY `FKtb_Questio808495` (`questionGroupID`),
  KEY `SubordinateTo` (`subordinateTo`),
  KEY `isAbout` (`isAbout`)
) ENGINE=MyISAM AUTO_INCREMENT=256 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_questions`
--

INSERT INTO `tb_questions` (`questionID`, `description`, `questionTypeID`, `listTypeID`, `questionGroupID`, `subordinateTo`, `isAbout`) VALUES
(1, 'Age', 5, NULL, 6, NULL, NULL),
(2, 'Altered consciousness/confusion', 8, 15, NULL, NULL, NULL),
(3, 'Angiotensin converting enzyme inhibitors (ACE inhibitors)', 8, 15, NULL, NULL, NULL),
(4, 'Angiotensin II receptor blockers (ARBs)', 8, 15, NULL, NULL, NULL),
(5, 'AVPU scale', 4, 2, NULL, NULL, NULL),
(6, 'BP (diastolic)', 5, NULL, NULL, NULL, NULL),
(7, 'BP (systolic)', 5, NULL, NULL, NULL, NULL),
(8, 'Chest pain', 8, 15, NULL, NULL, NULL),
(9, 'Conjunctivitis', 8, 15, NULL, NULL, NULL),
(10, 'Cough', 8, 15, NULL, NULL, NULL),
(11, 'Cough with sputum', 8, 15, NULL, NULL, NULL),
(12, 'Diarrhoea', 8, 15, NULL, NULL, NULL),
(13, 'Glasgow Coma Score (GCS /15)', 5, NULL, NULL, NULL, NULL),
(14, 'Heart rate', 5, NULL, NULL, NULL, NULL),
(15, 'Muscle aches (myalgia)', 8, 15, NULL, NULL, NULL),
(16, 'Non-steroidal anti-inflammatory (NSAID)', 8, 15, NULL, NULL, NULL),
(17, 'Other signs or symptoms', 8, 15, NULL, NULL, NULL),
(18, 'Oxygen saturation', 5, NULL, NULL, NULL, NULL),
(19, 'Respiratory rate', 5, NULL, NULL, NULL, NULL),
(20, 'Seizures', 8, 15, NULL, NULL, NULL),
(21, 'Severe dehydration', 8, 15, NULL, NULL, NULL),
(22, 'Shortness of breath', 8, 15, NULL, NULL, NULL),
(23, 'Sore throat', 8, 15, NULL, NULL, NULL),
(24, 'Sternal capillary refill time >2seconds', 8, 15, NULL, NULL, NULL),
(25, 'Temperature', 5, NULL, NULL, NULL, NULL),
(26, 'Vomiting/Nausea', 8, 15, NULL, NULL, NULL),
(27, 'Which sign or symptom', 7, NULL, NULL, NULL, NULL),
(28, 'Other signs or symptoms', 8, 15, 4, NULL, 17),
(29, 'Other signs or symptoms', 8, 15, 12, NULL, 17),
(30, 'Other complication', 8, 15, 3, NULL, NULL),
(31, 'Chest X-Ray /CT performed', 8, 15, 7, NULL, NULL),
(32, 'Was pathogen testing done during this illness episode', 8, 15, 7, NULL, NULL),
(33, 'Antifungal agent', 8, 15, 9, NULL, NULL),
(34, 'Antimalarial agent', 8, 15, 9, NULL, NULL),
(35, 'Antiviral', 8, 15, 9, NULL, NULL),
(36, 'Corticosteroid', 8, 15, 9, NULL, NULL),
(37, 'Experimental agent', 8, 15, 9, NULL, NULL),
(38, 'Bleeding (Haemorrhage)', 8, 15, 12, NULL, NULL),
(39, 'Oxygen therapy', 8, 15, 13, NULL, NULL),
(40, 'Oxygen saturation', 5, NULL, 5, NULL, 18),
(41, 'Oxygen saturation', 5, NULL, 14, NULL, 18),
(42, 'Other respiratory pathogen', 6, 11, 7, 32, NULL),
(43, 'Viral haemorrhagic fever', 6, 11, 7, 32, NULL),
(44, 'Coronavirus', 6, 11, 7, 32, NULL),
(45, 'Which coronavirus', 4, 3, 7, 44, NULL),
(46, 'Influenza virus', 6, 11, 7, 32, NULL),
(47, 'A history of self-reported feverishness or measured fever of ≥ 38 degrees Celsius', 1, NULL, 1, NULL, NULL),
(48, 'Clinical suspicion of ARI despite not meeting criteria above', 1, NULL, 1, NULL, NULL),
(49, 'Proven or suspected infection with pathogen of Public Health Interest', 1, NULL, 1, NULL, NULL),
(50, 'Ashtma', 8, 15, 2, NULL, NULL),
(51, 'Asplenia', 8, 15, 2, NULL, NULL),
(52, 'Chronic cardiac disease (not hypertension)', 8, 15, 2, NULL, NULL),
(53, 'Chronic kidney disease', 8, 15, 2, NULL, NULL),
(54, 'Chronic liver disease', 8, 15, 2, NULL, NULL),
(55, 'Chronic neurological disorder', 8, 15, 2, NULL, NULL),
(56, 'Chronic pulmonary disease', 8, 15, 2, NULL, NULL),
(57, 'Current smoking', 8, 15, 2, NULL, NULL),
(58, 'Diabetes', 8, 15, 2, NULL, NULL),
(59, 'HIV', 4, 6, 2, NULL, NULL),
(60, 'Hypertension', 8, 15, 2, NULL, NULL),
(61, 'Malignant neoplasm', 8, 15, 2, NULL, NULL),
(62, 'Other co-morbidities', 8, 15, 2, NULL, NULL),
(63, 'Dyspnoea (shortness of breath) OR Tachypnoea', 1, NULL, 1, NULL, NULL),
(64, 'Cough', 1, NULL, 1, NULL, NULL),
(65, 'Tuberculosis', 8, 15, 2, NULL, NULL),
(66, 'Acute renal injury', 8, 15, 3, NULL, NULL),
(67, 'Acute Respiratory Distress Syndrome', 8, 15, 3, NULL, NULL),
(68, 'Anaemia', 8, 15, 3, NULL, NULL),
(69, 'Bacteraemia', 8, 15, 3, NULL, NULL),
(70, 'Bleeding', 8, 15, 3, NULL, NULL),
(71, 'Bronchiolitis', 8, 15, 3, NULL, NULL),
(72, 'Cardiac arrest', 8, 15, 3, NULL, NULL),
(73, 'Cardiac arrhythmia', 8, 15, 3, NULL, NULL),
(74, 'Cardiomyopathy', 8, 15, 3, NULL, NULL),
(75, 'Endocarditis', 8, 15, 3, NULL, NULL),
(76, 'Liver dysfunction', 8, 15, 3, NULL, NULL),
(77, 'Meningitis/Encephalitis', 8, 15, 3, NULL, NULL),
(78, 'Myocarditis/Pericarditis', 8, 15, 3, NULL, NULL),
(79, 'Pancreatitis', 8, 15, 3, NULL, NULL),
(80, 'Pneumonia', 8, 15, 3, NULL, NULL),
(81, 'Shock', 8, 15, 3, NULL, NULL),
(82, 'Which corticosteroid route', 4, 4, 9, 36, NULL),
(83, 'Confusion', 8, 15, 4, NULL, NULL),
(84, 'Falciparum malaria', 6, 11, 7, 32, NULL),
(85, 'HIV', 6, 11, 7, 32, NULL),
(86, 'Infiltrates present', 8, 15, 7, 31, NULL),
(87, 'Maximum daily corticosteroid dose', 7, NULL, 9, 36, NULL),
(88, 'Non-Falciparum malaria', 6, 11, 7, 32, NULL),
(89, 'O2 flow', 4, 8, 13, 39, NULL),
(90, 'Oxygen interface', 4, 7, 13, 39, NULL),
(91, 'Site name', 7, NULL, 12, 38, NULL),
(92, 'Source of oxygen', 4, 14, 13, 39, NULL),
(93, 'Admission date at this facility', 2, NULL, 5, NULL, NULL),
(94, 'Height', 5, NULL, 5, NULL, NULL),
(95, 'Malnutrition', 8, 15, 5, NULL, NULL),
(96, 'Mid-upper arm circumference', 5, NULL, 5, NULL, NULL),
(97, 'Symptom onset (date of first/earliest symptom)', 2, NULL, 5, NULL, NULL),
(98, 'Weight', 5, NULL, 5, NULL, NULL),
(99, 'Which antifungal agent', 7, NULL, 9, 33, NULL),
(100, 'Which antimalarial agent', 7, NULL, 9, 34, NULL),
(101, 'Which antiviral', 4, 1, 9, 35, NULL),
(102, 'Which complication', 7, NULL, 3, 30, NULL),
(103, 'Which experimental agent', 7, NULL, 9, 37, NULL),
(104, 'Which other antiviral', 7, NULL, 9, 35, NULL),
(105, 'Which other pathogen of public health interest detected', 7, NULL, 7, 32, NULL),
(106, 'Other corona virus', 7, NULL, 7, 44, NULL),
(107, 'Date of Birth', 2, NULL, 6, NULL, NULL),
(108, 'Healthcare worker', 8, 15, 6, NULL, NULL),
(109, 'Laboratory Worker', 8, 15, 6, NULL, NULL),
(110, 'Pregnant', 9, 16, 6, NULL, NULL),
(111, 'Sex at Birth', 4, 13, 6, NULL, NULL),
(112, 'Oxygen saturation expl', 4, 10, 14, 41, NULL),
(113, 'Gestational weeks assessment', 5, NULL, 6, 110, NULL),
(114, 'ALT/SGPT measurement', 3, NULL, 8, NULL, NULL),
(115, 'APTT/APTR measurement', 3, NULL, 8, NULL, NULL),
(116, 'AST/SGOT measurement', 3, NULL, 8, NULL, NULL),
(117, 'Antibiotic', 8, 15, 9, NULL, NULL),
(118, 'ESR measurement', 3, NULL, 8, NULL, NULL),
(119, 'Intravenous fluids', 8, 15, 9, NULL, NULL),
(120, 'Oral/orogastric fluids', 8, 15, 9, NULL, NULL),
(121, 'Influenza virus type', 7, NULL, 7, 46, NULL),
(122, 'Ability to self-care at discharge versus before illness', 4, 12, 10, NULL, NULL),
(123, 'Outcome', 4, 9, 10, NULL, NULL),
(124, 'Outcome date', 2, NULL, 10, NULL, NULL),
(125, 'Which respiratory pathogen', 7, NULL, 7, 42, NULL),
(126, 'Which virus', 7, NULL, 7, 43, NULL),
(127, 'Abdominal pain', 8, 15, 12, NULL, NULL),
(128, 'Cough with haemoptysis', 8, 15, 12, NULL, NULL),
(129, 'Fatigue/Malaise', 8, 15, 12, NULL, NULL),
(130, 'Headache', 8, 15, 12, NULL, NULL),
(131, 'duration in weeks', 5, NULL, NULL, NULL, NULL),
(132, 'History of fever', 8, 15, 12, NULL, NULL),
(133, 'Inability to walk', 8, 15, 12, NULL, NULL),
(134, 'Joint pain (arthralgia)', 8, 15, 12, NULL, NULL),
(135, 'Lower chest wall indrawing', 8, 15, 12, NULL, NULL),
(136, 'Lymphadenopathy', 8, 15, 12, NULL, NULL),
(137, 'Runny nose (rhinorrhoea)', 8, 15, 12, NULL, NULL),
(138, 'Skin rash', 8, 15, 12, NULL, NULL),
(139, 'Skin ulcers', 8, 15, 12, NULL, NULL),
(140, 'Wheezing', 8, 15, 12, NULL, NULL),
(141, 'Oxygen saturation expl', 4, 10, 5, 40, NULL),
(142, 'Which sign or symptom', 7, NULL, 4, 28, 27),
(143, 'Which sign or symptom', 7, NULL, 12, 29, 27),
(144, 'Age (years)', 5, NULL, 6, NULL, 1),
(145, 'Creatine kinase measurement', 3, NULL, 8, NULL, NULL),
(146, 'Creatinine measurement', 3, NULL, 8, NULL, NULL),
(147, 'CRP measurement', 3, NULL, 8, NULL, NULL),
(148, 'D-dimer measurement', 3, NULL, 8, NULL, NULL),
(149, 'Extracorporeal (ECMO) support', 8, 15, 13, NULL, NULL),
(150, 'ICU or High Dependency Unit admission', 8, 15, 13, NULL, NULL),
(151, 'Inotropes/vasopressors', 8, 15, 13, NULL, NULL),
(152, 'Invasive ventilation', 8, 15, 13, NULL, NULL),
(153, 'Non-invasive ventilation', 9, 16, 13, NULL, NULL),
(154, 'Prone position', 8, 15, 13, NULL, NULL),
(155, 'Renal replacement therapy (RRT) or dialysis', 8, 15, 13, NULL, NULL),
(156, 'Ferritin measurement', 3, NULL, 8, NULL, NULL),
(157, 'Haematocrit measurement', 3, NULL, 8, NULL, NULL),
(158, 'Haemoglobin measurement', 3, NULL, 8, NULL, NULL),
(159, 'IL-6 measurement', 3, NULL, 8, NULL, NULL),
(160, 'INR measurement', 3, NULL, 8, NULL, NULL),
(161, 'Lactate measurement', 3, NULL, 8, NULL, NULL),
(162, 'LDH measurement', 3, NULL, 8, NULL, NULL),
(163, 'Platelets measurement', 3, NULL, 8, NULL, NULL),
(164, 'Potassium measurement', 3, NULL, 8, NULL, NULL),
(165, 'Procalcitonin measurement', 3, NULL, 8, NULL, NULL),
(166, 'Country', 4, 5, NULL, NULL, NULL),
(167, 'Date of enrolment', 2, NULL, NULL, NULL, NULL),
(168, 'Date of follow up', 2, NULL, NULL, NULL, NULL),
(169, 'PT measurement', 3, NULL, 8, NULL, NULL),
(170, 'Sodium measurement', 3, NULL, 8, NULL, NULL),
(171, 'Total bilirubin measurement', 3, NULL, 8, NULL, NULL),
(172, 'Troponin measurement', 3, NULL, 8, NULL, NULL),
(173, 'duration in days', 5, NULL, NULL, NULL, NULL),
(174, 'Urea (BUN) measurement', 3, NULL, 8, NULL, NULL),
(175, 'specific response', 7, NULL, NULL, NULL, NULL),
(176, 'Seizures', 8, 15, 3, NULL, 20),
(177, 'Chest pain', 8, 15, 4, NULL, 8),
(178, 'Seizures', 8, 15, 4, NULL, 20),
(179, 'Altered consciousness/confusion', 8, 15, 4, NULL, 2),
(180, 'Which NSAID', 7, NULL, 9, 16, NULL),
(181, 'Oxygen saturation expl', 4, 10, NULL, NULL, NULL),
(182, 'Vomiting/Nausea', 8, 15, 4, NULL, 26),
(183, 'Cough', 8, 15, 4, NULL, 10),
(184, 'Sore throat', 8, 15, 4, NULL, 23),
(185, 'Shortness of breath', 8, 15, 4, NULL, 22),
(186, 'Diarrhoea', 8, 15, 4, NULL, 12),
(187, 'Muscle aches (myalgia)', 8, 15, 4, NULL, 15),
(188, 'Conjunctivitis', 8, 15, 4, NULL, 9),
(189, 'Severe dehydration', 8, 15, 5, NULL, 21),
(190, 'AVPU scale', 4, 2, 5, NULL, 5),
(191, 'Heart rate', 5, NULL, 5, NULL, 14),
(192, 'BP (diastolic)', 5, NULL, 5, NULL, 6),
(193, 'Glasgow Coma Score (GCS /15)', 5, NULL, 5, NULL, 13),
(194, 'Respiratory rate', 5, NULL, 5, NULL, 19),
(195, 'BP (systolic)', 5, NULL, 5, NULL, 7),
(196, 'Sternal capillary refill time >2seconds', 8, 15, 5, NULL, 24),
(197, 'Cough with sputum production', 8, 15, 4, NULL, 11),
(198, 'Temperature', 5, NULL, 5, NULL, 25),
(199, 'Non-steroidal anti-inflammatory (NSAID)', 8, 15, 9, NULL, 16),
(200, 'Angiotensin converting enzyme inhibitors (ACE inhibitors)', 8, 15, 9, NULL, 3),
(201, 'Angiotensin II receptor blockers (ARBs)', 8, 15, 9, NULL, 4),
(202, 'Angiotensin converting enzyme inhibitors (ACE inhibitors)', 8, 15, 11, NULL, 3),
(203, 'Angiotensin II receptor blockers (ARBs)', 8, 15, 11, NULL, 4),
(204, 'Non-steroidal anti-inflammatory (NSAID)', 8, 15, 11, NULL, 16),
(205, 'Shortness of breath', 8, 15, 12, NULL, 22),
(206, 'Vomiting/Nausea', 8, 15, 12, NULL, 26),
(207, 'Altered consciousness/confusion', 8, 15, 12, NULL, 2),
(208, 'Diarrhoea', 8, 15, 12, NULL, 12),
(209, 'Muscle aches (myalgia)', 8, 15, 12, NULL, 15),
(210, 'Cough', 8, 15, 12, NULL, 10),
(211, 'Seizures', 8, 15, 12, NULL, 20),
(212, 'Age (months)', 5, NULL, 6, NULL, 1),
(213, 'Conjunctivitis', 8, 15, 12, NULL, 9),
(214, 'Chest pain', 8, 15, 12, NULL, 8),
(215, 'Sore throat', 8, 15, 12, NULL, 23),
(216, 'AVPU scale', 4, 2, 14, NULL, 5),
(217, 'Temperature', 5, NULL, 14, NULL, 25),
(218, 'Sternal capillary refill time >2seconds', 8, 15, 14, NULL, 24),
(219, 'BP (diastolic)', 5, NULL, 14, NULL, 6),
(220, 'Severe dehydration', 8, 15, 14, NULL, 21),
(221, 'Heart rate', 5, NULL, 14, NULL, 14),
(222, 'BP (systolic)', 5, NULL, 14, NULL, 7),
(223, 'Glasgow Coma Score (GCS /15)', 5, NULL, 14, NULL, 13),
(224, 'Respiratory rate', 5, NULL, 14, NULL, 19),
(225, 'Cough with sputum production', 8, 15, 12, NULL, 11),
(226, 'WBC count measurement', 3, NULL, 8, NULL, NULL),
(227, 'Which other co-morbidities', 7, NULL, 2, 62, NULL),
(228, 'Date of ICU/HDU admission', 2, NULL, 13, 150, NULL),
(229, 'ICU/HDU discharge date', 2, NULL, 13, 150, NULL),
(230, 'Date of ICU/HDU admission', 2, NULL, 13, 150, NULL),
(231, 'ICU/HDU discharge date', 2, NULL, 13, 150, NULL),
(232, 'Which antibiotic', 7, NULL, 9, 117, NULL),
(233, 'Total duration ICU/HCU', 5, NULL, 13, 150, 173),
(234, 'Total duration Oxygen Therapy', 5, NULL, 13, 39, 173),
(235, 'Total duration Non-invasive ventilation', 5, NULL, 13, 153, 173),
(236, 'Total duration Invasive ventilation', 5, NULL, 13, 152, 173),
(237, 'Total duration ECMO', 5, NULL, 13, 149, 173),
(238, 'Total duration Prone position', 5, NULL, 13, 154, 173),
(239, 'Total duration RRT or dyalysis', 5, NULL, 13, 155, 173),
(240, 'Total duration Inotropes/vasopressors', 5, NULL, 13, 151, 173),
(241, 'Systemic anticoagulation', 8, 15, 9, NULL, NULL),
(242, 'Facility name', 7, NULL, NULL, NULL, NULL),
(243, 'Loss of smell', 8, 15, NULL, NULL, NULL),
(244, 'Loss of taste', 8, 15, NULL, NULL, NULL),
(245, 'FiO2 value', 10, NULL, 13, 152, NULL),
(246, 'PaO2 value', 10, NULL, 13, 152, NULL),
(247, 'PaCO2 value', 10, NULL, 13, 152, NULL),
(248, 'Plateau pressure value', 10, NULL, 13, 152, NULL),
(249, 'PEEP value', 10, NULL, 13, 152, NULL),
(250, 'Loss of smell daily', 8, 15, 4, NULL, 243),
(251, 'Loss of taste daily', 8, 15, 4, NULL, 244),
(252, 'Loss of smell signs', 8, 15, 12, NULL, 243),
(253, 'Loss of taste signs', 8, 15, 12, NULL, 244),
(254, 'Which antiviral', 4, 1, 11, NULL, 101),
(255, 'Which other antiviral', 7, NULL, 11, 254, 104);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_questiontype`
--

DROP TABLE IF EXISTS `tb_questiontype`;
CREATE TABLE IF NOT EXISTS `tb_questiontype` (
  `questionTypeID` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL COMMENT '(pt-br) Descrição.\r\n(en) description.',
  PRIMARY KEY (`questionTypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_questiontype`
--

INSERT INTO `tb_questiontype` (`questionTypeID`, `description`) VALUES
(1, 'Boolean_Question'),
(2, 'Date question'),
(3, 'Laboratory question'),
(4, 'List question'),
(5, 'Number question'),
(6, 'PNNot_done_Question'),
(7, 'Text_Question'),
(8, 'YNU_Question'),
(9, 'YNUN_Question'),
(10, 'Ventilation question');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_user`
--

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_user`
--

INSERT INTO `tb_user` (`userID`, `login`, `firstName`, `lastName`, `regionalCouncilCode`, `password`, `eMail`, `foneNumber`) VALUES
(2, 'ETL_Hosp_Exemplo', 'ETL', 'Hosp EXEMPLO', NULL, 'testepsw', 'admin@hospitalexemplo.com.br', '5555-5555'),
(3, '01482642719', 'Vania', 'Borges', 'CRM 69596800', 'teste_psw', 'vj@gmail.com', '21 5555-5555'),
(8, 'Admin HUGG', 'Administrador', 'HUGG', 'CRM/CRF', 'teste_psw', 'adminHUGG@gmail.com', '21 5555-5555'),
(11, 'Admin', 'Administrador', 'Sistema', 'CRM/CRF', 'admin', 'adminsys@gmail.com', '5555-5555');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_userrole`
--

DROP TABLE IF EXISTS `tb_userrole`;
CREATE TABLE IF NOT EXISTS `tb_userrole` (
  `userID` int(11) NOT NULL,
  `groupRoleID` int(11) NOT NULL,
  `hospitalUnitID` int(11) NOT NULL,
  `creationDate` timestamp NOT NULL,
  `expirationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`userID`,`groupRoleID`,`hospitalUnitID`),
  KEY `FKtb_UserRol864770` (`groupRoleID`),
  KEY `FKtb_UserRol324331` (`hospitalUnitID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_userrole`
--

INSERT INTO `tb_userrole` (`userID`, `groupRoleID`, `hospitalUnitID`, `creationDate`, `expirationDate`) VALUES
(3, 7, 1, '2020-12-07 14:44:23', NULL),
(8, 1, 1, '2020-12-09 18:43:06', NULL),
(11, 1, 1, '2020-12-09 20:11:59', NULL),
(11, 1, 2, '2020-12-09 20:11:59', NULL);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_allforms_covidcrfrapid`
-- (Veja abaixo para a view atual)
--
DROP VIEW IF EXISTS `vw_allforms_covidcrfrapid`;
CREATE TABLE IF NOT EXISTS `vw_allforms_covidcrfrapid` (
`medicalRecord` varchar(500)
,`hospitalUnitName` varchar(500)
,`formrecordID` int(10)
,`Modulo` varchar(500)
,`QuestionGroup` varchar(500)
,`questionID` int(10)
,`question` varchar(500)
,`answer` varchar(512)
,`RSP_Padronizada` varchar(500)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_allquestionnaire`
-- (Veja abaixo para a view atual)
--
DROP VIEW IF EXISTS `vw_allquestionnaire`;
CREATE TABLE IF NOT EXISTS `vw_allquestionnaire` (
`questionnaireid` int(10)
,`questionnaire` varchar(255)
,`crfformsid` int(10)
,`questionid` int(10)
,`questionorder` int(10)
,`formulario` varchar(255)
,`questionGroup` varchar(255)
,`Question` varchar(255)
,`QuestionType` varchar(255)
,`listTypeResposta` varchar(255)
,`QuestaoSubordinadaA` varchar(255)
,`QuestaoReferenteA` varchar(255)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_crf_who_covid_pt_br`
-- (Veja abaixo para a view atual)
--
DROP VIEW IF EXISTS `vw_crf_who_covid_pt_br`;
CREATE TABLE IF NOT EXISTS `vw_crf_who_covid_pt_br` (
`crfformsid` int(10)
,`questionid` int(10)
,`questionorder` int(10)
,`formulario` varchar(500)
,`questionGroup` varchar(500)
,`commentQuestionGroup` varchar(500)
,`question` varchar(500)
,`questionType` varchar(255)
,`listtyperesposta` varchar(255)
,`listofvalue` varchar(341)
,`listofvaluesid` varchar(256)
,`questionSubordinadaa` varchar(500)
,`questaoReferentea` varchar(500)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_formquestionrecord`
-- (Veja abaixo para a view atual)
--
DROP VIEW IF EXISTS `vw_formquestionrecord`;
CREATE TABLE IF NOT EXISTS `vw_formquestionrecord` (
`medicalRecord` varchar(500)
,`hospitalUnitName` varchar(500)
,`formrecordID` int(10)
,`Modulo` varchar(500)
,`QuestionGroup` varchar(500)
,`questionID` int(10)
,`question` varchar(500)
,`answer` varchar(512)
,`RSP_Padronizada` varchar(500)
);

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_allforms_covidcrfrapid`
--
DROP TABLE IF EXISTS `vw_allforms_covidcrfrapid`;

DROP VIEW IF EXISTS `vw_allforms_covidcrfrapid`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_allforms_covidcrfrapid`  AS  select `t2`.`medicalRecord` AS `medicalRecord`,`t3`.`hospitalUnitName` AS `hospitalUnitName`,`t1`.`formRecordID` AS `formrecordID`,`TRANSLATE`('pt-br',`t4`.`description`) AS `Modulo`,(select `TRANSLATE`('pt-br',`qg`.`description`) from `tb_questiongroup` `qg` where (`qg`.`questionGroupID` = `t7`.`questionGroupID`)) AS `QuestionGroup`,`t5`.`questionID` AS `questionID`,`TRANSLATE`('pt-br',`t7`.`description`) AS `question`,`t5`.`answer` AS `answer`,(select `TRANSLATE`('pt-br',`lv`.`description`) from `tb_listofvalues` `lv` where (`lv`.`listOfValuesID` = `t5`.`listOfValuesID`)) AS `RSP_Padronizada` from ((((((`tb_formrecord` `t1` join `tb_participant` `t2`) join `tb_hospitalunit` `t3`) join `tb_crfforms` `t4`) join `tb_questiongroupformrecord` `t5`) join `tb_questiongroupform` `t6`) join `tb_questions` `t7`) where ((`t1`.`questionnaireID` = 1) and (`t1`.`participantID` = `t2`.`participantID`) and (`t1`.`hospitalUnitID` = `t3`.`hospitalUnitID`) and (`t4`.`crfFormsID` = `t1`.`crfFormsID`) and (`t5`.`formRecordID` = `t1`.`formRecordID`) and (`t6`.`crfFormsID` = `t5`.`crfFormsID`) and (`t6`.`questionID` = `t5`.`questionID`) and (`t7`.`questionID` = `t6`.`questionID`)) order by `t3`.`hospitalUnitName`,`t2`.`medicalRecord`,`t1`.`crfFormsID`,`t6`.`questionOrder` ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_allquestionnaire`
--
DROP TABLE IF EXISTS `vw_allquestionnaire`;

DROP VIEW IF EXISTS `vw_allquestionnaire`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_allquestionnaire`  AS  select `tabela_formulario`.`questionnaireid` AS `questionnaireid`,`tabela_formulario`.`questionnaire` AS `questionnaire`,`tabela_formulario`.`crfformsid` AS `crfformsid`,`tabela_formulario`.`questionid` AS `questionid`,`tabela_formulario`.`questionorder` AS `questionorder`,`tabela_formulario`.`formulario` AS `formulario`,(case when isnull(`tabela_formulario`.`questionGroup`) then '' else `tabela_formulario`.`questionGroup` end) AS `questionGroup`,(case when isnull(`tabela_formulario`.`QuestaoSubordinadaA`) then `tabela_formulario`.`question` else (`tabela_formulario`.`QuestaoSubordinadaA` or ': ' or `tabela_formulario`.`question`) end) AS `Question`,`tabela_formulario`.`questionType` AS `QuestionType`,`tabela_formulario`.`listTypeResposta` AS `listTypeResposta`,`tabela_formulario`.`QuestaoSubordinadaA` AS `QuestaoSubordinadaA`,`tabela_formulario`.`QuestaoReferenteA` AS `QuestaoReferenteA` from (select `t10`.`questionnaireID` AS `questionnaireid`,`t10`.`description` AS `questionnaire`,`t5`.`crfFormsID` AS `crfformsid`,`t1`.`questionID` AS `questionid`,`t9`.`questionOrder` AS `questionorder`,`t5`.`description` AS `formulario`,(select `t2`.`description` from `vodan_br_bd`.`tb_questiongroup` `t2` where (`t2`.`questionGroupID` = `t1`.`questionGroupID`)) AS `questionGroup`,`t1`.`description` AS `question`,(select `t3`.`description` AS `questionType` from `vodan_br_bd`.`tb_questiontype` `t3` where (`t3`.`questionTypeID` = `t1`.`questionTypeID`)) AS `questionType`,(select `t6`.`description` from `vodan_br_bd`.`tb_listtype` `t6` where (`t6`.`listTypeID` = `t1`.`listTypeID`)) AS `listTypeResposta`,(select `t7`.`description` from `vodan_br_bd`.`tb_questions` `t7` where (`t7`.`questionID` = `t1`.`subordinateTo`)) AS `QuestaoSubordinadaA`,(select `t8`.`description` from `vodan_br_bd`.`tb_questions` `t8` where (`t8`.`questionID` = `t1`.`isAbout`)) AS `QuestaoReferenteA` from (((`vodan_br_bd`.`tb_questions` `t1` join `vodan_br_bd`.`tb_crfforms` `t5`) join `vodan_br_bd`.`tb_questiongroupform` `t9`) join `vodan_br_bd`.`tb_questionnaire` `t10`) where ((`t10`.`questionnaireID` = `t5`.`questionnaireID`) and (`t9`.`crfFormsID` = `t5`.`crfFormsID`) and (`t9`.`questionID` = `t1`.`questionID`))) `tabela_formulario` order by `tabela_formulario`.`questionnaireid`,`tabela_formulario`.`questionnaire`,`tabela_formulario`.`crfformsid`,`tabela_formulario`.`questionorder` ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_crf_who_covid_pt_br`
--
DROP TABLE IF EXISTS `vw_crf_who_covid_pt_br`;

DROP VIEW IF EXISTS `vw_crf_who_covid_pt_br`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_crf_who_covid_pt_br`  AS  select `tb_questionario`.`crfformsid` AS `crfformsid`,`tb_questionario`.`questionid` AS `questionid`,`tb_questionario`.`questionorder` AS `questionorder`,`TRANSLATE`('pt-br',`tb_questionario`.`formulario`) AS `formulario`,`TRANSLATE`('pt-br',`tb_questionario`.`questionGroup`) AS `questionGroup`,`TRANSLATE`('pt-br',`tb_questionario`.`commentquestiongroup`) AS `commentQuestionGroup`,`TRANSLATE`('pt-br',`tb_questionario`.`Question`) AS `question`,`tb_questionario`.`QuestionType` AS `questionType`,`tb_questionario`.`listTypeResposta` AS `listtyperesposta`,(select group_concat(`TRANSLATE`('pt-br',`tlv`.`description`) separator ',') AS `listofvalue` from `tb_listofvalues` `tlv` where (`tlv`.`listTypeID` = `tb_questionario`.`listTypeID`)) AS `listofvalue`,(select group_concat(`tlv`.`listOfValuesID` separator ',') AS `listtypeID` from `tb_listofvalues` `tlv` where (`tlv`.`listTypeID` = `tb_questionario`.`listTypeID`)) AS `listofvaluesid`,`TRANSLATE`('pt-br',`tb_questionario`.`QuestaoSubordinada_A`) AS `questionSubordinadaa`,`TRANSLATE`('pt-br',`tb_questionario`.`QuestaoReferente_A`) AS `questaoReferentea` from (select `tabela_formulario`.`crfformsid` AS `crfformsid`,`tabela_formulario`.`questionid` AS `questionid`,`tabela_formulario`.`questionorder` AS `questionorder`,`tabela_formulario`.`formulario` AS `formulario`,(case when isnull(`tabela_formulario`.`questionGroup`) then '' else `tabela_formulario`.`questionGroup` end) AS `questionGroup`,(case when isnull(`tabela_formulario`.`commentquestionGroup`) then '' else `tabela_formulario`.`commentquestionGroup` end) AS `commentquestiongroup`,`tabela_formulario`.`question` AS `Question`,`tabela_formulario`.`questionType` AS `QuestionType`,`tabela_formulario`.`listTypeResposta` AS `listTypeResposta`,`tabela_formulario`.`listtypeid` AS `listTypeID`,`tabela_formulario`.`QuestaoSubordinada_A` AS `QuestaoSubordinada_A`,`tabela_formulario`.`QuestaoReferente_A` AS `QuestaoReferente_A` from (select `t5`.`crfFormsID` AS `crfformsid`,`t1`.`questionID` AS `questionid`,`t9`.`questionOrder` AS `questionorder`,`t5`.`description` AS `formulario`,(select `t2`.`description` from `tb_questiongroup` `t2` where (`t2`.`questionGroupID` = `t1`.`questionGroupID`)) AS `questionGroup`,(select `t2`.`comment` from `tb_questiongroup` `t2` where (`t2`.`questionGroupID` = `t1`.`questionGroupID`)) AS `commentquestionGroup`,`t1`.`description` AS `question`,(select `t3`.`description` AS `questionType` from `tb_questiontype` `t3` where (`t3`.`questionTypeID` = `t1`.`questionTypeID`)) AS `questionType`,(select `t6`.`description` from `tb_listtype` `t6` where (`t6`.`listTypeID` = `t1`.`listTypeID`)) AS `listTypeResposta`,`t1`.`listTypeID` AS `listtypeid`,(select `t7`.`description` from `tb_questions` `t7` where (`t7`.`questionID` = `t1`.`subordinateTo`)) AS `QuestaoSubordinada_A`,(select `t8`.`description` from `tb_questions` `t8` where (`t8`.`questionID` = `t1`.`isAbout`)) AS `QuestaoReferente_A` from ((`tb_questions` `t1` join `tb_crfforms` `t5`) join `tb_questiongroupform` `t9`) where ((`t9`.`crfFormsID` = `t5`.`crfFormsID`) and (`t9`.`questionID` = `t1`.`questionID`))) `tabela_formulario`) `tb_questionario` order by `tb_questionario`.`crfformsid`,`tb_questionario`.`questionorder` ;

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_formquestionrecord`
--
DROP TABLE IF EXISTS `vw_formquestionrecord`;

DROP VIEW IF EXISTS `vw_formquestionrecord`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_formquestionrecord`  AS  select `t2`.`medicalRecord` AS `medicalRecord`,`t3`.`hospitalUnitName` AS `hospitalUnitName`,`t1`.`formRecordID` AS `formrecordID`,`TRANSLATE`('pt-br',`t4`.`description`) AS `Modulo`,(select `TRANSLATE`('pt-br',`qg`.`description`) from `tb_questiongroup` `qg` where (`qg`.`questionGroupID` = `t7`.`questionGroupID`)) AS `QuestionGroup`,`t5`.`questionID` AS `questionID`,`TRANSLATE`('pt-br',`t7`.`description`) AS `question`,`t5`.`answer` AS `answer`,(select `TRANSLATE`('pt-br',`lv`.`description`) from `tb_listofvalues` `lv` where (`lv`.`listOfValuesID` = `t5`.`listOfValuesID`)) AS `RSP_Padronizada` from ((((((`tb_formrecord` `t1` join `tb_participant` `t2`) join `tb_hospitalunit` `t3`) join `tb_crfforms` `t4`) join `tb_questiongroupformrecord` `t5`) join `tb_questiongroupform` `t6`) join `tb_questions` `t7`) where ((`t1`.`participantID` = `t2`.`participantID`) and (`t1`.`hospitalUnitID` = `t3`.`hospitalUnitID`) and (`t4`.`crfFormsID` = `t1`.`crfFormsID`) and (`t5`.`formRecordID` = `t1`.`formRecordID`) and (`t6`.`crfFormsID` = `t5`.`crfFormsID`) and (`t6`.`questionID` = `t5`.`questionID`) and (`t7`.`questionID` = `t6`.`questionID`)) order by `t3`.`hospitalUnitName`,`t2`.`medicalRecord`,`t1`.`formRecordID`,`t1`.`crfFormsID`,`t6`.`questionOrder` ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
