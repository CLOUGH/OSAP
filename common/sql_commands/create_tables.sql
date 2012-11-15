 #create table for the database
 #create course table
CREATE TABLE course
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

    title VARCHAR(30) NOT NULL,
    subject VARCHAR(30) NOT NULL,
    type VARCHAR(30) NOT NULL,
    code VARCHAR(10) NOT NULL,
    faculty VARCHAR(30) NOT NULL,
    simester INT NOT NULL,
    level INT NOT NULL,
    credit INT NOT NULL,
    description VARCHAR(500)
);
CREATE TABLE schedule
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	crn INT NOT NULL UNIQUE,
	course_id INT NOT NULL,
	day VARCHAR(10),
	time TIME NOT NULL,
	room VARCHAR(30) NOT NULL,
	capacity INT,
	type VARCHAR(30) NOT NULL
);
CREATE TABLE lecturer
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	lecturer_name VARCHAR(30),
	email VARCHAR(30)
);
#mapping table that maps a lecturer to a schedule
CREATE TABLE lecture_map
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	schedule_id INT NOT NULL,
	lecturer_id	INT NOT NULL
);


 CREATE TABLE prerequisite
 (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	course_title VARCHAR(30) NOT NULL,
	grade VARCHAR(10) NOT NULL
 );

 # Create a user table for the system
 CREATE TABLE users
 (
 	id INT NOT NULL PRIMARY KEY,
 	user_name VARCHAR(20),
 	password VARCHAR(20) NOT NULL,
 	email VARCHAR(30) NOT NULL
 );
 CREATE TABLE comments
 (
 	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 	course_id INT NOT NULL,
 	title VARCHAR(30),
 	comment VARCHAR(500) NOT NULL,
 	commenters_name VARCHAR(20),
 	time TIME NOT NULL,
 	date DATE NOT NULL
 );
 CREATE TABLE course_requirements
 (
 	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 	course_id INT NOT NULL,
 	labs INT NOT NULL,
 	lectures INT NOT NULL,
 	tutorial INT NOT NULL
 );
