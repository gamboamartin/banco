<?php
namespace gamboamartin\banco\instalacion;

use base\orm\modelo;
use base\orm\modelo_base;
use gamboamartin\administrador\instalacion\_adm;
use gamboamartin\administrador\models\_instalacion;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class instalacion
{

    private function _add_bn_banco(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $init = (new _instalacion(link: $link));

        $create = (new _instalacion(link: $link))->create_table_new(table: 'bn_banco');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;

        $foraneas = array();
        $foraneas['bn_tipo_banco_id'] = new stdClass();

        $result = $init->foraneas(foraneas: $foraneas,table:  'bn_banco');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $result);
        }

        $out->foraneas = $result;
        
        return $out;
    }

    private function _add_bn_tipo_banco(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'bn_tipo_banco');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;

        return $out;
    }

    private function _add_bn_tipo_cuenta(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'bn_tipo_cuenta');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;

        return $out;
    }

    private function _add_bn_tipo_sucursal(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $create = (new _instalacion(link: $link))->create_table_new(table: 'bn_tipo_sucursal');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;

        return $out;
    }

    private function _add_bn_sucursal(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $init = (new _instalacion(link: $link));

        $create = (new _instalacion(link: $link))->create_table_new(table: 'bn_sucursal');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al create table', data:  $create);
        }
        $out->create = $create;

        $foraneas = array();
        $foraneas['bn_banco_id'] = new stdClass();
        $foraneas['bn_tipo_sucursal_id'] = new stdClass();

        $result = $init->foraneas(foraneas: $foraneas,table:  'bn_sucursal');
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar foranea', data:  $result);
        }

        $out->foraneas = $result;

        return $out;
    }

    private function bn_banco(PDO $link): array|stdClass
    {
        $create = $this->_add_bn_banco(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;
    }

    private function bn_tipo_banco(PDO $link): array|stdClass
    {
        $create = $this->_add_bn_tipo_banco(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;
    }

    private function bn_tipo_cuenta(PDO $link): array|stdClass
    {
        $create = $this->_add_bn_tipo_cuenta(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;
    }

    private function bn_tipo_sucursal(PDO $link): array|stdClass
    {
        $create = $this->_add_bn_tipo_sucursal(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;
    }

    private function bn_sucursal(PDO $link): array|stdClass
    {
        $create = $this->_add_bn_sucursal(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar create', data:  $create);
        }

        return $create;
    }

    final public function instala(PDO $link): array|stdClass
    {
        $result = new stdClass();

        $bn_banco = $this->bn_banco(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar bn_banco', data:  $bn_banco);
        }
        $result->bn_banco = $bn_banco;

        $bn_tipo_banco = $this->bn_tipo_banco(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar bn_tipo_banco', data:  $bn_tipo_banco);
        }
        $result->bn_tipo_banco = $bn_tipo_banco;

        $bn_tipo_cuenta = $this->bn_tipo_cuenta(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar bn_tipo_cuenta', data:  $bn_tipo_cuenta);
        }
        $result->bn_tipo_cuenta = $bn_tipo_cuenta;

        $bn_tipo_sucursal = $this->bn_tipo_sucursal(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar bn_tipo_sucursal', data:  $bn_tipo_sucursal);
        }
        $result->bn_tipo_sucursal = $bn_tipo_sucursal;

        $bn_sucursal = $this->bn_sucursal(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al ajustar bn_sucursal', data:  $bn_sucursal);
        }
        $result->bn_sucursal = $bn_sucursal;

        return $result;

    }

    final public function limpia(PDO $link): array|stdClass
    {

        $out = new stdClass();

        $modelos = array();
        $modelos[] = 'bn_banco';
        $modelos[] = 'bn_tipo_banco';
        $modelos[] = 'bn_tipo_cuenta';
        $modelos[] = 'bn_tipo_sucursal';
        $modelos[] = 'bn_sucursal';

        foreach ($modelos as $modelo){
            $modelo_new = modelo_base::modelo_new(link: $link,modelo:  $modelo,
                namespace_model: 'gamboamartin\\banco\\models');
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al generar modelo', data:  $modelo);
            }

            $del = $modelo_new->elimina_todo();
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al eliminar datos del modelo '.$modelo, data:  $del);
            }

            $out->$modelo = $del;

        }

        $modelos = array();
        $modelos[] = 'org_sucursal';

        foreach ($modelos as $modelo){
            $modelo_new = modelo_base::modelo_new(link: $link,modelo:  $modelo,
                namespace_model: 'gamboamartin\\organigrama\\models');
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al generar modelo', data:  $modelo);
            }
            $del = $modelo_new->elimina_todo();
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al eliminar datos del modelo '.$modelo, data:  $del);
            }
            $out->$modelo = $del;

        }

        $modelos = array();
        $modelos[] = 'com_email_cte';

        foreach ($modelos as $modelo){
            $modelo_new = modelo_base::modelo_new(link: $link,modelo:  $modelo,
                namespace_model: 'gamboamartin\\comercial\\models');
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al generar modelo', data:  $modelo);
            }
            $del = $modelo_new->elimina_todo();
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al eliminar datos del modelo '.$modelo, data:  $del);
            }
            $out->$modelo = $del;

        }

        $modelos = array();
        $modelos[] = 'not_rel_mensaje_etapa';

        foreach ($modelos as $modelo){
            $modelo_new = modelo_base::modelo_new(link: $link,modelo:  $modelo,
                namespace_model: 'gamboamartin\\notificaciones\\models');
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al generar modelo', data:  $modelo);
            }
            $del = $modelo_new->elimina_todo();
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al eliminar datos del modelo '.$modelo, data:  $del);
            }
            $out->$modelo = $del;

        }

        $modelos = array();
        $modelos[] = 'doc_version';

        foreach ($modelos as $modelo){
            $modelo_new = modelo_base::modelo_new(link: $link,modelo:  $modelo,
                namespace_model: 'gamboamartin\\documento\\models');
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al generar modelo', data:  $modelo);
            }
            $del = $modelo_new->elimina_todo();
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al eliminar datos del modelo '.$modelo, data:  $del);
            }
            $out->$modelo = $del;

        }

        return $out;


    }
}
