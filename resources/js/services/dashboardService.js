import axios from 'axios';

/*
|--------------------------------------------------------------------------
| SERVICIO DASHBOARD
|--------------------------------------------------------------------------
|
| Archivo encargado de consumir los endpoints relacionados
| al dashboard de la aplicación.
|
*/

/*
|--------------------------------------------------------------------------
| OBTENER DATOS DASHBOARD
|--------------------------------------------------------------------------
|
| Consume el endpoint del dashboard y retorna:
|
| - Productos con stock bajo
| - Cantidad total de productos
|
| Endpoint:
| GET /api/dashboard
|
| Retorna:
| {
|     productos_stock_bajo: [],
|     total_productos: number
| }
|
*/

export const obtenerDashboard = async () => {

    /*
    |--------------------------------------------------------------------------
    | CONSUMIR API
    |--------------------------------------------------------------------------
    */

    const response = await axios.get(
        '/api/dashboard'
    );

    /*
    |--------------------------------------------------------------------------
    | RETORNAR DATOS
    |--------------------------------------------------------------------------
    */

    return response.data;

};
