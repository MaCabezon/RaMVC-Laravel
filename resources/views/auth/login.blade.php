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
                          <div id="gSignInWrapper">
                                <div id="customBtn" class="customGPlusSignIn">
                                    <span class="icon"></span>
                                    <a href="{{ route('redirectSocialLite', ['provider' => 'google']) }}" class="buttonText">Google</a>
                                  </div>
                            </div>
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
