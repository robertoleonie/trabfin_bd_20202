## ATENÇÃO
# Esse arquivo renomea para adequar-se a nomeclatura do cakephp

#renomear tabelas
if [[ $1 -eq 0 ]]; then
	rm -f -- renomeado_$1
	touch renomeado_$1
	cp 'Script_VODAN_BR_BD(ReadsSQLData).sql' renomeado_$1
	sed -i 's/\btb_userrole\b/tb_users_roles/g' renomeado_$1
	sed -i 's/\btb_user\b/tb_users/g' renomeado_$1
	sed -i 's/\btb_questiontype\b/tb_question_types/g' renomeado_$1
	sed -i 's/\btb_questionnaire\b/tb_questionnaires/g' renomeado_$1
	sed -i 's/\btb_questiongroupformrecord\b/tb_question_groups_forms_records/g' renomeado_$1
	sed -i 's/\btb_questiongroupform\b/tb_question_groups_forms/g' renomeado_$1
	sed -i 's/\btb_questiongroup\b/tb_question_groups/g' renomeado_$1
	sed -i 's/\btb_permission\b/tb_permissions/g' renomeado_$1
	sed -i 's/\btb_participant\b/tb_participants/g' renomeado_$1
	sed -i 's/\btb_notificationrecord\b/tb_notification_records/g' renomeado_$1
	sed -i 's/\btb_multilanguage\b/tb_multilanguages/g' renomeado_$1
	sed -i 's/\btb_listtype\b/tb_list_types/g' renomeado_$1
	sed -i 's/\btb_listofvalues\b/tb_list_of_values/g' renomeado_$1
	sed -i 's/\btb_language\b/tb_languages/g' renomeado_$1
	sed -i 's/\btb_hospitalunit\b/tb_hospital_units/g' renomeado_$1
	sed -i 's/\btb_grouprolepermission\b/tb_group_roles_permissions/g' renomeado_$1
	sed -i 's/\btb_grouprole\b/tb_group_roles/g' renomeado_$1
	sed -i 's/\btb_formrecord\b/tb_form_records/g' renomeado_$1
	sed -i 's/\btb_crfforms\b/tb_crfforms/g' renomeado_$1
	sed -i 's/\btb_assessmentquestionnaire\b/tb_assessment_questionnaires/g' renomeado_$1
	#renomear primary keys
	sed -i 's/\bhospitalUnitID\b/hospital_unit_id/g' renomeado_$1
	sed -i 's/\bgroupRoleID\b/group_role_id/g' renomeado_$1 
	sed -i 's/\buserID\b/user_id/g' renomeado_$1
	sed -i 's/\bquestionTypeID\b/question_type_id/g' renomeado_$1
	sed -i 's/\bquestionID\b/question_id\b/g ' renomeado_$1
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
fi
