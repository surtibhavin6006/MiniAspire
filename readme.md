## About Project

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
- Pay Emi

**Explore how system work**

- First _Client_ create/request a proposal.At that time event will be called and notification will be sent to admin user.

- Admin user verify the proposal and approve/disapprove.On approve or disapprove event fired and notification sent to _Client_.On Approving, one event will call and add emis according to Tenure,Loan Type,Loan Amount,etc...

- _Client_ will pay emi have to pay emi from 1st to 5th date of every month if he has got emi due which will be reminder him by mail on every month's first day.

- If _Client_ don't pay till 5th of curren month,he will charged penalty.

- On completing all emis,Client will reminder proposal is completed.

- **system** will send reminder on every month's first day to all borrower's whose emi is due and ask to say pay till 5th of current month. 