CREATE TABLE login_logs (
    login_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(255),
    fullname VARCHAR(255),
    role VARCHAR(10),
    position VARCHAR(10),
    loginTime timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    logoutTime timestamp  NULL DEFAULT NULL
);
CREATE TABLE userActivity (
    activity_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(255),
    fullname VARCHAR(255),
    role VARCHAR(10),
    type_of_activity VARCHAR(255),
    activity_time timestamp  NULL DEFAULT NULL
);


DROP TABLE IF EXISTS `faculties`;
CREATE TABLE IF NOT EXISTS `faculties` (
  `fac_id` int(11) NOT NULL AUTO_INCREMENT,
  `fac_title` varchar(255) NOT NULL,
  PRIMARY KEY (`fac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- //!  CLEARANCE TABLE

CREATE TABLE clearance (
    clr_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    std_fullname VARCHAR(255),
    std_regNo varchar(50) NOT NULL,
    faculty varchar(50) NOT NULL,
    department varchar(100) NOT NULL,
    levels varchar(50) NOT NULL,
    programs varchar(255) NOT NULL,
    specialization varchar(100) NOT NULL,
    years int(2) NOT NULL,
    mode_of_study varchar(10) NOT NULL,
    campus varchar(10) NOT NULL,
    reason_for_clearance varchar(255) NULL,
    other_reasons varchar(255) NULL,
 
    date_of_submission date NOT NULL
);

--//! HOD CLEARANCE REQUEST TABLE
CREATE TABLE hod_clearance_request(
  hod_req_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  clr_id int(11),
  std_fullnames varchar(200) NOT NULL,
  std_regNo varchar(50) NOT NULL,
  stdStatus ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending' NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
--//! Librarian CLEARANCE REQUEST TABLE
CREATE TABLE library_clearance_request(
  lib_req_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
   clr_id int(11),
  std_fullnames varchar(200) NOT NULL,
  std_regNo varchar(50) NOT NULL,
  stdStatus ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending' NOT NULL,
    emp_fullname varchar(150)  NULL,

  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
--//! DEAN CLEARANCE REQUEST TABLE
CREATE TABLE dean_clearance_request(
  dean_req_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
   clr_id int(11),
  std_fullnames varchar(200) NOT NULL,
  std_regNo varchar(50) NOT NULL,
  stdStatus ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending' NOT NULL,
  emp_fullname varchar(150)  NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
--//! Registrar CLEARANCE REQUEST TABLE
CREATE TABLE reg_clearance_request(
  reg_req_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
   clr_id int(11),
  std_fullnames varchar(200) NOT NULL,
  std_regNo varchar(50) NOT NULL,
  stdStatus ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending' NOT NULL,
    emp_fullname varchar(150)  NULL,

  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
--//! Finance CLEARANCE REQUEST TABLE
CREATE TABLE fin_clearance_request(
  fin_req_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
   clr_id int(11),
  std_fullnames varchar(200) NOT NULL,
  std_regNo varchar(50) NOT NULL,
  stdStatus ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending' NOT NULL,
    emp_fullname varchar(150)  NULL,

  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- //!  STUDENTS TABLE

CREATE TABLE students (
    std_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    std_regNo varchar(50) NOT NULL UNIQUE,
    std_fullname VARCHAR(255),
    faculty varchar(50) NOT NULL,
    department varchar(100) NOT NULL,
    levels varchar(50) NOT NULL,
    programs varchar(255) NOT NULL,
    specialization varchar(100) NOT NULL,
    mode_of_study varchar(10) NOT NULL,
    years int(11) NOT NULL,
    gender varchar(5) NOT NUll,
    email varchar(50) NOT NULL UNIQUE,
    phone int(11) NOT NULL,
    std_address varchar(50) NOT NULL,
    date_created date NOT NULL,
    role ENUM('student', 'employee', 'admin') NOT NULL,
    trancript blob NULL,
    fee_statement blob NULL
);
INSERT INTO students(std_regNo, std_fullname,faculty,department,levels,programs,specialization,mode_of_study,years, gender, email, phone, std_address, date_created, role)
VALUES (1020276,'John Doe','Faculty of Science','Department of Computer and Information Science','Bachelor','Bachelor of Science in Computer Science','Not applicable','Day',4,'Male','john@gmail.com','0700000000','Ngong Road','2022-01-25','student');
-- //!  EMPLOYEES TABLE
CREATE TABLE employees (
    emp_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    emp_number varchar(50) NOT NULL UNIQUE,
    emp_fullname VARCHAR(255) NOT NULL,
    faculty varchar(50) NOT NULL,
    department varchar(100) NOT NULL,
    position varchar(50) NOT NULL,
    gender varchar(5) NOT NUll,
    email varchar(50) NOT NULL UNIQUE,
    phone varchar(11) NOT NULL,
    emp_address varchar(50) NOT NULL,
    date_created date NOT NULL,
    role ENUM('student', 'employee', 'admin') NOT NULL

);
INSERT INTO employees(emp_number, emp_fullname,faculty,department,position, gender, email, phone, emp_address, date_created, role)
VALUES (20001,'Jimmy Peter','Faculty of Science','Department of Computer and Information Science','HOD','Male','jim@gmail.com','0700000000','Ngong Road','2022-01-25','employee');

-- //!  ADMIN TABLE
CREATE TABLE admin (
    admin_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    admin_number varchar(50) NOT NULL UNIQUE,
    admin_fullname VARCHAR(255) NOT NULL,
    gender varchar(5) NOT NUll,
    email varchar(50) NOT NULL UNIQUE,
    phone varchar(11) NOT NULL,
    admin_address varchar(50) NOT NULL ,
    date_created date NOT NULL,
    role ENUM('student', 'employee', 'admin') NOT NULL

);
INSERT INTO admin(admin_number, admin_fullname, gender, email, phone, admin_address, date_created, role)
VALUES (10001,'Kejgon James','Male','kejgon@gmail.com','0700000000','Ngong Road','2022-01-25','admin');



CREATE TABLE somethi (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'employee', 'admin') NOT NULL
);
INSERT INTO students(
  std_regNo,
  std_fullname,
  faculty,
  department,
  levels,
  programs,
  specialization,
  mode_of_study,
  years,
  gender,
  email,
  phone,
  std_address,
  date_created) 
VALUES (
  '[value-1]',
  '[value-2]',
  '[value-3]',
  '[value-4]',
  '[value-5]',
  '[value-6]',
  '[value-7]',
  '[value-8]',
  '[value-9]',
  '[value-10]',
  '[value-11]',
  '[value-12]',
  '[value-13]',
  '[value-14]',
  '[value-15]'
  );


---//! ADDING THE FOREIGN KEY
ALTER TABLE clearance
ADD FOREIGN KEY (std_regNo) REFERENCES students(std_regNo) 
ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE hod_clearance_request
ADD FOREIGN KEY (std_regNo) REFERENCES clearance(std_regNo) 
ON DELETE CASCADE ON UPDATE CASCADE;

--//! DROPING A FOREIGN KEY
ALTER TABLE clearance
DROP FOREIGN KEY fk_std_regNo;

--//! DELETING  DATA FROM A TABLE;
TRUNCATE TABLE clearance;


--//! FACULTY OF SCIENCE
INSERT INTO `students`(`std_regNo`, `std_fullname`, `faculty`, `department`, `levels`, `programs`, `specialization`, `mode_of_study`, `years`, `gender`, `email`, `phone`, `std_address`, `date_created`, `password`, `role`) 
VALUES 
('1037178','Collin Okoth Ochara','Faculty of Science','Department of Computer and Information Science','Bachelor','Bachelor of Science in Computer Science','not applicable','Day','4','Male','collin@gmail.com','0734244322','Nairobi','2023-02-03','Collin123,./','Student'),
('1046644','Dammaris Mwiyathi Mwasya','Faculty of Science','Department of Computer and Information Science','Bachelor','Bachelor of Science in Computer Science','not applicable','Day','4','Male','dammaris@gmail.com','0734244322','Nairobi','2023-02-03','Dammaris123,./','Student'),
('1037156','Matlida Adhiambo','Faculty of Science','Department of Computer and Information Science','Bachelor','Bachelor of Science in Computer Science','not applicable','Day','4','Female','matilda@gmail.com','0734244322','Nairobi','2023-02-03','Matilda123,./','Student'),
('1041949','Magoba Emmanuel','Faculty of Science','Department of Computer and Information Science','Bachelor','Bachelor of Science in Computer Science','not applicable','Day','4','Male','magoba@gmail.com','0734244322','Nairobi','2023-02-03','Magoba123,./','Student'),
('1039061','Alice Gilbert Nzioki','Faculty of Science','Department of Computer and Information Science','Bachelor','Bachelor of Science in Computer Science','not applicable','Day','4','Male','alice@gmail.com','0734244322','Nairobi','2023-02-03','Alice123,./','Student'),
('1043693','Teresa Achieng','Faculty of Science','Department of Computer and Information Science','Bachelor','Bachelor of Science in Computer Science','not applicable','Day','4','Female','teresa@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1041032','John Mangaa Kevin','Faculty of Science','Department of Computer and Information Science','Bachelor','Bachelor of Science in Computer Science','not applicable','Day','4','Male','johnm@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1042085','Gatugi Pierah','Faculty of Science','Department of Computer and Information Science','Bachelor','Bachelor of Science in Computer Science','not applicable','Day','4','Male','gatugi@gmail.com','0734244322','Nairobi','2023-02-03','Gatugi123,./','Student'),
('1041206','Emayot Amoit Caren','Faculty of Science','Department of Computer and Information Science','Bachelor','Bachelor of Science in Computer Science','not applicable','Day','4','Male','emayot@gmail.com','0734244322','Nairobi','2023-02-03','Emayot123,./','Student'),
('1040667','Naimodu Jackson Koileken','Faculty of Science','Department of Computer and Information Science','Bachelor','Bachelor of Science in Computer Science','not applicable','Day','4','Female','naimodu@gmail.com','0734244322','Nairobi','2023-02-03','Naimodu123,./','Student');


--//! FACULTY OF Arts & Social Science, department of economic
INSERT INTO `students`(`std_regNo`, `std_fullname`, `faculty`, `department`, `levels`, `programs`, `specialization`, `mode_of_study`, `years`, `gender`, `email`, `phone`, `std_address`, `date_created`, `password`, `role`) 
VALUES 
('1047178','Okoth Collin Ochara','Faculty of Arts & Social Science','Department of Economics','Bachelor','Bachelor of Commerce','not applicable','Day','4','Male','okoth@gmail.com','0734244322','Nairobi','2023-02-03','Okoth123,./','Student'),
('1036644','Mwiyathi Dammaris Mwasya','Faculty of Arts & Social Science','Department of Economics','Bachelor','Bachelor of Commerce','not applicable','Day','4','Male','mwiyathi@gmail.com','0734244322','Nairobi','2023-02-03','Mwiyathi123,./','Student'),
('1047156','Anne Adhiambo','Faculty of Arts & Social Science','Department of Economics','Bachelor','Bachelor of Commerce','not applicable','Day','4','Female','anne@gmail.com','0734244322','Nairobi','2023-02-03','Anne123,./','Student'),
('1031949','Emmanuel Magoba','Faculty of Arts & Social Science','Department of Economics','Bachelor','Bachelor of Commerce','not applicable','Day','4','Male','emmanuel@gmail.com','0734244322','Nairobi','2023-02-03','emmanuel123,./','Student'),
('1049061','Jane Gilbert Nzioki','Faculty of Arts & Social Science','Department of Economics','Bachelor','Bachelor of Commerce','not applicable','Day','4','Female','jane@gmail.com','0734244322','Nairobi','2023-02-03','Jane123,./','Student'),
('1033693','Sarah Achieng','Faculty of Arts & Social Science','Department of Economics','Bachelor','Bachelor of Commerce','not applicable','Day','4','Female','sarah@gmail.com','0734244322','Nairobi','2023-02-03','Sarah123,./','Student'),
('1031032','Kevin John Mangaa','Faculty of Arts & Social Science','Department of Economics','Bachelor','Bachelor of Commerce','not applicable','Day','4','Male','kevin@gmail.com','0734244322','Nairobi','2023-02-03','Kevin123,./','Student'),
('1032085','Pierah Gatugi','Faculty of Arts & Social Science','Department of Economics','Bachelor','Bachelor of Commerce','not applicable','Day','4','Male','pierah@gmail.com','0734244322','Nairobi','2023-02-03','Pierah123,./','Student'),
('1031206','Hannah Amoit Caren','Faculty of Arts & Social Science','Department of Economics','Bachelor','Bachelor of Commerce','not applicable','Day','4','Female','hannah@gmail.com','0734244322','Nairobi','2023-02-03','Hannah123,./','Student'),
('1030667','Jackson Naimodu Koileken','Faculty of Arts & Social Science','Department of Economics','Bachelor','Bachelor of Commerce','not applicable','Day','4','Male','jackson@gmail.com','0734244322','Nairobi','2023-02-03','Jackson123,./','Student');

--//! FACULTY Science, Department of Mathematics and Actuarial Science
INSERT INTO `students`(`std_regNo`, `std_fullname`, `faculty`, `department`, `levels`, `programs`, `specialization`, `mode_of_study`, `years`, `gender`, `email`, `phone`, `std_address`, `date_created`, `password`, `role`) 
VALUES 
('1137172','Ochara Collin Okoth','Faculty of Science','Department of Mathematics and Actuarial Science','Bachelor','Bachelor of Science in Mathematics','not applicable','Day','4','Male','collin1@gmail.com','0734244322','Nairobi','2023-02-03','Collin123,./','Student'),
('1246642','Mwasya Dammaris Mwiyathi','Faculty of Science','Department of Mathematics and Actuarial Science','Bachelor','Bachelor of Science in Mathematics','not applicable','Day','4','Male','dammaris2@gmail.com','0734244322','Nairobi','2023-02-03','Dammaris123,./','Student'),
('1337152','Matlida John Adhiambo','Faculty of Science','Department of Mathematics and Actuarial Science','Bachelor','Bachelor of Science in Mathematics','not applicable','Day','4','Female','matilda3@gmail.com','0734244322','Nairobi','2023-02-03','Matilda123,./','Student'),
('1441942','Peter Magoba Emmanuel','Faculty of Science','Department of Mathematics and Actuarial Science','Bachelor','Bachelor of Science in Mathematics','not applicable','Day','4','Male','magoba4@gmail.com','0734244322','Nairobi','2023-02-03','Magoba123,./','Student'),
('1539062','Alice Gilbert','Faculty of Science','Department of Mathematics and Actuarial Science','Bachelor','Bachelor of Science in Mathematics','not applicable','Day','4','Male','alice5@gmail.com','0734244322','Nairobi','2023-02-03','Alice123,./','Student'),
('1643692','Teresa Patrick Achieng','Faculty of Science','Department of Mathematics and Actuarial Science','Bachelor','Bachelor of Science in Mathematics','not applicable','Day','4','Female','teresa6@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1741022','Kevin John Mangaa','Faculty of Science','Department of Mathematics and Actuarial Science','Bachelor','Bachelor of Science in Mathematics','not applicable','Day','4','Male','johnm7@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1842082','Gatugi Alex Pierah','Faculty of Science','Department of Mathematics and Actuarial Science','Bachelor','Bachelor of Science in Mathematics','not applicable','Day','4','Male','gatugi8@gmail.com','0734244322','Nairobi','2023-02-03','Gatugi123,./','Student'),
('1941202','Caren Emayot Amoit','Faculty of Science','Department of Mathematics and Actuarial Science','Bachelor','Bachelor of Science in Mathematics','not applicable','Day','4','Male','emayot9@gmail.com','0734244322','Nairobi','2023-02-03','Emayot123,./','Student'),
('1220662','JacksonNaimodu Koileken','Faculty of Science','Department of Mathematics and Actuarial Science','Bachelor','Bachelor of Science in Mathematics','not applicable','Day','4','Female','naimodu7@gmail.com','0734244322','Nairobi','2023-02-03','Naimodu123,./','Student');


--//!Faculty of Law, Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA CPD)
INSERT INTO `students`(`std_regNo`, `std_fullname`, `faculty`, `department`, `levels`, `programs`, `specialization`, `mode_of_study`, `years`, `gender`, `email`, `phone`, `std_address`, `date_created`, `password`, `role`) 
VALUES 
('1133171','Ochara Collin Okoth','Faculty of Law','Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA CPD)','Bachelor','Bachelor of Laws (LLB)','not applicable','Day','4','Male','collin111@gmail.com','0734244322','Nairobi','2023-02-03','Collin123,./','Student'),
('1243641','Mwasya Dammaris Mwiyathi','Faculty of Law','Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA CPD)','Bachelor','Bachelor of Laws (LLB)','not applicable','Day','4','Male','dammaris112@gmail.com','0734244322','Nairobi','2023-02-03','Dammaris123,./','Student'),
('1333151','Matlida John Adhiambo','Faculty of Law','Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA CPD)','Bachelor','Bachelor of Laws (LLB)','not applicable','Day','4','Female','matilda113@gmail.com','0734244322','Nairobi','2023-02-03','Matilda123,./','Student'),
('1443941','Peter Magoba Emmanuel','Faculty of Law','Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA CPD)','Bachelor','Bachelor of Laws (LLB)','not applicable','Day','4','Male','magoba114@gmail.com','0734244322','Nairobi','2023-02-03','Magoba123,./','Student'),
('1533062','Alice Gilbert','Faculty of Law','Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA CPD)','Bachelor','Bachelor of Laws (LLB)','not applicable','Day','4','Male','alice115@gmail.com','0734244322','Nairobi','2023-02-03','Alice123,./','Student'),
('1644691','Teresa Patrick Achieng','Faculty of Law','Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA CPD)','Bachelor','Bachelor of Laws (LLB)','not applicable','Day','4','Female','teresa116@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1743031','Kevin John Mangaa','Faculty of Law','Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA CPD)','Bachelor','Bachelor of Laws (LLB)','not applicable','Day','4','Male','johnm117@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1843081','Gatugi Alex Pierah','Faculty of Law','Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA CPD)','Bachelor','Bachelor of Laws (LLB)','not applicable','Day','4','Male','gatugi118@gmail.com','0734244322','Nairobi','2023-02-03','Gatugi123,./','Student'),
('1943201','Caren Emayot Amoit','Faculty of Law','Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA CPD)','Bachelor','Bachelor of Laws (LLB)','not applicable','Day','4','Male','emayot119@gmail.com','0734244322','Nairobi','2023-02-03','Emayot123,./','Student'),
('1223661','JacksonNaimodu Koileken','Faculty of Law','Department of CONTINUING PROFESSIONAL DEVELOPMENT PROJECTS AND RESEARCH (CUEA CPD)','Bachelor','Bachelor of Laws (LLB)','not applicable','Day','4','Female','naimodu117@gmail.com','0734244322','Nairobi','2023-02-03','Naimodu123,./','Student');

--//!DIPLOMA 
--//! FACULTY OF SCIENCE
INSERT INTO `students`(`std_regNo`, `std_fullname`, `faculty`, `department`, `levels`, `programs`, `specialization`, `mode_of_study`, `years`, `gender`, `email`, `phone`, `std_address`, `date_created`, `password`, `role`) 
VALUES 
('1037228','Collin Okoth Ochara','Faculty of Science','Department of Computer and Information Science','Diploma','Diploma in Information Technology','not applicable','Day','4','Male','collin6@gmail.com','0734244322','Nairobi','2023-02-03','Collin123,./','Student'),
('1046224','Dammaris Mwiyathi Mwasya','Faculty of Science','Department of Computer and Information Science','Diploma','Diploma in Information Technology','not applicable','Day','4','Male','dammaris66@gmail.com','0734244322','Nairobi','2023-02-03','Dammaris123,./','Student'),
('1037226','Matlida Adhiambo','Faculty of Science','Department of Computer and Information Science','Diploma','Diploma in Information Technology','not applicable','Day','4','Female','matilda66@gmail.com','0734244322','Nairobi','2023-02-03','Matilda123,./','Student'),
('1041229','Magoba Emmanuel','Faculty of Science','Department of Computer and Information Science','Diploma','Diploma in Information Technology','not applicable','Day','4','Male','magoba66@gmail.com','0734244322','Nairobi','2023-02-03','Magoba123,./','Student'),
('1039221','Alice Gilbert Nzioki','Faculty of Science','Department of Computer and Information Science','Diploma','Diploma in Information Technology','not applicable','Day','4','Male','alice66@gmail.com','0734244322','Nairobi','2023-02-03','Alice123,./','Student'),
('1043223','Teresa Achieng','Faculty of Science','Department of Computer and Information Science','Diploma','Diploma in Information Technology','not applicable','Day','4','Female','teresa66@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1041222','John Mangaa Kevin','Faculty of Science','Department of Computer and Information Science','Diploma','Diploma in Information Technology','not applicable','Day','4','Male','johnm66@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1042225','Gatugi Pierah','Faculty of Science','Department of Computer and Information Science','Diploma','Diploma in Information Technology','not applicable','Day','4','Male','gatugi66@gmail.com','0734244322','Nairobi','2023-02-03','Gatugi123,./','Student'),
('1041226','Emayot Amoit Caren','Faculty of Science','Department of Computer and Information Science','Diploma','Diploma in Information Technology','not applicable','Day','4','Male','emayot66@gmail.com','0734244322','Nairobi','2023-02-03','Emayot123,./','Student'),
('1040227','Naimodu Jackson Koileken','Faculty of Science','Department of Computer and Information Science','Diploma','Diploma in Information Technology','not applicable','Day','4','Female','naimodu66@gmail.com','0734244322','Nairobi','2023-02-03','Naimodu123,./','Student');
--//! FACULTY OF Theology
INSERT INTO `students`(`std_regNo`, `std_fullname`, `faculty`, `department`, `levels`, `programs`, `specialization`, `mode_of_study`, `years`, `gender`, `email`, `phone`, `std_address`, `date_created`, `password`, `role`) 
VALUES 
('1044628','Collin Okoth Ochara','Faculty of Theology','Department of Biblical Theology','Master','Master of Theology','Biblical Theology','Day','2','Male','collin623@gmail.com','0734244322','Nairobi','2023-02-03','Collin123,./','Student'),
('1045624','Dammaris Mwiyathi Mwasya','Faculty of Theology','Department of Biblical Theology','Master','Master of Theology','Biblical Theology','Day','2','Male','dammaris6623@gmail.com','0734244322','Nairobi','2023-02-03','Dammaris123,./','Student'),
('1045626','Matlida Adhiambo','Faculty of Theology','Department of Biblical Theology','Master','Master of Theology','Biblical Theology','Day','2','Female','matilda6623@gmail.com','0734244322','Nairobi','2023-02-03','Matilda123,./','Student'),
('1045629','Magoba Emmanuel','Faculty of Theology','Department of Biblical Theology','Master','Master of Theology','Biblical Theology','Day','2','Male','magoba6623@gmail.com','0734244322','Nairobi','2023-02-03','Magoba123,./','Student'),
('1045621','Alice Gilbert Nzioki','Faculty of Theology','Department of Biblical Theology','Master','Master of Theology','Biblical Theology','Day','2','Male','alice6623@gmail.com','0734244322','Nairobi','2023-02-03','Alice123,./','Student'),
('1045623','Teresa Achieng','Faculty of Theology','Department of Biblical Theology','Master','Master of Theology','Biblical Theology','Day','2','Female','teresa6623@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1045622','John Mangaa Kevin','Faculty of Theology','Department of Biblical Theology','Master','Master of Theology','Biblical Theology','Day','2','Male','johnm6623@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1045625','Gatugi Pierah','Faculty of Theology','Department of Biblical Theology','Master','Master of Theology','Biblical Theology','Day','2','Male','gatugi6623@gmail.com','0734244322','Nairobi','2023-02-03','Gatugi123,./','Student'),
('1045690','Emayot Amoit Caren','Faculty of Theology','Department of Biblical Theology','Master','Master of Theology','Biblical Theology','Day','2','Male','emayot6236@gmail.com','0734244322','Nairobi','2023-02-03','Emayot123,./','Student'),
('1045627','Naimodu Jackson Koileken','Faculty of Theology','Department of Biblical Theology','Master','Master of Theology','Biblical Theology','Day','2','Female','naimodu6326@gmail.com','0734244322','Nairobi','2023-02-03','Naimodu123,./','Student');

--//! FACULTY OF Theology
INSERT INTO `students`(`std_regNo`, `std_fullname`, `faculty`, `department`, `levels`, `programs`, `specialization`, `mode_of_study`, `years`, `gender`, `email`, `phone`, `std_address`, `date_created`, `password`, `role`) 
VALUES 
('1056728','Kennedy Okoth Ochara','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Male','collin783@gmail.com','0734244322','Nairobi','2023-02-03','Collin123,./','Student'),
('1056724','Kelvin Mwiyathi Mwasya','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Male','dammaris7823@gmail.com','0734244322','Nairobi','2023-02-03','Dammaris123,./','Student'),
('1056726','Mary Adhiambo','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Female','matilda7823@gmail.com','0734244322','Nairobi','2023-02-03','Matilda123,./','Student'),
('1056729','Peter Emmanuel','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Male','magoba7823@gmail.com','0734244322','Nairobi','2023-02-03','Magoba123,./','Student'),
('1056721','Alex Gilbert Nzioki','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Male','alice7823@gmail.com','0734244322','Nairobi','2023-02-03','Alice123,./','Student'),
('1056723','Jane Achieng','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Female','teresa7823@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1056722','Patric Mangaa Kevin','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Male','johnm7823@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1056725','Henry Pierah','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Male','gatugi7823@gmail.com','0734244322','Nairobi','2023-02-03','Gatugi123,./','Student'),
('1056790','Sarah Amoit Caren','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Male','emayot7836@gmail.com','0734244322','Nairobi','2023-02-03','Emayot123,./','Student'),
('1056727','Suzan Jackson Koileken','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Female','naimodu786@gmail.com','0734244322','Nairobi','2023-02-03','Naimodu123,./','Student');
--//! FACULTY OF Theology
INSERT INTO `students`(`std_regNo`, `std_fullname`, `faculty`, `department`, `levels`, `programs`, `specialization`, `mode_of_study`, `years`, `gender`, `email`, `phone`, `std_address`, `date_created`, `password`, `role`) 
VALUES 
('1067828','Kennedy Okoth Ochara','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Male','collin783@gmail.com','0734244322','Nairobi','2023-02-03','Collin123,./','Student'),
('1067824','Kelvin Mwiyathi Mwasya','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Male','dammaris7823@gmail.com','0734244322','Nairobi','2023-02-03','Dammaris123,./','Student'),
('1056726','Mary Adhiambo','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Female','matilda7823@gmail.com','0734244322','Nairobi','2023-02-03','Matilda123,./','Student'),
('1056729','Peter Emmanuel','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Male','magoba7823@gmail.com','0734244322','Nairobi','2023-02-03','Magoba123,./','Student'),
('1056721','Alex Gilbert Nzioki','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Male','alice7823@gmail.com','0734244322','Nairobi','2023-02-03','Alice123,./','Student'),
('1056723','Jane Achieng','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Female','teresa7823@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1056722','Patric Mangaa Kevin','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Male','johnm7823@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1056725','Henry Pierah','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Male','gatugi7823@gmail.com','0734244322','Nairobi','2023-02-03','Gatugi123,./','Student'),
('1056790','Sarah Amoit Caren','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Male','emayot7836@gmail.com','0734244322','Nairobi','2023-02-03','Emayot123,./','Student'),
('1056727','Suzan Jackson Koileken','Faculty of Theology','Department of Spiritual Theology','Doctoral','Doctor of Philosophy in Theology','Spiritual Theology','Day','2','Female','naimodu786@gmail.com','0734244322','Nairobi','2023-02-03','Naimodu123,./','Student');


--//! FACULTY OF SCIENCE , Department of Natural Sciences,  Bachelor of Science in Biology
INSERT INTO `students`(`std_regNo`, `std_fullname`, `faculty`, `department`, `levels`, `programs`, `specialization`, `mode_of_study`, `years`, `gender`, `email`, `phone`, `std_address`, `date_created`, `password`, `role`) 
VALUES 
('1078978','Derak Okoth Ochara','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Biology','not applicable','Day','4','Male','collin99@gmail.com','0734244322','Nairobi','2023-02-03','Collin123,./','Student'),
('1078944','Daniel Mwiyathi Mwasya','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Biology','not applicable','Day','4','Male','dammaris99@gmail.com','0734244322','Nairobi','2023-02-03','Dammaris123,./','Student'),
('1078956','Jennifer Adhiambo','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Biology','not applicable','Day','4','Female','matilda99@gmail.com','0734244322','Nairobi','2023-02-03','Matilda123,./','Student'),
('1078949','Dominic Emmanuel','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Biology','not applicable','Day','4','Male','magoba99@gmail.com','0734244322','Nairobi','2023-02-03','Magoba123,./','Student'),
('1078961','Diana Gilbert Nzioki','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Biology','not applicable','Day','4','Male','alice99@gmail.com','0734244322','Nairobi','2023-02-03','Alice123,./','Student'),
('1078993','Dora Achieng','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Biology','not applicable','Day','4','Female','teresa99@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1078932','Mike Mangaa Kevin','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Biology','not applicable','Day','4','Male','johnm99@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1078985','Micheal Pierah','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Biology','not applicable','Day','4','Male','gatugi99@gmail.com','0734244322','Nairobi','2023-02-03','Gatugi123,./','Student'),
('1078906','Michelle Amoit Caren','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Biology','not applicable','Day','4','Male','emayot99@gmail.com','0734244322','Nairobi','2023-02-03','Emayot123,./','Student'),
('1078967','Sharon Jackson Koileken','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Biology','not applicable','Day','4','Female','naimodu99@gmail.com','0734244322','Nairobi','2023-02-03','Naimodu123,./','Student');

--//! FACULTY OF SCIENCE , Department of Natural Sciences,  Bachelor of Science in Chemistry
INSERT INTO `students`(`std_regNo`, `std_fullname`, `faculty`, `department`, `levels`, `programs`, `specialization`, `mode_of_study`, `years`, `gender`, `email`, `phone`, `std_address`, `date_created`, `password`, `role`) 
VALUES 
('1078178','Joseph Okoth Ochara','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Chemistry','not applicable','Day','4','Male','collin909@gmail.com','0734244322','Nairobi','2023-02-03','Collin123,./','Student'),
('1078144','Jimmy Mwiyathi Mwasya','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Chemistry','not applicable','Day','4','Male','dammaris909@gmail.com','0734244322','Nairobi','2023-02-03','Dammaris123,./','Student'),
('1078156','Karen Adhiambo','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Chemistry','not applicable','Day','4','Female','matilda909@gmail.com','0734244322','Nairobi','2023-02-03','Matilda123,./','Student'),
('1078149','Brain Emmanuel','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Chemistry','not applicable','Day','4','Male','magoba909@gmail.com','0734244322','Nairobi','2023-02-03','Magoba123,./','Student'),
('1078161','Dalia Gilbert Nzioki','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Chemistry','not applicable','Day','4','Male','alice909@gmail.com','0734244322','Nairobi','2023-02-03','Alice123,./','Student'),
('1078193','Hannah Achieng','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Chemistry','not applicable','Day','4','Female','teresa909@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1078132','Mark Mangaa Kevin','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Chemistry','not applicable','Day','4','Male','johnm909@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1078185','Barak Pierah','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Chemistry','not applicable','Day','4','Male','gatugi909@gmail.com','0734244322','Nairobi','2023-02-03','Gatugi123,./','Student'),
('1078106','Obama Amoit Caren','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Chemistry','not applicable','Day','4','Male','emayot909@gmail.com','0734244322','Nairobi','2023-02-03','Emayot123,./','Student'),
('1078167','Rebecca Jackson Koileken','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Chemistry','not applicable','Day','4','Female','naimodu909@gmail.com','0734244322','Nairobi','2023-02-03','Naimodu123,./','Student');
--//! FACULTY OF SCIENCE , Department of Natural Sciences,  Bachelor of Science in Physics
INSERT INTO `students`(`std_regNo`, `std_fullname`, `faculty`, `department`, `levels`, `programs`, `specialization`, `mode_of_study`, `years`, `gender`, `email`, `phone`, `std_address`, `date_created`, `password`, `role`) 
VALUES 
('1078308','Joseph Okoth Joseph','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Physics','not applicable','Day','4','Male','collin9091@gmail.com','0734244322','Nairobi','2023-02-03','Collin123,./','Student'),
('1078344','Jimmy Derak Mwasya','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Physics','not applicable','Day','4','Male','dammaris9091@gmail.com','0734244322','Nairobi','2023-02-03','Dammaris123,./','Student'),
('1078356','Karen Daniel','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Physics','not applicable','Day','4','Female','matilda9091@gmail.com','0734244322','Nairobi','2023-02-03','Matilda123,./','Student'),
('1078349','Brain Dominic','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Physics','not applicable','Day','4','Male','magoba9091@gmail.com','0734244322','Nairobi','2023-02-03','Magoba123,./','Student'),
('1078361','Dalia Joseph Nzioki','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Physics','not applicable','Day','4','Male','alice9091@gmail.com','0734244322','Nairobi','2023-02-03','Alice123,./','Student'),
('1078393','Hannah Daniel','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Physics','not applicable','Day','4','Female','teresa9091@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1078332','Mark Micheal Kevin','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Physics','not applicable','Day','4','Male','johnm9091@gmail.com','0734244322','Nairobi','2023-02-03','Teresa123,./','Student'),
('1078385','Barak Obama','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Physics','not applicable','Day','4','Male','gatugi9091@gmail.com','0734244322','Nairobi','2023-02-03','Gatugi123,./','Student'),
('1078306','Peter Jackson Caren','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Physics','not applicable','Day','4','Male','emayot9091@gmail.com','0734244322','Nairobi','2023-02-03','Emayot123,./','Student'),
('1078367','Christina kejgon','Faculty of Science','Department of Natural Sciences','Bachelor','Bachelor of Science in Physics','not applicable','Day','4','Female','naimodu9091@gmail.com','0734244322','Nairobi','2023-02-03','Naimodu123,./','Student');

ALTER TABLE  dean_clearance_request ADD COLUMN clr_id int AFTER dean_req_id;
ALTER TABLE  dean_clearance_request ADD COLUMN emp_fullname VARCHAR(200) NULL AFTER stdStatus;
ALTER TABLE dean_clearance_request ADD FOREIGN KEY(clr_id) REFERENCES clearance(clr_id)
ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE  fin_clearance_request ADD COLUMN clr_id int AFTER fin_req_id;
ALTER TABLE  fin_clearance_request ADD COLUMN emp_fullname VARCHAR(200) NULL AFTER stdStatus;
ALTER TABLE fin_clearance_request ADD FOREIGN KEY(clr_id) REFERENCES clearance(clr_id)
ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE  reg_clearance_request ADD COLUMN clr_id int AFTER reg_req_id;
ALTER TABLE  reg_clearance_request ADD COLUMN emp_fullname VARCHAR(200) NULL AFTER stdStatus;
ALTER TABLE reg_clearance_request ADD FOREIGN KEY(clr_id) REFERENCES clearance(clr_id)
ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE  library_clearance_request ADD COLUMN clr_id int AFTER lib_req_id;
ALTER TABLE  library_clearance_request ADD COLUMN emp_fullname VARCHAR(200) NULL AFTER stdStatus;
ALTER TABLE library_clearance_request ADD FOREIGN KEY(clr_id) REFERENCES clearance(clr_id)
ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE  hod_clearance_request ADD COLUMN clr_id int AFTER hod_req_id;
ALTER TABLE  hod_clearance_request ADD COLUMN emp_fullname VARCHAR(200) NULL AFTER stdStatus;
ALTER TABLE hod_clearance_request ADD FOREIGN KEY(clr_id) REFERENCES clearance(clr_id)
ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE dean_clearance_request MODIFY COLUMN clr_id int NOT NULL;
ALTER TABLE fin_clearance_request MODIFY COLUMN clr_id int NOT NULL;
ALTER TABLE reg_clearance_request MODIFY COLUMN clr_id int NOT NULL;
ALTER TABLE library_clearance_request MODIFY COLUMN clr_id int NOT NULL;
ALTER TABLE hod_clearance_request MODIFY COLUMN clr_id int NOT NULL;


ALTER TABLE students 
ADD COLUMN transcript BLOB NULL AFTER file, 
ADD COLUMN fee_statement BLOB NULL AFTER transcript;




///? CHANGING THE DATE FORMAT 

ALTER TABLE employees MODIFY date_created DATE;
UPDATE employees SET date_created = DATE_FORMAT(date_created, '%m-%d-%Y');


ALTER TABLE students ADD updated_at DATE DEFAULT NULL;

SELECT COUNT(*) FROM table_name;


