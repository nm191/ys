<?php
  session_start();
  include($_SERVER['DOCUMENT_ROOT'].'/ys/classes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yellow-stone: Klimles</title>
    <!-- Include Bootstrap, jQuery & Tether-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
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
        <div class="col-6 ml-auto mr-auto text-center">
            <h1>Yellow-stone</h1>
            <div class="card">
                <div class="card-header">
                    <span class='lead'>Login om verder te gaan</span>
                </div>
                <div class="card-body">
                    <p class='login'>
                        <form>
                            <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
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
                
            </div>
        </div>
    </div>
</div>
</body>
</html>
