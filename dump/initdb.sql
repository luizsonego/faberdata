CREATE TABLE IF NOT EXISTS tasks (
  id int(11) AUTO_INCREMENT PRIMARY KEY,
  title varchar(255) NOT NULL,
  description varchar(255) NOT NULL,
  status varchar(255),
  timelimit DATE,
  created_at DATE,
  updated_at DATE
);