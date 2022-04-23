<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Celular</th>
        </tr>
    </thead>
    <tbody>
        @foreach($proveedor as $proveedores)
        <tr>
            <td>{{ $proveedores -> id_proveedor }}</td>
            <td>{{ $proveedores -> nombre_proveedor }}</td>
            <td>{{ $proveedores -> celular_proveedor }}</td>
        </tr>
        @endforeach
    </tbody>
</table>