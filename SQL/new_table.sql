DROP TABLE TODO_USER;

CREATE TABLE TODO_USER
    (ID varchar(10) NOT NULL PRIMARY KEY,
     NAME varchar(20) NOT NULL,
     PASSWORD varchar(10) NOT NULL
     );
    
INSERT INTO TODO_USER VALUES
('user01', '世良田二郎三郎元信', 'pass01'),
('user02', 'Siddhattha', 'budda'),
('user03', 'Gandi', 'barpoo');

DROP TABLE TODO_ITEM;

CREATE TABLE TODO_ITEM
    (ID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
     NAME varchar(30) NOT NULL,
     USER varchar(10) NOT NULL,
     EXPIRE_DATE date NOT NULL,
     FINISHED_DATE date
     );

INSERT INTO TODO_ITEM (NAME, USER, EXPIRE_DATE) VALUES
('項目01', 'user02', '2019/03/10'),
('項目04', 'user03', '2019/03/20'),
('項目06', 'user03', '2020/03/31'),
('項目07', 'user03', '2019/02/15'),
('項目08', 'user03', DATE_FORMAT(now() - INTERVAL 1 MONTH, '%Y/%m/%d')),
('項目10', 'user02', '2019/02/04'),
('項目14', 'user01', '2019/03/31'),
('項目15', 'user01', '2019/01/31'),
('項目17', 'user01', '2019/02/15'),
('項目18', 'user02', DATE_FORMAT(now() + INTERVAL 10 DAY, '%Y/%m/%d'))
;

INSERT INTO TODO_ITEM (NAME, USER, EXPIRE_DATE, FINISHED_DATE) VALUES
('項目02', 'user03', '2019/02/28', '2019/02/10'),
('項目03', 'user01', '2020/01/25', '2018/12/20'),
('項目05', 'user02', '2019/02/28', '2019/02/11'),
('項目09', 'user03', DATE_FORMAT(now() - INTERVAL 1 WEEK,'%Y/%m/%d'), '2019/01/01'),
('項目11', 'user02', '2019/02/04', '2019/02/08'),
('項目12', 'user02', '2019/02/10', '2019/02/08'),
('項目13', 'user01', DATE_FORMAT(now() + INTERVAL 2 WEEK,'%Y/%m/%d'), '2019/02/11'),
('項目16', 'user01', '2019/02/28', '2019/02/11'),
('項目19', 'user02', '2019/01/25', '2019/01/23'),
('項目20', 'user02', '2019/01/31', '2019/02/01')
;
