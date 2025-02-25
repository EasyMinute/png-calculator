<?php
$print_discounts = get_field( 'print_discounts', 'options' );
$sublimation_koefs   = get_field('sublimation_koefs', 'options');
$silk_screen_koefs  = get_field('silk_screen_koefs', 'options');
$uv_dtf_koefs  = get_field('uv_dtf_koefs', 'options');
$dtf_koefs           = get_field('dtf_koefs', 'options');
?>


<section id="png-calculator">
    <button class="modal-closer" id="png-calculator__closer">
        <span></span>
        <span></span>
    </button>
    <div class="container">
        <form id="png-calculator-form" class="pngcalc">
            <div class="pngcalc__step" data-step="calc">
                <fieldset class="pngcalc__block">
                    <h3 class="pngcalc__block__title">
                        <?php echo __('Продукція', 'pngcalc') ?>
                    </h3>

                    <div class="product_hidden_fields">
		                <?php $price = add_hidden_inputs_to_form(); ?>
                    </div>

                    <label for="product_quantity" class="pngcalc_label">
                        <span>
                            <?php echo __('Тираж', 'pngcalc') ?>
                        </span>
                        <input type="number" name="product_quantity" id="product_quantity">
                    </label>
                    <label for="product_price" class="pngcalc_label">
                        <span>
                            <?php echo __('Ціна з сайту', 'pngcalc') ?>
                        </span>
                        <input type="number" name="product_price" id="product_price" value="<?php echo $price ?? '' ?>">
                    </label>
                    <label for="product_final_price" class="pngcalc_label">
                        <span>
                            <?php echo __('Ціна за 1 шт', 'pngcalc') ?>
                        </span>
                        <input type="number" name="product_final_price" id="product_final_price" readonly>
                    </label>
                    <label for="product_sum" class="pngcalc_label"  style="display: none">
                        <span>
                            <?php echo __('Ціна за тираж', 'pngcalc') ?>
                        </span>
                        <input type="number" name="product_sum" id="product_sum" readonly>
                    </label>


	                <?php $additional = get_field('additional', 'options'); ?>
                    <?php
                    global $post;
                    if(current_user_can('administrator') || $post->post_password): ?>

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

		                <?php if(!empty($additional['urgency'])): ?>
                            <label for="printUrgency" class="pngcalc_label checkbox">
                                <input type="checkbox" name="printUrgency" id="printUrgency" value="1">
                                <span>
                                    <?php echo __('Терміновість (націнка залежиить від тиражу): Застосовується у випадку не стандартних термінів виготолвення. Швидше за 5-7 робочих днів') ?>
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

	                <?php if(!empty($additional['clients_items'])): ?>
                        <label for="printClientProduct" class="pngcalc_label checkbox">
                            <input type="checkbox" name="printClientProduct" id="printClientProduct" value="<?php echo $additional['clients_items'] ?>">
                            <span>
                                    <?php echo __('Продукція Клієнта') ?>
                                </span>
                        </label>
	                <?php endif; ?>

                </fieldset>
                <fieldset class="pngcalc__block">
                    <h3 class="pngcalc__block__title">
                        <?php echo __('Друк (нанесення)', 'pngcalc') ?>
                    </h3>

                    <!-- Container for all print configurations -->
                    <div id="printGroupsContainer">
                        <!-- Hidden template for cloning -->
                        <div class="pngcalc__block__group print-group-template" style="display: none;">
                            <label class="pngcalc_label select">
                                <span class="hidden"><?php echo __('Тип друку', 'pngcalc') ?></span>
                                <select name="printType[]" class="printType">
                                    <option value=""><?php echo __('Оберіть тип', 'pngcalc') ?></option>
                                    <?php if(!empty($dtf_koefs)): ?>
                                        <option value="dtf"><?php echo __('DTF', 'pngcalc') ?></option>
                                    <?php endif; ?>
	                                <?php if(!empty($uv_dtf_koefs)): ?>
                                        <option value="uvDtf"><?php echo __('UV DTF', 'pngcalc') ?></option>
                                    <?php endif; ?>
	                                <?php if(!empty($silk_screen_koefs)): ?>
                                        <option value="silkScreen"><?php echo __('Шовкотрафаретний', 'pngcalc') ?></option>
                                    <?php endif; ?>
	                                <?php if(!empty($sublimation_koefs)): ?>
                                        <option value="sublimation"><?php echo __('Сублімаційний', 'pngcalc') ?></option>
                                    <?php endif; ?>
                                </select>
                            </label>
                            <label class="pngcalc_label select">
                                <span class="hidden"><?php echo __('Формат друку', 'pngcalc') ?></span>
                                <select name="printFormat[]" class="printFormat">
                                    <option value=""><?php echo __('Оберіть формат', 'pngcalc') ?></option>
                                </select>
                            </label>
                        </div>
                    </div>

                    <div class="pngcalc_button--wrap">
                        <p style="display: none;">
                            <?php echo __('Опції друку', 'pngcalc') ?>
                        </p>
                        <!-- Add and Remove buttons -->
                        <button class="pngcalc_button" id="addPrint"><?php echo __('Додати друк', 'pngcalc') ?></button>
                        <button class="pngcalc_button grey" id="removePrint"><?php echo __('Видалити друк', 'pngcalc') ?></button>
                    </div>

                    <label for="print_final_price" class="pngcalc_label">
                        <span>
                            <?php echo __('Ціна за друк 1 шт', 'pngcalc') ?>
                        </span>
                        <input type="number" name="print_final_price" id="print_final_price" readonly>
                    </label>
                    <label for="print_sum" class="pngcalc_label" style="display: none">
                        <span>
                            <?php echo __('Сума за друк', 'pngcalc') ?>
                        </span>
                        <input type="number" name="print_sum" id="print_sum" readonly>
                    </label>

                </fieldset>


                <div class="pngcalc__footer">
                    <p class="pngcalc__footer__row">
                        <span><?php echo __('Вартість продукції: ') ?></span>
                        <span id="totalProd">0</span>
                        <span>грн</span>
                    </p>
                    <p class="pngcalc__footer__row">
                        <span><?php echo __('Вартість за друк: ') ?></span>
                        <span id="totalPrint">0</span>
                        <span>грн</span>
                    </p>
                    <p class="pngcalc__footer__row">
                        <span><?php echo __('Вартість одиниці: ') ?></span>
                        <span class="green" id="totalPrice">0</span>
                        <span class="green">грн</span>
                    </p>
                    <p class="pngcalc__footer__row">
                        <span><?php echo __('Загальна вартість: ') ?></span>
                        <span class="green" id="totalSum">0</span>
                        <span class="green">грн</span>
                    </p>
                    <button class="pngcalc_button pngcalc_stepper" data-step="user" id="nextStep"><?php echo __('Надіслати розрахунок', 'pngcalc') ?></button>
                </div>


            </div>
            <div class="pngcalc__step user-step hidden" data-step="user">
                <fieldset class="pngcalc__block">
                    <h3 class="pngcalc__block__title">
			            <?php echo __('Контактні дані', 'pngcalc') ?>
                    </h3>

                    <label for="user_name" class="pngcalc_label">
                        <span>
                            <?php echo __('ПІБ', 'pngcalc') ?>
                        </span>
                        <input type="text" name="user_name" id="user_name">
                    </label>
                    <label for="user_email" class="pngcalc_label">
                        <span>
                            <?php echo __('Email', 'pngcalc') ?>
                        </span>
                        <input type="email" name="user_email" id="user_email">
                    </label>
                    <label for="user_phone" class="pngcalc_label">
                        <span>
                            <?php echo __('Телефон', 'pngcalc') ?>
                        </span>
                        <input type="tel" name="user_phone" id="user_phone">
                    </label>

                    <label for="user_notes" class="pngcalc_label">
                        <span>
                            <?php echo __('Коментар', 'pngcalc') ?>
                        </span>
                        <textarea name="user_notes" id="user_notes"></textarea>
                    </label>

                    <div class="pngcalc_button--wrap">
                        <button class="pngcalc_button pngcalc_stepper" data-step="calc"><?php echo __('Попередній крок', 'pngcalc') ?></button>
                        <button type="submit" class="pngcalc_button" id="submitCalc"><?php echo __('Надіслати', 'pngcalc') ?></button>
                    </div>
                </fieldset>
            </div>

            <div class="pngcalc__step hidden" data-step="final">
                <div>
                    <p>
                        <?php echo __("Дякуємо за запит! Форму надіслано на обробку, наш менеджер звʼяжеться з вами найближчим часом.", "pngcalc"); ?>
                    </p>
                    <button class="pngcalc_button pngcalc_stepper" data-step="calc"><?php echo __('Заповнити знову', 'pngcalc') ?></button>
                </div>
            </div>
        </form>
    </div>
</section>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
</script>

