<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\banco\controllers;

use gamboamartin\banco\models\bn_tipo_cuenta;
use gamboamartin\errores\errores;
use gamboamartin\system\_ctl_parent_sin_codigo;
use gamboamartin\system\links_menu;
use gamboamartin\template\html;
use html\bn_tipo_cuenta_html;


use PDO;
use stdClass;

class controlador_bn_tipo_cuenta extends _ctl_parent_sin_codigo {

    public function __construct(PDO $link, html $html = new \gamboamartin\template_1\html(),
                                stdClass $paths_conf = new stdClass()){
        $modelo = new bn_tipo_cuenta(link: $link);
        $html_ = new bn_tipo_cuenta_html(html: $html);
        $obj_link = new links_menu(link: $link, registro_id:$this->registro_id);


        $datatables = new stdClass();
        $datatables->columns = array();
        $datatables->columns['bn_tipo_cuenta_id']['titulo'] = 'Id';
        $datatables->columns['bn_tipo_cuenta_codigo']['titulo'] = 'Cod';
        $datatables->columns['bn_tipo_cuenta_descripcion']['titulo'] = 'Tipo cuenta';

        $datatables->filtro = array();
        $datatables->filtro[] = 'bn_tipo_cuenta.id';
        $datatables->filtro[] = 'bn_tipo_cuenta.codigo';
        $datatables->filtro[] = 'bn_tipo_cuenta.descripcion';


        parent::__construct(html:$html_, link: $link,modelo:  $modelo, obj_link: $obj_link,
            datatables: $datatables, paths_conf: $paths_conf);

        $this->titulo_lista = 'Tipo Cuenta';

    }

    /**
     * Ajusta los parametros de los inputs para upd y alta
     * @param array $keys_selects Parametros precargados
     * @return array
     * @version 0.30.5
     */
    protected function key_selects_txt(array $keys_selects): array
    {
        $keys_selects = (new \base\controller\init())->key_select_txt(
            cols: 6,key: 'codigo', keys_selects:$keys_selects, place_holder: 'Cod');
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects);
        }

        $keys_selects = (new \base\controller\init())->key_select_txt(
            cols: 6,key: 'descripcion', keys_selects:$keys_selects, place_holder: 'Tipo Cuenta');
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects);
        }

        return $keys_selects;
    }



}
