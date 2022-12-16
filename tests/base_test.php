<?php
namespace tests;
use base\orm\modelo_base;
use gamboamartin\errores\errores;
use PDO;


class base_test{


    public function del(PDO $link, string $name_model): array
    {

        $model = (new modelo_base($link))->genera_modelo(modelo: $name_model);
        $del = $model->elimina_todo();
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al eliminar '.$name_model, data: $del);
        }
        return $del;
    }

    public function del_bn_cuenta(PDO $link): array
    {



        $del = $this->del($link, 'gamboamartin\\banco\\models\\bn_cuenta');
        if(errores::$error){
            return (new errores())->error('Error al eliminar', $del);
        }
        return $del;
    }

    public function del_bn_sucursal(PDO $link): array
    {
        $del = $this->del_bn_cuenta($link);
        if(errores::$error){
            return (new errores())->error('Error al eliminar', $del);
        }

        $del = $this->del($link, 'gamboamartin\\banco\\models\\bn_sucursal');
        if(errores::$error){
            return (new errores())->error('Error al eliminar', $del);
        }
        return $del;
    }

    public function del_bn_tipo_sucursal(PDO $link): array
    {

        $del = $this->del_bn_sucursal($link);
        if(errores::$error){
            return (new errores())->error('Error al eliminar', $del);
        }

        $del = $this->del($link, 'gamboamartin\\banco\\models\\bn_tipo_sucursal');
        if(errores::$error){
            return (new errores())->error('Error al eliminar', $del);
        }
        return $del;
    }


}
