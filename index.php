<?php
  session_start();
  include($_SERVER['DOCUMENT_ROOT'].'/ys/classes/config.php');
  Protect::mustNotBeLoggedIn();
//   dd::show($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yellow-stone: Klimles</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Include FontAwesome-->
    <script src="https://use.fontawesome.com/87e743cd60.js"></script>
    <!-- Include jQuery UI-->
    <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Main styles-->
    <link rel="stylesheet" href="http://<?= PUBLIC_ROOT ?>assets/css/mainstyles.css">

    <!-- Include datatables-->
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col s12 m6 offset-m3 center-align card">
            <h1>Yellow-Stone</h1>
            <div class="card-action">Login om verder te gaan</div>
            <form class='login_form col s12' method='POST'>
                <!-- Email row -->
                <div class="row">
                    <div class="input-field">
                        <input type="email" class="form-control" id="inputEmail" name='email'>
                        <label for="inputEmail">Email</label>
                    </div>
                </div>
                <!-- Password row -->
                <div class="row">
                    <div class="input-field">
                        <input type="password" class="form-control" id="inputPassword" name='password'>
                        <label for="inputPassword">Password</label>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn waves-effect waves-light">Log in</button>
                </div>
            </form>
        </div>
        <!-- <div class="col m6 s12 text-center">
            <h1>Yellow-stone</h1>
            <div class="card">
                <div class="card-header">
                    <span class='lead'>Login om verder te gaan</span>
                </div>
                <div class="card-body">
                    <p class='login'>
                        <form class='login_form' method='POST'>
                            <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" name='email' placeholder="Email">
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword" name='password' placeholder="Password">
                            </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-10 ml-auto">
                                <button type="submit" class="btn btn-primary btn-block">Log in</button>
                            </div>
                            </div>
                        </form>
                    </p>
                    </div>
                    <div class="card-footer text-muted text-right">
                        <a href="#" class="forgot-password"><small>Wachtwoord vergeten?</small></a>
                    </div>
                
            </div> -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.login_form').on('submit',function(e){
            e.preventDefault();
            var form_data = $(this).serializeArray();
            $.ajax({
                method: 'POST',
                url: 'handlers/loginHandler.php',
                data: form_data
            }).done(function(result){
                console.log(result);
                $('.login_form .alert ').remove();
                if(!result){
                    $('.login_form').prepend('<?= Bootstrap::Alert("Er ging helaas iets mis. Probeer het nog eens.", "red")?>');
                }else{
                    $('.login_form').prepend('<?= Bootstrap::Alert("Je bent succesvol ingelogd. Je wordt binnen enkele seconden doorgestuurd.", "teal white-text")?>');
                    window.setTimeout(function(){
                        location.reload();
                    }, 2000);
                }
            });
        });
    });
</script>
</body>
</html>
