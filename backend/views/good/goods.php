<?php
/**
 * Created by PhpStorm.
 * User: ivansamofal
 * Date: 6/2/18
 * Time: 1:28 PM
 */


?>

<div class="row">
    <?php /** @var Goods $good  */?>
    <?php foreach ($goods as $good):?>
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <?=$good->name?>
                <div class="card-body">
                    <p class="card-text"><?=$good->short_description?> <i><?=$good->price?></i></p>
                    <p class="card-text"><?=$good->humanNamesStatuses();?></p>
                </div>
            </div>

        </div>
    <?php endforeach;?>
</div>

<?php

