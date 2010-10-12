<?php
/**
 * Created at 23/07/2010 10:27:15 AM
 * Constants
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
class Constants {
	
	// Application root domain address
	const APPLICATION_DOMAIN = 'http://infotech.scu.edu.au/~smp/';
	
	// Admin email address
	const ADMIN_EMAIL = 'smp_admin@scu.edu.au';
	const APPLICATION_EMAIL = 'smp@scu.edu.au';

	// Image upload directory
	const IMAGE_UPLOAD_DIR = 'static/images/profile/';	
	
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
	const TABLE_LOG = 'smp_log';
	const TABLE_COORDINATOR = 'smp_coordinator';
	const TABLE_CAMPUS = 'smp_campus';
		
	// Messaging constants
	const MESSAGE_MENTOR = 'MESSAGE_MENTOR';
	const MESSAGE_MENTEE = 'MESSAGE_MENTEE';
	const MS_FOR_MENTOR = 'MS_FOR_MENTOR';
	const MS_FOR_MENTEE = 'MS_FOR_MENTEE';
	
	// Actions constants
	const ACTION = 'ACTION';
	const ACTION_SEARCH = 'ACTION_SEARCH';
	const ACTION_UPDATE = 'ACTION_UPDATE';
	const ACTION_SUBMIT = 'ACTION_SUBMIT';
}