<?php
/**
 * Created at 23/07/2010 10:27:15 AM
 * Constants
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
class Constants {
	
	// Exsiting Role in SMP application
	const ROLE_ANONYMOUS = 'ROLE_ANONYMOUS';
	const ROLE_ADMIN = 'ROLE_ADMIN';
	const ROLE_MANAGER = 'ROLE_MANAGER';
	const ROLE_COORDINATOR = 'ROLE_COORDINATOR';
	const ROLE_MENTOR = 'ROLE_MENTOR';
	const ROLE_MENTEE = 'ROLE_MENTEE';

	// Table names
	const TABLE_COURSE = 'smp_course';
	const TABLE_USER = 'smp_user';
	
	// Existing Account status for students in SMP application
	const AS_NEW_MENTOR = 'AS_NEW_MENTOR';
	const AS_NEW_MENTEE = 'AS_NEW_MENTEE';
	const AS_MATCHED_MENTOR = 'AS_MATCHED_MENTOR';
	const AS_MATCHED_MENTEE = 'AS_MATCHED_MENTEE';
	const AS_EXPIRED_MENTOR = 'AS_EXPIRED_MENTOR';
	const AS_EXPIRED_MENTEE = 'AS_EXPIRED_MENTEE';
	const AS_TRAINED_MENTOR = 'AS_TRAINED_MENTOR';
	
	// Messaging constants
	const MESSAGE_MENTOR = 'MESSAGE_MENTOR';
	const MESSAGE_MENTEE = 'MESSAGE_MENTEE';
	const MESSAGE_MANAGER = 'MESSAGE_MANAGER';
	const MESSAGE_COORDINATOR = 'MESSAGE_COORDINATOR';

	const MS_FOR_MENTOR = 'MS_FOR_MENTOR';
	const MS_FOR_MENTEE = 'MS_FOR_MENTEE';
	const MS_FOR_MANAGER = 'MS_FOR_MANAGER';
	const MS_FOR_COORDINATOR = 'MS_FOR_COORDINATOR';
	
	const ACTION = 'ACTION';
	const ACTION_SEARCH = 'ACTION_SEARCH';
	const ACTION_UPDATE = 'ACTION_UPDATE';
	const ACTION_SUBMIT = 'ACTION_SUBMIT';

	// Image upload directory
	const IMAGE_UPLOAD_DIR = 'static/images/profile/';	
	
	// Admin email address
	const ADMIN_EMAIL = 'smp_admin@scu.edu.au';
}