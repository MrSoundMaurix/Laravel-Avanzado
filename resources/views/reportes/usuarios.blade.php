<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title class="user">USUARIOS PDF</title>
</head>
<body>
    <h2 class="user" style="background-color: red">Listado de usuarios</h2>
<style>
.user{
    color: white;
}
th{
background-color: black;
color: white;
}
</style>

        <table border="1">
                <thead>
              <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Fecha creacion </th>
                    <th scope="col">Ultima actualizacion</th>
                    <th scope="col">Rol</th>

              </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $us)
                        <tr>
                            <th scope="row">{{$us->name}}</th>
                            <td>{{$us->email}}</td>
                            <td>{{$us->created_at}}</td>
                            <td>{{$us->updated_at}}</td>
                            <td>

                                     @if (count($us->roles) > 0)
                                        <ul class="list-group">
                                            @foreach ($us->roles as $rol)
                                                <li class="list-group-item">{{$rol->display_name}}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <strong>El usuario no tiene roles registrados</strong>
                                        </div>
                                    @endif


                            </td>

                        </tr>
                    @endforeach
                </tbody>
                </table>

    

   
</body>
</html>