<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
   @include('layouts.css')
   <style>
    .hide{
        display: none;
    }
   </style>
</head>
<body>
    <section class="login pt-5">
        <div class="container pt-5">
            <div id="errors-list"></div>
            <div class="log-in pt-5">
                <div class="card  p-4 m-auto" style="width: 50%; box-shadow: 0 0 8px -5px;">
                    <div class="card-header" style="display: flex;justify-content: space-evenly;">
                        <div class="log">
              
                            <input type="radio" style="display: none" class="btn-check" checked name="options"  id="btn-check-login" autocomplete="off">
                            <label style="width: 235px" class="btn btn-outline-primary" for="btn-check-login">LOGIN </label><br>
                            
                        </div>
                        <div class="log-out">
                            <input style="display: none" type="radio"  class="btn-check"   name="options" id="btn-check-logout" autocomplete="off">
                            <label style="width: 235px" class="btn btn-outline-primary" for="btn-check-logout">REGISTER </label><br>
                            
                        </div>
                    </div>
                    <div class="card-body">
                       <div class="form-register hide">
                        <form method="POST" id="handleRegisterAjax" action="{{route('register')}}" name="postform" >
                            @csrf
                            <div class="form-group">
                                <label for="#username">Username</label>
                                {!! Form::text('username', old('username'), ["class" => 'form-control' , "placeholder" => 'username' , 'required', 'id' =>'username']) !!}
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="#password">Password</label>
                                {!! Form::password('password',  ["class" => 'form-control' , "placeholder" => 'username' , 'required', 'id' =>'password']) !!}
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="#confirm">confirm password</label>
                                {!! Form::password('confirm_password',  ["class" => 'form-control' , "placeholder" => 'username' , 'required', 'id' =>'confirm']) !!}
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary " style="width: 100%">Register</button>
                              </div>
                        </form>
                       </div>
                        <div class="form-login ">
                            <form method="post" id="handleAjax" action="{{route('dologin')}}" name="postform" >
                                @csrf
                                <div class="form-group">
                                    <label for="#username">Username</label>
                                    {!! Form::text('username', old('username'), ["class" => 'form-control' , "placeholder" => 'username' , 'required']) !!}
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="#username">Password</label>
                                    {!! Form::password('password',  ["class" => 'form-control' , "placeholder" => 'username' , 'required']) !!}
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary " style="width: 100%">LOGIN</button>
                                  </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $(function() {
        // handle submit event of form
          $(document).on("submit", "#handleAjax", function() {
            var e = this;
            // change login button text before ajax
            $(this).find("[type='submit']").html("LOGIN...");
    
            $.post($(this).attr('action'), $(this).serialize(), function(data) {
    
              $(e).find("[type='submit']").html("LOGIN");
              if (data.status) { // If success then redirect to login url
                window.location = data.redirect_location;
              }
            }).fail(function(response) {
                // handle error and show in html
              $(e).find("[type='submit']").html("LOGIN");
              $(".alert").remove();
              var erroJson = JSON.parse(response.responseText);
              for (var err in erroJson) {
                for (var errstr of erroJson[err])
                  $("#errors-list").append("<div class='alert alert-danger'>" + errstr + "</div>");
              }
    
            });
            return false;
          });
        });


       
      </script>
       <script>
        $(function(){
         
          $(document).on("submit","#handleRegisterAjax",function(){
                var e=this;
           
                $(this).find("[type='submit']").html("REGISTER...");
                $.post($(this).attr('action'),$(this).serialize(),function(data){
                  
                  $(e).find("[type='submit']").html("REGISTER");
                  if(data.status){
                    alert(data.msg)
                    window.location=data.redirect_location;
                  }
                  
                }).fail(function(response) {
                 
                  $(e).find("[type='submit']").html("LOGIN");
                  $(".alert").remove();
                  var erroJson = JSON.parse(response.responseText);
                  for (var err in erroJson) {
                    for (var errstr of erroJson[err])
                    $("[name='" + err + "']").after("<div class='alert alert-danger'>" + errstr + "</div>");
                  }
    
                });
            return false;
          });
    
        });
      </script>
      <script>
        $(function() {
        // handle submit event of form
          $(document).on("click", "#btn-check-logout", function() {
            $('.form-login').addClass('hide');
            $('.form-register').removeClass('hide');
          });
        });
        $(function() {
        // handle submit event of form
          $(document).on("click", "#btn-check-login", function() {
            $('.form-register').addClass('hide');
            $('.form-login').removeClass('hide');
          });
        });


         
      </script>
</body>
</html>