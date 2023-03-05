<?php

$msg = isset($_SESSION['message'])? $_SESSION['message']: false;
$is_successful = isset($_SESSION['is_successful'])? 'yes': 'no';

if ($msg !== false) :
    if ($msg && $is_successful === 'yes'): ?>

        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
             role="alert">
            <span class="font-medium">Success alert!</span> <?= $msg ?>
        </div>

    <?php
    else: ?>

        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" 
            role="alert">
            <span class="font-medium"> Danger alert!</span> <?= $msg ?>
        </div>

    <?php
    endif;
    unset($_SESSION['message']);
    unset($_SESSION['is_successful']);
endif; ?>