<?php
namespace App\Services;

use App\DTO\ActualizarProductoDTO;
use App\DTO\ListaProductoDTO;
use App\DTO\MensajeDTO;
use App\DTO\ProductoDTO;
use App\Helpers\ConstantesHelper;
use App\Helpers\ProductoHelper;
use App\Interfaces\ProductoInterface;
use Exception;
use Illuminate\Http\UploadedFile;

/**
 * Class ProductoService
 *
 * Servicio encargado de la lógica de negocio relacionada con los productos.
 * Actúa como capa intermedia entre el controlador y la capa de acceso a datos (DAO),
 * garantizando la transformación de los datos en objetos DTO y el manejo de errores.
 *
 * @author Camilo Montt <cmonttf@gmail.com>
 * @package App\Services
 */
class ProductoService
{
    /**
     * Inyección de dependencias del acceso a datos de productos.
     *
     * @param ProductoInterface $productoInterface Implementación del contrato de acceso a datos.
     */
    public function __construct(
        private ProductoInterface $productoInterface
    )
    {}

    /**
     * Obtiene y transforma el listado de productos en objetos DTO.
     *
     * Recupera la información desde la capa DAO mediante la interfaz `ProductoInterface`,
     * valida que existan resultados y transforma cada registro en una instancia de `ListaProductoDTO`.
     *
     * @throws Exception Si no se logra obtener ningún producto desde la base de datos.
     *
     * @return ListaProductoDTO[] Arreglo de objetos DTO representando los productos.
     */
    public function obtenerListadoProductos(): array
    {
        $datos = $this->productoInterface::obtenerListadoProductos();

        return array_map(
            fn($dato) => ListaProductoDTO::fromObject($dato),
            $datos
        );
    }

    /**
     * Guarda un nuevo producto en el sistema junto con su imagen asociada.
     *
     * Este método se encarga de:
     * - Construir un DTO con los datos del producto.
     * - Persistir el producto mediante la capa de acceso a datos.
     * - Almacenar la imagen del producto utilizando su identificador.
     *
     * @param array $dato Datos asociados a producto
     *
     * @return bool Retorna true si el producto y su imagen se guardan correctamente,
     *              false en caso de error.
     */
    public function guardarProductoNuevo(
        array $dato
    ): bool
    {
        $datos = ProductoDTO::fromArray($dato);

        $id = $this->productoInterface::guardarProductoNuevo($datos);

        return ProductoHelper::guardarImagen($dato["imagen"], $id);
    }

    /**
     * Obtiene y retorna la información de un producto a partir de su identificador.
     *
     * Este método consulta la capa de acceso a datos para recuperar un producto
     * específico. En caso de no existir registros asociados al ID proporcionado,
     * se lanza una excepción.
     *
     * @param int $id Identificador único del producto.
     *
     * @return ProductoDTO DTO que contiene los datos del producto solicitado.
     *
     * @throws Exception Si no se encuentran datos asociados al producto.
     */
    public function mostrarProductoPorId(int $id): ProductoDTO
    {
        $resultado = $this->productoInterface::obtenerProductoPorId($id);

        if (count($resultado) === ConstantesHelper::CERO) {
            throw new Exception("No se pudo obtener los datos del producto {$id}.");
        }

        $dato = $resultado[0];

        return new ProductoDTO(
            $dato->nombre,
            $dato->precioVenta,
            $dato->descripcion,
            $dato->stock,
            $dato->precioCosto,
            $dato->imagen
        );
    }

    public function borrarProductoPorId(int $id): bool
    {
        if ($this->productoInterface::existeProductiPorId($id) === ConstantesHelper::FALSO) {
            throw new Exception("El producto con id {$id} no existe.");
        }

        $imagen = $this->obtenerNombreImagen($id);

        ProductoHelper::borrarImagen($imagen, $id);

        return $this->productoInterface::eliminarProductoPorId($id);
    }

    /**
     * Actualiza la información de un producto existente.
     *
     * - Verifica si el producto existe en la base de datos.
     * - Si no existe, lanza una excepción.
     * - Si existe, transforma los datos recibidos a un DTO
     *   y ejecuta la actualización mediante el repositorio.
     *
     * @param array $dato Datos actualizados del producto.
     * @param int $id ID del producto a actualizar.
     *
     * @throws Exception Se lanza cuando el producto no existe.
     *
     * @return bool Retorna true si el producto fue actualizado correctamente.
     */
    public function actualizarProducto(array $dato, int $id): bool
    {
        if ($this->productoInterface::existeProductiPorId($id) === ConstantesHelper::FALSO) {
            throw new Exception("El producto con el id {$id} no existe.");
        }

        return $this->productoInterface::actualizarProducto(ActualizarProductoDTO::fromArray($dato, $id));
    }

    /**
     * Obtiene el nombre de la imagen asociada a un producto.
     *
     * Este método consulta la capa de acceso a datos para recuperar
     * la información de un producto específico y extrae el nombre
     * de la imagen asociada. Si el producto no existe, se lanza
     * una excepción.
     *
     * @param int $id Identificador único del producto.
     *
     * @return string Nombre del archivo de imagen del producto.
     *
     * @throws Exception Si no se encuentra el producto solicitado.
     */
    private function obtenerNombreImagen(int $id): string
    {
        $datos = $this->productoInterface::obtenerProductoPorId($id);

        if (count($datos) === ConstantesHelper::CERO) {
            throw new Exception("No se pudo obtener el producto con id {$id}.");
        }

        return $datos[0]->imagen;
    }
}
