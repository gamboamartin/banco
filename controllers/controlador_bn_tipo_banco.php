<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\banco\controllers;

use gamboamartin\banco\models\bn_tipo_banco;
use gamboamartin\cat_sat\controllers\_base;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use gamboamartin\template\html;
use html\bn_tipo_banco_html;
use html\cat_sat_moneda_html;
use html\com_cliente_html;
use html\com_producto_html;
use html\com_sucursal_html;
use html\em_empleado_html;
use html\nom_par_deduccion_html;
use html\nom_par_percepcion_html;
use html\nom_percepcion_html;
use models\com_cliente;
use models\com_producto;
use models\com_sucursal;
use models\em_empleado;
use models\nom_par_deduccion;
use models\nom_par_percepcion;
use models\nom_percepcion;
use PDO;
use stdClass;

class controlador_bn_tipo_banco extends _base {

    public function __construct(PDO $link, html $html = new \gamboamartin\template_1\html(),
                                stdClass $paths_conf = new stdClass()){
        $modelo = new bn_tipo_banco(link: $link);
        $html_ = new bn_tipo_banco_html(html: $html);
        $obj_link = new links_menu(link: $link, registro_id:$this->registro_id);


        $datatables = new stdClass();
        $datatables->columns = array();
        $datatables->columns['bn_tipo_banco_id']['titulo'] = 'Id';
        $datatables->columns['bn_tipo_banco_codigo']['titulo'] = 'Cod';
        $datatables->columns['bn_tipo_banco_descripcion']['titulo'] = 'Tipo Banco';

        $datatables->filtro = array();
        $datatables->filtro[] = 'bn_tipo_banco.id';
        $datatables->filtro[] = 'bn_tipo_banco.codigo';
        $datatables->filtro[] = 'bn_tipo_banco.descripcion';


        parent::__construct(html:$html_, link: $link,modelo:  $modelo, obj_link: $obj_link,
            datatables: $datatables, paths_conf: $paths_conf);

        $this->titulo_lista = 'Tipo Banco';

    }



}