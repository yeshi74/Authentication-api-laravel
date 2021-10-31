<?php

return [
	'insta' => [
		'API_LEAD_CRM'=> 'http://35.154.82.90:5000/api/v1/LeadsManagement/SubmitLead',
		'LOGIN' => 'https://api.instahealthsolutions.com/ahllclinics/Customer/Login.do?_method=login&hospital_name=[HOSPITAL_ID]&customer_user_id=[CUSTOMER_ID]&customer_user_password=[CUSTOMER_USER_PASSWORD]',
       	'EMR' => 'https://api.instahealthsolutions.com/ahllclinics/Customer/emr/VisitEMRView.do?_method=getVisitEMR&request_handler_key=[REQUEST_HANDLER]&visitId=[VISIT_ID]',
	    'MASTERDATA' => 'https://api.instahealthsolutions.com/ahllclinics/Customer/Registration/GeneralRegistration.do?_method=getRegMasterData&request_handler_key=[REQUEST_HANDLER]',
        'REGISTRATION' => 'https://api.instahealthsolutions.com/ahllclinics/Customer/Registration/GeneralRegistration.do?_method=getPatientDetails&request_handler_key=[REQUEST_HANDLER]&mr_no=[UHID]',
		'FRAN_LOGIN' => 'https://api.instahealthsolutions.com/ahll/Customer/Login.do?_method=login&hospital_name=[FRAN_HOSPITAL_ID]&customer_user_id=[FRAN_CUSTOMER_ID]&customer_user_password=[FRAN_CUSTOMER_USER_PASSWORD]',
    	'FRAN_EMR' => 'https://api.instahealthsolutions.com/ahll/Customer/emr/VisitEMRView.do?_method=getVisitEMR&request_handler_key=[REQUEST_HANDLER]&visitId=[VISIT_ID]',
		'FRAN_MASTERDATA' => 'https://api.instahealthsolutions.com/ahll/Customer/Registration/GeneralRegistration.do?_method=getRegMasterData&request_handler_key=[REQUEST_HANDLER]',
    	'FRAN_REGISTRATION' => 'https://api.instahealthsolutions.com/ahll/Customer/Registration/GeneralRegistration.do?_method=getPatientDetails&request_handler_key=[REQUEST_HANDLER]&mr_no=[UHID]',
		'HOSPITAL_ID' => 'ahllclinics',
		'CUSTOMER_ID' => 'APIUser',
		'CUSTOMER_USER_PASSWORD' => 'Apollo*1',
		'FRAN_HOSPITAL_ID' => 'ahll',
		'FRAN_CUSTOMER_ID' => 'APIUser',
		'FRAN_CUSTOMER_USER_PASSWORD' => 'Apollo*1',
		'REG_URL' => 'https://api.instahealthsolutions.com/ahllclinics/Customer/Registration/GeneralRegistration.do?_method=doPreRegistration&request_handler_key=[REQUEST_HANDLER]',
	
	],
	'edocapi' => [
		'BASE' => 'https://uat1.askapollo.com/edocapiservice/api/eDocConsultation/',
		'AUTHKEY' => 'AHLLMOBILEUAT-8045-8DEC-D76FA',
		'CREATE_APPOINTMENT' => 'https://uat1.askapollo.com/edocapiservice/eDocConsultation/BookConsultationAppointmentIneDocv3',
		'LEAD_SOURCE' => 'apolloclinics-mobile'
	],
	'prism' => [
		'AUTH' => 'https://base.apolloprism.com/login?userId=hie_user&password=Adm!N$90(83',
		'USERDETAILS_MOBILE' => 'https://base.apolloprism.com/hieSearch?mobile=[MOBILE]&authToken=[AUTHTOKEN]',
		'USERDETAILS_UHID' => 'https://base.apolloprism.com/hieSearch?uhid=[UHID]&authToken=[AUTHTOKEN]',
		'PROFILE' => 'https://base.apolloprism.com/getprofile?authToken=[AUTHTOKEN]'
	],
	'pubkey' => [
		'publish_key' => 'pub-c-b61ad3f9-8608-49c4-a66f-a7bd478eb3cd',
		'subscribe_key' => 'sub-c-149fad8e-e452-11eb-85a6-7a138f7aba45'
	],
	'sms' => [
		'sms_url' => 'http://www.smsjust.com/sms/user/urlsms.php?username=apollohealth&pass=dM76$Bc-&senderid=APOHLL&dest_mobileno=[MOBILE]&message=[MESSAGE]&response=Y',
		'otp_message' => 'Your OTP is [OTP]'
	]
]
?>
