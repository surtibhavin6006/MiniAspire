## About Project

[**Api Documentation**](https://documenter.getpostman.com/view/2386392/Rzn8NgMM)

**Description** 

This project is asking for loan and approving loan.

It has **Admin** and **Client** two types of users.

So when you set up the project by given below instruction you will have One admin user and two roles.

Admin user can do:

- Crud of Client
- Crud of Loan Type
- View,Approve/Disapprove Proposal
- View Emi

Client user can do:

- Create a proposal
- View Emi
- Pay Emi

**Explore how system work**

- First _Client_ create/request a proposal.At that time event will be called and notification will be sent to admin user.

- Admin user verify the proposal and approve/disapprove.On approve or disapprove event fired and notification sent to _Client_.On Approving, one event will call and add emis according to Tenure,Loan Type,Loan Amount,etc...

- _Client_  have to pay emi between 1st to 5th date of every month if he has got emi due which will be reminder him by mail on every month's first day.

- If _Client_ don't pay till 5th of current month,he will charged penalty.

- On completing all emis,Client will reminder proposal is completed.

- **system** will send reminder on every month's first day to all borrower's whose emi is due and ask to say pay till 5th of current month. 


## Installation and Guide

We have used UUID instead of default auto incremented id.

### Installation
* Clone a project.
* Apply below command to install packages:
    * `composer install`
* Set up **.env** file.
* Set up jwt secret key by below command:
    * `php artisan jwt:secret`
* Run the below command for migration and seed.
    * `php artisan migrate --seed`

Now you will have two roles *admin*,*client* and default admin with below credential:
- `username:admin / password:secret`

**Note** : It will also add permissions to that admin user but we will take it in todo.We have authorizing action by role for now.

### System Commands
* Command to verify the user by id 
    * `php artisan user:verify {userId}`

* Command to send reminder to users which can be schedule on every first date of month to sent notification to remind Emi is due and have to pay till 5th of month.
    * `php artisan emi:reminder`
    
## System Information

* Php 7.1.3 or Above
* Laravel Framework : 5.7