# JU Social & e-Learning Platform

## Overview

JU Social & e-Learning Platform is an integrated web-based application designed to streamline the day-to-day activities of university students and teachers at Jahangirnagar University. This platform centralizes various functionalities such as communication, course management, examination management, and social networking into a single system, thereby reducing the need to access multiple distinct applications or websites.

## Main Features

- **Data Storage**: All data and records are stored in a MySQL database.
- **Registration Panel**: Separate registration panels for teachers and students.
- **Emergency Notifications**: Students can send emergency messages to teachers, who will be notified via text message.
- **User Authentication**: Student, teacher, and admin login capabilities.
- **Search Functionality**: Search for students or teachers using various filters in both classroom and social media sections.
- **Profile Management**: Edit personal profiles, including profile photo, cover photo, and personal details.
- **Social Networking**: Send and manage friend requests, create and join groups, post content, and interact with others through likes and comments.
- **Messaging**: Individual and group chat functionality.
- **Course Management**: Create and manage courses, upload and access study materials, and track course progress.
- **Exam and Assignment Management**: Manage exams and assignments, including grading.
- **Admin Panel**: Admin functionalities include approving registration requests, verifying payments, and updating notices.
- **User Dashboard**: A comprehensive dashboard for users to view and update their data, and search for teachers and students.

## Objectives

- Implement and apply knowledge of HTML, CSS, JavaScript, JQuery, PHP, MySQL, and DBMS learned during the semester.
- Develop a practical, real-life web application to assist university students and teachers.
- Provide a multi-functional communication and study platform that integrates various needs into a single system.

## Technologies Used

- HTML
- CSS
- JavaScript
- JQuery
- AJAX
- PHP
- MySQL

## Database Models

The project utilizes a MySQL database with the following schema:

- **Admin**: `admin(admin_id, password)`
- **Books**: `books(book, m_id)`
- **Course**: `course(c_id, credit, cname, semester, cstatus, u_id)`
- **Dept**: `dept(dept_id, dept_name, faculty_name)`
- **Enroll**: `enroll(u_id, c_id)`
- **Exam**: `exam(etime, edate, file, grade, e_id, e_details, e_title, c_id)`
- **GroupPost**: `grouppost(gpid, pdate, ptime, pdetails, likecount, commentcnt, memberid, gid)`
- **GroupPost_Comments**: `grouppost_comments(comid, comtime, comdate, comdetails, gpid, memberid)`
- **GroupPost_Likes**: `grouppost_likes(lid, ltime, ldate, gpid, memberid)`
- **GroupPost_Photos**: `grouppost_photos(photosid, location, gpid)`
- **GroupPost_Videos**: `grouppost_videos(videosid, location, gpid)`
- **GroupRequests**: `grouprequests(rqfrom, rqto)`
- **Groups**: `groups(gid, gname, about, dp)`
- **Group_Member**: `group_member(memberid, mute, gid)`
- **Group_Message**: `group_message(gid, msg_id, msg_from, msg, sendtime)`
- **Grp_Members**: `grp_members(gid, u_id)`
- **Messages**: `messages(msg_id, msg_to, msg_from, msg, msg_time)`
- **Notices**: `notices(notice_id, headline, description, date, noticefile, admin_id)`
- **Notifications**: `notifications(no_id, type, sender, senderentity, ndate, ntime, isseen, u_id)`
- **Payment**: `payment(t_id, amount, pdate, semester, pstatus, u_id, admin_id)`
- **Posts**: `posts(p_id, post, date, c_id)`
- **Records**: `records(video, m_id)`
- **Request**: `request(rqfrom, rqto)`
- **Seen**: `seen(u_id, seen)`
- **Slides**: `slides(slide, m_id)`
- **Student**: `student(u_id, skills, hall, cg, semester, batch, dept_id)`
- **Study_Material**: `study_material(m_id, u_id, c_id)`
- **Takes_Part**: `takes_part(u_id, e_id, sgrade, ftime, fdate, date, file)`
- **Teacher**: `teacher(u_id, rinterest, designation, dept_id)`
- **Temp**: `temp(t_id, karconvo, u_id_to, seen)`
- **User**: `user(u_id, email, fname, lname, password, district, house_no, thana, phone, bg, status, id_type, gender, dob, dp, id_image, ustat, token, admin_id)`
- **UserPost**: `userpost(p_id, pdate, ptime, pdetails, likecount, commentcnt, u_id)`
- **UserPost_Comments**: `userpost_comments(comid, comtime, comdate, comdetails, p_id, u_id)`
- **UserPost_Likes**: `userpost_likes(lid, ltime, ldate, pid, u_id)`
- **UserPost_Photos**: `userpost_photos(photosid, location, pid)`
- **UserPost_Videos**: `userpost_videos(videosid, location, pid)`
- **User_Friends**: `user_friends(friendfrom, friendto)`
- **User_Groups**: `user_groups(gname, cover, gid, about, member, u_id)`

## Installation and Setup

1. Clone the repository:
   ```sh
   git clone https://github.com/shawon-iitju-48/JU-Social-Platform.git
   cd JU-Social-Platform
   ```

2. Install the necessary dependencies (if any).

3. Configure the database:
   - Import the provided SQL file into your MySQL database to create the necessary tables.
   - Update the database configuration in the project files to match your MySQL setup.

4. Start the server:
   ```sh
   php -S localhost:8000
   ```

5. Open your browser and navigate to `http://localhost:8000` to access the platform.

## Documentation

- [Sample Output](Project%20Documents/JU%20Social%20and%20E-Learning%20Platform%20Outputs.pdf)
- [Project Report](Project%20Documents/Project%20Report%20-%20Group-%2019.pdf)


## Contact

For any inquiries or feedback, please contact us at:
- **Email**: shawon.iitju.48@gmail.com
  
