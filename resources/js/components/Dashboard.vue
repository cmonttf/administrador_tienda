<template>

    <div class="dashboard">

        <h1 class="titulo">
            Productos por Agotarse
        </h1>

        <!-- TABLA -->

        <div class="row mb-2">
            <div class="col-sm-12">
                <TablaStockBajo
                    :productos="productosStockBajo"
                />
            </div>
        </div>

        <div class="row mt-2 g-4">
            <div class="col-md-6">
                <CardIndicador
                    titulo="Cantidad de productos"
                    :valor="totalProductos"
                />
            </div>

            <div class="col-md-6">
                <CardIndicador
                    titulo="Cantidad"
                    :valor="totalProductos"
                />
            </div>
        </div>

    </div>

</template>

<script setup>

import {
    ref,
    onMounted,
    onUnmounted
} from 'vue';

/*
|--------------------------------------------------------------------------
| SERVICES
|--------------------------------------------------------------------------
*/

import {
    obtenerDashboard
} from '../services/dashboardService';
import CardIndicador from './CardIndicador.vue';
import TablaStockBajo from './TablaStockBajo.vue';

/*
|--------------------------------------------------------------------------
| VARIABLES REACTIVAS
|--------------------------------------------------------------------------
*/

const productosStockBajo = ref([]);
const totalProductos = ref(0);

/*
|--------------------------------------------------------------------------
| INTERVALO
|--------------------------------------------------------------------------
*/

let intervalo = null;

/*
|--------------------------------------------------------------------------
| CARGAR DASHBOARD
|--------------------------------------------------------------------------
*/

const cargarDashboard = async () => {

    try {

        /*
        |--------------------------------------------------------------------------
        | CONSUMIR API
        |--------------------------------------------------------------------------
        */

        const data =
            await obtenerDashboard();

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR TABLA
        |--------------------------------------------------------------------------
        */

        productosStockBajo.value = data.productos_stock_bajo;

        totalProductos.value = data.total_productos;

    } catch (error) {

        console.error(
            'Error cargando dashboard:',
            error
        );

    }

};

/*
|--------------------------------------------------------------------------
| LIFECYCLE
|--------------------------------------------------------------------------
*/

onMounted(() => {

    /*
    |--------------------------------------------------------------------------
    | CARGA INICIAL
    |--------------------------------------------------------------------------
    */

    cargarDashboard();

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR CADA 5 SEGUNDOS
    |--------------------------------------------------------------------------
    */

    intervalo = setInterval(() => {

        cargarDashboard();

    }, 5000);

});

/*
|--------------------------------------------------------------------------
| LIMPIAR INTERVALO
|--------------------------------------------------------------------------
*/

onUnmounted(() => {

    clearInterval(intervalo);

});

</script>
