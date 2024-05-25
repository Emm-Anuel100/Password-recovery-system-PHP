# Forgot Password System with PHP

## Introduction
The Forgot Password System is a crucial feature of any web application that allows users to reset their passwords if they have forgotten them. This system ensures security and convenience by verifying the user's identity and providing a secure way to set a new password.

## How it Works
1. **User Requests Password Reset**: The user initiates the password reset process by clicking on the "Forgot Password" link on the login page.
2. **Provide Email**: The user inputs the email associated with their account during the initial registration.
3. **Verify Email**: The system checks if the email already exist in the database, if it exist a 5 digit reset code will be sent to the person's mail.
4. **Password Reset Form**: The user can copy the code in the email, and then input the unique code in the password reset form.
5. **User Authentication**: The system verifies the code to ensure it is valid and matches the one stored in the database.
6. **New Password**: The user enters a new password into the password reset form.
7. **Password Update**: Upon successful verification, the system updates the user's password in the database with the new one provided by the user.
8. **Login**: The user can now login with the new password.

## Clone and Navigate to the Project
To clone the Forgot Password System project and navigate to its directory, run the following shell commands:

```sh
git clone https://github.com/Emm-Anuel100/Password-recovery-system-PHP.git
```

```sh
cd Password-recovery-system-PHP
```
