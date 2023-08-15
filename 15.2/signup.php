<?php require 'header.php'; ?>

    <title>Sign-up</title>
  </head>
  <body class="text-center">

    <form class="form-signin" method="POST" action="signupLogic.php">
      <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>

      <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
      <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Full Name" required>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email Adress" required>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-success btn-block" name="submit" type="submit">Sign up</button>

      <small>If you already have an account. Log in <a href="login.php">here</a></small>
    </form>

<?php require 'footer.php' ?>