-- добавляем пользователей
insert into users 
(name,email,password)
values 
('Алексей', 'myfreejob13@gmail.com','1a1dc91c907325c69271ddf0c944bc72'),
('Тестов Тест', 'test@test.test','098f6bcd4621d373cade4e832627b4f6');

-- добавляем список проектов
insert into projects 
(title,author)
values 
('Входящие','1'),
('Учеба','1'),
('Работа','1'),
('Домашние дела','1'),
('Авто','1');

-- добавляем список задач
insert into tasks 
(title,task_status,date_ready,author,project)
values 
('Собеседование в IT компании','0','20.07.05','1','3'),
('Выполнить тестовое задание','0','20.07.03','1','3'),
('Сделать задание первого раздела','1','20.07.01','1','2'),
('Встреча с другом','0','20.06.29','1','1'),
('Купить корм для кота','0','20.06.27','1','4'),
('Заказать пиццу','0','20.06.25','1','4');

-- получить список из всех проектов для одного пользователя
select p.title from projects p 
inner join users u on u.id = p.author 
where u.id = 1;

-- получить список из всех задач для одного проекта
select t.title from tasks t 
inner join projects p on p.id = t.project 
where p.id = 3;

-- пометить задачу как выполненную
update tasks 
set task_status = 1 
where id = 5;

-- обновить название задачи по её идентификатору
update tasks 
set title = 'Изменено: купить корм для кота' 
where id = 5;