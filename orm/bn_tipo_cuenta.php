<?php
namespace gamboamartin\banco\models;
use base\orm\modelo;
use PDO;

class bn_tipo_cuenta extends modelo{

    public function __construct(PDO $link){
        $tabla = 'bn_tipo_cuenta';
        $columnas = array($tabla=>false);
        $campos_obligatorios = array();

        $no_duplicados = array();
        $no_duplicados[] = 'codigo';
        $no_duplicados[] = 'descripcion';
        $no_duplicados[] = 'descripcion_select';
        $no_duplicados[] = 'alias';
        $no_duplicados[] = 'codigo_bis';

        $childrens['bn_sucursal'] = "gamboamartin\\banco\\models";

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, no_duplicados: $no_duplicados, childrens: $childrens);

        $this->NAMESPACE = __NAMESPACE__;
    }
}