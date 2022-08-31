<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>    
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
    </head>
<header>
    <h1>Cabecera de mi documento</h1>
    <h2>Libros pdf</h2>
  </header>
    <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>                                        
										<th>Categoria</th>
										<th>Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($libros as $libro)
                                        <tr>  
                                            <td>{{ $libro->id }}</td>                                                                         
											<td>{{ $libro->categoria->name }}</td>
											<td>{{ $libro->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                              <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
              Desarrolloweb.com
            </p>
        </td>
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
  </footer>
  <div id="content">
    <p>
      Lorem ipsum dolor sit...
    </p><p>
    Vestibulum pharetra fermentum fringilla...
    </p>
    <p style="page-break-before: always;">
    Podemos romper la página en cualquier momento...</p>
    </p><p>
    Praesent pharetra enim sit amet...
    </p>
  </div>
</body>
</html>