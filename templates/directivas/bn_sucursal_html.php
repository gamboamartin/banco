<?php
namespace html;

use gamboamartin\banco\controllers\controlador_bn_banco;
use gamboamartin\banco\controllers\controlador_bn_sucursal;
use gamboamartin\banco\controllers\controlador_bn_tipo_banco;
use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use models\bn_banco;
use models\bn_sucursal;
use models\bn_tipo_banco;
use PDO;
use stdClass;

class bn_sucursal_html extends html_controler {

    private function asigna_inputs(controlador_bn_sucursal $controler, stdClass $inputs): array|stdClass
    {
        $controler->inputs->select = new stdClass();
        $controler->inputs->select->bn_banco_id = $inputs->selects->bn_banco_id;
        $controler->inputs->select->bn_tipo_sucursal_id = $inputs->selects->bn_tipo_sucursal_id;
        return $controler->inputs;
    }

    public function genera_inputs_alta(controlador_bn_sucursal $controler, array $keys_selects, PDO $link): array|stdClass
    {
        $inputs = $this->init_alta(keys_selects: $keys_selects, link: $link);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar inputs',data:  $inputs);

        }
        $inputs_asignados = $this->asigna_inputs(controler:$controler, inputs: $inputs);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asignar inputs',data:  $inputs_asignados);
        }

        return $inputs_asignados;
    }

    private function genera_inputs_modifica(controlador_bn_sucursal $controler,PDO $link,
                                            stdClass $params = new stdClass()): array|stdClass
    {
        $inputs = $this->init_modifica(link: $link, row_upd: $controler->row_upd, params: $params);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar inputs',data:  $inputs);

        }
        $inputs_asignados = $this->asigna_inputs(controler:$controler, inputs: $inputs);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asignar inputs',data:  $inputs_asignados);
        }

        return $inputs_asignados;
    }

    private function init_alta(array $keys_selects, PDO $link): array|stdClass
    {
        $selects = $this->selects_alta(keys_selects: $keys_selects, link: $link);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar selects',data:  $selects);
        }

        $texts = $this->texts_alta(row_upd: new stdClass(), value_vacio: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar texts',data:  $texts);
        }

        $alta_inputs = new stdClass();
        $alta_inputs->selects = $selects;
        $alta_inputs->texts = $texts;

        return $alta_inputs;
    }

    private function init_modifica(PDO $link, stdClass $row_upd, stdClass $params = new stdClass()): array|stdClass
    {
        $selects = $this->selects_modifica(link: $link, row_upd: $row_upd);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar selects',data:  $selects);
        }

        $texts = $this->texts_alta(row_upd: $row_upd, value_vacio: false, params: $params);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar texts',data:  $texts);
        }

        $alta_inputs = new stdClass();
        $alta_inputs->texts = $texts;
        $alta_inputs->selects = $selects;
        return $alta_inputs;
    }

    public function inputs_bn_sucursal(controlador_bn_sucursal $controlador,
                                       stdClass $params = new stdClass()): array|stdClass
    {
        $inputs = $this->genera_inputs_modifica(controler: $controlador,
            link: $controlador->link, params: $params);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar inputs',data:  $inputs);
        }
        return $inputs;
    }

    private function selects_alta(array $keys_selects, PDO $link): array|stdClass
    {

        $selects = new stdClass();

        foreach ($keys_selects as $name_model=>$params){

            $selects  = $this->select_aut(link: $link,name_model:  $name_model,params:  $params, selects: $selects);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al generar select', data: $selects);
            }

        }

        return $selects;

    }


    private function selects_modifica(PDO $link, stdClass $row_upd): array|stdClass
    {
        $selects = new stdClass();

        $select = (new bn_tipo_sucursal_html(html:$this->html_base))->select_bn_tipo_sucursal_id(
            cols: 6, con_registros:true, id_selected:$row_upd->bn_tipo_sucursal_id,link: $link);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select',data:  $select);
        }
        $selects->bn_tipo_sucursal_id = $select;

        $select = (new bn_banco_html(html:$this->html_base))->select_bn_banco_id(
            cols: 6, con_registros:true, id_selected:$row_upd->bn_banco_id,link: $link);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select',data:  $select);
        }
        $selects->bn_banco_id = $select;

        return $selects;
    }

    public function select_bn_sucursal_id(int $cols, bool $con_registros, int $id_selected, PDO $link): array|string
    {
        $modelo = new bn_sucursal(link: $link);

        $select = $this->select_catalogo(cols:$cols,con_registros:$con_registros,id_selected:$id_selected,
            modelo: $modelo,label: 'Sucursal',required: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

    private function texts_alta(stdClass $row_upd, bool $value_vacio, stdClass $params = new stdClass()): array|stdClass
    {
        $texts = new stdClass();
        return $texts;
    }

}
