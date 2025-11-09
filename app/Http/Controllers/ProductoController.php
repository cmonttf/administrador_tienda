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
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = new StdResponse("Listado de los productos.", true);

        try {
            $response->data = $this->productoService->obtenerListadoProductos();
        } catch (Exception $e) {
            $response->status = false;
            $response->message = "Error inesperado: {$e->getMessage()}";
            Log::error($response->message);
            JSONResponse::error($response);
        }

        JSONResponse::success($response);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
