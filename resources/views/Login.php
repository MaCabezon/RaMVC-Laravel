<?php
if (isset($_POST['login']))
{
    $arrayUsuarios = [["usuario" => "administrador", "password" => "123admin123"],  ["usuario" => "lazaro.hernandez", "password" => "hernandez.lazaro"], ["usuario" => "manuel.masias", "password" => "masias.manuel"], ["usuario" => "juan.tortajada", "password" => "tortajada.juan"], ["usuario" => "loyda.alas", "password" => "alas.loyda"], ["usuario" => "larisa.hernandez", "password" => "hernandez.larisa"], ["usuario" => "sara.berbil", "password" => "berbil.sara"], ["usuario" => "elder.bolcaal", "password" => "bolcaal.edler"], ["usuario" => "efrain.salazar", "password" => "salazar.efrain"], ["usuario" => "abraham.fernandez", "password" => "fernandez.abraham"], ["usuario" => "invitado", "password" => ""]];

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    foreach ($arrayUsuarios as $key => $value)
    {

        if ($usuario == $value['usuario'] && $password == $value['password'])
        {
            session_start();
            $_SESSION['user'] = $usuario;

            header("refresh:0;url=../index.php");
        }
    }
}
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <link type="text/css" rel="stylesheet" href="../css/Login.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>

        <div class="container">

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog" >
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="padding:35px 50px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
                        </div>
                        <div class="modal-body" style="padding:40px 50px;">
                            <form role="form" action="Login.php" method="post">
                                <div class="form-group">
                                    <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
                                    <input type="text" class="form-control" id="usrname" name="usuario" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                                    <input type="password" class="form-control" id="psw" name="password" placeholder="Enter password">
                                </div>
                                <!--            <div class="checkbox">
                                              <label><input type="checkbox" value="" checked>Remember me</label>
                                            </div>-->
                                <button type="submit" class="btn btn-success btn-block" name="login"><span class="glyphicon glyphicon-off"></span> Login</button>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                            <a class="btn btn-block btn-social btn-google" href="{{ route('redirectSocialLite', ['provider' => 'google']) }}">
                                <i class="btn btn-lg waves-effect waves-light btn-block googles"></i> Iniciar sesión con correo Google
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {

                $("#myModal").modal();

            });
        </script>

    </body>
</html>
