CREATE TABLE paiza_bbs
(
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_name text NOT NULL,
  content text NOT NULL,
  updated_at datetime NOT NULL
);

CREATE TABLE paiza_todos (
  id int(11) NOT NULL AUTO_INCREMENT PRIMAY KEY,
  name varchar(30) NOT NULL
  );
