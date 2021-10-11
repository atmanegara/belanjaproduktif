<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@sourcePathImg','/appbelanjaproduktif/uploads');
Yii::setAlias('@path_upload', $_SERVER['DOCUMENT_ROOT'].'/appbelanjaproduktif/uploads');
Yii::setAlias('@admin_backend','/appbelanjaproduktif/backend');
Yii::setAlias('@admin_frontend','/appbelanjaproduktif/frontend');