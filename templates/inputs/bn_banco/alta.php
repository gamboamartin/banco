<?php /** @var  \gamboamartin\banco\controllers\controlador_bn_banco $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>
<?php echo $controlador->inputs->codigo; ?>
<?php echo $controlador->inputs->codigo_bis; ?>
<?php echo $controlador->inputs->descripcion; ?>
<?php echo $controlador->inputs->descripcion_select; ?>
<?php echo $controlador->inputs->select->bn_tipo_banco_id; ?>
<?php include (new views())->ruta_templates.'botons/submit/alta_bd_otro.php';?>