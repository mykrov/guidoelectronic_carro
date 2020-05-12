º@component('mail::message')

# Gracias por preferirnos.

Pedido Numero: {{$venta->idventas}}

#Detalle:

<table class="table" style="width:100%;  align:center;">
    <tr>
        <thead>
            <td style="width:30%">Producto</td>
            <td style="width:20%">Cantidad</td>
            <td style="width:20%">Precio</td>
            <td style="width:10%">IVA</td>
            <td style="width:10%">Total</td>
        </thead>
        <tbody>
            @foreach ($array as $item)
            <tr>
                <td>{{$item['nombre']}}</td>
                <td>x {{ $item['cantidad']}}</td>
                <td>${{round($item['precio'],2)}}</td>
                <td>{{$item['gr_iva']}}</td>
                <td>${{round(((floatval($item['precio'])*floatval($item['cantidad']))*0.12)+floatval($item['precio'])*floatval($item['cantidad']),2)}}</td>
            </tr>
            @endforeach
        </tbody>
    </tr>
</table>

<br>
SubTotal: ${{$venta->subtotal}}
IVA: ${{$venta->iva}}.<br>
Total: <strong>${{$venta->total}}.<strong><br>

Fecha:{{$venta->fecha}}.<br> 

{{ config('app.name') }}
@endcomponent
