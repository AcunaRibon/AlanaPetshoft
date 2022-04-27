<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Celular</th>
            <th>Fecha de creación</th>
            <th>Última actualización</th>
        </tr>
    </thead>
    <tbody>
        @foreach($proveedor as $proveedores)
        <tr>
            <td>{{ $proveedores -> id_proveedor }}</td>
            <td>{{ $proveedores -> nombre_proveedor }}</td>
            <td>{{ $proveedores -> celular_proveedor }}</td>
            <td>{{ $proveedores -> created_at }}</td>
            <td>{{ $proveedores -> updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>