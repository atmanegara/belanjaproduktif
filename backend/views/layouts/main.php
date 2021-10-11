<?php
/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\bootstrap4\Modal;

!empty($viewPath) || $viewPath = '@app/views/layouts';
!empty($viewHeader) || $viewHeader = $viewPath . '/_header';
!empty($viewSidebar) || $viewSidebar = $viewPath . '/_sidebar';
//!empty($viewContent) || $viewContent = $viewPath . '/_content';
//AceAsset::register($this);
AppAsset::register($this);
// if (!Yii::$app->user->isGuest) {
//     $kode_group_user = Yii::$app->user->identity->kode_group_user;
//     $dataMenu = \backend\models\RefGroupUser::findOne(['kode' => $kode_group_user]);
//     $url = $dataMenu['url'];
// } else {
    $url = '/site/home';
// }
    $subscribe='awal';
    $role_id = Yii::$app->user->identity->role_id;
    if(in_array($role_id, ['1'])){
        $subscribe = 'superduper';
    }elseif(in_array($role_id,['2'])){
        $subscribe = Yii::$app->user->identity->no_acak;
        
    }
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>Belanja Produktif,  <?= date("D, F j, Y") ?></title>
 <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script>
 //console.log(<?=$subscribe?>);
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;
 
var pusher = new Pusher('d9d09bafc66e41e27f56', {
  cluster:'mt1',
});
 
var channel = pusher.subscribe("<?=$subscribe?>");
channel.bind('my_event', function(data) {
 console.log(data.message);
var message = data.message;
toastr.info(message);
});
</script>
        <?php $this->head() ?>
    </head>

    <?php $this->beginBody() ?>
    <body>

        <?php if (Yii::$app->controller->action->id == 'login') { ?>
            <div class="login-content" >    
                <?= $content ?>
            </div>
            <?php
        } else {
            ?>
               <div id="page-loader" class="fade show"><span class="spinner"></span></div>
            <!-- begin #page-container -->
            <div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">

                <?= $this->render($viewHeader) ?>
                <?= $this->render($viewSidebar) ?>
                <!-- begin #content -->
                <div class="content" id="content">    
         <?= Alert::widget() ?>
                  <?= $content ?>
                </div>
            </div>     <!-- end #content -->

        <?php } ?>
    </body>

    <?php $this->endBody() ?>
</html>
<?php 
$this->endPage();

?>
<?php
Modal::begin([
    'options' => [
        'id' => 'modal',
    ],
       'title' => 'Form Dialog',
    'size' => 'modal-lg',
    
]);
echo "<div class='panel panel-inverse'> <div class='panel-heading'>+</div><div class='panel-body  text-white'>"
. "<div id='modelContent'></div></div></div>";
Modal::end();
?>

	<script>
		$(document).ready(function() {
			App.init();
		//	Dashboard.init();
		});
                
                
                
	</script>
       