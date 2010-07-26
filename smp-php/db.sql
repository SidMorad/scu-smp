CREATE DATABASE IF NOT EXISTS smp;
USE smp;

DROP TABLE IF EXISTS smp_mentor_mentee;
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
	student_number VARCHAR(10),
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
	email VARCHAR(100),
	user_id BIGINT,
	student_id BIGINT,
	CONSTRAINT smp_fk_contact_user FOREIGN KEY (user_id) REFERENCES smp_user(id) ON DELETE CASCADE,
	CONSTRAINT smp_fk_contact_student FOREIGN KEY (student_id) REFERENCES smp_student(id) ON DELETE CASCADE,
	PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE smp_mentor_mentee (
	mentor_id BIGINT,
	mentee_id BIGINT,
	expired BOOLEAN,
	CONSTRAINT smp_fk_mentor_student FOREIGN KEY (mentor_id) REFERENCES smp_student(id) ON DELETE CASCADE,
	CONSTRAINT smp_fk_mentee_student FOREIGN KEY (mentee_id) REFERENCES smp_student(id) ON DELETE CASCADE,
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
insert into smp_user values(6, 'james', 'james', 'j.li.24@scu.edu.au');
insert into smp_user values(7, 'bruce', 'bruce', 'l.li.24@scu.edu.au');
insert into smp_user_role (user_id, role_id) values(1,1);
insert into smp_user_role (user_id, role_id) values(2,2);
insert into smp_user_role (user_id, role_id) values(3,3);
insert into smp_user_role (user_id, role_id) values(4,4);
insert into smp_user_role (user_id, role_id) values(5,5);

insert into smp_student (id, user_id, firstname, lastname, gender, student_number, age_range, course, major, study_mode, recommended_by_staff
						,semesters_completed,family_status, work_status, tertiary_study_status,is_first_year, is_international, is_disability, is_indigenous
						,is_non_english,is_regional,is_socioeconomic,prefer_gender,prefer_australian,prefer_distance,prefer_international,prefer_on_campus,interests,comments, account_status)
		values (1, 4, 'Jiya', 'Khangura', 'female', '21555555', 'under25', 'IT', 'Multimedia', 'coffs', 'Paul Woods'
				,'3', 'no', 'parttime', 'no', 'yes', '1', '0', '0'
				,'1', '0', '0', 'yes', '1', '0', '1', '1', 'Reading', 'No Commnets left', 'AS_NEW_MENTOR'),
			   (2, 7, 'Bruce', 'Li', 'male', '21666666', 'under25', 'IT', 'Multimedia', 'coffs', 'Paul Woods'
				,'3', 'no', 'parttime', 'no', 'yes', '1', '0', '0'
				,'1', '0', '0', 'yes', '1', '0', '1', '1', 'Reading', 'No Commnets left', 'AS_NEW_MENTOR'),
			   (3, 6, 'James', 'Gleeson', 'male', '21777777', 'under25', 'IT', 'Software Development', 'coffs', 'Paul Woods'
				,'3', 'no', 'parttime', 'no', 'yes', '0', '0', '0'
				,'1', '0', '0', 'yes', '1', '0', '1', '1', 'Reading', 'No Commnets left', 'AS_NEW_MENTEE'),
			   (4, 5, 'Lucy', 'Zhang', 'female', '21888888', 'under25', 'IT', 'Software Development', 'coffs', 'Paul Woods'
				,'3', 'no', 'parttime', 'no', 'yes', '1', '0', '0'
				,'1', '0', '0', 'yes', '1', '0', '1', '1', 'Reading', 'No Commnets left', 'AS_NEW_MENTEE');

insert into smp_contact values (1, 'One Street', 'Coffs Harbour', '2450', '025555555', '045555555', 'jiya@gmail.com', 4,1);				
insert into smp_contact values (2, 'Two Street', 'Coffs Harbour', '2450', '026666666', '046666666', 'bruce@gmail.com', 7,2);				
insert into smp_contact values (3, 'Three Street', 'Coffs Harbour', '2450', '027777777', '047777777', 'james@gmail.com', 6,3);				
insert into smp_contact values (4, 'Four Street', 'Coffs Harbour', '2450', '027777777', '048888888', 'lucy@gmail.com', 5,4);				
				