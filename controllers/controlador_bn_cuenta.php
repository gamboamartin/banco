<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\banco\controllers;

use gamboamartin\banco\models\bn_cuenta;
use gamboamartin\errores\errores;
use gamboamartin\system\_ctl_base;
use gamboamartin\system\links_menu;

use gamboamartin\template\html;
use html\bn_cuenta_html;


use html\bn_sucursal_html;
use html\bn_tipo_cuenta_html;
use html\org_sucursal_html;
use html\em_empleado_html;
use PDO;
use stdClass;

class controlador_bn_cuenta extends _ctl_base {

    public function __construct(PDO $link, html $html = new \gamboamartin\template_1\html(),
                                stdClass $paths_conf = new stdClass()){

        $modelo = new bn_cuenta(link: $link);
        $html_ = new bn_cuenta_html(html: $html);
        $obj_link = new links_menu(link: $link, registro_id:$this->registro_id);


        $datatables = new stdClass();
        $datatables->columns = array();
        $datatables->columns['bn_cuenta_id']['titulo'] = 'Id';
        $datatables->columns['bn_cuenta_codigo']['titulo'] = 'Cod';
        $datatables->columns['bn_cuenta_descripcion']['titulo'] = 'Cuenta';

        $datatables->filtro = array();
        $datatables->filtro[] = 'bn_cuenta.id';
        $datatables->filtro[] = 'bn_cuenta.codigo';
        $datatables->filtro[] = 'bn_cuenta.descripcion';


        parent::__construct(html:$html_, link: $link,modelo:  $modelo, obj_link: $obj_link,
            datatables: $datatables, paths_conf: $paths_conf);

        $this->titulo_lista = 'Cuenta';

    }

    public function alta(bool $header, bool $ws = false): array|string
    {

        $r_alta = $this->init_alta();
        if(errores::$error){
            return $this->retorno_error(
                mensaje: 'Error al inicializar alta',data:  $r_alta, header: $header,ws:  $ws);
        }


        $keys_selects = $this->key_select(cols:12, con_registros: true,filtro:  array(), key: 'bn_tipo_cuenta_id',
            keys_selects: array(), id_selected: -1, label: 'Tipo Cuenta');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }


        $keys_selects = $this->key_select(cols:12, con_registros: true,filtro:  array(), key: 'org_sucursal_id',
            keys_selects: $keys_selects, id_selected: -1, label: 'Empresa');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }

        $keys_selects = $this->key_select(cols:12, con_registros: true,filtro:  array(), key: 'em_empleado_id',
            keys_selects: $keys_selects, id_selected: -1, label: 'Empleado');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }

        $keys_selects = $this->key_select(cols:12, con_registros: true,filtro:  array(), key: 'bn_sucursal_id',
            keys_selects: $keys_selects, id_selected: -1, label: 'Banco');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }



        $keys_selects['descripcion'] = new stdClass();
        $keys_selects['descripcion']->cols = 6;


        $inputs = $this->inputs(keys_selects: $keys_selects);
        if(errores::$error){
            return $this->retorno_error(
                mensaje: 'Error al obtener inputs',data:  $inputs, header: $header,ws:  $ws);
        }



        return $r_alta;
    }

    protected function campos_view(): array
    {
        $keys = new stdClass();
        $keys->inputs = array('codigo','descripcion');
        $keys->selects = array();

        $init_data = array();
        $init_data['bn_tipo_cuenta'] = "gamboamartin\\banco";
        $init_data['org_sucursal'] = "gamboamartin\\organigrama";
        $init_data['bn_sucursal'] = "gamboamartin\\banco";
        $init_data['em_empleado'] = "gamboamartin\\empleado";
        $campos_view = $this->campos_view_base(init_data: $init_data,keys:  $keys);

        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al inicializar campo view',data:  $campos_view);
        }


        return $campos_view;
    }

    protected function inputs_children(stdClass $registro): stdClass|array
    {
        $select_bn_tipo_cuenta_id = (new bn_tipo_cuenta_html(html: $this->html_base))->select_bn_tipo_cuenta_id(
            cols:6,con_registros: true,id_selected:  -1,link:  $this->link);

        if(errores::$error){
            return $this->errores->error(
                mensaje: 'Error al obtener select_bn_tipo_cuenta_id',data:  $select_bn_tipo_cuenta_id);
        }

        $select_org_sucursal_id = (new org_sucursal_html(html: $this->html_base))->select_org_sucursal_id(
            cols:6,con_registros: true,id_selected:  -1,link:  $this->link);

        if(errores::$error){
            return $this->errores->error(
                mensaje: 'Error al obtener select_org_sucursal_id',data:  $select_org_sucursal_id);
        }

        $select_bn_sucursal_id = (new bn_sucursal_html(html: $this->html_base))->select_bn_sucursal_id(
            cols:6,con_registros: true,id_selected:  -1,link:  $this->link);

        if(errores::$error){
            return $this->errores->error(
                mensaje: 'Error al obtener select_bn_sucursal_id',data:  $select_bn_sucursal_id);
        }

        $select_em_empleado_id = (new em_empleado_html(html: $this->html_base))->select_em_empleado_id(
            cols:6,con_registros: true,id_selected:  -1,link:  $this->link);

        if(errores::$error){
            return $this->errores->error(
                mensaje: 'Error al obtener select_em_empleado_id',data:  $select_em_empleado_id);
        }


        $this->inputs = new stdClass();
        $this->inputs->select = new stdClass();
        $this->inputs->select->bn_tipo_cuenta_id = $select_bn_tipo_cuenta_id;
        $this->inputs->select->org_sucursal_id = $select_org_sucursal_id;
        $this->inputs->select->bn_sucursal_id = $select_bn_sucursal_id;
        $this->inputs->select->em_empleado_id = $select_em_empleado_id;


        return $this->inputs;
    }


    protected function key_selects_txt(array $keys_selects): array
    {

        $keys_selects = (new \base\controller\init())->key_select_txt(cols: 6, key: 'codigo', keys_selects: $keys_selects, place_holder: 'Cod');
        if (errores::$error) {
            return $this->errores->error(mensaje: 'Error al maquetar key_selects', data: $keys_selects);
        }

        $keys_selects = (new \base\controller\init())->key_select_txt(cols: 6,key: 'descripcion', keys_selects:$keys_selects, place_holder: 'Cuenta');
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects);
        }


        return $keys_selects;
    }

    public function modifica(
        bool $header, bool $ws = false): array|stdClass
    {
        $r_modifica = $this->init_modifica(); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->retorno_error(
                mensaje: 'Error al generar salida de template',data:  $r_modifica,header: $header,ws: $ws);
        }


        $keys_selects = $this->key_select(cols:12, con_registros: true,filtro:  array(), key: 'bn_tipo_cuenta_id',
            keys_selects: array(), id_selected: $this->registro['bn_tipo_cuenta_id'], label: 'Tipo Cuenta');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }

        $keys_selects = $this->key_select(cols:12, con_registros: true,filtro:  array(), key: 'org_sucursal_id',
            keys_selects: $keys_selects, id_selected: $this->registro['org_sucursal_id'], label: 'Sucursal');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }

        $keys_selects = $this->key_select(cols:12, con_registros: true,filtro:  array(), key: 'bn_sucursal_id',
            keys_selects: $keys_selects, id_selected: $this->registro['bn_sucursal_id'], label: 'Banco');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }

        $keys_selects = $this->key_select(cols:12, con_registros: true,filtro:  array(), key: 'em_empleado_id',
            keys_selects: $keys_selects, id_selected: $this->registro['em_empleado_id'], label: 'Empleado');
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects, header: $header,ws:  $ws);
        }

        $keys_selects['descripcion'] = new stdClass();
        $keys_selects['descripcion']->cols = 6;

        $keys_selects['codigo'] = new stdClass();
        $keys_selects['codigo']->disabled = true;

        $base = $this->base_upd(keys_selects: $keys_selects, not_actions: array(__FUNCTION__), params: array(),params_ajustados: array());
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al integrar base',data:  $base, header: $header,ws:  $ws);
        }




        return $r_modifica;
    }




}
