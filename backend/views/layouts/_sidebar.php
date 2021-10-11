<?php

use yii\helpers\Url;
use vakata\database\Query;
?>

<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="<?= Yii::getAlias('@web') . '/cadmin' ?>/img/user/user-13.jpg" alt="" />
                    </div>
                    <div class="info">
                        <?php
                        $username = '';
                        $roleide = '';
                        $namarole = '';
                        if (!Yii::$app->user->isGuest) {
                            $no_acak = Yii::$app->user->identity->no_acak;
                            $namausername = Yii::$app->user->identity->username;
                            $roleide = backend\models\Role::find()->where(['id' => Yii::$app->user->identity->role_id]);
                            if ($roleide->exists()) {
                                $namarole = $roleide->one();
                                $namarole = $namarole['nama_role'];
                            } else {
                                $namarole = '';
                            }
                        }
                        ?>
<?= $namausername ?>
                        <small><?= $namarole ?></small>
                    </div>
                </a>
            </li>

        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Menu Main</li>
            <?php
            $id_role = Yii::$app->user->identity->role_id;
            $no_acak = Yii::$app->user->identity->no_acak;
            $id_status_dp = 0;
            $expembayaran = backend\models\KonfirmasiPembayaran::find()->where(['no_acak' => $no_acak, 'id_status_pembayaran' => '2']);
            if ($expembayaran->exists()) {
                $status_dp = $expembayaran->all();
                foreach ($status_dp as $val) {
                    $id_status_dp = $val['id_status_dp'];
                    if ($id_status_dp == '2') {
                        $id_status_dp = '2';
                    }
                }
            }
            if (in_array($id_role, ['1', '4', '5'])) {
                $id_status_dp = 2;
            }
            $items = [];
            $itemSubs = [];
            //menu header
            $queryMenu = (new \yii\db\Query())
                    ->select('*')
                    ->from('menu_header')
                    ->where(['aktif' => 'Y'])
                    ->andWhere('FIND_IN_SET(:role_id,role_id)', [':role_id' => $id_role])
                    ->andWhere('FIND_IN_SET(:id_status_dp,id_status_dp)', [':id_status_dp' => $id_status_dp])
                    ->orderBy('no_urut')
                    ->all();
            //menu sub_header
            //menu sub_header_tk2
            ?>
            <?php
            foreach ($queryMenu as $menu) {
                ?>
                <li class="has-sub">
                    <a href="<?= $menu['url'] == '#' ? 'javascript:;' : Url::to(['/' . $menu['url']]) ?>">
    <?php if ($menu['sub_header'] == 'Y') { ?>
                            <b class="caret"></b>
                        <?php } ?>
                        <i class="<?=$menu['icon']?>"></i> 
                        <span><?= $menu['label'] ?></span><?php
                    if ($menu['notif'] == 'Y') {
                        if (in_array($id_role, ['2', '6'])) {
                            $modelCountBooking = backend\models\BookingBarang::modelDataBookingCount($no_acak);
                            $modelCountBookingSelesai = backend\models\BookingBarang::modelDataBookingCount($no_acak,2);
                            $modelCountCod = backend\models\QueryModel::countCod($no_acak);
                        }
                            ?>
                            <?php if ($menu['id'] == '24') { ?>
                                <span class="label label-theme m-l-5"><?= $modelCountBooking ?></span>
                                <span class="label label-success m-l-5"><?= $modelCountBookingSelesai ?></span>
                            <?php } else { ?>

                                <span class="label label-theme m-l-5"><?= $modelCountCod ?></span>
                            <?php }
                        }
                        ?>
                    </a>
                    <ul class="sub-menu">
                        <?php
                        $querySubMenu = (new \yii\db\Query())
                                ->select('*')
                                ->from('menu_sub_header')
                                ->where(['aktif' => 'Y'])
                                ->andWhere('FIND_IN_SET(:role_id,role_id)', [':role_id' => $id_role])
                                ->andWhere('FIND_IN_SET(:id_status_dp,id_status_dp)', [':id_status_dp' => $id_status_dp])
                                ->andWhere(['id_menu_header' => $menu['id']])
                                ->orderBy('no_urut')
                                ->all();

                        foreach ($querySubMenu as $sub_menu) {
                            ?>
        <?php if ($menu['id'] == $sub_menu['id_menu_header']) { ?>
                                <li class="has-sub">
                                    <a href="<?= $sub_menu['url'] == '#' ? 'javascript:;' : Url::to(['/' . $sub_menu['url']]) ?>">

                                        <?php if ($sub_menu['subheadertk2'] == 'Y') { ?>
                                            <b class="caret"></b>
                                        <?php } ?>
                                                <i class="<?=$sub_menu['icon']?>"></i> 
            <?= $sub_menu['label'] ?>
                                    </a>
                                    <ul class="sub-menu">
                                        <?php
                                        $querySubMenuTk2 = (new \yii\db\Query())
                                                ->select('*')
                                                ->from('menu_sub_header_tk2')
                                                ->where(['aktif' => 'Y'])
                                                ->andWhere('FIND_IN_SET(:role_id,role_id)', [':role_id' => $id_role])
                                                ->andWhere(['id_menu_sub_header' => $sub_menu['id']])
                                                ->orderBy('no_urut')
                                                ->all();
                                        foreach ($querySubMenuTk2 as $sub_menu_tk2) {
                                            if ($sub_menu['id'] == $sub_menu_tk2['id_menu_sub_header']) {
                                                ?>
                                                <li><a href="<?= $sub_menu_tk2['url'] == '#' ? 'javascript:;' : Url::to(['/' . $sub_menu_tk2['url']]) ?>">
                                                          <i class="<?=$sub_menu_tk2['icon']?>"></i> 
                                                        <?= $sub_menu_tk2['label'] ?></a></li>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <?php
                                }
                            }
                            ?>
                    </ul>
                </li>

<?php } ?>
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->