<?php

$config = array(
    'upload_path'   => realpath(dirname(__FILE__)) . '/../../assets/img/',
    'allowed_types' => 'jpg|png|jpeg',
    'overwrite'     => TRUE,
    'encrypt_name'  => TRUE,
    'max_size'      => '2048000', // Can be set to particular file size , here it is 2 MB(2048 Kb)
    'max_height'    => '2000',
    'max_width'     => '2000'
);
