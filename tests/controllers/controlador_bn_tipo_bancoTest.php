<?php
namespace tests\controllers;

use gamboamartin\banco\controllers\controlador_adm_session;
use gamboamartin\banco\controllers\controlador_bn_tipo_banco;
use gamboamartin\banco\controllers\controlador_bn_tipo_cuenta;
use gamboamartin\banco\controllers\controlador_bn_tipo_sucursal;
use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use stdClass;


class controlador_bn_tipo_bancoTest extends test {
    public errores $errores;
    private stdClass $paths_conf;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
        $this->paths_conf = new stdClass();
        $this->paths_conf->generales = '/var/www/html/banco/config/generales.php';
        $this->paths_conf->database = '/var/www/html/banco/config/database.php';
        $this->paths_conf->views = '/var/www/html/banco/config/views.php';
    }


    public function test_key_selects_txt(): void
    {
        errores::$error = false;

        $_GET['seccion'] = 'cat_sat_tipo_persona';
        $_GET['accion'] = 'lista';
        $_SESSION['grupo_id'] = 1;
        $_SESSION['usuario_id'] = 2;
        $_GET['session_id'] = '1';

        $controler = new controlador_bn_tipo_banco(link: $this->link,paths_conf: $this->paths_conf);
        $controler = new liberator($controler);

        $keys_selects = array();
        $resultado = $controler->key_selects_txt($keys_selects);

        $this->assertIsArray($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals(6,$resultado['codigo']->cols);
        $this->assertEquals('Cod',$resultado['codigo']->place_holder);
        $this->assertEquals(true,$resultado['codigo']->required);

        $this->assertEquals(6,$resultado['descripcion']->cols);
        $this->assertEquals('Tipo Banco',$resultado['descripcion']->place_holder);
        $this->assertEquals(true,$resultado['descripcion']->required);

        errores::$error = false;
    }





}

