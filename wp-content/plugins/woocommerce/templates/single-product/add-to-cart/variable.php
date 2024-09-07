<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
    <?php do_action( 'woocommerce_before_variations_form' ); ?>

    <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
        <p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
    <?php else : ?>
        <div class="variations" cellspacing="0" role="radiogroup" aria-label="<?php esc_attr_e( 'Product options', 'woocommerce' ); ?>">
            <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                <div class="variation-row">
                    <span class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></span>
                    <div class="value">
                        <?php
                        wc_dropdown_variation_attribute_options(
                            array(
                                'options'   => $options,
                                'attribute' => $attribute_name,
                                'product'   => $product,
                                'class'     => 'hidden',
                            )
                        );
                        if ( ! empty( $options ) ) {
                            if ( taxonomy_exists( $attribute_name ) ) {
                                $terms = wc_get_product_terms( $product->get_id(), $attribute_name, array( 'fields' => 'all' ) );
                                foreach ( $terms as $term ) {
                                    if ( in_array( $term->slug, $options, true ) ) {
                                        ?>
                                        <label class="variation-box">
                                            <input 
                                                type="radio" 
                                                name="attribute_<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>" 
                                                value="<?php echo esc_attr( $term->slug ); ?>" 
                                                id="<?php echo esc_attr( sanitize_title( $attribute_name ) . '_' . $term->slug ); ?>"
                                                <?php checked( sanitize_title( $product->get_variation_default_attribute( $attribute_name ) ), $term->slug ); ?> 
                                                data-attribute_name="attribute_<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"
                                                data-value="<?php echo esc_attr( $term->slug ); ?>"
                                            >
                                            <span><?php echo esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name, $term, $attribute_name, $product ) ); ?></span>
                                        </label>
                                        <?php
                                    }
                                }
                            } else {
                                foreach ( $options as $option ) {
                                    ?>
                                    <label class="variation-box">
                                        <input 
                                            type="radio" 
                                            name="attribute_<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>" 
                                            value="<?php echo esc_attr( $option ); ?>" 
                                            id="<?php echo esc_attr( sanitize_title( $attribute_name ) . '_' . sanitize_title( $option ) ); ?>"
                                            <?php checked( sanitize_title( $product->get_variation_default_attribute( $attribute_name ) ), sanitize_title( $option ) ); ?> 
                                            data-attribute_name="attribute_<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"
                                            data-value="<?php echo esc_attr( $option ); ?>"
                                        >
                                        <span><?php echo esc_html( apply_filters( 'woocommerce_variation_option_name', $option, null, $attribute_name, $product ) ); ?></span>
                                    </label>
                                    <?php
                                }
                            }
                        }
                        echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php do_action( 'woocommerce_after_variations_table' ); ?>

        <div class="single_variation_wrap">
            <?php
                /**
                 * Hook: woocommerce_before_single_variation.
                 */
                do_action( 'woocommerce_before_single_variation' );

                /**
                 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
                 *
                 * @since 2.4.0
                 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
                 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
                 */
                do_action( 'woocommerce_single_variation' );

                /**
                 * Hook: woocommerce_after_single_variation.
                 */
                do_action( 'woocommerce_after_single_variation' );
            ?>
        </div>
    <?php endif; ?>

    <?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<style>
.variations {
    margin-bottom: 20px;
}
.variation-row {
    margin-bottom: 15px;
}
.variation-row .label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}
.variation-row .value {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.variation-box {
    position: relative;
    display: inline-block;
    border: 1px solid #ddd;
    padding: 5px 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.variation-box input[type="radio"] {
    position: absolute;
    opacity: 0;
}
.variation-box span {
    display: inline-block;
}
.variation-box:hover {
    border-color: #999;
}
.variation-box input[type="radio"]:checked + span {
    font-weight: bold;
    color: #CA975E;
}
.variation-box input[type="radio"]:checked + span::after {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    border: 2px solid #CA975E;
    border-radius: 3px;
    pointer-events: none;
}
.hidden {
    display: none !important;
}
</style>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('.variations input[type="radio"]').on('change', function() {
        var $form = $(this).closest('form.variations_form');
 
        // Collect all selected attributes
        $form.find('.variations input[type="radio"]:checked').each(function() {
            var name = $(this).attr('name');
            var value = $(this).val();
            selectedAttrs[name] = value;
        });

        // Trigger WooCommerce's variation selection
        $form.find('select').val('');
        $.each(selectedAttrs, function(name, value) {
            $form.find('select[name="' + name + '"]').val(value);
        });
        $form.trigger('check_variations');
        $form.trigger('woocommerce_variation_select_change');
        $form.trigger('change', [selectedAttrs]);
    });

    // Trigger change on page load to initialize the form
    $('.variations input[type="radio"]:checked').first().trigger('change');
});
</script>