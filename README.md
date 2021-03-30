# Employee System Demo

Realistic data generated for the demo is included in data.csv, must be placed under mysql/data/employee_db/


MYSQL Queries to enter manually:

			CREATE database employee_db;

			USE employee_db;

			CREATE TABLE persons (
			id int UNSIGNED  PRIMARY KEY AUTO_INCREMENT,
			fname VARCHAR(30) NOT NULL,
			mname VARCHAR(30),
			lname VARCHAR(30) NOT NULL,
			email VARCHAR(50) NOT NULL,
			phone VARCHAR(50),
			hiredate VARCHAR(50) NOT NULL
			)AUTO_INCREMENT=1000;

			LOAD DATA INFILE 'data.csv' 
			INTO TABLE persons 
			FIELDS TERMINATED BY ',' 
			ENCLOSED BY '"'
			LINES TERMINATED BY '\n'
			IGNORE 1 ROWS;
