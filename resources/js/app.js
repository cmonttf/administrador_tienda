import './bootstrap';

import $ from 'jquery';

window.$ = window.jQuery = $;

import DataTable from 'datatables.net-dt';
import 'datatables.net-dt/css/dataTables.dataTables.css';

$(document).ready(function () {
    $('#tabla').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-CL.json'
        }
    });
});
