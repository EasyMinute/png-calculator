<?php


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

                <!-- Add and Remove buttons -->
                <button class="pngcalc_button" id="addPrint"><?php echo __('Додати друк', 'pngcalc') ?></button>
                <button class="pngcalc_button" id="removePrint"><?php echo __('Видалити друк', 'pngcalc') ?></button>

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

        </form>
    </div>
</section>
