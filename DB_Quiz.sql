CREATE TABLE `QuizInfo` (
	`QuizID` INT(100) NOT NULL AUTO_INCREMENT,
	`Title` varchar(100) NOT NULL,
	`Skill Type` varchar(100) NOT NULL,
	`Pass Score` INT(100) NOT NULL,
	`Num Of Questions` INT(100) NOT NULL,
	`Expected Duration` INT(100) NOT NULL,
	PRIMARY KEY (`QuizID`)
);

CREATE TABLE `Question` (
	`QuestionID` INT(100) NOT NULL AUTO_INCREMENT,
	`QuizID` INT(100) NOT NULL,
	`Question` varchar(100) NOT NULL,
	`Possible Solutions` varchar(200) NOT NULL,
	`Correct Solution` varchar(100) NOT NULL,
	PRIMARY KEY (`QuestionID`)
);

CREATE TABLE `PassedQuiz` (
	`UserID` varchar(100) NOT NULL,
	`QuizID` INT(100) NOT NULL,
	PRIMARY KEY (`UserID`,`QuizID`)
);

CREATE TABLE `asked` (
	`UserID` INT(100) NOT NULL,
	`QuizID` INT(100) NOT NULL,
	PRIMARY KEY (`UserID`,`QuizID`)
);

ALTER TABLE `Question` ADD CONSTRAINT `Question_fk0` FOREIGN KEY (`QuizID`) REFERENCES `QuizInfo`(`QuizID`);

ALTER TABLE `PassedQuiz` ADD CONSTRAINT `PassedQuiz_fk0` FOREIGN KEY (`QuizID`) REFERENCES `QuizInfo`(`QuizID`);

ALTER TABLE `asked` ADD CONSTRAINT `asked_fk0` FOREIGN KEY (`QuizID`) REFERENCES `QuizInfo`(`QuizID`);

