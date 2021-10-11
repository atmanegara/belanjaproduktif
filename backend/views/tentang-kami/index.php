<div class="profile">
    <div class="profile-header">
        <!-- BEGIN profile-header-cover -->
        <div class="profile-header-cover"></div>
        <!-- END profile-header-cover -->
        <!-- BEGIN profile-header-content -->
        <div class="profile-header-content">
            <!-- BEGIN profile-header-img -->
            <div class="profile-header-img">
                <img src="<?= Yii::getAlias('@sourcePathImg/') . $modelFotoProfil['filename']; ?>" alt="">
            </div>
            <!-- END profile-header-img -->
            <!-- BEGIN profile-header-info -->
            <div class="profile-header-info">
                <h4 class="m-t-10 m-b-5"><?= $model['nama_cv'] ?></h4>
                <p class="m-b-10"><?= $model['no_siup'] ?></p>
                <p>
                    <?=
                    yii\bootstrap4\Html::button('Edit Foto', ['class' => 'btn btn-primary showModalButton',
                        'value' => \yii\helpers\Url::to(['/foto-profil/update', 'id' => $model->id])])
                    ?>

                </p>
            </div>
            <!-- END profile-header-info -->
        </div>
        <!-- END profile-header-content -->
        <!-- BEGIN profile-header-tab -->
        <ul class="profile-header-tab nav nav-tabs">
            <li class="nav-item"><a href="#" class="nav-link" data-toggle="tab">ABOUT</a></li>
        </ul>
        <!-- END profile-header-tab -->
    </div>
    <div class="profile-content">
        <!-- begin tab-content -->
        <div class="tab-content p-0">

            <!-- begin #profile-about tab -->
            <div class="tab-pane fade in active show" id="profile-about">
                <!-- begin table -->
                <div class="table-responsive">
                    <p>
                        <?=
                        yii\bootstrap4\Html::button('Update', ['class' => 'btn btn-primary showModalButton',
                            'value' => \yii\helpers\Url::to(['update', 'id' => $model->id])])
                        ?>
                        <?=
                        yii\bootstrap4\Html::button('Update Info Tentang Kami', ['class' => 'btn btn-warning showModalButton',
                            'value' => \yii\helpers\Url::to(['/detail-about/update', 'id' => '1'])])
                        ?>
                    </p>
                    <div class="row">
                        <div class="col-md-4">
                            <?=
                            \kartik\detail\DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    //   'id',
                                    'nama_cv:text:Nama Perusahaan/Badan Usaha',
                                    'no_siup:text:NO. SIUP',
                                    'alamat_cv:text:Alamat Kantor',
                                    'telp_cv:text:Telp Kantor',
                                    'telp_admin:text:Telp (WA) Admin',
                                    'telp_marketting:text:Telp (WA) Marketing',
                                    'email:email:E-mail',
                                    'kontak_lainnya:text:Info Rekening',
                                ],
                            ])
                            ?> 
                        </div>
                        <div class="col-md-8">
                              <p>       <div class="row row-space-6">
                         
                                <div class="col-md-12 col-xl-12">
                                    <?=
                                    \kartik\detail\DetailView::widget([
                                        'model' => $modelDetailAbout,
                                        'attributes' => [
                                            //   'id',
                                            'tag_line:text:Tag Line',
                                            'header:text:Info Tentang Kami',
                                        ],
                                    ])
                                    ?>

                                </div>
                          
                            </div>            </p>   
                            <div class="row row-space-6">
                                <p>

                                    <?=
                                    yii\bootstrap4\Html::button('Update Visi dan Misi', ['class' => 'btn btn-info showModalButton',
                                        'value' => \yii\helpers\Url::to(['/visi-misi-perusahaan/update', 'id' => '1'])])
                                    ?>
                                </p>
                                <div class="col-md-12 col-xl-12">      <?=
                                    \kartik\detail\DetailView::widget([
                                        'model' => $modelVisiMisi,
                                        'attributes' => [
                                         
                                            'visi:text:VISI',
                                            'misi:text:MISI',
                                        ],
                                    ])
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end table -->
            </div>
            <!-- end #profile-about tab -->



        </div>
        <!-- end tab-content -->
    </div>
</div>