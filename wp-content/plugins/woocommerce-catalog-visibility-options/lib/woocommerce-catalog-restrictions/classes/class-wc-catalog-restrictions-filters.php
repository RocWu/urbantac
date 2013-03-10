<?php

class WC_Catalog_Restrictions_Filters {

    private static $instance;

    public static function instance() {
        if (!self::$instance) {
            self::$instance = new WC_Catalog_Restrictions_Filters();
        }
        return self::$instance;
    }

    public function __construct() {

        add_filter('woocommerce_grouped_price_html', array(&$this, 'on_price_html'), 100, 2);
        add_filter('woocommerce_variable_price_html', array(&$this, 'on_price_html'), 100, 2);
        add_filter('woocommerce_sale_price_html', array(&$this, 'on_price_html'), 100, 2);
        add_filter('woocommerce_price_html', array(&$this, 'on_price_html'), 100, 2);
        add_filter('woocommerce_empty_price_html', array(&$this, 'on_price_html'), 100, 2);

        add_filter('woocommerce_variable_sale_price_html', array(&$this, 'on_price_html'), 100, 2);
        add_filter('woocommerce_variable_free_sale_price_html', array(&$this, 'on_price_html'), 100, 2);
        add_filter('woocommerce_variable_free_price_html', array(&$this, 'on_price_html'), 100, 2);
        add_filter('woocommerce_variable_empty_price_html', array(&$this, 'on_price_html'), 100, 2);

        add_filter('woocommerce_free_sale_price_html', array(&$this, 'on_price_html'), 100, 2);
        add_filter('woocommerce_free_price_html', array(&$this, 'on_price_html'), 100, 2);

        add_filter('woocommerce_sale_flash', array(&$this, 'on_sale_flash'), 100, 3);
        
        add_action('woocommerce_before_add_to_cart_form', array(&$this, 'on_before_add_to_cart_button'), 0);
        add_action('woocommerce_after_add_to_cart_form', array(&$this, 'on_after_add_to_cart_button'), 100);

        add_action('woocommerce_after_shop_loop_item', array(&$this, 'on_after_shop_loop_item'), 0);
    }

    /*
     * Replacement HTML
     */

    public function on_price_html($html, $_product) {
        global $wc_cvo;

        if (!$this->user_can_view_price($_product)) {
            return apply_filters('catalog_visibility_alternate_price_html', do_shortcode(wptexturize($wc_cvo->setting('wc_cvo_c_price_text'))), $_product);
        }

        return $html;
    }

    public function on_sale_flash($html, $post, $product) {
        if (!$this->user_can_view_price($product)) {
            return '';
        }

        return $html;
    }

    public function on_before_add_to_cart_button() {
        global $product;

        if (!$this->user_can_purchase($product) || !$this->user_can_view_price($product)) {
            ob_start();
        }
    }

    public function on_after_add_to_cart_button() {
        global $wc_cvo, $product;

        if (!$this->user_can_purchase($product) || !$this->user_can_view_price($product)) {
            ob_end_clean();
        } else {
            return ob_get_clean();
        }

        // Variable product price handling
        if ($product->is_type('variable')) {
            if (!$this->user_can_view_price($product)) {
                ?>
                <div class="single_variation_wrap" style="display:none;">
                    <div class="single_variation"></div>
                    <div class="variations_button">
                        <input type="hidden" name="variation_id" value="" />
                    </div>
                </div>
                <div><input type="hidden" name="product_id" value="<?php echo esc_attr($product->id); ?>" /></div>
                <?php
            }
        }

        $html = apply_filters('catalog_visibility_alternate_add_to_cart_button', do_shortcode(wpautop(wptexturize($wc_cvo->setting('wc_cvo_s_price_text')))), $product);
        echo $html;
    }

    public function on_after_shop_loop_item() {
        global $post, $product, $wc_cvo;
        if (!$this->user_can_purchase($product)) {
            remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

            $label = wptexturize($wc_cvo->setting('wc_cvo_atc_text'));
            if (empty($label)) {
                return;
            }

            $link = get_permalink($post->ID);

            echo apply_filters('catalog_visibility_alternate_add_to_cart_link', sprintf('<a href="%s" data-product_id="%s" class="button add_to_cart_button product_type_%s">%s</a>', $link, $product->id, $product->product_type, $label));
        }
    }

    public function user_can_purchase($product) {
        //If the user can not view prices, they can not purchase the product. 
        $price_result = $this->user_can_view_price($product);
        
        if ($price_result) {
            $pfilter = get_post_meta($product->id, '_wc_restrictions_purchase', true);
            $result = false;
            if ($pfilter == 'public') {
                $result = true; //Everyone
            } elseif ($pfilter == 'restricted') {
                $roles = get_post_meta($product->id, '_wc_restrictions_purchase_roles', true);
                if ($roles && is_array($roles)) {
                    if (!is_user_logged_in()) {
                        return false;
                    }

                    foreach ($roles as $role) {

                        if (current_user_can($role)) {
                            $result = true;
                            break;
                        }
                    }
                }
            } else {
                $result = $this->user_can_purchase_in_category($product);
            }
        } else {
            $result = false;
        }

        return apply_filters('catalog_visibility_user_can_purchase', $result, $product);
    }

    public function user_can_purchase_in_category($product) {
        $result = true;

        return apply_filters('catalog_visibility_user_can_purchase_in_category', $result, $product);
    }

    public function user_can_view_price($product) {
        $pfilter = get_post_meta($product->id, '_wc_restrictions_price', true);
        $result = false;
        if ($pfilter == 'public') {
            $result = true;
        } elseif ($pfilter == 'restricted') {
            $roles = get_post_meta($product->id, '_wc_restrictions_price_roles', true);
            if ($roles && is_array($roles)) {
                if (!is_user_logged_in()) {
                    return false;
                }

                foreach ($roles as $role) {

                    if (current_user_can($role)) {
                        $result = true;
                        break;
                    }
                }
            }
        } else {
            $result = $this->user_can_view_price_in_category($product);
        }

        return apply_filters('catalog_visibility_user_can_view_price', $result, $product);
    }

    public function user_can_view_price_in_category($product) {
        $result = true;

        return apply_filters('catalog_visibility_user_can_view_price_in_category', $result, $product);
    }

}
?>