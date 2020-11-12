INSERT INTO projects (project_name, autor) VALUES('Домашние дела', 'Cat');
INSERT INTO projects (project_name, autor) VALUES('Работа', 'KirillAlex');
INSERT INTO projects (project_name, autor) VALUES('Учеба', 'Swatron');

INSERT INTO tasks (project_name, autor, start_date, status, task_name, link, deadline) VALUES('Работа', 'KirillAlex',
 '2020-09-09', 0, 'Устроиться на работу', ' ', '2020-12-31');
INSERT INTO tasks (project_name, autor, start_date, status, task_name, link, deadline) VALUES('Учеба', 'Swatron',
 '2020-10-20', 1, 'Написать программы', ' ', '2020-11-01');
INSERT INTO tasks (project_name, autor, start_date, status, task_name, link, deadline) VALUES('Учеба', 'KirillAlex',
 '2020-10-20', 0, 'Сдать экзамены', ' ', '2021-01-22');
INSERT INTO tasks (project_name, autor, start_date, status, task_name, link, deadline) VALUES('Домашние дела', 'Cat',
 '2020-09-11', 1, 'Убраться', ' ', '2020-09-12');
INSERT INTO tasks (project_name, autor, start_date, status, task_name, link, deadline) VALUES('Домашние дела', 'Cat',
 '2020-10-23', 0, 'Купить новый ковер', 'https://kover.ru/upload/iblock/d9c/d9c01125088441653d00d69573ac5323.jpg', '2020-11-23');

INSERT INTO users (registration_date, email, user_name, pass) VALUES('2020-09-09', 'what123@yandex.ru', 'KirillAlex',
 'asda22hjv432kjbjhzvxzx');
INSERT INTO users (registration_date, email, user_name, pass) VALUES('2020-10-10', 'kirill.alex.of@gmail.com', 'Swatron',
 'www272tnbasalsklm$ajbam%');
INSERT INTO users (registration_date, email, user_name, pass) VALUES('2019-10-17', 'meowmeow@pets.com', 'Cat',
 'psadkaslkdnakjslaksb712kj1bvjb5##8120');

SELECT U.user_name, P.project_name from projects P Join users U ON P.autor = 'Cat';

SELECT P.project_name, T.task_name FROM tasks T JOIN projects P ON T.project_name = 'Учеба';

UPDATE tasks SET status = 1 WHERE task_name = 'Сдать экзамены';

UPDATE tasks SET task_name = 'Купить новый стул' WHERE id = 5;


CREATE FULLTEXT INDEX tasks_search ON tasks(task_name, deadline); 
SELECT project_name, task_name, deadline FROM tasks WHERE MATCH(task_name) AGAINST(?);

