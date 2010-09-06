CREATE DATABASE IF NOT EXISTS smp;
USE smp;

DROP TABLE IF EXISTS smp_mentor_mentee;
DROP TABLE IF EXISTS smp_mentee;
DROP TABLE IF EXISTS smp_mentor;
DROP TABLE IF EXISTS smp_contact;
DROP TABLE IF EXISTS smp_student;
DROP TABLE IF EXISTS smp_course;
DROP TABLE IF EXISTS smp_user_role;
DROP TABLE IF EXISTS smp_log;
DROP TABLE IF EXISTS smp_user;
DROP TABLE IF EXISTS smp_role;

CREATE TABLE smp_user (
	id BIGINT NOT NULL AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL UNIQUE,
	password VARCHAR(50) NOT NULL,
	scu_email VARCHAR(100) NOT NULL UNIQUE,
	picture VARCHAR(100),
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

CREATE TABLE smp_course (
	id BIGINT NOT NULL AUTO_INCREMENT,
	name VARCHAR(100),
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE smp_student (
	id BIGINT NOT NULL AUTO_INCREMENT,
	firstname VARCHAR(100),
	lastname VARCHAR(100),
	gender VARCHAR(20),
	student_number VARCHAR(10) UNIQUE,
	age_range VARCHAR(20),
	course_id BIGINT,
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
	CONSTRAINT smp_fk_student_course FOREIGN KEY (course_id) REFERENCES smp_course(id) ON DELETE CASCADE,
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
	id BIGINT NOT NULL AUTO_INCREMENT,
	mentor_id BIGINT,
	mentee_id BIGINT,
	create_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	mentor_contact_confirm BOOLEAN DEFAULT FALSE,
	mentor_contact_confirm_time TIMESTAMP NULL,	
	expired BOOLEAN DEFAULT FALSE,
	CONSTRAINT smp_fk_mm_mentor FOREIGN KEY (mentor_id) REFERENCES smp_mentor(id) ON DELETE CASCADE,
	CONSTRAINT smp_fk_mm_mentee FOREIGN KEY (mentee_id) REFERENCES smp_mentee(id) ON DELETE CASCADE,
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

insert into smp_role values(1, 'ROLE_ADMIN');
insert into smp_role values(2, 'ROLE_MANAGER');
insert into smp_role values(3, 'ROLE_COORDINATOR');
insert into smp_role values(4, 'ROLE_MENTOR');
insert into smp_role values(5, 'ROLE_MENTEE');
insert into smp_user (id, username, password, scu_email) values
	(1, 'admin'		, '21232f297a57a5a743894a0e4a801fc3', 'earl.whittaker@scu.edu.au'),
	(2, 'rob'		, '760061f6bfde75c29af12f252d4d3345', 'rob.cumings@scu.edu.au'),
	(3, 'jo'		, '674f33841e2309ffdd24c85dc3b999de', 'jo.mason@scu.edu.au'),
	(4, 'jiya'		, '23a52ee24d66e9a72ec506cd9db39057', 'b.kaur.10@scu.edu.au'),
	(5, 'lucy'		, 'ecfb2ca9428299f31f0bbb9b5ea28dc3', 'l.zhang.12@scu.edu.au'),
	(6, 'james'		, 'b4cc344d25a2efe540adbf2678e2304c', 'j.glees.24@scu.edu.au'),
	(7, 'bruce'		, 'e8315caa4eb8c2a2625d4e97dbba100a', 's.li.24@scu.edu.au'),
	(8, 'mentor5'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor5@scu.edu.au'),
	(9, 'mentor6'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor6@scu.edu.au'),
	(10,'mentor7'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor7@scu.edu.au'),
	(11,'mentor8'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor8@scu.edu.au'),
	(12,'mentor9'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor9@scu.edu.au'),
	(13,'mentor10'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor10@scu.edu.au'),
	(14,'mentee5'	, '4c0d07eab2ce912d12db2375f69d5152', 'mentee5@scu.edu.au'),
	(15,'mentee6'	, '4c0d07eab2ce912d12db2375f69d5152', 'mentee6@scu.edu.au'),
	(16,'mentee7'	, '4c0d07eab2ce912d12db2375f69d5152', 'mentee7@scu.edu.au'),
	(17,'mentee8'	, '4c0d07eab2ce912d12db2375f69d5152', 'mentee8@scu.edu.au'),
	(18,'mentee9'	, '4c0d07eab2ce912d12db2375f69d5152', 'mentee9@scu.edu.au'),
	(19,'mentee10'	, '4c0d07eab2ce912d12db2375f69d5152', 'mentee10@scu.edu.au'),
	(20,'mentor11'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor11@scu.edu.au'),
	(21,'mentor12'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor12@scu.edu.au'),
	(22,'mentor13'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor13@scu.edu.au'),
	(23,'mentor14'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor14@scu.edu.au'),
	(24,'mentor15'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor15@scu.edu.au'),
	(25,'mentor16'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor16@scu.edu.au'),
	(26,'mentor17'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor17@scu.edu.au'),
	(27,'mentor18'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor18@scu.edu.au'),
	(28,'mentor19'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor19@scu.edu.au'),
	(29,'mentor20'	, '23cbeacdea458e9ced9807d6cbe2f4d6', 'mentor20@scu.edu.au');
insert into smp_user_role (user_id, role_id) values(1,1),
	(2,2),(3,3),(4,4),(5,5),(6,5),
	(7,4),(8,4),(9,4),(10,4),(11,4),(12,4),(13,4),
	(14,5),(15,5),(16,5),(17,5),(18,5),(19,5),
	(20,5),(21,5),(22,5),(23,5),(24,5),(25,5),(26,5),(27,5),(28,5),(29,5);

insert into smp_course (name) values 
	('Ageing In The Community'),
	('Applied Computing'),
	('Applied Science (Forestry)'),
	('Arts'),
	('Arts / Educ'),
	('Arts / Laws'),
	('Assoc Degree of Info Tech'),
	('Assoc Degree in Law'),
	('Behavioural Science '),
	('Business'),
	('Business Admin'),
	('Business / Arts'),
	('Business / Laws'),
	('Clinical Sciences'),
	('Contemp Music'),
	('Contemp Music / Educ'),
	('Contemp Music / Laws'),
	('Convention & Event Mgt'),
	('Education / Early Childhood'),
	('Education / Primary'),
	('Education / Secondary'),
	('Education / Technology'),
	('Enviro Science'),
	('Enviro Science / Laws'),
	('Enviro Tourism Mgt'),
	('Exercise Science & Nutrition'),
	('Hotel & Resort Mgt'),
	('Indigenous Studies'),
	('Indigenous Studies (T & H)'),
	('Indigenous Studies / Laws'),
	('Info Tech'),
	('International Tourism Mgt'),
	('Laws'),
	('Legal & Justice Studies'),
	('Legal & Justice Studies / Laws'),
	('Mgt & Prof Studies'),
	('Marine Science & Mgt'),
	('Media'),
	('Multimedia'),
	('Naturopathy'),
	('Nursing'),
	('Occupational Therapy'),
	('Psychology'),
	('Science / Educ'),
	('Social Science'),
	('Social Science / Laws'),
	('Sport & Exercise Science'),
	('Sport & Exercise Science / Educ'),
	('Sport & Exercise Sci / Laws'),
	('Sport Tourism Mgt'),
	('Tourism Mgt'),
	('Tourism Mgt / Laws'),
	('Visual Arts'),
	('Visual Arts / Educ'),
	('Doctor of Business Mgt'),
	('Master of Business Admin'),
	('Master of Bus Admin (Hotel & Tour Mgt)'),
	('Master of Convention & Event Mgt'),
	('Master of Environmental Science'),
	('Master of Professional Accounting'),
	('Master of Public Health'),
	('Master of Supply Chain Mgt'),
	('Master of Technology Mgt'),
	('Master of Tourism & Hotel Mgt');


insert into smp_student (id, user_id, firstname, lastname, gender, student_number, age_range, course_id, major, study_mode, recommended_by_staff, semesters_completed, family_status, work_status, tertiary_study_status,is_first_year, is_international, is_disability, 
	is_indigenous,is_non_english,is_regional,is_socioeconomic,prefer_gender,prefer_australian,prefer_distance,prefer_international,prefer_on_campus,interests,comments,account_status)
values 	
		(1, 4 , 'Jiya' 	 	, 'Khangura', 'f', '21555555', 'under25', 31, 'Multimedia'	, 'coffs', 'Paul Woods', '4', 'no' 	, 'parttime', 'no' , 'no' , '1', '0', '0', '1', '0', '0', 'no' , '0', '1', '1', '1', 'Reading', 'No Commnets left', 'AS_NEW_MENTOR'),
		(2, 5 , 'Lucy' 	 	, 'Zhang'   , 'f', '21888888', 'under25', 31, 'Software '	, 'coffs', 'Paul Woods', '0', 'no' 	, 'parttime', 'no' , 'no' , '0', '0', '0', '1', '1', '0', 'no' , '1', '0', '1', '1', 'Reading', 'No Commnets left', 'AS_NEW_MENTEE'),
		(3, 7 , 'Bruce'  	, 'Li'      , 'm', '21666666', 'under25', 31, 'Multimedia'	, 'coffs', 'Paul Woods', '4', 'no' 	, 'parttime', 'no' , 'no' , '1', '0', '0', '1', '0', '0', 'no' , '1', '0', '1', '1', 'Reading', 'No Commnets left', 'AS_NEW_MENTOR'),
		(4, 6 , 'James'	 	, 'Gleeson' , 'm', '21777777', 'under25', 31, 'Software '	, 'coffs', 'Paul Woods', '1', 'no' 	, 'parttime', 'no' , 'no' , '0', '0', '0', '0', '1', '0', 'no' , '0', '1', '1', '1', 'Reading', 'No Commnets left', 'AS_NEW_MENTEE'),
		(5, 8 , 'Mentor5'	, 'Family5' , 'f', '21000005', 'under25', 41, 'Major1'		, 'coffs', 'Paul Woods', '2', 'no' 	, 'nowork'  , 'no' , 'yes', '0', '1', '0', '1', '0', '1', 'yes', '1', '0', '0', '0', 'Walking', 'I like chocolate', 'AS_NEW_MENTOR'),
		(6, 9 , 'Mentor6'	, 'Family6' , 'm', '21000006', '25to30' , 41, 'Major2'		, 'tweed', 'Staff num1', '2', 'yes'	, 'casual'  , 'yes', 'no' , '1', '0', '1', '0', '1', '0', 'no' , '0', '1', '1', '1', 'Walking', 'I like ice cream', 'AS_NEW_MENTOR'),
		(7, 10, 'Mentor7'	, 'Family7' , 'f', '21000007', '30to40' , 41, 'Major1'		, 'coffs', 'Paul Woods', '2', 'no' 	, 'nowork'  , 'no' , 'yes', '0', '1', '0', '1', '0', '1', 'yes', '1', '0', '0', '0', 'Walking', 'I like chocolate', 'AS_NEW_MENTOR'),
		(8, 11, 'Mentor8'	, 'Family8' , 'm', '21000008', '25to30' , 51, 'Major2'		, 'tweed', 'Staff num1', '2', 'yes'	, 'casual'  , 'yes', 'no' , '1', '0', '1', '0', '1', '0', 'no' , '0', '1', '1', '1', 'Walking', 'I like ice cream', 'AS_NEW_MENTOR'),
		(9, 12, 'Mentor9'	, 'Family9' , 'f', '21000009', '30to40' , 51, 'Major1'		, 'coffs', 'Paul Woods', '2', 'no' 	, 'nowork'  , 'no' , 'yes', '0', '1', '0', '1', '0', '1', 'yes', '1', '0', '0', '0', 'Walking', 'I like chocolate', 'AS_NEW_MENTOR'),
		(10,13, 'Mentor10'	, 'Family10', 'm', '21000010', '25to30' , 51, 'Major2'		, 'tweed', 'Staff num1', '2', 'yes'	, 'casual'  , 'yes', 'no' , '1', '0', '1', '0', '1', '0', 'no' , '0', '1', '1', '1', 'Walking', 'I like ice cream', 'AS_NEW_MENTOR'),
		(11,14, 'Mentee5'	, 'Family5' , 'f', '21000011', 'under25', 41, 'Major1'		, 'coffs', 'Paul Woods', '2', 'no' 	, 'nowork'  , 'no' , 'yes', '0', '1', '0', '1', '0', '1', 'yes', '1', '0', '0', '0', 'Walking', 'I like chocolate', 'AS_NEW_MENTEE'),
		(12,15, 'Mentee6'	, 'Family6' , 'm', '21000012', 'under25', 41, 'Major2'		, 'tweed', 'Staff num1', '2', 'yes'	, 'casual'  , 'yes', 'no' , '1', '0', '1', '0', '1', '0', 'no' , '0', '1', '1', '1', 'Walking', 'I like ice cream', 'AS_NEW_MENTEE'),
		(13,16, 'Mentee7'	, 'Family7' , 'f', '21000013', '30to40' , 41, 'Major1'		, 'coffs', 'Paul Woods', '2', 'no' 	, 'nowork'  , 'no' , 'yes', '0', '1', '0', '1', '0', '1', 'yes', '1', '0', '0', '0', 'Walking', 'I like chocolate', 'AS_NEW_MENTEE'),
		(14,17, 'Mentee8'	, 'Family8' , 'm', '21000014', '25to30' , 51, 'Major2'		, 'tweed', 'Staff num1', '2', 'yes'	, 'casual'  , 'yes', 'no' , '1', '0', '1', '0', '1', '0', 'no' , '0', '1', '1', '1', 'Walking', 'I like ice cream', 'AS_NEW_MENTEE'),
		(15,18, 'Mentee9'	, 'Family9' , 'f', '21000015', 'under25', 51, 'Major1'		, 'coffs', 'Paul Woods', '2', 'no' 	, 'nowork'  , 'no' , 'yes', '0', '1', '0', '1', '0', '1', 'yes', '1', '0', '0', '0', 'Walking', 'I like chocolate', 'AS_NEW_MENTEE'),
		(16,19, 'Mentee10'	, 'Family10', 'm', '21000016', 'under25' , 51, 'Major2'		, 'tweed', 'Staff num1', '2', 'no'	, 'casual'  , 'yes', 'no' , '0', '0', '1', '0', '1', '0', 'no' , '0', '1', '1', '1', 'Walking', 'I like ice cream', 'AS_NEW_MENTEE'),
		(17,20, 'Mentor11'	, 'Family11', 'm', '21000017', 'under25', 31, 'Info Sys'	, 'coffs', 'Barry Wilks','3', 'no'	, 'nowork'  , 'no' , 'no' , '1', '0', '0', '1', '0', '0', 'no' , '0', '1', '1', '1', 'Running', 'I like Badminton', 'AS_NEW_MENTOR'),
		(18,21, 'Mentor12'	, 'Family12', 'm', '21000018', 'under25', 31, 'Software'	, 'coffs', 'Barry Wilks','2', 'no'	, 'nowork'  , 'no' , 'no' , '1', '0', '0', '0', '0', '0', 'no' , '0', '1', '1', '1', 'Running', 'I like Badminton', 'AS_NEW_MENTOR'),
		(19,22, 'Mentor13'	, 'Family13', 'f', '21000019', 'under25', 31, 'Multimudia'	, 'coffs', 'Barry Wilks','3', 'no'	, 'nowork'  , 'no' , 'no' , '1', '0', '0', '1', '0', '0', 'no' , '0', '1', '1', '1', 'Running', 'I like Badminton', 'AS_NEW_MENTOR'),
		(20,23, 'Mentor14'	, 'Family14', 'f', '21000020', 'under25', 31, 'Info Sys'	, 'coffs', 'Barry Wilks','2', 'no'	, 'nowork'  , 'no' , 'no' , '1', '0', '0', '0', '0', '0', 'no' , '0', '1', '1', '1', 'Running', 'I like Badminton', 'AS_NEW_MENTOR'),
		(21,24, 'Mentor15'	, 'Family15', 'm', '21000021', 'under25', 41, 'Major 1'		, 'tweed', 'Staff num1', '4', 'no'	, 'nowork'  , 'no' , 'no' , '1', '0', '0', '1', '0', '0', 'no' , '1', '0', '1', '1', 'Singing', 'I like pop music', 'AS_NEW_MENTOR'),
		(22,25, 'Mentor16'	, 'Family16', 'f', '21000022', 'under25', 41, 'Major 2'		, 'tweed', 'Staff num1', '4', 'no'	, 'nowork'  , 'no' , 'no' , '1', '0', '0', '0', '0', '0', 'no' , '0', '1', '1', '1', 'Singing', 'I like pop music', 'AS_NEW_MENTOR'),
		(23,26, 'Mentor17'	, 'Family17', 'm', '21000023', 'under25', 41, 'Major 3'		, 'tweed', 'Staff num1', '4', 'no'	, 'nowork'  , 'no' , 'no' , '1', '0', '0', '1', '0', '0', 'no' , '1', '0', '1', '1', 'Singing', 'I like pop music', 'AS_NEW_MENTOR'),
		(24,27, 'Mentor18'	, 'Family18', 'f', '21000024', 'under25', 51, 'Major 1'		, 'coffs', 'Paul Woods', '5', 'no'	, 'nowork'  , 'no' , 'no' , '1', '0', '1', '0', '0', '0', 'no' , '0', '1', '1', '1', 'Wiritng', 'I like read poem', 'AS_NEW_MENTOR'),
		(25,28, 'Mentor19'	, 'Family19', 'm', '21000025', 'under25', 51, 'Major 2'		, 'coffs', 'Paul Woods', '5', 'no'	, 'nowork'  , 'no' , 'no' , '1', '0', '1', '0', '0', '0', 'no' , '0', '0', '1', '1', 'Wiritng', 'I like read poem', 'AS_NEW_MENTOR'),
		(26,29, 'Mentor20'	, 'Family20', 'f', '21000026', 'under25', 51, 'Major 3'		, 'coffs', 'Paul Woods', '5', 'no'	, 'nowork'  , 'no' , 'no' , '1', '0', '1', '0', '0', '0', 'no' , '0', '1', '1', '1', 'Wiritng', 'I like read poem', 'AS_NEW_MENTOR');

insert into smp_contact values (1, 'Carina College, SCU, Hogbin Dr', 'Coffs Harbour', '2450', '025555555', '045555555', '045555555', 'jiya@gmail.com', 4,1);				
insert into smp_contact values (2, '48 Ameroo Street, Toormina    ', 'Toormina     ', '2452', '026666666', '046666666', '046666666', 'bruce@gmail.com', 7,3);				
insert into smp_contact values (3, 'Carina College, SCU, Hogbin Dr', 'Coffs Harbour', '2450', '027777777', '047777777', '047777777', 'james@gmail.com', 6,4);				
insert into smp_contact values (4, 'Carina College, SCU, Hogbin Dr', 'Coffs Harbour', '2450', '027777777', '048888888', '048888888', 'lucy@gmail.com', 5,2);				
insert into smp_contact values 
 (5, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 8, 5),				
 (6, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 9, 6),				
 (7, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 10, 7),				
 (8, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 11, 8),				
 (9, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 12, 9),				
 (10, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 13, 10),				
 (11, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 14, 11),				
 (12, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 15, 12),				
 (13, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 16, 13),				
 (14, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 17, 14),				
 (15, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 18, 15),				
 (16, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 19, 16),				
 (17, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 20, 17),				
 (18, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 21, 18),				
 (19, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 22, 19),				
 (20, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 23, 20),				
 (21, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 24, 21),				
 (22, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 25, 22),				
 (23, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 26, 23),				
 (24, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 27, 24),				
 (25, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 28, 25),				
 (26, '101 Street', 'City', '2450', '021111111', '0233333333', '041111111', 'foo@bar.com', 29, 26);				

insert into smp_mentor (id, user_id, student_id, contact_id, mentee_limit, trained, matched, expired) values 
	(1,  4, 1, 1, NULL, 0, 0, 0),  
	(2,  7, 3, 2, 1   , 0, 0, 0),
	(3,  8, 5, 5, NULL, 0, 0, 0),
	(4,  9, 6, 6, NULL, 0, 0, 0),
	(5, 10, 7, 7, NULL, 0, 0, 0),
	(6, 11, 8, 8, NULL, 0, 0, 0),
	(7, 12, 9, 9, NULL, 0, 0, 0),
	(8, 13,10,10, NULL, 0, 0, 0),
	(9, 20,17,17, NULL, 0, 0, 0),
	(10,21,18,18, NULL, 0, 0, 0),
	(11,22,19,19, NULL, 0, 0, 0),
	(12,23,20,20, NULL, 0, 0, 0),
	(13,24,21,21, NULL, 0, 0, 0),
	(14,25,22,22, NULL, 0, 0, 0),
	(15,26,23,23, NULL, 0, 0, 0),
	(16,27,24,24, NULL, 0, 0, 0),
	(17,28,25,25, NULL, 0, 0, 0),
	(18,29,26,26, NULL, 0, 0, 0);

insert into smp_mentee (id, user_id, student_id, contact_id, matched, expired) values 
	(1, 5, 2, 4, 0, 0),
	(2, 6, 4, 3, 0, 0),
	(3,14,11,11, 0, 0),
	(4,15,12,12, 0, 0),
	(5,16,13,13, 0, 0),
	(6,17,14,14, 0, 0),
	(7,18,15,15, 0, 0),
	(8,19,16,16, 0, 0);
