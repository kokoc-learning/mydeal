CREATE DATABASE mydeal;
CREATE TABLE projects (
    id INT NOT NULL AUTO_INCREMENT,
    project_name VARCHAR(50),
    autor VARCHAR(30),
    PRIMARY KEY(id)
);
CREATE TABLE tasks (
    id INT NOT NULL AUTO_INCREMENT,
    project_name VARCHAR(50),
    autor VARCHAR(30),
    start_date DATE,
    status BOOLEAN,
    task_name VARCHAR(50),
    link TEXT,
    deadline DATE,
    PRIMARY KEY(id)
);
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    registration_date DATE,
    email VARCHAR(50),
    user_name VARCHAR(50),
    pass TEXT,
    PRIMARY KEY(id)
);
