<?
use yii\helpers\Html;
?>
<h4>Сброс настроек:</h4>

    <blockquote>
        <p>При нажатии кнопки <b>Сброс настроек</b></p>
        <footer>На главной странице блоки отобразятся так, как задал администратор</footer>
        <footer>Визуальное оформление станет таким, как задал администратор</footer>
    </blockquote>

<?= Html::a('Сброс настроек', ['reset'],
    ['class' => 'btn btn-danger',
        'data-confirm' => 'Вы действительно хотите сбросить настройки?',
        'data-method' => 'post']) ?>