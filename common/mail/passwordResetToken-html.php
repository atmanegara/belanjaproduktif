<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
?>
<div class="password-reset">
     <p>
        DATA AGEN REFERENSI
    </p>
    <table class="table table-bordered">

        <tbody>
            <tr>
                <td>NIK</td>
                <td><?= $user['nik_ref'] ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><?= $user['nama_ref'] ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?= $user['alamat_ref'] ?></td>
            </tr>
            <tr>
                <td>No. Telp</td>
                <td><?= $user['nope_ref'] ?></td>
            </tr>
        </tbody>
    </table>
    <p>
       DATA PRIBADI REGISTRASI
    </p>
    <table class="table table-bordered">

        <tbody>
            <tr>
                <td>NIK</td>
                <td><?= $user['nik'] ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><?= $user['nama'] ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?= $user['alamat'] ?></td>
            </tr>
            <tr>
                <td>No. Telp</td>
                <td><?= $user['nope'] ?></td>
            </tr>
        </tbody>
    </table>
    <p>
        DATA AKUN USER
    </p>
    <table class="table table-bordered">

        <tbody>
            <tr>
                <td>Username</td>
                <td><?= $user['username'] ?></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><?= $user['password_string'] ?></td>
            </tr>

        </tbody>
    </table>
    <p>
            INFORMASI AKUN DAN DATA PRIBADI DARI APLIKASI BELANJA PRODUKTIF
            <br>
           INFORMASI LEBIH LANJUT SILAKAN HUBUNGI <b>    CS : <?= backend\models\TentangKami::find()->one()->telp_marketting;?> </b>
    </p>
</div>
