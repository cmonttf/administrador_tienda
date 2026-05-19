<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;

/**
 * Data Transfer Object (DTO) para representar un Producto.
 *
 * Este DTO encapsula la información necesaria para la creación o
 * manipulación de un producto dentro del sistema, asegurando
 * tipado fuerte y una estructura clara de datos.
 *
 * @author Camilo Montt <cmonttf@gmail.com>
 * @package App\DTO
 */
class ProductoDTO extends BaseDTO
{
    /**
     * Constructor del DTO Producto.
     *
     * @param string $nombre      Nombre del producto.
     * @param int    $precio      Precio de venta del producto.
     * @param string $descripcion Descripción detallada del producto.
     * @param int    $stock       Cantidad disponible en inventario.
     * @param int    $costo       Costo interno del producto.
     * @param UploadedFile $imagen      Ruta o nombre de la imagen asociada al producto.
     */
    public function __construct(
        public string $nombre,
        public int $precio,
        public string $descripcion,
        public int $stock,
        public int $costo,
        public UploadedFile $imagen
    )
    {}

    /**
     * Crea una instancia del dto a partir de un arreglo asociativo.
     *
     * @param array $dato Datos de un producto asociados al dto.
     *
     * @return ProductoDTO Retorna un dto asociativo.
     */
    public static function fromArray(array $dato): self
    {
        return new self(
            nombre: self::campoObligatorio($dato, "nombre"),
            precio: self::campoObligatorio($dato, "precio"),
            descripcion: self::campoObligatorio($dato, "descripcion"),
            stock: self::campoObligatorio($dato, "stock"),
            costo: self::campoObligatorio($dato, "costo"),
            imagen: self::campoObligatorio($dato, "imagen")
        );
    }
}
