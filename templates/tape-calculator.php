<?php
$tape_calculator = get_field('tape_calculator', 'options');
$distance = $tape_calculator['distance'] ?? '0.2';
$tape_width = $tape_calculator['tape_width'] ?? '60';
$tape_price = $tape_calculator['tape_price'] ?? '0';
$cutting_price = $tape_calculator['cutting_price'] ?? '0';
?>

<section class="tape-calculator-block">
    <div class="container">
        <form action="" id="tape-calculator" class="tape-calculator pngcalc">
    <div class="hidden_values">
        <input type="hidden" id="tape-distance" value="<?php echo $distance ?>">
        <input type="hidden" id="tape-width" value="<?php echo $tape_width ?>">
        <input type="hidden" id="tape-price" value="<?php echo $tape_price ?>">
        <input type="hidden" id="tape-cutting-price" value="<?php echo $cutting_price ?>">
    </div>
    <div class="tape-calculator__head">
        <h3>
            <?php echo __('Розрахунок вартості плівки', 'pngcalc') ?>
        </h3>
    </div>
    <div class="tape-calculator__body">
        <div class="tape-calculator__row">
            <label for="print_width" class="pngcalc_label">
                <span>
                    <?php echo __('Ширина', 'pngcalc') ?>
                </span>
                <input type="number" name="print_width" id="print_width">
            </label>
            <label for="print_length" class="pngcalc_label">
                <span>
                    <?php echo __('Довжина', 'pngcalc') ?>
                </span>
                <input type="number" name="print_length" id="print_length">
            </label>
            <label for="print_quantity" class="pngcalc_label">
                <span>
                    <?php echo __('Кількість', 'pngcalc') ?>
                </span>
                <input type="number" name="print_quantity" id="print_quantity">
            </label>
        </div>

        <label for="tape-cutting" class="pngcalc_label checkbox">
            <input type="checkbox" name="tape-cutting" id="tape-cutting" value="1">
            <span>
                <?php echo __('Плотерна порізка') ?>
            </span>
        </label>
    </div>
    <div class="tape-calculator__footer">
        <label for="print_orientation" class="pngcalc_label total_label">
            <span>
                <?php echo __('Оптимальна орієнтація', 'pngcalc') ?>
            </span>
            <input class="total-input" type="text" value="0 грн" name="print_orientation" id="print_orientation" readonly>
        </label>
        <label for="tape_length" class="pngcalc_label total_label">
            <span>
                <?php echo __('Довжина плівки (мп)', 'pngcalc') ?>
            </span>
            <input class="total-input" type="text" value="0 грн" name="tape_length" id="tape_length" readonly>
        </label>
        <label for="total_tape_price" class="pngcalc_label total_label">
            <span>
                <?php echo __('Вартість тиражу', 'pngcalc') ?>
            </span>
            <input class="total-input" type="text"  value="0 грн" name="total_tape_price" id="total_tape_price" readonly>
        </label>
        <label for="print_price" class="pngcalc_label total_label">
            <span>
                <?php echo __('Вартість за шт', 'pngcalc') ?>
            </span>
            <input class="total-input" type="text" value="0 грн" name="print_price" id="print_price" readonly>
        </label>
    </div>
</form>
    </div>
</section>
