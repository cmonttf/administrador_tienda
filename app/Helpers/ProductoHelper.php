<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

/**
 * Helper para la gestión de imágenes de productos.
 *
 * Esta clase contiene métodos estáticos para guardar y eliminar
 * imágenes asociadas a productos dentro del directorio público.
 *
 * @author Camilo Montt <cmonttf@gmail.com>
 * @package App\Helpers
 */
class ProductoHelper
{
    /**
     * Guarda una imagen en el directorio público /img.
     *
     * - Verifica si el directorio existe.
     * - Si no existe, lo crea con permisos 0755.
     * - Mueve la imagen al directorio indicado.
     *
     * @param UploadedFile $imagen Archivo de imagen a guardar.
     * @return bool Retorna true si la imagen se guardó correctamente, false en caso contrario.
     */
    public static function guardarImagen(UploadedFile $imagen, int $id): bool
    {
        $ruta = public_path("img/productos/{$id}");

        if (!file_exists($ruta)) {
            mkdir($ruta, 0755, true);
        }

        if($imagen->move($ruta, $imagen->getClientOriginalName())){
            return true;
        }

        return false;
    }

    /**
     * Elimina una imagen y su carpeta asociada del directorio público.
     *
     * - Verifica si la imagen existe.
     * - Elimina el archivo del sistema.
     * - Si la carpeta queda vacía después de eliminar la imagen,
     *   también elimina el directorio del producto.
     *
     * @param string $imagen Nombre del archivo de imagen.
     * @param int $id ID del producto.
     *
     * @return bool Retorna true si la imagen fue eliminada correctamente.
     */
    public static function borrarImagen(string $imagen, int $id): bool
    {
        $rutaImagen = public_path("img/productos/{$id}/{$imagen}");

        // Verifica existencia de la imagen
        if (!file_exists($rutaImagen)) {
            return false;
        }

        // Elimina imagen
        if (!unlink($rutaImagen)) {
            return false;
        }

        // Ruta carpeta producto
        $rutaCarpeta = public_path("img/productos/{$id}");

        // Obtiene archivos restantes ignorando . y ..
        $archivos = array_diff(scandir($rutaCarpeta), ['.', '..']);

        // Si la carpeta está vacía, la elimina
        if (empty($archivos)) {
            rmdir($rutaCarpeta);
        }

        return true;
    }
}
