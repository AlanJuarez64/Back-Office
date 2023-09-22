<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickHaul - Login</title>
  <link rel="stylesheet" href="{{asset('/css/style-login.css')}}">
  <header>

  </header>
</head>
<br>
<br>

<body>
  <section class="contenido-login">

    <form id="form-login" action="/login" method="POST">
        <h1>Inicio de Sesion</h1>
      <br>
      <br>
      @csrf

      <input type="email" id="email" name="email" placeholder="Ingrese su email" required>
      <input type="password" id="password" name="password" placeholder="Contraseña" required>

      <div>
        <button id="btn-login" type="submit">Iniciar sesión</button>
        <p class="advert" id="advert"></p>
      </div>
    </form>
  </section>

  
</body>

</html>