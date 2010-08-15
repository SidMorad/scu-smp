CREATE DATABASE IF NOT EXISTS smp;
USE smp;

DROP TABLE IF EXISTS smp_mentor_mentee;
DROP TABLE IF EXISTS smp_mentee;
DROP TABLE IF EXISTS smp_mentor;
DROP TABLE IF EXISTS smp_contact;
DROP TABLE IF EXISTS smp_student;
DROP TABLE IF EXISTS smp_user_role;
DROP TABLE IF EXISTS smp_log;
DROP TABLE IF EXISTS smp_user;
DROP TABLE IF EXISTS smp_role;

CREATE TABLE smp_user (
	id BIGINT NOT NULL AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL UNIQUE,
	password VARCHAR(50) NOT NULL,
	scu_email VARCHAR(100) NOT NULL UNIQUE, 
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE smp_role(
	id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL UNIQUE,
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE smp_user_role(
	user_id BIGINT,
	role_id INT(11),
	CONSTRAINT smp_fk_user_role FOREIGN KEY (user_id) REFERENCES smp_user(id) ON DELETE CASCADE,
	CONSTRAINT smp_fk_role_user FOREIGN KEY (role_id) REFERENCES smp_role(id) ON DELETE CASCADE,
	PRIMARY KEY(user_id, role_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE smp_log (
	id BIGINT NOT NULL AUTO_INCREMENT,
	time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	msg VARCHAR(255),
	title VARCHAR(50),
	user_id BIGINT,
	CONSTRAINT smp_fk_log_user FOREIGN KEY (user_id) REFERENCES smp_user(id) ON DELETE CASCADE,
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE smp_student (
	id BIGINT NOT NULL AUTO_INCREMENT,
	firstname VARCHAR(100),
	lastname VARCHAR(100),
	gender VARCHAR(20),
	student_number VARCHAR(10) UNIQUE,
	age_range VARCHAR(20),
	course VARCHAR(100),
	major VARCHAR(100),
	study_mode VARCHAR(50),
	recommended_by_staff VARCHAR(100),
	semesters_completed VARCHAR(3),
	family_status VARCHAR(5),
	work_status VARCHAR(50),
	tertiary_study_status VARCHAR(5),
	is_first_year VARCHAR(5),
	is_international BOOLEAN,
	is_disability BOOLEAN,
	is_indigenous BOOLEAN,
	is_non_english BOOLEAN,
	is_regional BOOLEAN,
	is_socioeconomic BOOLEAN,
	prefer_gender VARCHAR(20),
	prefer_australian BOOLEAN,
	prefer_distance BOOLEAN,
	prefer_international BOOLEAN,
	prefer_on_campus BOOLEAN,
	interests VARCHAR(255),
	comments VARCHAR(255),
	user_id BIGINT,
	account_status VARCHAR(50),
	CONSTRAINT smp_fk_student_user FOREIGN KEY (user_id) REFERENCES smp_user(id) ON DELETE CASCADE,
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE smp_contact (
	id BIGINT NOT NULL AUTO_INCREMENT,
	address VARCHAR(255),
	city VARCHAR(100),
	postcode VARCHAR(20),
	phone_home VARCHAR(20),
	phone_work VARCHAR(20),
	mobile VARCHAR(20),
	email VARCHAR(100),
	user_id BIGINT,
	student_id BIGINT,
	CONSTRAINT smp_fk_contact_user FOREIGN KEY (user_id) REFERENCES smp_user(id) ON DELETE CASCADE,
	CONSTRAINT smp_fk_contact_student FOREIGN KEY (student_id) REFERENCES smp_student(id) ON DELETE CASCADE,
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE smp_mentor (
	id BIGINT NOT NULL AUTO_INCREMENT,
	user_id BIGINT NOT NULL,
	student_id BIGINT NOT NULL,
	contact_id BIGINT NOT NULL,
	mentee_limit int,
	mentee_contact_confirm BOOLEAN DEFAULT FALSE,
	trained BOOLEAN DEFAULT FALSE,
	matched BOOLEAN DEFAULT FALSE,
	expired BOOLEAN DEFAULT FALSE,
	CONSTRAINT smp_fk_mentor_user FOREIGN KEY (user_id) REFERENCES smp_user(id) ON DELETE CASCADE,
	CONSTRAINT smp_fk_mentor_student FOREIGN KEY (student_id) REFERENCES smp_student(id) ON DELETE CASCADE,
	CONSTRAINT smp_fk_mentor_contact FOREIGN KEY (contact_id) REFERENCES smp_contact(id) ON DELETE CASCADE,
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE smp_mentee (
	id BIGINT NOT NULL AUTO_INCREMENT,
	user_id BIGINT NOT NULL,
	student_id BIGINT NOT NULL,
	contact_id BIGINT NOT NULL,
	matched BOOLEAN DEFAULT FALSE,
	expired BOOLEAN DEFAULT FALSE,
	CONSTRAINT smp_fk_mentee_user FOREIGN KEY (user_id) REFERENCES smp_user(id) ON DELETE CASCADE,
	CONSTRAINT smp_fk_mentee_student FOREIGN KEY (student_id) REFERENCES smp_student(id) ON DELETE CASCADE,
	CONSTRAINT smp_fk_mentee_contact FOREIGN KEY (contact_id) REFERENCES smp_contact(id) ON DELETE CASCADE,
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE smp_mentor_mentee (
	mentor_id BIGINT,
	mentee_id BIGINT,
	create_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	expired BOOLEAN DEFAULT FALSE,
	CONSTRAINT smp_fk_mm_mentor FOREIGN KEY (mentor_id) REFERENCES smp_mentor(id) ON DELETE CASCADE,
	CONSTRAINT smp_fk_mm_mentee FOREIGN KEY (mentee_id) REFERENCES smp_mentee(id) ON DELETE CASCADE,
	PRIMARY KEY(mentor_id, mentee_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

insert into smp_role values(1, 'ROLE_ADMIN');
insert into smp_role values(2, 'ROLE_MANAGER');
insert into smp_role values(3, 'ROLE_COORDINATOR');
insert into smp_role values(4, 'ROLE_MENTOR');
insert into smp_role values(5, 'ROLE_MENTEE');
insert into smp_user values(1, 'admin', 'admin', 'earl.whittaker@scu.edu.au');
insert into smp_user values(2, 'rob', 'rob', 'rob.cumings@scu.edu.au');
insert into smp_user values(3, 'jo', 'jo', 'jo.mason@scu.edu.au');
insert into smp_user values(4, 'jiya', 'jiya', 'b.kaur.10@scu.edu.au');
insert into smp_user values(5, 'lucy', 'lucy', 'l.zhang.12@scu.edu.au');
insert into smp_user values(6, 'james', 'james', 'j.glees.24@scu.edu.au');
insert into smp_user values(7, 'bruce', 'bruce', 's.li.24@scu.edu.au');
insert into smp_user values(8, 'mentor5', 'mentor', 'mentor5@scu.edu.au');
insert into smp_user values(9, 'mentor6', 'mentor', 'mentor6@scu.edu.au');
insert into smp_user values(10,'mentor7', 'mentor', 'mentor7@scu.edu.au');
insert into smp_user values(11,'mentor8', 'mentor', 'mentor8@scu.edu.au');
insert into smp_user values(12,'mentor9', 'mentor', 'mentor9@scu.edu.au');
insert into smp_user values(13,'mentor10','mentor', 'mentor10@scu.edu.au');
insert into smp_user values(14,'mentee5', 'mentee', 'mentee5@scu.edu.au');
insert into smp_user values(15,'mentee6', 'mentee', 'mentee6@scu.edu.au');
insert into smp_user values(16,'mentee7', 'mentee', 'mentee7@scu.edu.au');
insert into smp_user values(17,'mentee8', 'mentee', 'mentee8@scu.edu.au');
insert into smp_user values(18,'mentee9', 'mentee', 'mentee9@scu.edu.au');
insert into smp_user values(19,'mentee10','mentee', 'mentee10@scu.edu.au');
insert into smp_user_role (user_id, role_id) values(1,1);
insert into smp_user_role (user_id, role_id) values(2,2);
insert into smp_user_role (user_id, role_id) values(3,3);
insert into smp_user_role (user_id, role_id) values(4,4);
insert into smp_user_role (user_id, role_id) values(5,5);
insert into smp_user_role (user_id, role_id) values(6,5);
insert into smp_user_role (user_id, role_id) values(7,4);
insert into smp_user_role (user_id, role_id) values(8,4);
insert into smp_user_role (user_id, role_id) values(9,4);
insert into smp_user_role (user_id, role_id) values(10,4);
insert into smp_user_role (user_id, role_id) values(11,4);
insert into smp_user_role (user_id, role_id) values(12,4);
insert into smp_user_role (user_id, role_id) values(13,4);
insert into smp_user_role (user_id, role_id) values(14,5);
insert into smp_user_role (user_id, role_id) values(15,5);
insert into smp_user_role (user_id, role_id) values(16,5);
insert into smp_user_role (user_id, role_id) values(17,5);
insert into smp_user_role (user_id, role_id) values(18,5);
insert into smp_user_role (user_id, role_id) values(19,5);

insert into smp_student (id, user_id, firstname, lastname, gender, student_number, age_range, course, major, study_mode, recommended_by_staff, semesters_completed, family_status, work_status, tertiary_study_status,is_first_year, is_international, is_disability, 
						is_indigenous,is_non_english,is_regional,is_socioeconomic,prefer_gender,prefer_australian,prefer_distance,prefer_international,prefer_on_campus,interests,comments,account_status)
values 	
		(1, 4 , 'Jiya' 	 , 'Khangura', 'female', '21555555', 'under25', 'IT'		, 'Multimedia'			, 'coffs', 'Paul Woods', '4', 'no' , 'parttime', 'no' , 'no' , '1', '0', '0', '1', '0', '0', 'no' , '0', '1', '1', '1', 'Reading', 'No Commnets left', 'AS_NEW_MENTOR'),
		(2, 5 , 'Lucy' 	 , 'Zhang'   , 'female', '21888888', 'under25', 'IT'		, 'Software Development', 'coffs', 'Paul Woods', '0', 'no' , 'parttime', 'no' , 'no' , '1', '0', '0', '1', '0', '0', 'no' , '1', '0', '1', '1', 'Reading', 'No Commnets left', 'AS_NEW_MENTEE'),
		(3, 7 , 'Bruce'  , 'Li'      , 'male'  , '21666666', 'under25', 'IT'		, 'Multimedia'			, 'coffs', 'Paul Woods', '4', 'no' , 'parttime', 'no' , 'no' , '1', '0', '0', '1', '0', '0', 'no' , '1', '0', '1', '1', 'Reading', 'No Commnets left', 'AS_NEW_MENTOR'),
		(4, 6 , 'James'	 , 'Gleeson' , 'male'  , '21777777', 'under25', 'IT'		, 'Software Development', 'coffs', 'Paul Woods', '1', 'no' , 'parttime', 'no' , 'no' , '0', '0', '0', '0', '1', '0', 'no' , '0', '1', '1', '1', 'Reading', 'No Commnets left', 'AS_NEW_MENTEE'),
		(5, 8 , 'Mentor5', 'Family5' , 'female', '21000005', 'under25', 'Nursing'	, 'Major1'				, 'coffs', 'Paul Woods', '2', 'no' , 'nowork'  , 'no' , 'yes', '0', '1', '0', '1', '0', '1', 'yes', '1', '0', '0', '0', 'Walking', 'I like chocolate', 'AS_NEW_MENTOR'),
		(6, 9 , 'Mentor6', 'Family6' , 'male'  , '21000006', '25to30' , 'Nursing'	, 'Major2'				, 'tweed', 'Staff num1', '2', 'yes', 'casual'  , 'yes', 'no' , '1', '0', '1', '0', '1', '0', 'no' , '0', '1', '1', '1', 'Walking', 'I like ice cream', 'AS_NEW_MENTOR'),
		(7, 10, 'Mentor7', 'Family7' , 'female', '21000007', '30to40' , 'Hotel Mgm'	, 'Major1'				, 'coffs', 'Paul Woods', '2', 'no' , 'nowork'  , 'no' , 'yes', '0', '1', '0', '1', '0', '1', 'yes', '1', '0', '0', '0', 'Walking', 'I like chocolate', 'AS_NEW_MENTOR'),
		(8, 11, 'Mentor8', 'Family8' , 'male'  , '21000008', '25to30' , 'Hotel Mgm'	, 'Major2'				, 'tweed', 'Staff num1', '2', 'yes', 'casual'  , 'yes', 'no' , '1', '0', '1', '0', '1', '0', 'no' , '0', '1', '1', '1', 'Walking', 'I like ice cream', 'AS_NEW_MENTOR'),
		(9, 12, 'Mentor9', 'Family9' , 'female', '21000009', '30to40' , 'Hotel Mgm'	, 'Major1'				, 'coffs', 'Paul Woods', '2', 'no' , 'nowork'  , 'no' , 'yes', '0', '1', '0', '1', '0', '1', 'yes', '1', '0', '0', '0', 'Walking', 'I like chocolate', 'AS_NEW_MENTOR'),
		(10,13, 'Mentor10','Family10', 'male'  , '21000010', '25to30' , 'Hotel Mgm'	, 'Major2'				, 'tweed', 'Staff num1', '2', 'yes', 'casual'  , 'yes', 'no' , '1', '0', '1', '0', '1', '0', 'no' , '0', '1', '1', '1', 'Walking', 'I like ice cream', 'AS_NEW_MENTOR'),
		(11,14, 'Mentee5', 'Family5' , 'female', '21000011', 'under25', 'Nursing'	, 'Major1'				, 'coffs', 'Paul Woods', '2', 'no' , 'nowork'  , 'no' , 'yes', '0', '1', '0', '1', '0', '1', 'yes', '1', '0', '0', '0', 'Walking', 'I like chocolate', 'AS_NEW_MENTEE'),
		(12,15, 'Mentee6', 'Family6' , 'male'  , '21000012', '25to30' , 'Nursing'	, 'Major2'				, 'tweed', 'Staff num1', '2', 'yes', 'casual'  , 'yes', 'no' , '1', '0', '1', '0', '1', '0', 'no' , '0', '1', '1', '1', 'Walking', 'I like ice cream', 'AS_NEW_MENTEE'),
		(13,16, 'Mentee7', 'Family7' , 'female', '21000013', '30to40' , 'Hotel Mgm'	, 'Major1'				, 'coffs', 'Paul Woods', '2', 'no' , 'nowork'  , 'no' , 'yes', '0', '1', '0', '1', '0', '1', 'yes', '1', '0', '0', '0', 'Walking', 'I like chocolate', 'AS_NEW_MENTEE'),
		(14,17, 'Mentee8', 'Family8' , 'male'  , '21000014', '25to30' , 'Hotel Mgm'	, 'Major2'				, 'tweed', 'Staff num1', '2', 'yes', 'casual'  , 'yes', 'no' , '1', '0', '1', '0', '1', '0', 'no' , '0', '1', '1', '1', 'Walking', 'I like ice cream', 'AS_NEW_MENTEE'),
		(15,18, 'Mentee9', 'Family9' , 'female', '21000015', '30to40' , 'Hotel Mgm'	, 'Major1'				, 'coffs', 'Paul Woods', '2', 'no' , 'nowork'  , 'no' , 'yes', '0', '1', '0', '1', '0', '1', 'yes', '1', '0', '0', '0', 'Walking', 'I like chocolate', 'AS_NEW_MENTEE'),
		(16,19, 'Mentee10','Family10', 'male'  , '21000016', '25to30' , 'Hotel Mgm'	, 'Major2'				, 'tweed', 'Staff num1', '2', 'yes', 'casual'  , 'yes', 'no' , '1', '0', '1', '0', '1', '0', 'no' , '0', '1', '1', '1', 'Walking', 'I like ice cream', 'AS_NEW_MENTEE');

insert into smp_contact values (1, 'Carina College, SCU, Hogbin Dr', 'Coffs Harbour', '2450', '025555555', '045555555', '045555555', 'jiya@gmail.com', 4,1);				
insert into smp_contact values (2, '48 Ameroo Street, Toormina    ', 'Toormina     ', '2452', '026666666', '046666666', '046666666', 'bruce@gmail.com', 7,3);				
insert into smp_contact values (3, 'Carina College, SCU, Hogbin Dr', 'Coffs Harbour', '2450', '027777777', '047777777', '047777777', 'james@gmail.com', 6,4);				
insert into smp_contact values (4, 'Carina College, SCU, Hogbin Dr', 'Coffs Harbour', '2450', '027777777', '048888888', '048888888', 'lucy@gmail.com', 5,2);				
insert into smp_contact values 
 (5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),				
 (6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),				
 (7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),				
 (8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),				
 (9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),				
 (10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),				
 (11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),				
 (12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),				
 (13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),				
 (14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),				
 (15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),				
 (16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);				

insert into smp_mentor values (1, 4, 1, 1, NULL, 0, 0, 0, 0);  
insert into smp_mentor values (2, 7, 3, 2, 1, 0, 0, 0, 0);
insert into smp_mentor values (3, 8, 5, 5, NULL, 0, 0, 0, 0);
insert into smp_mentor values (4, 9, 6, 6, NULL, 0, 0, 0, 0);
insert into smp_mentor values (5,10, 7, 7, NULL, 0, 0, 0, 0);
insert into smp_mentor values (6,11, 8, 8, NULL, 0, 0, 0, 0);
insert into smp_mentor values (7,12, 9, 9, NULL, 0, 0, 0, 0);
insert into smp_mentor values (8,13,10,10, NULL, 0, 0, 0, 0);

insert into smp_mentee values (1, 5, 2, 4, 0, 0);  
insert into smp_mentee values (2, 6, 4, 3, 0, 0);
insert into smp_mentee values (3,14,11,11, 0, 0);
insert into smp_mentee values (4,15,12,12, 0, 0);
insert into smp_mentee values (5,16,13,13, 0, 0);
insert into smp_mentee values (6,17,14,14, 0, 0);
insert into smp_mentee values (7,18,15,15, 0, 0);
insert into smp_mentee values (8,19,16,16, 0, 0);
