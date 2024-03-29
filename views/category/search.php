<?php // debug($products) ?>

<!-- products-breadcrumb -->
<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="<?= \yii\helpers\Url::home() ?>">Home</a><span>|</span></li>
				<li>Поиск</li>
			</ul>
		</div>
</div>
<!-- //products-breadcrumb -->

<!-- banner -->
<div class="banner">
        <?= $this->render('//layouts/inc/sidebar') // Рендерим левую боковую панель-меню ?>

		<div class="w3l_banner_nav_right">
			<div class="w3l_banner_nav_right_banner3">
				<h3>Best Deals For New Products<span class="blink_me"></span></h3>
			</div>
			<div class="w3l_banner_nav_right_banner3_btm">
				<div class="col-md-4 w3l_banner_nav_right_banner3_btml">
					<div class="view view-tenth">
						<img src="images/13.jpg" alt=" " class="img-responsive" />
						<div class="mask">
							<h4>Grocery Store</h4>
							<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
						</div>
					</div>
					<h4>Utensils</h4>
					<ol>
						<li>sunt in culpa qui officia</li>
						<li>commodo consequat</li>
						<li>sed do eiusmod tempor incididunt</li>
					</ol>
				</div>
				<div class="col-md-4 w3l_banner_nav_right_banner3_btml">
					<div class="view view-tenth">
						<img src="images/14.jpg" alt=" " class="img-responsive" />
						<div class="mask">
							<h4>Grocery Store</h4>
							<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
						</div>
					</div>
					<h4>Hair Care</h4>
					<ol>
						<li>enim ipsam voluptatem officia</li>
						<li>tempora incidunt ut labore et</li>
						<li>vel eum iure reprehenderit</li>
					</ol>
				</div>
				<div class="col-md-4 w3l_banner_nav_right_banner3_btml">
					<div class="view view-tenth">
						<img src="images/15.jpg" alt=" " class="img-responsive" />
						<div class="mask">
							<h4>Grocery Store</h4>
							<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
						</div>
					</div>
					<h4>Cookies</h4>
					<ol>
						<li>dolorem eum fugiat voluptas</li>
						<li>ut aliquid ex ea commodi</li>
						<li>magnam aliquam quaerat</li>
					</ol>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="w3ls_w3l_banner_nav_right_grid">
				<h3>Поиск: "<?= \yii\helpers\Html::encode($q) ?>"</h3>
                <?php if(!empty($products)): ?>
                    <?php foreach($products as $product): ?>
                        <div class="w3ls_w3l_banner_nav_right_grid1">
                            <div class="col-md-3 w3ls_w3l_banner_left">
                                <div class="hover14 column">
                                    <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                                        <div class="agile_top_brand_left_grid_pos">
                                            <?php if($product->is_offer): ?>
                                                <?= \yii\helpers\Html::img('@web/images/offer.png', ['alt' => 'offer', 'class' => 'img-responsive']) // Используем HtmlHelper для вывода изображения вместо закоментированного ниже ?>
                                                <!-- <img src="images/offer.png" alt=" " class="img-responsive" /> -->
                                            <?php endif; ?>
                                        </div>
                                        <div class="agile_top_brand_left_grid1">
                                            <figure>
                                                <div class="snipcart-item block">
                                                    <div class="snipcart-thumb">
                                                        <a href="<?= \yii\helpers\URL::to(['product/view/', 'id' => $product->id]) ?>">
                                                            <?= \yii\helpers\Html::img("@web/{$product->img}", ['alt' => $product->title, ])?>
                                                        </a>
                                                        <!-- <a href="single.html"><img src="images/5.png" alt=" " class="img-responsive" /></a> -->
                                                        <p><?= $product->title ?></p>
                                                        <h4>
                                                            <?= $product->price ?>
                                                            <?php if((float) $product->old_price): // Поскольку old_price передаётся как строка '0.00', преобразуем её к float типу, чтобы если старая цена не указана (при значении 0.0), она и не выводилась ?>
                                                                <span><?= $product->old_price ?></span>
                                                            <?php endif; ?>
                                                        </h4>
                                                    </div>
                                                    <div class="snipcart-details">
													<a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $product->id]) ?>" data-id="<?= $product->id ?>" class="button add-to-cart">Добавить товар в корзину</a>
                                                        <!-- <form action="#" method="post">
                                                            <fieldset>
                                                                <input type="hidden" name="cmd" value="_cart" />
                                                                <input type="hidden" name="add" value="1" />
                                                                <input type="hidden" name="business" value=" " />
                                                                <input type="hidden" name="item_name" value="knorr instant soup" />
                                                                <input type="hidden" name="amount" value="3.00" />
                                                                <input type="hidden" name="discount_amount" value="1.00" />
                                                                <input type="hidden" name="currency_code" value="USD" />
                                                                <input type="hidden" name="return" value=" " />
                                                                <input type="hidden" name="cancel_return" value=" " />
                                                                <input type="submit" name="submit" value="Add to cart" class="button" />
                                                            </fieldset> -->
                                                        </form>											
                                                    </div>
                                                </div>    
                                            </figure>
                                        </div>
                                    </div>
                                </div>
							</div>
                        </div>   
					<?php endforeach; ?>
                    <div class="clearfix"> </div>
					<div class="col-md-12">
						<?= \yii\widgets\LinkPager::widget([
							'pagination' => $pages, // Настраиваем постраничную навигацию
						]) ?>
					</div>
                <?php else: ?>
                    <div class="w3ls_w3l_banner_nav_right_grid1">
                        <h6>По запросу ничего не найдено!</h6>
                    </div>
                <?php endif; ?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->