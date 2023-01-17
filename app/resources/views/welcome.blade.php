<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
    </style>
</head>

<body class="w3-theme-l5">
    <div class="w3-top">
     <div class="w3-bar w3-theme-d2 w3-left-align">
      <a href="/" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Login</a>
      <a href="/logout" class="w3-bar-item w3-button w3-right w3-padding-large w3-hover-white" title="Sair">
        Sair
      </a>
     </div>
    </div>

    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
          <!-- Profile -->
          <div class="w3-card w3-round w3-white">
            <div class="w3-container">
             <h1 class="w3-center">Logado com sucesso</h1>
             <p class="w3-center">Usuário: {{$username}}</p>
             <hr>
             <h2>Resposta da API</h2>
             <p>Status code: {{$status}}</p>
             <p>{{$body}}</p>
            </div>
          </div>
          <br>
    </div>
    <br>
    <footer class="w3-container w3-theme-d5">
      <p>Powered by Marcos Lauder</p>
    </footer>
    </body>
    </html>
