<?php require 'header.php'; ?>

    <title>Llog-in</title>
  </head>
  <body class="text-center">

    <form class="form-signin" method="POST" action="loginLogic.php">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email Adress" required autofocus>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-warning btn-block" name="submit" type="submit">Sign in</button>

      <small>If you aren't registered. Sign up <a href="signup.php">here</a></small>
    </form>

<?php require 'footer.php' ?>