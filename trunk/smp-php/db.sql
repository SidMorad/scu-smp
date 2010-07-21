CREATE DATABASE IF NOT EXISTS smp;
USE smp;

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
	is_trained BOOLEAN,
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

insert into smp_role values(1, 'ROLE_ADMIN');
insert into smp_role values(2, 'ROLE_MANAGER');
insert into smp_role values(3, 'ROLE_COORDINATOR');
insert into smp_role values(4, 'ROLE_MENTOR');
insert into smp_role values(5, 'ROLE_MENTEE');
insert into smp_user values(1, 'admin', 'admin', 'earl.whittaker@scu.edu.au');
insert into smp_user values(2, 'manager', 'manager', 'rob.cumings@scu.edu.au');
insert into smp_user values(3, 'coordinator', 'coordinator', 'jo.mason@scu.edu.au');
insert into smp_user values(4, 'mentor', 'mentor', 'b.kaur.10@scu.edu.au');
insert into smp_user values(5, 'mentee', 'mentee', 's.li.24@scu.edu.au');
insert into smp_user_role (user_id, role_id) values(1,1);
insert into smp_user_role (user_id, role_id) values(2,2);
insert into smp_user_role (user_id, role_id) values(3,3);
insert into smp_user_role (user_id, role_id) values(4,4);
insert into smp_user_role (user_id, role_id) values(5,5);
