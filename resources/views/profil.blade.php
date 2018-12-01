<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ali Crud</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="<?php echo asset('bootstrap-4.1.3-dist/css/bootstrap.css');?>" rel="stylesheet"/>
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
                    Data Profil
                </div>
                <a class="btn btn-primary" href="<?php echo route('profil.create');?>">Tambah Data</a><br><br>
                <a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
                <a href="{{ URL::to('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
                <a href="{{ URL::to('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>DoB</th>
                        <th>Telepon</th>
                        <th>Gender</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                    $no=1;
                    foreach ($profil_model as $key=>$value){

                    ?>
                    <tr>
                        <td><?php echo $no++;?> </td>
                        <td><?php echo $value->nama;?> </td>
                        <td><?php echo $value->email;?></td>
                        <td><?php echo $value->dob;?> </td>
                        <td><?php echo $value->telepon;?> </td>
                        <td><?php echo $value->gender;?> </td>
                        <td><?php echo $value->alamat;?> </td>
                        <td>
                            <a href="<?php echo route('profil.edit', $value->id);?>">Edit</a>
                            &nbsp; &nbsp;
                            <form action="<?php echo route('profil.destroy', $value->id);?>" method="post" style="display: inline-block;">
                                <!-- token here -->
                                <?php echo csrf_field()?>
                                <?php echo method_field('DELETE')?>
                                <a href="javascript:;" onclick="confirm_delete(this.parentNode)"> Hapus</form>
                        </td>
                    </tr>
                    <?php
                     }
                     ?>    
                </table>
            </div>
        </div>

        <script type="text/javascript">
        function confirm_delete(form){
            c= confirm("Hapus Data?");
            if(c== true){
                form.submit();
            }
            else{
                //do nothing
            }
        }
        </script>
    </body>
</html>
