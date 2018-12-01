<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Edit</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?php echo asset('bootstrap-4.1.3-dist/css/bootstrap.css')?>">
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
                font-size: 60px;
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
                margin-bottom: 0px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position">
            <div class="content">
                <div class="title m-b-md">
                    Edit
                </div>

                <div class="content">
                    <form action="<?php echo route('profil.update', $profil_model->id)?>" method="post" onsubmit="return validateForm()">
                        <div class="form-group">

                        <!-- token here -->
                        <?php echo csrf_field()?>
                        <?php echo method_field('PATCH')?>

                        Nama 
                        <input type="text" name="profil_nama" value="<?php echo $profil_model->nama?>" class="form-control" /> <br>
                        {!! $errors->first('profil_nama','<span style="color: red">:message</span>') !!} 

                        Email 
                        <input type="email" name="profil_email" value="<?php echo $profil_model->email?>" class="form-control"/> <br>
                        {!! $errors->first('profil_email','<span style="color: red">:message</span>') !!} 

                        Date of Birth 
                        <input type="text" name="profil_dob" id="datepicker" value="<?php echo $profil_model->dob?>" class="form-control"/> <br>
                        {!! $errors->first('profil_dob','<span style="color: red">:message</span>') !!} 

                        No. Telepon 
                        <input type="text" pattern="[0-9]+" name="profil_telepon" value="<?php echo $profil_model->telepon?>" class="form-control"/> <br>
                        {!! $errors->first('profil_telepon','<span style="color: red">:message</span>') !!}

                        Jenis Kelamin
                        <select name="profil_gender" class="form-control" onsubmit="return validateForm()">
                            <option value="<?php echo $profil_model->gender?>"
                                <?php if(!isset($profil_model->gender)) echo "selected" ?> disabled></option>

                            <option value="male" <?php if (isset($profil_model->gender)) if ($profil_model->gender == "male" ) echo "selected" ?>>
                                male</option>
                            <option value="female" <?php if (isset($profil_model->gender)) if ($profil_model->gender == "female" ) echo "selected" ?>>
                               female</option>
                        </select>

                        Alamat 
                        <input type="text" name="profil_alamat" value="<?php echo $profil_model->alamat?>" class="form-control"/> <br>
                        {!! $errors->first('profil_alamat','<span style="color: red">:message</span>') !!}
                        
                        <input type="submit" value="submit" class="btn btn-primary">
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
