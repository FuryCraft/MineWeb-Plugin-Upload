<?php
/**
 * Fury_Craft : Développeur (https://dev.fury-craft.tk), YouTubeur (https://www.youtube.com/c/furycraft/) et administrateur de Fury Land (https://www.furyland.ga/)
 * @author        Fury_Craft - https://dev.fury-craft.tk
 * @copyright     Fury_Craft - All rights reserved
 * @link          http://mineweb.org/market
 * @since         ERROR
 */

Router::connect('/admin/Uploads', ['controller' => 'Uploads', 'action' => 'index', 'plugin' => 'Uploads', 'admin' => true]);
Router::connect('/admin/Uploads/delete/:id', ['controller' => 'Uploads', 'action' => 'delete', 'plugin' => 'Uploads', 'admin' => true], ['pass' => ['id']], ['id' => '[0-9]+']);
Router::connect('/Uploads', ['controller' => 'Uploads', 'action' => 'index', 'plugin' => 'Uploads']);
