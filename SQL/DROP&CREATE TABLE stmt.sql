DROP TABLE todolist;

CREATE TABLE todolist
    (id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
     subject varchar(30) NOT NULL,
     staff varchar(21) NOT NULL,
     term date NOT NULL,
     done varchar(10) NOT NULL DEFAULT '未'
     );
