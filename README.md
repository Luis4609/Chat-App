<h1 align="center">Chat-App</h1>

### 🎯 About this file

The purpose of this file is to provide overview, setup instructions and background information of the project.

## ▶️ Demo (TO-DO)

Here you can find the demo links:

- [Heroku](https://ljmp-message-app.herokuapp.com/index.php)

### Test credentials

> Email: luis@gmail.com<br/>
> Password: 1234<br/>

## Features imlemented:

:heavy_check_mark: &nbsp;&nbsp;User Sign In & User Sign Up<br />
:heavy_check_mark: &nbsp;&nbsp;User Sign Up with verification email<br />
:heavy_check_mark: &nbsp;&nbsp;Send message to a existing user<br />
:heavy_check_mark: &nbsp;&nbsp;See the list of the received messages<br />
:heavy_check_mark: &nbsp;&nbsp;See the list of the sended messages<br />
:heavy_check_mark: &nbsp;&nbsp;Detail of a message<br />
:heavy_check_mark: &nbsp;&nbsp;Replay to a message<br />
:heavy_check_mark: &nbsp;&nbsp;Send a message to multiple users<br />
:heavy_check_mark: &nbsp;&nbsp;Groups of users (similar to WhatsApp)<br />
:heavy_check_mark: &nbsp;&nbsp;User profile<br />
:heavy_check_mark: &nbsp;&nbsp;Friendship between users<br />
:heavy_check_mark: &nbsp;&nbsp;Insert files and images in the messages<br />
:heavy_check_mark: &nbsp;&nbsp;Administration zone<br />

### Features not implemented:

&nbsp;&nbsp;Password recovery<br />
&nbsp;&nbsp;Testing with Codeception<br />

## Technologies

- [PHP](https://www.php.net/)
- [PHP Mailer](https://github.com/PHPMailer/PHPMailer)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/)
- [XAMPP](https://www.apachefriends.org/es/index.html)

## Run Locally

- Clone the project

```bash
  git clone https://github.com/Luis4609/Chat-App.git
```

- Go to the project directory

```bash
  cd Chat-App
```

- Change the config.php file a

```bash
  define('DBUSER', 'your_user');
  define('DBPWD', 'your_password');
  define('DBHOST', 'localhost');
  define('DBNAME', 'database_name');
```
