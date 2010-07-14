USE smp;

DROP TABLE IF EXISTS smp_user_role;
DROP TABLE IF EXISTS smp_user;
DROP TABLE IF EXISTS smp_role;
DROP TABLE IF EXISTS smp_log;

CREATE TABLE smp_log (
	id BIGINT NOT NULL AUTO_INCREMENT,
	time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	msg VARCHAR(255),
	title VARCHAR(50),
	user_id BIGINT,
	CONSTRAINT smp_fk_log_user FOREIGN KEY (user_id) REFERENCES smp_user(id) ON DELETE CASCADE,
	PRIMARY KEY(id)
);

CREATE TABLE smp_user (
	id BIGINT NOT NULL AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL UNIQUE,
	password VARCHAR(50) NOT NULL,
	scu_email VARCHAR(100) NOT NULL UNIQUE, 
	PRIMARY KEY(id)
);

CREATE TABLE smp_role(
	id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL UNIQUE,
	PRIMARY KEY(id)
);

CREATE TABLE smp_user_role(
	user_id BIGINT,
	role_id INT(11),
	CONSTRAINT smp_fk_user_role FOREIGN KEY (user_id) REFERENCES smp_user(id) ON DELETE CASCADE,
	CONSTRAINT smp_fk_role_user FOREIGN KEY (role_id) REFERENCES smp_role(id) ON DELETE CASCADE,
	PRIMARY KEY(user_id, role_id)
);

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
