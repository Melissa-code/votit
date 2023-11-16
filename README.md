# Vot It 

The company VotIt wants to offer a website for polls about the IT/dev. 
* It would like that the users could sign up (email, password, pseudo) in order to create a poll (title, description) or vote on a poll. 
* When a user creates a poll, he could add some proposals. 
* A poll belongs to a category (front-end, back-end, devops, mobile, UI/UX).
* The result of the poll must be displayed by a progression bar
* The polls can be filtered (bycatégory with a search)   

--- 

## Table of content  

--- 

## General info   

---  

## Technologies 

A list of technologies used within the project :   
* WAMP Server (Windows, Apache, MySQL, PHP)  
* PHP version 8.1  
* MySQL version 5.7

---   

## Installation  

1. Create the project in the www folder of WAMP.  

2. Download the zip or clone the project in local :  
git clone [https://github.com/Melissa-code/votit.git](https://github.com/Melissa-code/votit.git)

3. Move into the directory :  
cd /path/to/the/file/votit  

4. Open the project with a code editor, for instance Visual Studio Code.  

5. Start WAMP and go to phpMyAdmin.  

6. Create the database votit by a SQL query in the tab SQL :  
`CREATE DATABASE votit;`
`USE votit;`

Import the database (Upload the votit.sql file).  

7. You can add a new user for the database :
In phpMyAdmin, click on the tab User Account. Fill in the Username and the Password fields. Then, check the global privileges (here are all privileges) and link the user to the database.

8. Connect the project to the database. 

9. You can add a local domain :  

* Windows :
- Open the folder C:\Windows\System32\drivers\etc\hosts
- Add a line to the local domain : 
`127.0.0.1 votit.local`

* Machintosh : 
[https://dev.to/crankysparrow/configuring-virtual-hosts-with-mamp-f3i](https://dev.to/crankysparrow/configuring-virtual-hosts-with-mamp-f3i) 

* Then, indicate to Apache  :   
Update the httpd-vhosts.conf file :   
* Wamp :  
`C:\wamp64\bin\apache\apache2.4.51\conf\extra\httpd-vhosts.conf`
* Xampp :  
`C:\xampp\apache\conf\extra\httpd-vhosts.conf` 
* Mamp :  
`/Applications/MAMP/conf/apache/extra/httpd-vhosts.conf`
   
Finally, add the config : 

`<VirtualHost *:80>
DocumentRoot "C:\wamp64\www\votit"
ServerName votit.local
</VirtualHost>`    


And restart Wamp server  

---  

## Run 

* Start WAMP if it's not already started.  
* Open your browser and navigate directly to http://votit.local  (or http://localhost/votit/)   

---  

## Built with  

### Languages and Frameworks  

* PHP 8.1 [PHP Documentation PHP Documentation](https://www.php.net/manual/fr/index.php).   

* SQL [SQL Documentation SQL Documentation](https://sql.sh/).   

* HTML/CSS [HTML CSS MDN Documentation MDN Documentation](https://developer.mozilla.org/fr/docs/Web) & [W3School W3School](https://www.w3schools.com/).   

* Bootstrap 5.3 [Bootstrap Documentation Bootstrap Documentation](https://getbootstrap.com/).   
 
* JavaScript [JavaScript Documentation MDN JavaScript Documentation](https://developer.mozilla.org/fr/docs/Web/JavaScript).   

* Git [Git Documentation Git Documentation](https://git-scm.com/doc).  

### Tools  

* GitHub [GitHub](https://github.com/).

* DBeaver Community [DBeaver Community]().

* FontAwesome [Fontawesome](https://fontawesome.com/icons) and CDN font-awesome [CDN font-awesome](https://cdnjs.com/libraries/font-awesome). 

* Google Fonts [Google Fonts](https://fonts.google.com/).

* Unsplash [Unsplash](https://unsplash.com/fr).

### IDE  

* Visual Studio Code [Visual Studio Code](https://code.visualstudio.com/).

---   

## Author    

Melissa-code  

---   

## Licence  

