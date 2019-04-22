CREATE TABLE `QuizInfo` (
	`QuizID` INT(100) NOT NULL AUTO_INCREMENT,
	`Title` varchar(100) NOT NULL,
	`Skill` varchar(100) NOT NULL,
	`PassScore` INT(100) NOT NULL,
	`NumOfQuestions` INT(100) NOT NULL,
	`ExpectedDuration` INT(100) NOT NULL,
	PRIMARY KEY (`QuizID`)
);

CREATE TABLE `Question` (
	`QuestionID` INT(100) NOT NULL AUTO_INCREMENT,
	`QuizID` INT(100) NOT NULL,
	`Question` varchar(100) NOT NULL,
	`PossibleSolutions` varchar(200) NOT NULL,
	`CorrectSolution` varchar(100) NOT NULL,
	PRIMARY KEY (`QuestionID`)
);

CREATE TABLE `PassedQuiz` (
	`UserID` varchar(100) NOT NULL,
	`QuizID` INT(100) NOT NULL,
	`UserScore` INT(100) NOT NULL,
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

