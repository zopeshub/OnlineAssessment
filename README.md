# OnlineAssessment
Assessment portal for colleges and recruiters

# Features:
Currently this portal offers test which can be divided in 3 different modules(eg Quantitative ability, Verbal ability, Logical ability)
You can change it as per needs eg. C,JAVA,general Aptitude.(sample databases are included)

- The portal randomizes the questions from 8 different tables, so the chance of the neighbors getting same questions is reduced.
- Report generation in excelsheet format.
- Flexible marking scheme

## User Login:
The test taker can login using the roll, the default password is user@1234(it is hardcoded, you can change it in the index.php)
[ Login: 12ce1013 Pass: user@1234 ] (user added in sample DB)

## Admin Login
The admin can set the number of questions for 3 sections, timer and generate a report in form of excel sheet
[ Login: admin Pass: admin@1234 ] 

## Add New User
Since this was created for the college to take test , there is no signup page. You will need to add the users manually in the database.
Just add roll & name (other fields are optional)

## Steps to run on Local Machine
1.Open Xampp server(run mysql and apache server)  
2.Create a new database by name aptitude   
3.select newly created database   
4.Click import and import the .sql file(samples in database folder)
