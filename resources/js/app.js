import './bootstrap';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
/*
|--------------------------------------------------------------------------
| JQUERY
|--------------------------------------------------------------------------
*/

import $ from 'jquery';

window.$ = window.jQuery = $;

/*
|--------------------------------------------------------------------------
| DATATABLES
|--------------------------------------------------------------------------
*/

import DataTable from 'datatables.net-dt';

import 'datatables.net-dt/css/dataTables.dataTables.css';

/*
|--------------------------------------------------------------------------
| VUE
|--------------------------------------------------------------------------
*/

import { createApp } from 'vue';

import Dashboard from './components/Dashboard.vue';

/*
|--------------------------------------------------------------------------
| MONTAR VUE
|--------------------------------------------------------------------------
*/

if (document.getElementById('dashboard-app')) {

    createApp(Dashboard)
        .mount('#dashboard-app');

}

/*
|--------------------------------------------------------------------------
| DATATABLES INIT
|--------------------------------------------------------------------------
*/

$(document).ready(function () {

    if ($('#tabla').length) {

        $('#tabla').DataTable({

            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-CL.json'
            }

        });

    }

});
