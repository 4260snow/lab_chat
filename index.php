<!doctype html>
<html>
  <head>
    <title>Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
	<link href="css/assets/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/sign-in.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin w-100 m-auto">
  <form method="POST" action="main.php">
    <h1 class="h3 mb-3 fw-normal">Username</h1>

    <div class="form-floating">
      <input  type="text" maxlength=200 class="form-control"  name="name" id="username" placeholder="Username">
      <label for="floatingInput">Username</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
  </form>
</main>


    
  </body>
</html>
