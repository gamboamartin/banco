<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\banco\controllers;

use gamboamartin\banco\models\bn_sucursal;
use gamboamartin\banco\models\bn_tipo_sucursal;
use gamboamartin\cat_sat\controllers\_base;
use gamboamartin\errores\errores;
use gamboamartin\system\_ctl_parent_sin_codigo;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use gamboamartin\template\html;
use html\bn_sucursal_html;
use html\bn_tipo_banco_html;
use html\bn_tipo_sucursal_html;
use html\com_cliente_html;
use html\com_producto_html;
use html\com_sucursal_html;
use html\em_empleado_html;
use html\nom_par_deduccion_html;
use html\nom_par_percepcion_html;
use html\nom_percepcion_html;
use models\bn_tipo_banco;
use models\com_cliente;
use models\com_producto;
use models\com_sucursal;
use models\em_empleado;
use models\nom_par_deduccion;
use models\nom_par_percepcion;
use models\nom_percepcion;
use PDO;
use stdClass;

class controlador_bn_sucursal extends _base {

    public function __construct(PDO $link, html $html = new \gamboamartin\template_1\html(),
                                stdClass $paths_conf = new stdClass()){
        $modelo = new bn_sucursal(link: $link);
        $html_ = new bn_sucursal_html(html: $html);
        $obj_link = new links_menu(link: $link, registro_id:$this->registro_id);


        $datatables = new stdClass();
        $datatables->columns = array();
        $datatables->columns['bn_sucursal_id']['titulo'] = 'Id';
        $datatables->columns['bn_sucursal_codigo']['titulo'] = 'Cod';
        $datatables->columns['bn_sucursal_descripcion']['titulo'] = 'Sucursal';

        $datatables->filtro = array();
        $datatables->filtro[] = 'bn_sucursal.id';
        $datatables->filtro[] = 'bn_sucursal.codigo';
        $datatables->filtro[] = 'bn_sucursal.descripcion';


        parent::__construct(html:$html_, link: $link,modelo:  $modelo, obj_link: $obj_link,
            datatables: $datatables, paths_conf: $paths_conf);

        $this->titulo_lista = 'Sucursal';

    }



}
