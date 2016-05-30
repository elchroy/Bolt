# Bolt

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

[Bolt](https://boltt.herokuapp.com) is a Learning Management System built with the [Laravel](http://www.laravel.com), an opensource [PHP](http://www.php.net) framework with an expressive and elegant syntax.

Bolt offers users the ability to manage their learning of some of the best and popular computer programming languages.

## Users

### User Registration

Bolt allows users to register and start managing their collection of learning resources. Registration is free and easy. Registration only requires a name, an email address and a password that must be confirmed.

### Traditional Authentication

Bolt allows users to login into the application. There is a traditional authentication system that requires both a unique username and a password.

### Social Authentication
Bolt also extends to social users, allowing [Facebook](http://www.facebook.com), [Twitter](http://www.twitter.com) and [GitHub](http://github.com) users to login into the application. Bolt requires at least, that the email used for social registration be made publicly available.

Future versions of Bolt would extend social services to users with [Google](http://www.google.com), [BitBucket](http://www.bitbucket.com), and other social accounts.

### Dashboard

Once a user has been registered or has logged into the application, the user is redirected to his dashboard. This where he can then manage all his learning resources. Only authenticated users have a dashboard.

### Password Reset

If a user, with an account, forgets the credentials to his account, he can request for resetting his account. On such a request, the users enters his email address, to which a link will be sent. On visiting th link, the users can then enter and confirm his new password. On sucess, he is logged in and redirected to his dashboard. Only guest users are permitted to perform this action. Guest users that have not registered in the past do not have access to this feature.

### User Edit Profile

A user can edit his profile and change his name or his email address. However the email must be unique.
The user can also upload a new image avatar.


## Videos

### Index

Users (both authenticated and guest) can view a collection of videos. The list of videos is paginated if need be, enabling users to continue browsing to other videos.

### Categories

Apart from viewing all the videos, a user can view only the videos of a particular category. The videos in a category are paginated if need be.

### Search

In addition to viewing all the videos, a user can search for any video by title. This is available to both authenticated users and guest users. The result of the search is displayed and pagination is used if need be.

### Uploading a video resource

Only authenticated users are able to add a new video resource. To add a video link, the title, the url, an a description are required. The category of the video is also required.
The url must be link to a valid youtube video. As such all validations must be met before the video is added to the collection of video resources.

### Editing a video resource

To edit a video resource, the user must be authenticated and be the correct owner of the video resource. Otherwise the request is rejected. Also the new details of the video are validated, just like during addition.

### Deleting a video resource

Deleting a video resource requires the user to be authenticated. Also a user can only delete his video resource. Once a video is deleted, all other descendants are deleted, including the comments under that video and the traces of the likes and favorites of that video. Deleting a video cannot be undone. Such a video would have to be re-added to the collection of videos.

### Single Video

A user can go further and watch a video that he likes. 

### Comments and Favorites

When viewing one video resource, authenticated users can drop comments on the video resource. In addtion, they can edit and delete the comments.

Authenticated users can also favorite/unfavorite a video resource by simply clicking a button.

Guest users will need to login before they can comment or favorite a video resource.

## Categories

### Index

Each video belong to a category. All the categories can be listed in the categorie page. From this page, a user can view the videos belonging to a particular category. The category page is also available to both authenticated and guest users.

### Single category

A user can view all the videos in a particular category.

### Adding categories

Authenticated users can add categories to the collection. However, the name of the category must be provided and unique. A brief description of the category must also be provided.

**Any authenticated user can add a new category, but only the top categories can be viewed on the video index page.**

### Editing a category

Authenticated users can view and edit their categories from their dashboard. Authenticated users can only edit the details of a category that belongs to them.



## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Bolt, please send an e-mail to [Chijioke Elisha-Wigwe](http://www.github.com/andela-elisha-wigwe) at chijioke.elisha-wigwe@andela.com. All security vulnerabilities will be promptly addressed.

## License

Bolt is built with the Laravel framework, an open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
