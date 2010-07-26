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
	const ROLE_ADMIN = 'ROLE_ADMIN';
	const ROLE_MANAGER = 'ROLE_MANAGER';
	const ROLE_COORDINATOR = 'ROLE_COORDINATOR';
	const ROLE_MENTOR = 'ROLE_MENTOR';
	const ROLE_MENTEE = 'ROLE_MENTEE';

	// Existing Account status for students in SMP application
	const AS_NEW_MENTOR = 'AS_NEW_MENTOR';
	const AS_NEW_MENTEE = 'AS_NEW_MENTEE';
	const AS_MATCHED_MENTOR = 'AS_MATCHED_MENTOR';
	const AS_MATCHED_MENTEE = 'AS_MATCHED_MENTEE';
	const AS_EXPIRED_MENTOR = 'AS_EXPIRED_MENTOR';
	const AS_EXPIRED_MENTEE = 'AS_EXPIRED_MENTEE';
	const AS_TRAINED_MENTOR = 'AS_TRAINED_MENTOR';
}