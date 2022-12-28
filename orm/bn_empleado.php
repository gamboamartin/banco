<?php
namespace gamboamartin\banco\models;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class bn_empleado extends _modelo_parent {

    public function __construct(PDO $link){
        $tabla = 'bn_empleado';
        $columnas = array($tabla=>false,'org_puesto'=>$tabla,'org_departamento'=>'org_puesto',
            'org_tipo_puesto'=>'org_puesto','org_empresa'=>'org_departamento','org_clasificacion_dep'=>'org_departamento');
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'descripcion_select';


        $no_duplicados = array('codigo','descripcion','codigo_bis','alias');

        parent::__construct(link: $link, tabla: $tabla, campos_obligatorios: $campos_obligatorios, columnas: $columnas,
            no_duplicados: $no_duplicados);

        $this->NAMESPACE = __NAMESPACE__;
    }

    public function alta_bd(array $keys_integra_ds = array('nombre', 'ap','am')): array|stdClass
    {
        if(!isset($this->registro['descripcion'])){
            $this->registro['descripcion'] = $this->registro['nombre'].' '.$this->registro['ap'].' '.$this->registro['am'];
        }
        $r_alta_bd =  parent::alta_bd(keys_integra_ds: $keys_integra_ds); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al insertar empleado',data:  $r_alta_bd);
        }
        return $r_alta_bd;
    }


}