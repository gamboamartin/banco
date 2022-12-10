<?php /** @var  \gamboamartin\banco\controllers\controlador_bn_tipo_banco $controlador  controlador en ejecucion */ ?>
<?php use config\views; ?>

<?php echo $controlador->inputs->codigo; ?>
<?php echo $controlador->inputs->descripcion; ?>

<?php include (new views())->ruta_templates.'botons/submit/alta_bd_otro.php';?>



<div class="cold-row-12">
    <?php foreach ($controlador->buttons as $button){ ?>
        <?php echo $button; ?>
    <?php }?>
</div>
