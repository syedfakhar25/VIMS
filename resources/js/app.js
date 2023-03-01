import './bootstrap';

import Alpine from 'alpinejs';
import 'datatables.net-dt/css/jquery.dataTables.css';
import $ from 'jquery';

window.jQuery = $;
require('datatables.net-dt')();

window.Alpine = Alpine;

Alpine.start();
