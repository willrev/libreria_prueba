@extends('layouts.app')

@section('template_title')
    Libro
@endsection

@section('content')


    <!-- Barra de busqueda -->
        <div class="container">

            <h3>Buscar Libro</h3>

                <div class="col-md-6">

                        <form action="{{route('libros.index')}}" method="get">

                            <div class="form-row">

                                <div class="col-sm-4 my-1">

                                    <input type="text" class="form-control" name="text" value="">
                                
                                </div>


                                <div class="col-auto my-1">

                                    <input type="submit" class="btn btn-primary" value="Buscar" >

                                </div>

                            </div>

                        </form>

                </div>

        </div>
    <!-- Fin de barra -->


    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Libro') }}
                            </span>

                            <!-- /***Select format***/ -->

                                <!-- /**Boton para ver pdf****/ -->
                            <div class="float-right">
                                    <a href="{{ route('libros.pdf') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                        {{ __('Ver Documento en PDF') }}
                                    </a>
                                </div>

                                <!-- /**Boton para descargar pdf****/ -->
                                <div class="float-right">
                                    <a href="{{ route('libros.descargar-pdf') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                        {{ __('Descargar formato PDF') }}
                                    </a>
                                </div>

                                <!-- /****Boton para descargar excel****/ -->
                                <div class="float-right">                            
                                    <a href="{{ route('libro.exportExcel') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                        {{ __('Exportar Excel') }}</a>                            
                                </div>

                                 <!-- /****Formulario para importar archivo excel****/ -->
                                 <div class="float-right">     
                                            @if (isset($errors) && $errors->any())
                                    <div class="alert alert-danger" role="alert">
                                             @foreach ($errors->all() as $error)
                                            {{$error}}
                                            @endforeach
                                    </div>
                                         @endif                       
                                    <form action="{{ route('libro.importExcel') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                                <input type="file" name="file">
                                                <button class="">Importar Datos</button>                                     </form>                            
                                </div>

                                <div class="float-right">
                                    <a href="{{ route('libros.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                        {{ __('Create New') }}
                                    </a>
                                </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Categorias</th>
										<th>Name</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($libros as $libro)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $libro->categoria->name }}</td>
											<td>{{ $libro->name }}</td>
                                            <td>
                                                <form action="{{ route('libros.destroy',$libro->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('libros.show',$libro->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('libros.edit',$libro->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $libros->links() !!}
            </div>
        </div>
    </div>
    
@endsection
