# Part 1 Assignment of Project

**Li Zijia:** 

1> Create login module to allow people to register a new user in the system, and logging in. Check that the register form is complete and verify that the information entered is valid.

2> Uniform everyone's code style.

**Geng Shizhe:** 

1> Create “Dashboard” page to display and manage reservation list, and allow user to logout. Receive and apply messages from the "Check-in" page.

2> Write README.md file.

**Wang Zhuoxi:**

1> Create "New Reservation" page to allow user select available day and submit reservation. Redirected to the “Dashboard” page.

2> Implement the functionality in "Others".

**Wang Wenrui:**

1> Create "Check-In" page to allow user input the invitation code and his/her password for authentication. Pass the message to the "Dashboard page".

2> Use Git to manage group code.



-----

# Part 2 Instruction for Installing

**Create the database before running the command**

1. $ cp .env.example .env # Modify the database configuration to your own database
2. $ php artisan key:generate # Set the application key
3. $ composer install -V # Install composer
4. $ php artisan migrate # Running database migration

**Parameter description**

1. CARNIVAL_DAYS: integer, value for how long will the Carnival take
2. CURRENT_DAY: integer, value from 0 to CARNIVAL_DAYS, where 0  indicates a day before the first day of the Carnival