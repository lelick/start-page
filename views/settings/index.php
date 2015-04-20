<?php
/* @var $this yii\web\View */
use yii\bootstrap\Tabs;

$this->title = 'Персональные настройки';
?>

<?if($msg = \Yii::$app->session->getFlash('success')):?>
    <div class="alert alert-success">
        <?=\Yii::$app->session->getFlash('success')?>
    </div>
<?endif?>

<h3><?=$this->title?></h3>
<!--<p>Здесь можно сбросить настройки по умолчанию</p>-->
<div class="row">
    <div class="col-md-3">

    </div>
</div>


<?

echo Tabs::widget([
    'items' => [
        [
            'label' => 'Основные',
            'content' => 'Основные настройки',
            'active' => true,
        ],
        [
            'label' => 'Справочники',
            'content' => 'Справочники',
            'options' => ['tag' => 'div'],
            'headerOptions' => ['class' => 'my-class'],
        ],
        [
            'label' => 'Логирование',
            'content' => 'Управление логированием',
            'options' => ['tag' => 'div'],
            'headerOptions' => ['class' => 'my-class'],
        ],
        [
            'label' => 'Сброс настроек',
            'content' => $this->render('_reset'),
        ],
    ],
    'options' => ['tag' => 'div'],
    'itemOptions' => ['tag' => 'div'],
    'headerOptions' => ['class' => 'my-class'],
    'clientOptions' => ['collapsible' => false],
]);
?>