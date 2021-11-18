# Chat-App

### About this file

The purpose of this file is to provide overview, setup instructions and background information of the project. If you have joined this project as a part of the development team, please ensure this file is up to date.

**Note** : Any dependencies added / modified to this project which affect the running of the code in this git repository must be listed in this file. All developers must ensure that the instructions mentioned in this file are sufficient to enable a new developer to obtain a executable copy of the lastest code in this repository, without involvement from any other human assistance.

## Features

### Basic Funcionality

- Access: users can access the application with a username and a password.
- Sending: users can send messages to other users.
- Inbox: users can see the list of the messages.
- Messages: check each message individually.
- Config.file: the connection data to the database and to the mail server must be stored in files

## Extensions

- **Self-registration**: realistic process for users to register on the website. To get the full score, you have to include an email with an activation link. **DONE**
- **Password recovery**: users can change their password.
- **Messages to multiple recipients**: allow to enter more than one recipient in the message submission form.
- **Encrypted password**: php - password_hash. **DONE**
- **User avatar**: Users will be able to upload an image to use as an avatar.It has to have some consequence in the application. For example, that the avatar
  appears in the messages that a user sends, or that it can be seen when accessing their
  profile.They can also update it.
- **User profile**: Users will be able to enter and modify a series of data about themselves, such as age,
  city of residence, hobbies or their avatar.Other users must be able to access this information.
- **Friendship**: Two users can establish a friendship relationship with each other.One of them starts the process by sending a request, which the other has to accept or
  reject.It has to have some consequence in the application. For example, that you can only
  write to friends or that a user's profile is only visible to their friends.
- **Groups**: Develop a group system similar to Telegram or WhatsApp.
- **Administration**: n this area you have to implement tasks typical of an administrator. For example, block
  or unblock users.
- **Attached files**: Allow to attach files to a message.
- **Images**: Allow to insert images as part of a message.For this enlargement to be considered correct, the images must be viewed directly when
  viewing the message, not as attachments or following a link.
- **Testing**: Incorporate acceptance testing with Codeception.The grade is proportional to the number of sections tested.
- **Outbox**: The user will be able to see a table with his sent messages, similar to the inbox.
  Messages will be sorted by date sent, most recent first.In the table you must see the recipient of the message. If there are several, it can be
  indicated by putting “Several”.From the table you can access the detail of each message, as in the inbox. In the detail
  of the message, the complete list of recipients must appear, indicating which of them
  have read it.If the application does not allow sending to more than one user, in this extension only
  half of the score can be obtained.

- **Presentation**: Public presentation of the application in the classroom.Includes description of the development process and demo.The grade is proportional to the number of sections made.

## Some utility links:

> https://codepen.io/ezenith/pen/pJLypJ

> https://www.w3schools.com/php/php_file_upload.asp

> https://github.com/PHPMailer/PHPMailer

> **Admin Zone:** https://www.cloudways.com/blog/admin-dashboard-template-php-boostrap-4/

> https://www.php.net/manual/en/ref.ldap.php

> https://www.mkdocs.org/

> **Text-area for message**: https://getbootstrap.com/docs/5.0/forms/form-control/

> https://www.w3schools.com/tags/tag_datalist.asp

> https://getbootstrap.com/docs/5.0/forms/input-group/

> https://getbootstrap.com/docs/5.0/examples/cheatsheet/

> https://realfavicongenerator.net/favicon_result?file_id=p1fkl4ekhvs4b1d1h87v1sv5ll96#.YZQKRmDMLcs

> https://makitweb.com/how-to-store-array-in-mysql-with-php/

> https://www.w3schools.com/tags/tag_embed.asp