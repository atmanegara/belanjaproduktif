<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

use yii\base\Model;
use Yii;

/**
 * Description of KondisiBagiHasil
 *
 * @author Administrator
 */
class KondisiBagiHasil extends Model {

    //put your code here


    public static function kondisiBagiHasil($no_acak_pembeli, $no_acak_user, $valJual) {
        $dataAgenPembeli = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_pembeli])->one();
    
        $no_acak_promo = $valJual['no_acak_agen_promo'];
        $no_acak_referensi = $dataAgenPembeli['no_acak_ref'];
        $level = 0;
        $hasil = 0;
        $itemPasok = 'N';
        $ket_sumber = 2;
        $kondisi = false;
        $kondisiPromo = false;
        $dataAnggotaAgen = [];
        $kode_anggota = [];
        //masukkan BP dalam anggota
        $dataAnggotaAgen[] = [
            'no_acak' => Yii::$app->user->identity->no_acak,
            'id_data_agen' => Yii::$app->user->identity->id_agen,
            'id_ref_agen' => Yii::$app->user->identity->id_ref_agen,
            'level' => 0, //artinya direkut sesama BP langsung
            'itemPasok' => 'N',
            'ket_sumber' => $ket_sumber,
                //      'ket_agen' => "99" //BP
        ];
        $kode_anggota[] = '99';

        if ($dataAgenPembeli['id_ref_agen'] == '1') {
            $no_acak_referensi = $no_acak_user;
            $levelpasok = 0;
            $tingkat = 0;
            for ($tingkat = 0; $tingkat < 10; $tingkat++) {
                $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '1']); //artinya sesama pasok
                if ($dataAgen->exists()) {
                    $level = $tingkat + 1; //menunjukan jika direkrot oleh pasok 1, jika level=2 artinya direkrot pasok no 2, pasok(1) rekrot pasok(2) rekrut pasok
                    $dataAgenPasok = $dataAgen->one(); //promo

                    $ket_agen = '2'; //2:Hanya promo
                    $kode_anggota[] = $ket_agen;
                    $dataAnggotaAgen[] = [
                        'no_acak' => $dataAgenPasok['no_acak'],
                        'id_data_agen' => $dataAgenPasok['id'],
                        'id_ref_agen' => $dataAgenPasok['id_ref_agen'],
                        'level' => $level,
                        'itemPasok' => $itemPasok,
                        'ket_sumber' => $ket_sumber,
                            //       'ket_agen'=>$ket_agen
                    ];

                    $dataItemBelanja = (new \yii\db\Query())
                            ->select('a.item_barang,b.no_acak,d.id,d.id_ref_agen,d.nama_agen,d.id_agen')
                            ->from('data_barang a')
                            ->innerJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
                            ->innerJoin('data_agen d', 'b.no_acak=d.no_acak')
                            //    ->leftJoin('data_agen d', 'b.no_acak=d.no_acak')
                            ->where([
                        'a.id' =>$valJual['id_data_barang'], //\yii\helpers\ArrayHelper::map(\backend\models\DataAnggota::find()->where(['no_acak_agen' => $no_acak_user])->asArray()->all(), 'no_acak', 'no_acak'),
                        'b.id_ref_barang' => $valJual['id_ref_barang']
                    ]);
                    if ($dataItemBelanja->exists()) { //cek siapa pemilik item ini dalam agen promo itu sendiri
                        $kondisi = true;
                        $ket_sumber = 4;
                        $itemPasok = 'Y';
                        $dataAgenPasokItem = $dataItemBelanja->one();
                        $dataAnggotaAgen[] = [
                            'no_acak' => $dataAgenPasokItem['no_acak'],
                            'id_data_agen' => $dataAgenPasokItem['id'],
                            'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
                            'level' => 1,
                            'itemPasok' => $itemPasok,
                            'ket_sumber' => $ket_sumber
                        ];
                        $ket_agen = '12';
                        $kode_anggota[] = $ket_agen;
                    }


                    $no_acak_referensi = $dataAgenPasok['no_acak_ref'];
                }
            }
        }

//stokis
        if ($dataAgenPembeli['id_ref_agen'] == '7') {
            $no_acak_referensi = $no_acak_user;
            $levelpasok = 0;
            $tingkat = 0;
            for ($tingkat = 0; $tingkat < 10; $tingkat++) {
                $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '7']); //artinya direkut sesama stokis
                if ($dataAgen->exists()) {
                    $level = $tingkat + 1; //menunjukan jika direkrot oleh pasok 1, jika level=2 artinya direkrot pasok no 2, pasok(1) rekrot pasok(2) rekrut pasok
                    $dataAgenPasok = $dataAgen->one();

                    $ket_agen = '2'; //2:Hanya pasok rekrot bukan pemilik item
                    $kode_anggota[] = $ket_agen;
                    $dataAnggotaAgen[] = [
                        'no_acak' => $dataAgenPasok['no_acak'],
                        'id_data_agen' => $dataAgenPasok['id'],
                        'id_ref_agen' => $dataAgenPasok['id_ref_agen'],
                        'level' => $level,
                        'itemPasok' => $itemPasok,
                        'ket_sumber' => $ket_sumber,
                            //       'ket_agen'=>$ket_agen
                    ];
                    $dataItemBelanja = (new \yii\db\Query())
                            ->select('a.item_barang,b.no_acak,d.id,d.id_ref_agen,d.nama_agen,d.id_agen')
                            ->from('data_barang a')
                            ->innerJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
                            ->innerJoin('data_agen d', 'b.no_acak=d.no_acak')
                            //    ->leftJoin('data_agen d', 'b.no_acak=d.no_acak')
                            ->where([
                    //    'b.no_acak' => \yii\helpers\ArrayHelper::map(\backend\models\DataAnggota::find()->where(['no_acak_agen' => $no_acak_user])->asArray()->all(), 'no_acak', 'no_acak'),
                      'a.id' =>$valJual['id_data_barang'],
                                'b.id_ref_barang' => $valJual['id_ref_barang']
                    ]);

//                            $dataItemBelanja = (new \yii\db\Query())
//                                    ->select('a.item_barang,b.no_acak,d.id,d.id_ref_agen,d.nama_agen,d.id_agen')
//                                    ->from('data_barang a')
//                                    ->leftJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
//                                    ->innerJoin('data_agen c', 'a.id_data_agen=c.id')
//                                    ->leftJoin('data_agen d', 'b.no_acak=d.no_acak')
//                                    ->where([
//                                'c.no_acak' => $no_acak_user,
//                                'b.id_ref_barang' => $valJual['id_ref_barang']
//                            ]);
                    if ($dataItemBelanja->exists()) { //cek siapa pemilik item ini dalam agen promo itu sendiri
                        $kondisi = true;
                        $ket_sumber = 4;
                        $itemPasok = 'Y';
                        $dataAgenPasokItem = $dataItemBelanja->one();
                        $dataAnggotaAgen[] = [
                            'no_acak' => $dataAgenPasokItem['no_acak'],
                            'id_data_agen' => $dataAgenPasokItem['id'],
                            'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
                            'level' => 1,
                            'itemPasok' => $itemPasok,
                            'ket_sumber' => $ket_sumber
                        ];
                        $ket_agen = '12';
                        $kode_anggota[] = $ket_agen;
                    }


                    $no_acak_referensi = $dataAgenPasok['no_acak_ref'];
                }
            }
        }

        if ($dataAgenPembeli['id_ref_agen'] == '2') {
            
            $level = 0;
            $levelpasok = 0;
            $tingkat = 0;
            for ($tingkat = 0; $tingkat < 10; $tingkat++) {
                $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '2']); //artinya direkut sesama pasok
                if ($dataAgen->exists()) {
                    $level = $level + 1; //menunjukan jika direkrot oleh pasok 1, jika level=2 artinya direkrot pasok no 2, pasok(1) rekrot pasok(2) rekrut pasok
                    $dataAgenPasok = $dataAgen->one();

                    $dataItemPasok = (new \yii\db\Query())
                            ->select('a.item_barang,b.no_acak,d.id,d.id_ref_agen,d.nama_agen,d.id_agen')
                            ->from('data_barang a')
                            ->leftJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
                            ->innerJoin('data_agen c', 'a.id_data_agen=c.id')
                            ->leftJoin('data_agen d', 'b.no_acak=d.no_acak')
                            ->where([
                       'b.no_acak' => $no_acak_referensi,
                  //    'a.id' =>$valJual['id_data_barang'],
                                'b.id_ref_barang' => $valJual['id_ref_barang']
                    ]);
                    if ($dataItemPasok->exists()) {  //cek apakah pasok yang merekrot pemilik item
                        $kondisi = true;
                        $itemPasok = 'Y';
                        $levelpasok++;
                        $ket_sumber = 4;
                        $ket_agen = "21"; //"21:Pasok Rekrot Pasok Pemilik Item" 
                        $dataAgenPasokItem = $dataItemPasok->one();
                        $dataAnggotaAgen[] = [
                            'no_acak' => $dataAgenPasokItem['no_acak'],
                            'id_data_agen' => $dataAgenPasokItem['id'],
                            'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
                            'level' => 1,
                            'itemPasok' => $itemPasok,
                            'ket_sumber' => $ket_sumber
                        ];
                        $kode_anggota[] = $ket_agen;
                    } else {
                        if ($level == '1') {
                            $ket_agen = '2'; //2:Hanya pasok rekrot bukan pemilik item
                            $kode_anggota[] = $ket_agen;
                            $dataAnggotaAgen[] = [
                                'no_acak' => $dataAgenPasok['no_acak'],
                                'id_data_agen' => $dataAgenPasok['id'],
                                'id_ref_agen' => $dataAgenPasok['id_ref_agen'],
                                'level' => $level,
                                'itemPasok' => $itemPasok,
                                'ket_sumber' => $ket_sumber,
                                    //       'ket_agen'=>$ket_agen
                            ];
                        }
                        if ($level == '1') {
//                                    $dataItemBelanja = (new \yii\db\Query())
//                                            ->select('a.item_barang,b.no_acak,c.id,c.id_ref_agen,c.nama_agen,c.id_agen')
//                                            ->from('data_barang a')
//                                            ->innerJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
//                                            ->innerJoin('data_agen c', 'b.no_acak=c.no_acak')
//                                            ->where([
//                                        'c.no_acak_ref' => $no_acak_user,
//                                        'b.id_ref_barang' => $valJual['id_ref_barang']
//                                    ]);

                            $dataItemBelanja = (new \yii\db\Query())
                                    ->select('a.item_barang,b.no_acak,d.id,d.id_ref_agen,d.nama_agen,d.id_agen')
                                    ->from('data_barang a')
                                    ->innerJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
                                    ->innerJoin('data_agen d', 'b.no_acak=d.no_acak')
                                    //    ->leftJoin('data_agen d', 'b.no_acak=d.no_acak')
                                    ->where([
                   'a.id' =>$valJual['id_data_barang'],
                                        //            'b.no_acak' => \yii\helpers\ArrayHelper::map(\backend\models\DataAnggota::find()->where(['no_acak_agen' => $no_acak_user])->asArray()->all(), 'no_acak', 'no_acak'),
                                'b.id_ref_barang' => $valJual['id_ref_barang']
                            ]);

                            if ($dataItemBelanja->exists()) { //cek siapa pemilik item ini dalam agen promo itu sendiri
                                $kondisi = true;
                                $ket_sumber = 4;
                                $itemPasok = 'Y';
                                $dataAgenPasokItem = $dataItemBelanja->one();
                                $dataAnggotaAgen[] = [
                                    'no_acak' => $dataAgenPasokItem['no_acak'],
                                    'id_data_agen' => $dataAgenPasokItem['id'],
                                    'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
                                    'level' => 1,
                                    'itemPasok' => $itemPasok,
                                    'ket_sumber' => $ket_sumber
                                ];
                                $ket_agen = '12';
                                $kode_anggota[] = $ket_agen;
                            }
                        }
                    }
                    $no_acak_referensi = $dataAgenPasok['no_acak_ref'];
                } else {
                    $dataAnggotaAgenPromo = '';
                    if ($no_acak_promo != $no_acak_referensi) {
                        $no_acak_referensi = $no_acak_promo;
                    }
                    $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '1']) //agen promo
                            ->orWhere(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '7']); //agen stokis
                    $dataAgenPromo = $dataAgen->one();
                    $ket_agen = '1';

                    $dataAnggotaAgen[] = [
                        'no_acak' => $dataAgenPromo['no_acak'],
                        'id_data_agen' => $dataAgenPromo['id'],
                        'id_ref_agen' => $dataAgenPromo['id_ref_agen'],
                        'level' => $level, //artinya direkut  BP langsung
                        'itemPasok' => $itemPasok,
                        'ket_sumber' => $ket_sumber,
                            // 'ket_agen'=>'1', //Promo
                    ];

                    $dataAnggotaAgenPromo = [
                        'no_acak' => $dataAgenPromo['no_acak'],
                        'id_data_agen' => $dataAgenPromo['id'],
                        'id_ref_agen' => $dataAgenPromo['id_ref_agen'],
                        'level' => $level, //artinya direkut  BP langsung
                        'itemPasok' => $itemPasok,
                        'ket_sumber' => $ket_sumber,
                            // 'ket_agen'=>'1', //Promo
                    ];
                    $kode_anggota[] = $ket_agen;
                    $tingkat = 11;
                    if ($level == '0') {
                        $dataItemBelanja = (new \yii\db\Query())
                                ->select('a.item_barang,b.no_acak,c.id,c.id_ref_agen,c.nama_agen,c.id_agen')
                                ->from('data_barang a')
                                ->innerJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
                                ->innerJoin('data_agen c', 'b.no_acak=c.no_acak')
                                ->where([
                     //       'c.no_acak_ref' => $no_acak_user,
                        'a.id' =>$valJual['id_data_barang'],
                                    'b.id_ref_barang' => $valJual['id_ref_barang']
                        ]);
                        if ($dataItemBelanja->exists()) { //cek item siapa ampunnya 
                            $kondisi = true;
                            $ket_sumber = 4;
                            $itemPasok = 'Y';
                            $dataAgenPasokItem = $dataItemBelanja->one();
                            $dataAnggotaAgen[] = [
                                'no_acak' => $dataAgenPasokItem['no_acak'],
                                'id_data_agen' => $dataAgenPasokItem['id'],
                                'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
                                'level' => 1,
                                'itemPasok' => $itemPasok,
                                'ket_sumber' => $ket_sumber
                            ];
                            $ket_agen = '12';
                            $kode_anggota[] = $ket_agen;
                        }
                    }
                }
            }
        }


        if ($dataAgenPembeli['id_ref_agen'] == '3') {
            $level = 0;
            $levelpasok = 0;
            $dataAnggotaAgenPromo = '';
            $tingkat = 0;
            for ($tingkat = 0; $tingkat < 10; $tingkat++) {
                $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '3']);
                if ($dataAgen->exists()) {  //artinya direkut sesama niaga
                    $level = $level + 1; //menunjukan jika direkrot oleh niaga 1, jika level=2 artinya direkrot niaga no 2, niaga(1) rekrot niaga(2) rekrut niaga
                    $dataAgenx = $dataAgen->one();
                    if ($level == '1') {
                        $dataAnggotaAgen[] = [
                            'no_acak' => $dataAgenx['no_acak'],
                            'id_data_agen' => $dataAgenx['id'],
                            'id_ref_agen' => $dataAgenx['id_ref_agen'],
                            'level' => $level,
                            'itemPasok' => $itemPasok,
                            'ket_sumber' => $ket_sumber
                        ];

                        $ket_agen = '3'; //pasok yang rekrut niaga
                    }
                    $no_acak_referensi = $dataAgenx['no_acak_ref'];
                    $kode_anggota[] = $ket_agen;
                } else {
                    $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '2']); //apakah pasok yang merekrtut ada pasok lain yang merekrot
                    if ($dataAgen->exists()) {
                        $dataAgenx = $dataAgen->one();
                        $tingkatx = 0;
                        for ($tingkat = 0; $tingkat < 10; $tingkat++) {
                            $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '2']); //artinya direkut sesama pasok
                            if ($dataAgen->exists()) {
                                $level = $level + 1;

                                $levelpasok = $levelpasok + 1; //menunjukan jika direkrot oleh pasok 1, jika level=2 artinya direkrot pasok no 2, pasok(1) rekrot pasok(2) rekrut pasok
                                $dataAgenPasok = $dataAgen->one();

                                $dataItemPasok = (new \yii\db\Query())
                                        ->select('a.item_barang,b.no_acak,d.id,d.id_ref_agen,d.nama_agen,d.id_agen')
                                        ->from('data_barang a')
                                        ->leftJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
                                        ->innerJoin('data_agen c', 'a.id_data_agen=c.id')
                                        ->leftJoin('data_agen d', 'b.no_acak=d.no_acak')
                                        ->where([
                               //'a.id' =>$valJual['id_data_barang'],//      
                               'b.no_acak' => $no_acak_referensi,
                                    'b.id_ref_barang' => $valJual['id_ref_barang']
                                ]);
                                if ($dataItemPasok->exists()) {  //cek apakah pasok yang merekrot pemilik item
                                    $kondisi = true;
                                    $itemPasok = 'Y';
                                    //    $levelpasok++;
                                    $ket_sumber = 4;
                                    $ket_agen = "31"; //"21:niaga di Rekrot Pasok Pemilik Item" 
                                    $dataAgenPasokItem = $dataItemPasok->one();
                                    $dataAnggotaAgen[] = [
                                        'no_acak' => $dataAgenPasokItem['no_acak'],
                                        'id_data_agen' => $dataAgenPasokItem['id'],
                                        'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
                                        'level' => 1,
                                        'itemPasok' => $itemPasok,
                                        'ket_sumber' => $ket_sumber
                                    ];
                                    $kode_anggota[] = $ket_agen;
                                } else {

                                    //  return var_dump($level)
                                    if ($level == '1') {
                                        $ket_agen = '32'; //2:Hanya pasok rekrot bukan pemilik item, pembelinya niaga

                                        $kode_anggota[] = $ket_agen;
                                        $dataAnggotaAgen[] = [
                                            'no_acak' => $dataAgenPasok['no_acak'],
                                            'id_data_agen' => $dataAgenPasok['id'],
                                            'id_ref_agen' => $dataAgenPasok['id_ref_agen'],
                                            'level' => $level,
                                            'itemPasok' => $itemPasok,
                                            'ket_sumber' => $ket_sumber,
                                                //       'ket_agen'=>$ket_agen
                                        ];
                                        //     return var_dump($dataAnggotaAgen);
                                    }
                                    if ($levelpasok == '1') {
                                        $dataItemBelanja = (new \yii\db\Query())
                                                ->select('a.item_barang,b.no_acak,c.id,c.id_ref_agen,c.nama_agen,c.id_agen')
                                                ->from('data_barang a')
                                                ->innerJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
                                                ->innerJoin('data_agen c', 'b.no_acak=c.no_acak')
                                                ->where([
                                   'a.id' =>$valJual['id_data_barang'],//          'c.no_acak_ref' => $no_acak_user,
                                            'b.id_ref_barang' => $valJual['id_ref_barang']
                                        ]);
                                        if ($dataItemBelanja->exists()) { //cari pemilik itemnya
                                            $kondisi = true;
                                            $ket_sumber = 4;
                                            $itemPasok = 'Y';
                                            $dataAgenPasokItem = $dataItemBelanja->one();
                                            $dataAnggotaAgen[] = [
                                                'no_acak' => $dataAgenPasokItem['no_acak'],
                                                'id_data_agen' => $dataAgenPasokItem['id'],
                                                'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
                                                'level' => 1,
                                                'itemPasok' => $itemPasok,
                                                'ket_sumber' => $ket_sumber
                                            ];
                                            $ket_agen = '12';
                                            $kode_anggota[] = $ket_agen;
                                        }
                                    }
                                }
                                $no_acak_referensi = $dataAgenPasok['no_acak_ref'];
                            } else {
                                if ($no_acak_promo != $no_acak_referensi) {
                                    $no_acak_referensi = $no_acak_promo;
                                }
                                $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '1']); //agen promo
                                $dataAgenPromo = $dataAgen->one();
                                $ket_agen = '1';

                                $dataAnggotaAgen[] = [
                                    'no_acak' => $dataAgenPromo['no_acak'],
                                    'id_data_agen' => $dataAgenPromo['id'],
                                    'id_ref_agen' => $dataAgenPromo['id_ref_agen'],
                                    'level' => $level, //artinya direkut  BP langsung
                                    'itemPasok' => $itemPasok,
                                    'ket_sumber' => $ket_sumber,
                                        // 'ket_agen'=>'1', //Promo
                                ];
                                $kode_anggota[] = $ket_agen;
                                $tingkat = 11;

                                $dataAnggotaAgenPromo = [
                                    'no_acak' => $dataAgenPromo['no_acak'],
                                    'id_data_agen' => $dataAgenPromo['id'],
                                    'id_ref_agen' => $dataAgenPromo['id_ref_agen'],
                                    'level' => $level, //artinya direkut  BP langsung
                                    'itemPasok' => $itemPasok,
                                    'ket_sumber' => $ket_sumber,
                                        // 'ket_agen'=>'1', //Promo
                                ];
                                ;
                            }
                        }

                        // 
                        // if($dataAgen['id_ref_agen']=='3'){ //1 tingkat niaga
                        //     $no_acak_referensi = $dataAgen['no_acak_ref'];
                        // }
                    } else {
                        $dataAnggotaAgenPromo = '';
                        if ($no_acak_promo != $no_acak_referensi) {
                            $no_acak_referensi = $no_acak_promo;
                        }
                        $dataAgen = \backend\models\DataAgen::find()
                                ->where(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '1']) //agen promo
                                ->orWhere(['no_acak' => $no_acak_referensi, 'id_ref_agen' => '7']); //agen stockis
                        $dataAgenPromo = $dataAgen->one(); //direkrot uleh promo
                        $ket_agen = '1'; //ini pasti promo

                        $dataAnggotaAgen[] = [
                            'no_acak' => $dataAgenPromo['no_acak'],
                            'id_data_agen' => $dataAgenPromo['id'],
                            'id_ref_agen' => $dataAgenPromo['id_ref_agen'],
                            'level' => $level, //artinya direkut  BP langsung
                            'itemPasok' => $itemPasok,
                            'ket_sumber' => $ket_sumber,
                                // 'ket_agen'=>'1', //Promo
                        ];


                        $dataAnggotaAgenPromo = [
                            'no_acak' => $dataAgenPromo['no_acak'],
                            'id_data_agen' => $dataAgenPromo['id'],
                            'id_ref_agen' => $dataAgenPromo['id_ref_agen'],
                            'level' => $level, //artinya direkut  BP langsung
                            'itemPasok' => $itemPasok,
                            'ket_sumber' => $ket_sumber,
                                // 'ket_agen'=>'1', //Promo
                        ];

                        $kode_anggota[] = $ket_agen;
                        $tingkat = 11;
                        if ($level == 0) {
                            $dataItemBelanja = (new \yii\db\Query())
                                    ->select('a.item_barang,b.no_acak,c.id,c.id_ref_agen,c.nama_agen,c.id_agen')
                                    ->from('data_barang a')
                                    ->innerJoin('data_item_barang_agen b', 'a.id_ref_barang=b.id_ref_barang')
                                    ->innerJoin('data_agen c', 'b.no_acak=c.no_acak')
                                    ->where([
                            'a.id' =>$valJual['id_data_barang'],//     'c.no_acak_ref' => $no_acak_user,
                                'b.id_ref_barang' => $valJual['id_ref_barang']
                            ]);
                            if ($dataItemBelanja->exists()) { //cek siapa pemilik barangnya
                                $kondisi = true;
                                $ket_sumber = 4;
                                $itemPasok = 'Y';
                                $dataAgenPasokItem = $dataItemBelanja->one();
                                $dataAnggotaAgen[] = [
                                    'no_acak' => $dataAgenPasokItem['no_acak'],
                                    'id_data_agen' => $dataAgenPasokItem['id'],
                                    'id_ref_agen' => $dataAgenPasokItem['id_ref_agen'],
                                    'level' => 1,
                                    'itemPasok' => $itemPasok,
                                    'ket_sumber' => $ket_sumber
                                ];
                                $ket_agen = '12';
                                $kode_anggota[] = $ket_agen;
                            }
                        }
                    }
                }
            }
        }



        return [
            'kode_anggota' => $kode_anggota,
            'dataAnggotaAgen' => $dataAnggotaAgen
        ];
    }

}
