<?php
namespace gamboamartin\banco\models;
use base\orm\_modelo_parent;
use PDO;

class bn_tipo_sucursal extends _modelo_parent {

    public function __construct(PDO $link){
        $tabla = 'bn_tipo_sucursal';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'descripcion_select';

        $tipo_campos['codigos'] = 'cod_1_letras_mayusc';

        $no_duplicados = array('codigo','descripcion');

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, tipo_campos: $tipo_campos, no_duplicados: $no_duplicados);

        $this->NAMESPACE = __NAMESPACE__;
    }


}