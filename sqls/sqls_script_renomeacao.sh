#!/bin/bash
## ATENÇÃO
# Esse arquivo renomea para adequar-se a nomeclatura do cakephp

if [[ $# -ne 0 && -f $1 ]]; then
	touch renomeado_$1
	cp $1 renomeado_$1
	#renomear primary keys
	sed -i 's/\bhospitalUnitID\b/hospital_unit_id/g' renomeado_$1
	sed -i 's/\bgroupRoleID\b/group_role_id/g' renomeado_$1 
	sed -i 's/\buserID\b/user_id/g' renomeado_$1
	sed -i 's/\bquestionTypeID\b/question_type_id/g' renomeado_$1
	sed -i 's/\bquestionID\b/question_id/g ' renomeado_$1
	sed -i 's/\bquestionnaireID\b/questionnaire_id/g' renomeado_$1
	sed -i 's/\bquestionGroupFormRecordID \b/question_groups_forms_record_id/g' renomeado_$1
	sed -i 's/\bcrfFormsID\b/crfform_id/g' renomeado_$1
	sed -i 's/\bquestionGroupID\b/question_group_id/g' renomeado_$1
	sed -i 's/\bpermissionID\b/permission_id/g' renomeado_$1
	sed -i 's/\bparticipantID\b/participant_id/g' renomeado_$1
	sed -i 's/\browdID\b/row_id/g' renomeado_$1
	sed -i 's/\bhospitalUnitID\b/hospital_unit_id/g' renomeado_$1
	sed -i 's/\bprofileID\b/profile_id/g' renomeado_$1
	sed -i 's/\buserID\b/user_id\b/g ' renomeado_$1
	sed -i 's/\blanguageID\b/language_id/g' renomeado_$1
	sed -i 's/\blistTypeID\b/list_type_id/g' renomeado_$1
	sed -i 's/\blisttypeID\b/list_type_id/g' renomeado_$1
	sed -i 's/\blistOfValuesID\b/list_of_value_id/g' renomeado_$1
	sed -i 's/\blanguageID\b/language_id/g' renomeado_$1
	sed -i 's/\bhospitalUnitID\b/hospital_unit_id/g' renomeado_$1
	sed -i 's/\bpermissionID\b/permission_id/g' renomeado_$1
	sed -i 's/\bformRecordID\b/form_record_id/g' renomeado_$1
	sed -i 's/\bcrfFormsID\b/crfforms_id/g' renomeado_$1
	sed -i 's/\bparticipantID\b/participant_id/g' renomeado_$1
	#renomear tabelas
	sed -i 's/\btb_userrole\b/users_roles/g' renomeado_$1
	sed -i 's/\btb_user\b/users/g' renomeado_$1
	sed -i 's/\btb_questiontype\b/question_types/g' renomeado_$1
	sed -i 's/\btb_questions\b/questions/g ' renomeado_$1
	sed -i 's/\btb_questionnaire\b/questionnaires/g' renomeado_$1
	sed -i 's/\btb_questiongroupformrecord\b/question_groups_forms_records/g' renomeado_$1
	sed -i 's/\btb_questiongroupform\b/question_groups_forms/g' renomeado_$1
	sed -i 's/\btb_questiongroup\b/question_groups/g' renomeado_$1
	sed -i 's/\btb_permission\b/permissions/g' renomeado_$1
	sed -i 's/\btb_participant\b/participants/g' renomeado_$1
	sed -i 's/\btb_notificationrecord\b/notification_records/g' renomeado_$1
	sed -i 's/\btb_multilanguage\b/multilanguages/g' renomeado_$1
	sed -i 's/\btb_listtype\b/list_types/g' renomeado_$1
	sed -i 's/\btb_listofvalues\b/list_of_values/g' renomeado_$1
	sed -i 's/\btb_language\b/languages/g' renomeado_$1
	sed -i 's/\btb_hospitalunit\b/hospital_units/g' renomeado_$1
	sed -i 's/\btb_grouprolepermission\b/group_roles_permissions/g' renomeado_$1
	sed -i 's/\btb_grouprole\b/group_roles/g' renomeado_$1
	sed -i 's/\btb_formrecord\b/form_records/g' renomeado_$1
	sed -i 's/\btb_crfforms\b/crfforms/g' renomeado_$1
	sed -i 's/\btb_assessmentquestionnaire\b/assessment_questionnaires/g' renomeado_$1

fi
