<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {
    frontend\assets\AppAsset::register($this);
    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage();
    header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');
    header("Access-Control-Allow-Origin: *");
    ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" ng-app="<?= str_replace(" ", "",strtolower(Html::encode($this->title))) ?>">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
        <?php $this->head() ?>
        <style>
            .label-pr {
                cursor: pointer;
            }
        </style>
        <script type="text/javascript">
            var frontendURI = "<?= $GLOBALS["frontend_base_uri"];?>";
            var HeaderController = "<?= str_replace(" ", "",strtolower(Html::encode($this->title))); ?>";
            var MainController = "<?= str_replace(" ", "",strtolower(Html::encode($this->title))).'ctrl'; ?>";
            
            $(function () { 
                $("[data-toggle='tooltip']").tooltip(); 
            });;
            /* To initialize BS3 popovers set this below */
            $(function () { 
                $("[data-toggle='popover']").popover(); 
            });
        </script>
    </head>
    <body class="hold-transition skin-green" oncontextmenu="return true;">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
