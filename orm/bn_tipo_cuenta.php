<?php
namespace gamboamartin\banco\models;
use base\orm\_modelo_parent;
use PDO;

class bn_tipo_cuenta extends _modelo_parent {

    public function __construct(PDO $link){
        $tabla = 'bn_tipo_cuenta';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'descripcion_select';

        $tipo_campos['codigos'] = 'cod_1_letras_mayusc';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, tipo_campos: $tipo_campos);

        $this->NAMESPACE = __NAMESPACE__;
    }


}