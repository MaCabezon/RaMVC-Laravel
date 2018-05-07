<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <link type="text/css" rel="stylesheet" href="{{ asset('css/Login.css') }}" />

         <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
      <link href="{{ asset('css/webService.css') }}" rel="stylesheet">

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="{{ asset('js//bootstrap.min.js') }}"></script>
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
                            <form role="form" action="{{ route('login') }}" method="POST">
                              @csrf
                                <div class="form-group">
                                    <label for="email"><span class="glyphicon glyphicon-user"></span> Email</label>
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="Enter email">

                                    @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="password"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  id="password" name="password" placeholder="Enter password">
                                    @if ($errors->has('password'))
                                          <span class="invalid-feedback">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif
                                </div>
                                <button type="submit" class="btn btn-success btn-block" name="login"><span class="glyphicon glyphicon-off"></span>Login</button>
                                <a class="btn btn-block btn-social btn-google" href="{{ route('redirectSocialLite', ['provider' => 'google']) }}">
                                    <i class="btn btn-lg waves-effect waves-light btn-block googles"></i> Iniciar sesión con correo Google
                                </a>
                            </form>
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
