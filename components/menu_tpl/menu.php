<!-- Шаблон одного пункта левого бокового меню -->
<li <?php if(isset($category['children'])) echo 'class="dropdown"' // Если у категории есть потомки, присваиваем тегу списка класс dropdown ?>>
    <a  href="<?= \yii\helpers\Url::to(['category/view', 'id' => $category['id']]) ?>"<?php if(isset($category['children'])) echo 'class="dropdown-toggle" data-toggle="dropdown"'?>>
        <?= $category['title'] // Выводим название категории ?>
    </a>
    <?php if(isset($category['children'])): // Если есть потомки, выводим всех потомков ?>
        <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
            <div class="w3ls_vegetables">
                <ul>
                    <?= $this->getMenuHtml($category['children']) // Рекурсивный вызов потомков ?>
                    <!--<li><a href="drinks.html">Soft Drinks</a></li>
                    <li><a href="drinks.html">Juices</a></li>-->
                </ul>
            </div>                  
        </div>
    <?php endif; ?>
</li>



<!-- Выводим только корневые категории -->
<!--<li>
    <a href="< ?= \yii\helpers\Url::to(['category/view', 'id' => $category['id']]) // Ссылка на категорию, ссылки потом нужно настроить в web/config ?>">
        < ?= $category['title'] // Выводим название категории ?>
    </a>
</li>-->
