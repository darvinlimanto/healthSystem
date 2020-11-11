# healthSystem
Contains healthSystem project from my final year studies. This is a joint project with 2 other students from the same class. Aytug Altunag and Albert Kousa.

The project uses combination of HTML, CSS, PHP, JavaScript, and MySQL for database. 

Project details
Create a health advisory system that will be able to generate health advice based on the user input.

How it's work
1. The system has two sides for access. One is for customer and the other side is for administrator. 
2. After creating an entry, the system will dynamically create unique page (html page) for that specific entry.
3. The system contain basic files for database, login form, login session.



Administrator will have the ability to:
1. Create health entries.
  Health entries will have several attributes. Administrator will need to specify the name, the formula, the parameters, and the risk or recommendations.
  For example: creating BMI will use parameters of weight and height, formula will be Weight/(Height/100*Height/100), 
  and the risk can be defined into 3 categories: overweight, normal and underweight with each of the advice specified.
  
2. View health entries history.
  Administrator will be able to view the health entries that have been previously created. Ideally, every health entry title should be unique. 
  
Customer will have the ability to:
1. Choose health entries.
  After choosing an entry, user input is needed. For example, BMI need input on user's weight and height. Then, the result will be calculated and specific advice will be given.
 
