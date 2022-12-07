<?php
namespace gamboamartin\banco\models;
use base\orm\modelo;
use PDO;

class bn_tipo_banco extends modelo{

    public function __construct(PDO $link){
        $tabla = 'bn_tipo_banco';
        $columnas = array($tabla=>false);
        $campos_obligatorios = array();

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);

        $this->NAMESPACE = __NAMESPACE__;
    }
}