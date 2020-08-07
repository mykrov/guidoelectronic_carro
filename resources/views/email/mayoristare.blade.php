<h1>Petición de Usuario Mayorista.</h1>
<div style="border: 2px solid #ccc; border-radius:1rem; padding-top:1rem;">
    <div style="padding-left: 1rem">
        <h3>Nombre: {{$datos['nombre']}}</h3>
        <h3>Apellido: {{$datos['apellido']}}</h3>
        <h3>Cedula/RUC: {{$datos['ruc']}}</h3>
        <h3>Correo: {{$datos['email']}}</h3>
        <h3>Dirección: {{$datos['dir']}} , {{$datos['dir2']}}</h3>
        <h3>Representante: {{$datos['repre']}},Identificación: {{$datos['idrepre']}}</h3>
        <br>
        <h2>Contacto</h2>
        <h3>Teléfonos: {{$datos['tlf1']}},{{$datos['tlf2']}}</h3>
    </div>
</div>
<div style="margin: auto; text-align: center;padding-top: 1rem;">
    <p>{{ config('app.name') }}</p>
</div>


