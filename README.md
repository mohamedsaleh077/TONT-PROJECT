# Tont-Project
DEMO for a school management system, Education Community, AI overview and more..

presented by the Code-Hatsu team, won fourth place in Egypt in the Digitopia 2025 competition presented 
by the Ministry of Communications and Information Technology.

we started working on the project in Sep 2025, and now it is open-source.

## Demo
- https://tont.ct.ws/
  - home page
- https://tont.ct.ws/new/admin/login.php
  - admin panel, user: `sudo`, password: `password`
- https://tont.ct.ws/login/index.php?demo=s
  - Login as Student
- https://tont.ct.ws/login/index.php?demo=p
  - Login as Parent
- https://tont.ct.ws/login/index.php?demo=t
  - Login as Teacher

## About the team
### Code-Hatsu Team
- Mohammed Saleh (me, Team Leader, Full Stack Web Developer with PHP and MySQL).
- Halla Osama (UIUX Designer).
- Abdelrahman Rashed (Front End Developer).

## Features
- Login, Activate Account.
- Admin Panel with SFCRUD operations.
- Students, Teachers, Parents, Grades, Exams, Attendance Reports, Students Reports, Teachers Reports, Parents Reports.
- community.
- school announcements.
- customization for profiles.
- easy-to-use dashboard for users.
- Habit Tracker.
- LeaderBoard.
- Matrials and Certicates (static).
- Mistakes Notebook.
- Motivation Quotes (not based on analysis).
- Notebook.
- Path-Finder test.
- Streams (static).
- Timetable.
- ToDo list
- VARK test.
- AI features.

## Technologies used
- PHP
- HTML
- CSS
- JS
- MySQL
- Docker

## How to run the project?
you need to install
 - docker
 - docker-compose

 - run docker.
 - run this command in your terminal or CMD, whatever. in docker_setup directory.
```
cd docker_setup
docker compose up --build -d
```
this command will pull all necessary images and run them.

~~copy all the content in the file `db.sql` into phpmyadmin > tont_db > SQL tab.~~
- no need now to copy the file db.sql content manually again!

### Here we go!
- http://localhost/ for the website
- http://localhost/demo_setup/index.php simple admin panel to add the testing data into the database.
- http://localhost:8081/ for phpmyadmin

### FOR AI FEATURES!
you will need to get the API key from google AI studio and paste it in the `/api/ai.php` file.

### FOR PRODUCTION!
- change the configurations in `configs.ini` file.
- dont forget tp enable AI features as I said above.