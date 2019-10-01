@component('mail::message')

# Solicitud de Recuperacion de Contraseña.

#De click en el Siguiente enlace para cambio de contraseña:

@component('mail::button', ['url' => $link])
Cambio de Contraseña
@endcomponent
 
<br>

@endcomponent
