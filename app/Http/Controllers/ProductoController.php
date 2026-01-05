<?php

namespace App\Http\Controllers;

use App\Services\ProductoService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use StdJsonResponse\JSONResponse;
use StdJsonResponse\StdResponse;

/**
 * Class ProductoController
 *
 * Encargado de todas las operaciones de los productos.
 *
 * @author Camilo Montt <cmonttf@gmail.com>
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{
    public function __construct(
        private ProductoService $productoService
    )
    {}

    /**
     * Método que enlista los productos en un listado con algunos detalles
     *
     * @return string Listado de los productos.
     *
     * @throws Exception Lanza excepción cuando algo falla.
     */
    public function index(): string
    {
        try {
            $resultado = $this->productoService->obtenerListadoProductos();
        } catch (Exception $error) {
            return view("admin.error", ["error" => $error])->render();
        }

        return view("admin.products.index", [
            "products" => $resultado
        ])->render();
    }

    /**
     * Muestra la vista de creación de un nuevo producto.
     *
     * Este método renderiza el formulario utilizado para registrar un producto,
     * inicializando la colección de errores como vacía para evitar validaciones
     * inexistentes en la primera carga de la vista.
     *
     * @return string Vista renderizada del formulario de creación de productos.
     */
    public function create()
    {
        return view("admin.products.create", [
            "errors" => collect()
        ])->render();
    }

    /**
     * Procesa la solicitud de creación de un nuevo producto.
     *
     * Este método se encarga de:
     * - Validar los datos enviados desde el formulario.
     * - Delegar la lógica de negocio al servicio de productos.
     * - Retornar el listado de productos si la operación es exitosa.
     * - Manejar excepciones y mostrar una vista de error en caso de fallo.
     *
     * @param Request $request Objeto que contiene los datos de la solicitud HTTP.
     *
     * @return mixed Vista con el resultado de la operación.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => ['required', 'string'],
                'precio' => ['required', 'integer'],
                'descripcion' => ['required', 'string'],
                'stock' => ['required', 'integer'],
                'costo' => ['required', 'integer'],
                'imagen' => ['file']
            ]);

            $resultado = $this->productoService->guardarProductoNuevo(
                $request->input("nombre"),
                $request->input("precio"),
                $request->input("descripcion"),
                $request->input("stock"),
                $request->input("costo"),
                $request->file('imagen')
            );



            return $this->index();

        } catch (Exception $error) {
            return view("admin.error", ["error" => $error])->render();
        }
    }

    /**
     * Muestra el detalle de un producto específico.
     *
     * Este método obtiene la información de un producto a partir de su
     * identificador, delegando la lógica de negocio al servicio correspondiente.
     * En caso de error, se renderiza una vista de error.
     *
     * @param string $id Identificador del producto a mostrar.
     *
     * @return string Vista renderizada con el detalle del producto o la vista de error.
     */
    public function show(string $id)
    {
        try {
            $resultado = $this->productoService->mostrarProductoPorId($id);
        } catch (Exception $error) {
            return view("admin.error", ["error" => $error])->render();
        }

        return view("admin.products.show", ["producto" => $resultado, "id" => $id, "errors" => collect()])->render();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Elimina un producto a partir de su identificador.
     *
     * Este método delega la eliminación del producto a la capa de servicio.
     * Si la operación es exitosa, redirige al listado de productos mostrando
     * un mensaje de confirmación. En caso de error, se renderiza una vista
     * de error con el detalle de la excepción.
     *
     * @param string $id Identificador del producto a eliminar.
     *
     * @return string
     */
    public function destroy(string $id)
    {
        try {
            $resultado = $this->productoService->borrarProductoPorId($id);
        } catch (Exception $error) {
            return view("admin.error", ["error" => $error])->render();
        }

        return redirect()
            ->route('products.index')
            ->with('alert', "Se ha eliminado el producto {$resultado}");
    }
}
