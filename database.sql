create table user_types(
	id int(3) primary key AUTO_INCREMENT,
	user_type varchar(50),
	created_on TIMESTAMP NULL DEFAULT NULL,
	modified_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


create table users(
	id int(3) primary key AUTO_INCREMENT,
	firstname varchar(50),
	lastname varchar(50),
	password varchar(50),
	random_no varchar(10),
	gender varchar(6),
	email_id varchar(25),
	address varchar(50),
	country varchar(50),
	state varchar(50),
	city varchar(50),
	zip_code int(6),
	biography text,
	user_type_id int(3),
	created_on TIMESTAMP NULL DEFAULT NULL,
	modified_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (user_type_id) REFERENCES user_types(id)
);
