<?php

namespace App\Http\Controllers;

use App\Ventas;
use App\Compras;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Usuario;
use App\Categorias;
use App\Familias;
use App\Marca;
use App\Http\Models\Producto;
use PhpParser\Node\Stmt\TryCatch;
use App\Tipo_Cliente;

// Controlador que manejas las peticiones para sincronizar datos entre la base de datos
// ADM del cliente y la base de datos del carro de compra.

class ApiController extends Controller
{
    //obtener las cabeceras y detalles del pedido.
    public function getPedidos()
    {
        DB::enableQueryLog();
        // obtiene las ventas
        $ventas = DB::table('ventas')
            ->where('estado', '=', 'A')
            ->where('estadoPago', '=', 'APROBADO')
            ->orWhere('estadoPago', '=', 'Por Acordar')
            ->get();

        // crea array para retornar
        $ids = [];
        //agrega datos al array
        foreach ($ventas as $venta) {
            array_push($ids, $venta->idventas);
        }
        $detalles = DB::table('compras')->whereIn('idventa', $ids)->get();
        // retorna
        return response()->json(['status' => 'OK', 'pedidos' => $ventas, 'detalles' => $detalles]);
    }

    //obtener los usuarios por una fecha dada.
    public function getUsuarios($fecha)
    {
        $usuarios = DB::table('usuario')->where('ingreso', '=', $fecha)->get();       
        return response()->json(['status' => 'OK', 'fecha' => $fecha, 'usuariosw' => $usuarios]);
    }

    //añadir categoria
    public function addCategoria(Request $request)
    {
        $categ = [];
        // recorre la lista de categorias
        foreach ($request->categorias as $key => $value) {
            // verifica que no exista registro similar
            $verify = DB::table('categoria')->where('idcategoria', '=', $value['idcategoria'])->count();

            if ($verify == 0) {
                // graba la categoria
                try {
                    $cate = new Categorias();
                    $cate->nombre = $value["nombre"];
                    $cate->idcategoria = $value["idcategoria"];
                    $cate->estado = "A";
                    $cate->save();
                    // agrega al array
                    array_push($categ, ['categoria' => $value['idcategoria'], 'status' => 'OK']);
                } catch (\Throwable $th) {
                    return response()->json($th);
                }
            } else {
                array_push($categ, ['categoria' => $value['idcategoria'], 'status' => 'NoSaved']);
            }
        }
        //retorna el array
        return response()->json($categ);
    }

    //añadir familia.
    public function addFamilia(Request $request)
    {
        //array para retornar
        $famli = [];
        foreach ($request->familias as $key => $value) {
            // verifica que no exista registro similar
            $verify = DB::table('familia')->where('idfamilia', '=', $value['idfamilia'])->count();

            if ($verify == 0) {
                try {
                    // crea y almacena familia
                    $fami = new Familias();
                    $fami->nombre_familia = trim($value["nombre_familia"]);
                    $fami->idfamilia = $value["idfamilia"];
                    $fami->idcategoria = $value["idcategoria"];
                    $fami->estado = "A";
                    $fami->save();
                    // agrega al array
                    array_push($famli, ['familia' => $value['idfamilia'], 'status' => 'OK']);
                } catch (\Throwable $th) {
                    return response()->json($th);
                }
            } else {
                array_push($famli, ['familia' => $value['idfamilia'], 'status' => 'NoSaved']);
            }
        }
        // retorna el array
        return response()->json($famli);
    }

    //añadir Marcas.
    public function addMarca(Request $request)
    {
        // array para retornar
        $marks = [];
        foreach ($request->marcas as $key => $value) {
            // verifoca que no exista el rigistro
            $verify = DB::table('marca')->where('idmarca', '=', $value['idmarca'])->count();

            if ($verify == 0) {
                try {
                    // crea y guarda Marca
                    $marca = new Marca();
                    $marca->nombre_marca = $value["nombre"];
                    $marca->idmarca = $value["idmarca"];
                    $marca->estado = $value["estado"];
                    $marca->save();
                    // agrega al array
                    array_push($marks, ['marca' => $value['idmarca'], 'status' => 'OK']);
                } catch (\Throwable $th) {
                    return response()->json($th);
                }
            } else {
                array_push($marks, ['marca' => $value['idmarca'], 'status' => 'NoSaved']);
            }
        }
        // retorna el array
        return response()->json($marks);
    }

    //añadir usuarios
    public function addUsuarios(Request $request)
    {
        // array par retornar
        $ruc = [];
        foreach ($request->usuarios as $key => $value) {

            try {
                // verifica que no exista el registro
                $verify = DB::table('usuario')->where('numero_identificacion', '=', $value['numero_identificacion'])->count();

                if ($verify == 0) {
                    // crea usuario y lo graba
                    $user = new Usuario();

                    $user->activacion = 'habilitar';
                    $user->nombre = $value['nombre'];
                    $user->apellido = $value['apellido'];

                    if ($value['correo'] == null) {
                        $user->correo = "";
                    } else {
                        $user->correo = $value['correo'];
                    }

                    if ($value['contrasenia'] == null || $value['contrasenia'] == '') {
                        $user->correo = "";
                        $user->contrasenia = "";
                    } else {
                        $user->correo = $value['correo'];
                        $user->contrasenia = $value['contrasenia'];
                    }

                    $user->identificacion = $value['identificacion'];
                    $user->numero_identificacion = $value['numero_identificacion'];
                    $user->direccion = $value['direccion'];
                    $user->referencia = $value['referencia'];
                    $user->pais = $value['pais'];
                    $user->ciudad = $value['ciudad'];
                    $user->codigo_postal = $value['codigo_postal'];
                    $user->celular1 = $value['celular1'];
                    $user->celular2 = $value['celular2'];
                    $user->imagen = $value['imagen'];
                    $user->img_servicios = $value['img_servicios'];
                    $user->img_representante = $value['img_representante'];
                    $user->img_cedula = $value['img_cedula'];
                    $user->empresa = $value['empresa'];
                    $user->ruc = $value['ruc'];
                    $user->idtipo = $value['idtipo'];
                    $user->ingreso = $value['ingreso'];
                    $user->save();
                    // Agrega el ruc al array
                    array_push($ruc, ['identify' => $value['numero_identificacion'], 'status' => 'OK']);
                } else {
                    array_push($ruc, ['identify' => $value['numero_identificacion'], 'status' => 'NoSaved']);
                }
            } catch (\Throwable $th) {
                return response()->json($th);
            }
        }
        // retorna el array
        return response()->json($ruc);
    }

    //añadir productos
    public function addProductos(Request $request)
    {
        //array para retornar
        $codes = [];

        foreach ($request->productos as $key => $value) {
            try {
                // verifica que no exista el registro 
                $verify = DB::table('producto')->where('idproducto', '=', $value['idproducto'])->count();

                if ($verify == 0) {
                    // crea y graba el roducto
                    $pro = new Producto();
                    $pro->idproducto = $value['idproducto'];
                    $pro->descripcion = $value['descripcion'];
                    $pro->estado = $value['estado'];
                    $pro->precio = $value['precio'];
                    $pro->precio_anterior = $value['precio_anterior'];
                    $pro->precio2 = $value['precio2'];
                    $pro->precio3 = $value['precio3'];
                    $pro->precio4 = $value['precio4'];
                    $pro->precio5 = $value['precio5'];
                    $pro->total_con_iva = $value['total_con_iva'];
                    $pro->total_con_iva2 = $value['total_con_iva2'];
                    $pro->total_oferta_iva = $value['total_oferta_iva'];
                    $pro->total_oferta_iva2 = $value['total_oferta_iva2'];
                    $pro->imagen = $value['imagen'];
                    $pro->porcentaje_oferta = $value['porcentaje_oferta'];
                    $pro->iva = $value['iva'];
                    $pro->oferta = $value['oferta'];
                    $pro->idcategoria = $value['idcategoria'];
                    $pro->idfamilia = $value['idfamilia'];
                    $pro->idmarca = $value['idmarca'];
                    $pro->stock = $value['stock'];
                    $pro->costo_envio = $value['costo_envio'];
                    $pro->envio_gratuito = $value['envio_gratuito'];
                    $pro->recomendado = $value['recomendado'];
                    $pro->idcolor = $value['idcolor'];
                    $pro->Graba_Iva = $value['Graba_Iva'];

                    $pro->save();
                    // agrega el producto al array
                    array_push($codes, ['product' => $value['idproducto'], 'status' => 'Saved']);
                } else {
                    $producto = DB::table('producto')->where('idproducto', '=', $value['idproducto'])->first();
                    if ($producto->precio != $value['precio']) {
                        $producto->precio = $value['precio'];
                    } else {
                        # code...
                    }
                    array_push($codes, ['product' => $value['idproducto'], 'status' => 'NoSaved']);
                }
            } catch (\Throwable $th) {
                return $th;
            }
        }
        //retorna el array
        return response()->json($codes);
    }

    //Actualizar Datos de Productos
    public function updateProductos(Request $request)
    {

        // array para retornar
        $codes = [];

        foreach ($request->productos as $key => $value) {
            try {
                // obtiene la instancia del producto a modificar
                $proIns = Producto::find($value['idproducto']);

                if ($proIns != null) {
                    // actualiza los campos
                    $proIns->descripcion = $value['descripcion'];
                    $proIns->estado = $value['estado'];
                    $proIns->precio = $value['precio'];
                    $proIns->precio_anterior = $value['precio_anterior'];
                    $proIns->precio2 = $value['precio2'];
                    $proIns->precio3 = $value['precio3'];
                    $proIns->precio4 = $value['precio4'];
                    $proIns->precio5 = $value['precio5'];
                    $proIns->total_con_iva = $value['total_con_iva'];
                    $proIns->total_con_iva2 = $value['total_con_iva2'];
                    $proIns->total_oferta_iva = $value['total_oferta_iva'];
                    $proIns->total_oferta_iva2 = $value['total_oferta_iva2'];
                    $proIns->imagen = $value['imagen'];
                    $proIns->porcentaje_oferta = $value['porcentaje_oferta'];
                    $proIns->iva = $value['iva'];
                    $proIns->oferta = $value['oferta'];
                    $proIns->idcategoria = $value['idcategoria'];
                    $proIns->idfamilia = $value['idfamilia'];
                    $proIns->idmarca = $value['idmarca'];
                    $proIns->stock = $value['stock'];
                    $proIns->costo_envio = $value['costo_envio'];
                    $proIns->envio_gratuito = $value['envio_gratuito'];
                    $proIns->recomendado = $value['recomendado'];
                    $proIns->idcolor = $value['idcolor'];
                    $proIns->Graba_Iva = $value['Graba_Iva'];
                    // graba los cambios
                    $proIns->save();

                    array_push($codes, ['product' => $value['idproducto'], 'status' => 'Update']);
                } else {
                    array_push($codes, ['product' => $value['idproducto'], 'status' => 'NoFinded']);
                }
            } catch (\Throwable $th) {
                return $th;
            }
        }
        // retorna el array
        return response()->json($codes);
    }

    //actualizar estado de las Ventas
    public function updatePedidos(Request $request)
    {
        // array a retornar
        $codes = [];
        
        foreach ($request->pedidos as $key => $value) {
            try {
                //busca la compra
                $ventaIns = Ventas::find($value['idventas']);

                if ($ventaIns != null) {
                    // cambia el estado y guarda
                    $ventaIns->estado = 'P';
                    $ventaIns->save();
                    // agrega al array
                    array_push($codes, ['pedido' => $value['idventas'], 'status' => 'Update']);
                } else {
                    array_push($codes, ['pedido' => $value['idventas'], 'status' => 'NoFinded']);
                }
            } catch (\Throwable $th) {
                return $th;
            }
        }
        // retorna el array
        return response()->json($codes);
    }

    //tipos de clientes y precios
    public function clientePrecio(Request $request)
    {
        // array a retornar
        $codes = [];
        foreach ($request->clientePrecio as $key => $value) {

            try {
                // verifica que exista el registo
                $verify = DB::table('tipo_cliente')->where('tipo', '=', $value['TIPO'])->count();

                if ($verify == 1) {
                    // si existe le actualiza los campos
                    $tipoC = \App\Tipo_Cliente::where('tipo', $value['TIPO'])->first();
                    $tipoC->tipo = $value["TIPO"];
                    $tipoC->precio = $value["PRECIO"];
                    $tipoC->fecha = $value["FECHA"];
                    $tipoC->operador = $value["OPERADOR"];
                    $tipoC->save();
                    array_push($codes, ['tiposClientes' => $value['TIPO'], 'status' => 'Updated']);
                } else {
                    // si no, lo crea
                    $tipoCliente = new Tipo_Cliente();
                    $tipoCliente->tipo = $value['TIPO'];
                    $tipoCliente->precio = $value['PRECIO'];
                    $tipoCliente->fecha = $value['FECHA'];
                    $tipoCliente->operador = $value['OPERADOR'];
                    $tipoCliente->save();
                    array_push($codes, ['tiposClientes' => $value['TIPO'], 'status' => 'Created']);
                }
            } catch (\Throwable $th) {
                return response()->json(["error" => $th]);
            }
        }
        // retorna el resultado del array
        return response()->json($codes);
    }


    // verifica que exista un archivo de imagen con los  codigos de los productos
    // si existe , cambiará el estado del item a 'A' 
    public function disableItemNoImage()
    {
        $arrayImg = [];
        $nulos = [];
        $dir = public_path();

        foreach (glob($dir . "/assets/productos/*") as $filename) {

            $path_parts = pathinfo($filename);
            $imgbase = $path_parts['basename'];
            $nombre = explode('.', $imgbase);
            $nombre1 = $nombre[0];
            $producto = Producto::find($nombre1);
            if ($producto != null) {
                $producto->estado = 'A';
                $producto->save();
                $arrayImg[] = ['Procesado' => $producto['idproducto']];
            } else {
                $nulos[] = ['NoProcesado' => $nombre1];
            }
        }

        foreach (glob($dir . "/assets/productos/*.JPG") as $filename) {
            $file = realpath($filename);
            rename($file, str_replace(".JPG", ".jpg", $file));
        }

        // retorna los resultados
        return response()->json(['Nulos' => $nulos, 'Procesados' => $arrayImg]);
    }


    // verifica si hay cambio en los stock de productos
    public function stockProducto(Request $request)
    {
        // contadores
        $seMantiene = 0;
        $actualizado = 0;
        $noEncontrado = 0;

        foreach ($request->stock as $key => $value) {
            // busca el producto
            $producto = Producto::where('idproducto', '=', $value['ITEM'])->first();
            // verifica si hay necesidad de actualizar o no, y lo hace
            if ($producto != null) {
                if ($producto->stock != $value['STOCK']) {
                    $producto->stock = $value['STOCK'];
                    $producto->save();
                    $actualizado++;
                } else {
                    $seMantiene++;
                }
            } else {
                $noEncontrado++;
            }
        }

        // retorna el resultado
        return response()->json(['actualizados' => $actualizado, 'noEncontrado' => $noEncontrado, 'igual' => $seMantiene]);
    }

    // funcion no implementada
    public function sincUser(Request $r)
    {
        $users = $r['usuarios'];
        foreach ($users as $key => $value) {
            $usuario = Usuario::where('numero_identificacion', '=', $value['ruc'])->first();
        }
    }
}
