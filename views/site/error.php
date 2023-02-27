<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="banner">
	<?= $this->render('//layouts/inc/sidebar')?>
	<div class="w3l_banner_nav_right">
				<div style="padding: 0 1em;">
                    <h2><?= Html::encode($this->title) ?></h2>
                    <div class="alert alert-danger">
                        <?= nl2br(Html::encode($message)) ?>
                    </div>
                </div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<!-- <div class="site-error">

    <h1>< ?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        < ?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div> -->
