# php-simple-router

A simple router to use in PHP API's

You need the `.htaccess` file existing on the repo to redirect all your requests to the `index.php` file.

## How to use

Create a folder `controllers` in the same folder of `index.php` file and create your controllers inside.

> * All your controllers must have the route name capitalized (e.g. "User")
> * All your class names on the controller files must end in the word `Controller` (e.g. "UserController").
> * All your methods must start with the word `action` (e.g. "actionIndex")

## Example of a controller for the User model

**Route:** `"https://example.domain.com>/user"`

### Create the `User.php` file in the `controllers` folder

```php
class UserController { // class name ending with the word "Controller"

  public function actionIndex() // method name starting with the word "action"
  {
    return "User Controller";
  }

  public function actionGet($id)
  {
    return (object)[
      'id' => 1,
      'name' => 'John Doe'
    ];
  }

}
```

### Then you can access to the following URLs and see the responses

* `"https://example.domain.com/user"`

```json
"User Controller"
```

* `"https://example.domain.com/user/get/id/1"`

```json
{
  "id": 1,
  "name": "John Doe"
}
```
