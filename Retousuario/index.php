<?php
require_once 'vendor/autoload.php';

use App\Models\Save;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'cursophp',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();
// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

if (!empty($_POST)) {
  $save = new Save();
  $save-> user = $_POST['user'];
  $save-> password = $_POST['password'];
  $save-> save();
}

  ?>

<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
      crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Username Reto</title>
  </head>
  <body>
    <h1>Add User</h1>

    <div class="alert alert-primary" role="alert">
    </div>

    <form action="index.php" method="post" >
        <label for="">User:</label>
        <input type="text" name="user" ><br>
        <label for="">Password:</label>
        <input type="password" name="password"><br>
        <button type="submit">Save</button>
    </form>
  </body>
</html>
