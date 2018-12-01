<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Create</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?php echo asset('bootstrap-4.1.3-dist/css/bootstrap.css')?>">
        <link rel='stylesheet' id='admin-css'  href='admin.css' type='text/css' media='all' />
        <link rel='stylesheet' id='colors-fresh-css'  href='colors-fresh.css' type='text/css' media='all' />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position">
            

            <div class="content">
                <div class="title m-b-md">
                    CRUD
                </div>

                <div class="content">
                    <form  method="post" name="myForm" action="{{URL::to('/send')}}" id="inputform" onsubmit="return validateForm()">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" class="form-control" />
                        Nama
                        <input type="text" name="nama" if value=" @if (isset($nama)) {{ $nama }} @endif" class="form-control" onsubmit="return validateForm()"/> <br>
                        
                        Email
                        <input type="email" name="email" value="@if (isset($email)) {{ $email }} @endif" class="form-control" onsubmit="return validateForm()"/><br>
                        
                        Date of Birth
                        <input type="text" name="dob" id="datepicker" value="@if (isset($dob)) {{ $dob }} @endif" class="form-control" onsubmit="return validateForm()"/><br>
                        
                        Telepon
                        <input type="text" pattern="[0-9]+" name="telepon" value="@if (isset($telepon)) {{ $telepon }} @endif" class="form-control" onsubmit="return validateForm()"/><br>
                        
                        Jenis Kelamin
                        <select name="--gender--" class="form-control" onsubmit="return validateForm()">
                            <option @if(!isset($gender)) {{"selected"}}  @endif selected disabled>--gender--</option>
                            <option value="male" @if (isset($gender)) @if ($gender == "male" ) {{"selected"}} @endif @endif>male</option>
                            <option value="female" @if (isset($gender)) @if ($gender == "female" ) {{"selected"}} @endif @endif>female</option>
                        </select> <br>
                        
                        Alamat
                        <textarea name="alamat" cols="30" class="form-control" onsubmit="return validateForm()" rows="10">@if (isset($alamat)) {{ $alamat }} @endif</textarea> <br>

                        @if (!isset($nama))
                        <a class="btn btn-warning" onclick="document.getElementById('inputform').reset();">Reset</a>
                        <input type="submit" name="submit" value="submit" class="btn btn-success">
                        @endif
                      
                    </form>
                </div>
            </div>
        </div>

        <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
        <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
        <script>
            $(function(){
                $( "#datepicker" ).datepicker();

                $("#icon").click(function() { 
                    $("#datepicker").datepicker( "show" );
                })
            });
        </script>


        <script>

        function validate(evt) {
          var theEvent = evt || window.event;

          // Handle paste
          if (theEvent.type === 'paste') {
              key = event.clipboardData.getData('text/plain');
          } else {
          // Handle key press
              var key = theEvent.keyCode || theEvent.which;
              key = String.fromCharCode(key);
          }
          var regex = /[0-9]|\./;
          if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
          }
        }

        function validateForm() {
            var nama = document.forms["myForm"]["nama"].value;
            var email = document.forms["myForm"]["email"].value;
            var dob = document.forms["myForm"]["dob"].value;
            var telepon = document.forms["myForm"]["telepon"].value;
            var gender = document.forms["myForm"]["--gender--"].value;
            var alamat = document.forms["myForm"]["alamat"].value;
            if (nama == "" || email == "" || dob == "" || telepon == "" || gender == "" || alamat == "") {
                alert("semua form harus diisi");
                return false;
            if(empty($telepon)){
                $msg ='<span class="error"> Please enter a value</<span>';
            }    else if(!is_numeric($telepon)){
                $msg='<span class="error"> Data entered was not numeric</span>';
            }
                else if(strlen($telepon)!=6){
                $msg='<span class="error">  The number entered was not 6 digits long</<span>';
                }
            }
           
            else
            {
                var myform = document.getElementById("myForm");
                var fd = new FormData(myForm );

                    $.ajax({
                    type: 'post',
                    url: '/send',
                    data: fd,
                    success: function(data) {
                        alert(data);
                    }
                });
            }
        }
        </script>
    </body>
</html>
