<?php

return [
    'common' => [
        'home' => 'Home',
        'search' => 'Search',
        'app_name' => 'Geoglify',
        'app_subtitle' => 'Made to last',
        'powered_by' => 'Powered by GEOGLIFY v1.0.0',
        'saved' => 'Saved.',
        'fields' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Confirm Password',
            'description' => 'Description',
        ],
    ],

    'navigation' => [
        'dashboard' => 'Dashboard',
        'users' => 'Users',
        'roles' => 'Roles',
        'ports' => 'Ports',
        'configurations' => 'Configurations',
        'logout' => 'Logout',
    ],

    'actions' => [
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'delete' => 'Delete',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'confirm' => 'Confirm',
    ],

    'auth' => [
        'login_title' => 'Log in',
        'login_button' => 'Login',
        'register_title' => 'Register',
        'register_button' => 'Register',
        'logout' => 'Log Out',
        'forgot_password_title' => 'Forgot Password',
        'reset_password_title' => 'Reset Password',
        'reset_password_button' => 'Reset Password',
        'reset_button' => 'Reset',
        'confirm_password_title' => 'Confirm Password',
        'confirm_button' => 'Confirm',
        'verify_email_title' => 'Email Verification',
        'resend_verification' => 'Resend Verification Email',
        'back_to_login' => 'Back to login',
        'logged_in_message' => 'You\'re logged in!',
        'login' => 'Log in',

        'already_have_account' => 'Already have an account?',
        'forgot_password_message' => 'Forgot your password? No failure. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.',
        'reset_password_message' => 'Reset your password, enter your new password and confirm it.',
        'confirm_password_message' => 'This is a secure area of the application. Please confirm your password before continuing.',
        'verify_email_message' => 'Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.',
        'verification_link_sent' => 'A new verification link has been sent to the email address you provided during registration.',
        'register_question' => 'Don\'t have an account?',
        'remember_me' => 'Remember me',
        'forgot_password' => 'Forgot Password?',
    ],

    'users' => [
        'title' => 'Users',
        'create_title' => 'Create User',
        'create_subtitle' => 'Create a new user',
        'edit_title' => 'Edit User',
        'edit_subtitle' => 'Edit user details',
        'import' => 'Import',
        'delete_confirmation_title' => 'Are you sure you want to delete this account?',
        'delete_warning' => 'Once this account is deleted, all of its resources and data will be permanently deleted.',

        'fields' => [
            'type' => 'Type',
            'ports' => 'Ports',
            'default_port' => 'Default Port',
            'role' => 'Role',
        ],
    ],

    'roles' => [
        'title' => 'Roles',
        'create_title' => 'Create Role',
        'create_subtitle' => 'Create a new role',
        'edit_title' => 'Edit Role',
        'edit_subtitle' => 'Edit role details',
        'permissions' => 'Permissions',
        'select_permissions' => 'Select permissions for the role',
        'delete_confirmation_title' => 'Are you sure you want to delete this role?',
        'delete_warning' => 'Once this role is deleted, all of its resources and data will be permanently deleted.',

        'fields' => [
            'title' => 'Title',
            'description' => 'Description',
        ],
    ],

    'profile' => [
        'title' => 'Profile',
        'information_title' => 'Profile Information',
        'information_description' => 'Update your account\'s profile information and email address.',
        'update_password_title' => 'Update Password',
        'update_password_description' => 'Ensure your account is using a long, random password to stay secure.',
        'delete_account_title' => 'Delete Account',
        'delete_account_description' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.',
        'delete_account_button' => 'Delete Account',
        'delete_confirmation_title' => 'Are you sure you want to delete your account?',
        'delete_confirmation_message' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.',
        'email_unverified' => 'Your email address is unverified.',
        'resend_verification' => 'Click here to re-send the verification email.',
        'verification_sent' => 'A new verification link has been sent to your email address.',

        'fields' => [
            'current_password' => 'Current Password',
            'new_password' => 'New Password',
        ],
    ],
];
