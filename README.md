
## Problem Statement
Creating a simple PHP application that allows users to subscribe on this application and send email that contain random comics at every 5 minutes.

  
### Constraints

 - Application should include email verification to avoid people using others’ email addresses.
 - It must be done in core PHP including API calls, recurring emails, including attachments should happen in core PHP.
 - Do not use any libraries.

### How to use this application

 - First user needs to subscribe with valid email and otp will be sent to that email.
 - After entering correct otp, user account will be activated
 - And user will get XKCD comics at every 5 minutes via subscribed email.
 - Now if user wants to unsubscribe, click on the unsubscribe link that has been sent to the mail which contains comics image, and verify your email, and you will be unsubscribed from the mailing list.


### How it is implemented

 - This application is simply built with basic concepts of HTML,CSS and PHP.
 - I've used mail function to send the mails.
 - Email verification step is also included so no one can use other's email address without authentication.
 - I've tried to make it safe from vulnerabilities like SQL injection.


 ### Resources that I've used
 - VSCode as editor
 