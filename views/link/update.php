<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Link */

$this->title = 'Редактирование ссылки: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Список блоков', 'url' => ['/block/index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="row">
    <div class="col-md-5 col-md-offset-1">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
