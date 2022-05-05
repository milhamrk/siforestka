<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$config['ipaymu_key'] = config('ipaymu');
$config['ipaymu_status'] = array(
    -1 => 'Sedang diproses',
    0 => 'Pending',
    1 => 'Berhasil',
    2 => 'Batal',
    3 => 'Refund',
);
