<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Social Network | Register</title>
</head>
<body>
  <h1>Social Network</h1>
  <h2>Register</h2>
  <form action="/register" method="post">
    <div>
      <label for="username">username : </label>
      <input type="text" id="username" name="username">
    </div>
    <br>
    <div>
      <label for="password">password : </label>
      <input type="password" id="password" name="password">
    </div>
    <br>
    <div>
      <label for="password_validation">password validation : </label>
      <input type="password" id="password_validation" name="password_validation">
    </div>
    <br>
    <div>
      <label for="firstname">firstname : </label>
      <input type="text" id="firstname" name="firstname">
    </div>
    <br>
    <div>
      <label for="lastname">lastname : </label>
      <input type="text" id="lastname" name="lastname">
    </div>
    <br>
    <div>
      <input type="submit" value="submit">
    </div>
  </form>
  <br>
  <a href="/login">If you have an account login here!</a>
</body>
</html>