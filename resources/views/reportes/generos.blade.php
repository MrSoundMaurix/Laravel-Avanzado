<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title class="user">USUARIOS PDF</title>
</head>
<body>
    <h2 class="user" style="background-color: red">Listado de Géneros</h2>
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
                    <th scope="col">Fecha creacion </th>
                    <th scope="col">Ultima actualizacion</th>

              </tr>
                </thead>
                <tbody>
                    @foreach ($generos as $gen)
                        <tr>
                            <th scope="row">{{$gen->nombre}}</th>
                            <td>{{$gen->created_at}}</td>
                            <td>{{$gen->updated_at}}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
                </table>

    

   
</body>
</html>