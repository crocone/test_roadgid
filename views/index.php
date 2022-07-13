<?php

/** @var yii\web\View $this */

$this->title = 'Test for roadgid';
$this->registerJsFile(
    '@web/js/main.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <div class="row">
            <form class="col-12 input-group mb-3" action="/" id="shortMyLinkForm">
                <input type="url" name="url" class="form-control" placeholder="Вставьте вашу ссылку сюда"
                       aria-label="Вставьте вашу ссылку сюда" aria-describedby="linkUri" autofocus>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Сократить!</button>
                </div>
            </form>

            <div class="col-12">
                <div class="resultSuccess d-none input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Ваша ссылка:</span>
                    </div>
                    <input type="url" disabled class="form-control shortLinkResult">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary copyLink" type="button">Скопировать</button>
                    </div>
                </div>

                <p class="resultError <?= !$error ? 'd-none' : '' ?> text-danger"><?= $error ?></p
            </div>
        </div>
    </div>
</div>
