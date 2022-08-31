<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Genero</th>
        <th>Nombre</th>
        <th>Creado</th>
        <th>Modificado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($libro as $libros)
        <tr>
            <td>{{ $libros->id  }}</td>
            <td>{{ $libros->categoria->name }}</td>
            <td>{{ $libros->name }}</td>
            <td>{{ $libros->created_at }}</td>
            <td>{{ $libros->updated_at }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
