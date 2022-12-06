<?php
namespace models;
use base\orm\modelo;
use PDO;

class bn_tipo_sucursal extends modelo{

    public function __construct(PDO $link){
        $tabla = __CLASS__;
        $columnas = array($tabla=>false);
        $campos_obligatorios = array();

        $no_duplicados = array();
        $no_duplicados[] = 'codigo';
        $no_duplicados[] = 'descripcion';
        $no_duplicados[] = 'descripcion_select';
        $no_duplicados[] = 'alias';
        $no_duplicados[] = 'codigo_bis';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, no_duplicados: $no_duplicados);

        $this->NAMESPACE = __NAMESPACE__;
    }
}