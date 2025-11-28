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
        $response = new StdResponse("Listado de los productos.");

        try {
            $resultado = $this->productoService->obtenerListadoProductos();
        } catch (Exception $e) {
            $response->status = false;
            $response->message = "Error inesperado: {$e->getMessage()}";
            Log::error($response->message);

            JSONResponse::send($response);
        }

        return view("admin.products.index", [
            "products" => $resultado
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.products.create", [
            "errors" => collect()
        ])->render();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
