<?php
namespace gamboamartin\banco\models;
use base\orm\_modelo_parent;
use PDO;

class bn_cuenta extends _modelo_parent {

    public function __construct(PDO $link){
        $tabla = 'bn_cuenta';
        $columnas = array($tabla=>false,'bn_empleado'=>$tabla,'org_sucursal'=>$tabla,'bn_sucursal'=>$tabla,
            'bn_tipo_cuenta'=>$tabla,'bn_tipo_sucursal'=>'bn_sucursal','bn_banco'=>'bn_sucursal',
            'bn_tipo_banco'=>'bn_banco','org_empresa'=>'org_sucursal');
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'descripcion_select';


        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);

        $this->NAMESPACE = __NAMESPACE__;
    }


}