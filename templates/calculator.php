<?php
$print_discounts = get_field( 'print_discounts', 'options' );

?>


<section id="png-calculator">
    <div class="container">
        <h1 class="pngcalc_title">
	        <?php echo __('Розрахунок вартості', 'pngcalc') ?>
        </h1>
        <form id="png-calculator-form" class="pngcalc">
            <fieldset class="pngcalc__block">
                <h3 class="pngcalc__block__title">
	                <?php echo __('Визначення вартості виробів', 'pngcalc') ?>
                </h3>

                <label for="product_quantity" class="pngcalc_label">
                    <span>
                        <?php echo __('Кількість товарів', 'pngcalc') ?>
                    </span>
                    <input type="number" name="product_quantity" id="product_quantity">
                </label>
                <label for="product_price" class="pngcalc_label">
                    <span>
                        <?php echo __('Роздрібна ціна', 'pngcalc') ?>
                    </span>
                    <input type="number" name="product_price" id="product_price">
                </label>
                <label for="product_final_price" class="pngcalc_label">
                    <span>
                        <?php echo __('Ціна за 1 шт', 'pngcalc') ?>
                    </span>
                    <input type="number" name="product_final_price" id="product_final_price" readonly>
                </label>
                <label for="product_sum" class="pngcalc_label">
                    <span>
                        <?php echo __('Ціна за тираж', 'pngcalc') ?>
                    </span>
                    <input type="number" name="product_sum" id="product_sum" readonly>
                </label>
            </fieldset>


            <fieldset class="pngcalc__block">
                <h3 class="pngcalc__block__title">
			        <?php echo __('Визначення вартості друку', 'pngcalc') ?>
                </h3>

                <!-- Container for all print configurations -->
                <div id="printGroupsContainer">
                    <!-- Hidden template for cloning -->
                    <div class="pngcalc__block__group print-group-template" style="display: none;">
                        <label class="pngcalc_label select">
                            <span><?php echo __('Тип друку', 'pngcalc') ?></span>
                            <select name="printType[]" class="printType">
                                <option value=""><?php echo __('Оберіть тип', 'pngcalc') ?></option>
                                <option value="sublimation"><?php echo __('Сублімаційний', 'pngcalc') ?></option>
                                <option value="whiteDirect"><?php echo __('Прямий друк на білих тканинах', 'pngcalc') ?></option>
                                <option value="colorDirect"><?php echo __('Прямий друк на кольорових тканинах', 'pngcalc') ?></option>
                                <option value="dtf"><?php echo __('DTF', 'pngcalc') ?></option>
                            </select>
                        </label>
                        <label class="pngcalc_label select">
                            <span><?php echo __('Формат друку', 'pngcalc') ?></span>
                            <select name="printFormat[]" class="printFormat">
                                <option value=""><?php echo __('Оберіть формат', 'pngcalc') ?></option>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="pngcalc_button--wrap">
                    <p>
                        <?php echo __('Опції друку', 'pngcalc') ?>
                    </p>
                    <!-- Add and Remove buttons -->
                    <button class="pngcalc_button" id="addPrint"><?php echo __('Додати друк', 'pngcalc') ?></button>
                    <button class="pngcalc_button" id="removePrint"><?php echo __('Видалити друк', 'pngcalc') ?></button>
                </div>

                <?php if(current_user_can('administrator')): ?>

                    <label class="pngcalc_label select discountGroup">
                        <span><?php echo __('Група знижок', 'pngcalc') ?></span>
                        <select name="printDiscounts" class="printDiscounts">
                            <option value="1"><?php echo __('Без знижки', 'pngcalc') ?></option>
                            <?php foreach($print_discounts as $discount): ?>
                                <option value="<?php echo (100 - $discount['value']) / 100 ?>">
                                    <?php echo $discount['title'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <?php $additional = get_field('additional', 'options'); ?>

                    <?php if(!empty($additional['urgency'])): ?>
                        <label for="printUrgency" class="pngcalc_label checkbox">
                            <input type="checkbox" name="printUrgency" id="printUrgency" value="1">
                            <span>
                                <?php echo __('Терміновість (націнка залежиить від тиражу): Застосовується у випадку не стандартних термінів виготолвення. Швидше за 5-7 робочих днів') ?>
                            </span>
                        </label>
                    <?php endif; ?>

                    <?php if(!empty($additional['clients_items'])): ?>
                        <label for="printClientProduct" class="pngcalc_label checkbox">
                            <input type="checkbox" name="printClientProduct" id="printClientProduct" value="<?php echo $additional['clients_items'] ?>">
                            <span>
                                <?php echo __('Продукція Клієнта') ?>
                            </span>
                        </label>
                    <?php endif; ?>
                    <?php if(!empty($additional['difficulty_koef'])): ?>
                        <label for="printDifficulty" class="pngcalc_label checkbox">
                            <input type="checkbox" name="printDifficulty" id="printDifficulty" value="<?php echo $additional['difficulty_koef'] ?>">
                            <span>
                                <?php echo __('Складність нанесення: (включається на такі типи продуку: тенти, робочий одяг з друком на кишеню, нанесення на шви, продукція з додатковою фурнітурою, рюкзаки, парасолі)') ?>
                            </span>
                        </label>
                    <?php endif; ?>
                    <?php if(!empty($additional['package_add'])): ?>
                        <label for="printPackaging" class="pngcalc_label checkbox">
                            <input type="checkbox" name="printPackaging" id="printPackaging" value="<?php echo $additional['package_add'] ?>">
                            <span>
                                <?php echo __('Додаткове розпакування-запакування ( яке потребує додаткового зусилля)') ?>
                            </span>
                        </label>
                    <?php endif; ?>

                <?php endif; ?>

                <label for="print_final_price" class="pngcalc_label">
                    <span>
                        <?php echo __('Ціна за принт 1 шт', 'pngcalc') ?>
                    </span>
                    <input type="number" name="print_final_price" id="print_final_price" readonly>
                </label>
                <label for="print_sum" class="pngcalc_label">
                    <span>
                        <?php echo __('Сума за принт', 'pngcalc') ?>
                    </span>
                    <input type="number" name="print_sum" id="print_sum" readonly>
                </label>

            </fieldset>

            <div class="pngcalc__footer">
                <p class="pngcalc__footer__row">
                    <?php echo __('Загальна вартість одиниці: ') ?>
                    <span id="totalPrice">0</span>
                </p>
                <p class="pngcalc__footer__row">
		            <?php echo __('Загальна сума: ') ?>
                    <span id="totalSum">0</span>
                </p>
            </div>
        </form>
    </div>
</section>
