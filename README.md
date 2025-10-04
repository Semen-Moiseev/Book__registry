# book-catalog-laravel-backend <ins>***EN***</ins>

The implementation of the simplest registry of books in the library

## Project Description

_Brief description of the project:_

The project is a web application for library management with an administrative panel and a REST API. The system implements CRUD operations for the entities "Books", "Authors" and "Genres" with data validation and logging of actions. In the administrative part, filtering, searching and sorting of books, as well as statistics on authors are available. The API provides author authorization and provides endpoints for working with books, authors, and genres, including pagination. Authors can edit only their own data and books. The types of book editions are implemented via Enum.

_The detailed terms of reference:_

Three entities enter the bar–a book, an author, and a genre. The set of fields for entities is the minimum required to complete the task.

One author can have many books. Books have many genres and only one author. Many books belong to the genre.

Books can be of three types: graphic edition, digital edition, printed edition (use Enum for implementation).

After any actions on the book data, it is necessary to record a short notification about this in the application logs (in a database or file).

Enable the user module built into the framework for user authorization. The user of the administrative panel is the administrator, and the API users are the authors.

Implement the administrative part: 
- CRUD operations for authors, books, and book genres.
- When creating a book, do not allow the creation of books whose name is already in the database.
- Display a list of genres.
- Display a list of authors indicating the number of books.
- Display a list of books with the author's name, genres, and the date the book was added (dd.mm.yyyy).
- On the page with the list of books, do a search by book title, filtering by author, filtering by genre.
- On the page with the list of books, sort by book title.

Implement data output in JSON format using the REST API:
- Request for user authorization.
- Getting a list of books with the author's name, authorization is not required (with pagination).
- Receiving book data by id, authorization is not required.
- Updating the book data, authorization under the author of the book is required.
- Deleting a book, authorization under the author of the book is required.
- Getting a list of authors indicating the number of books, authorization is not required (with pagination).
- Getting the author's data with a list of books, authorization is not required.
- Updating the author's data, authorization under the author is required (you can only update your own data).
- A list of genres with a list of books inside (with pagination).

## Technologies used

- PHP 8.4.0
- Laravel 12.28.1
- Composer 2.8.11
- MySQL 8.0.43

## Usage examples

----------------------------------------------------------------------------
# book-catalog-laravel-backend <ins>***RU***</ins>

Реализация простейшего реестра книг в библиотеке

## Описание проекта

_Краткое описание проекта:_

Проект представляет собой веб-приложение для управления библиотекой с административной панелью и REST API. Система реализует CRUD-операции для сущностей "Книги", "Авторы" и "Жанры" с валидацией данных и логированием действий. В административной части доступны фильтрация, поиск и сортировка книг, а также статистика по авторам. API обеспечивает авторизацию авторов и предоставляет эндпоинты для работы с книгами, авторами и жанрами, включая пагинацию. Для авторов реализована возможность редактирования только своих данных и книг. Типы изданий книг реализованы через Enum.

_Подробное техническое задание:_

В бар заходят три сущности – книга, автор и жанр. Набор полей у сущностей – минимально необходимый для выполнения задания.

У одного автора может быть множество книг. У книг есть множество жанров и только один автор. К жанру относятся многие книги.

Книги могут быть трех типов: графическое издание, цифровое издание, печатное издание (для реализации использовать Enum).

После любых действий над данными о книге необходимо записывать об этом короткое уведомление в логи приложения (в базу данных или файл).

Подключить, встроенный в фреймворк, модуль user для авторизации пользователей. Пользователем административной панели является администратор, а пользователями API – авторы.

Реализовать административную часть: 
- CRUD-операции для авторов, книг и книжных жанров.
- При создании книги не позволять создавать книги, название которых уже есть в базе.
- Вывести список жанров.
- Вывести список авторов с указанием количества книг.
- Вывести список книг с указанием имени автора, жанров, даты добавления книги (dd.mm.yyyy).
- На странице со списком книг сделать поиск по названию книги, фильтрацию по автору, фильтрацию по жанрам.
- На странице со списком книг сделать сортировку по названию книги.

Реализовать выдачу данных в формате JSON с помощью REST API:
- Запрос на авторизацию пользователя.
- Получение списка книг с именем автора, авторизация не обязательна (с пагинацией).
- Получение данных книги по id, авторизация не обязательна.
- Обновление данных книги, авторизация под автором книги обязательна.
- Удаление книги, авторизация под автором книги обязательна.
- Получение списка авторов с указанием количества книг, авторизация не обязательна (с пагинацией).
- Получение данных автора со списком книг, авторизация не обязательна.
- Обновление данных автора, авторизация под автором обязательна (можно обновлять только свои данные).
- Список жанров со списком книг внутри (с пагинацией).

## Используемые технологии

- PHP 8.4.0
- Laravel 12.28.1
- Composer 2.8.11
- MySQL 8.0.43

## Примеры использования
