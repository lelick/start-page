<?php

use yii\bootstrap\Html;
use app\assets\AutocompleteAsset;
use anmaslov\autocomplete\AutoComplete;

AutocompleteAsset::register($this);
?>

<div class="row">
    <div class="col-md-6 sub-brand-text">
        <h1><?=\Yii::$app->settings->get('brand.brand-sub-text')?></h1>
    </div>
    <div class="col-md-6">
        <form>
            <div class="form-group">
                <?=Html::textInput('links', null, [
                    'id' => 'autocomplete',
                    'class' => 'form-control',
                    'placeholder' => Yii::t('app', 'FAST_SEARCH')
                ]) ?>
            </div>
        </form>

        <?= AutoComplete::widget([
                'name' => 'link',
                'id' => 'super',
                'data' =>  $link,
                'options' => [
                    'placeholder' => Yii::t('app', 'FAST_SEARCH'),
                ],
                'clientOptions' => [
                    'minChars' => 2,
                    'groupBy' => 'category',
                ],
            ])?>

    </div>
</div>

<script type="text/javascript">
    $(function(){
        var countries = <?= \yii\helpers\Json::encode($link);?>;
        $('#autocomplete').autocomplete({
            lookup: countries,
            minChars: 2,
            groupBy: 'category',
            onSelect: function (suggestion) {
                location.href = suggestion.stat;
            }
        }).focus();
    });
</script>