<?php
if (!defined('ABSPATH'))
    exit();
class PGBlockWooBreadcrumb
{
    function __construct()
    {
        add_action('init', array($this, 'register_scripts'));
    }
    // loading src files in the gutenberg editor screen
    function register_scripts()
    {
        register_block_type(
            post_grid_plugin_dir . 'build/blocks/woo-breadcrumb/block.json',
            array(
                'render_callback' => array($this, 'theHTML'),
            )
        );
    }
    // front-end output from the gutenberg editor 
    function theHTML($attributes, $content, $block)
    {
        global $postGridCssY;
        $post_ID = isset($block->context['postId']) ? $block->context['postId'] : '';
        $post_url = get_the_permalink($post_ID);
        $blockId = isset($attributes['blockId']) ? $attributes['blockId'] : '';
        $blockAlign = isset($attributes['align']) ? 'align' . $attributes['align'] : '';
        $wrapper = isset($attributes['wrapper']) ? $attributes['wrapper'] : [];
        $wrapperOptions = isset($wrapper['options']) ? $wrapper['options'] : [];
        $wrapperTag = isset($wrapperOptions['tag']) ? $wrapperOptions['tag'] : 'div';
        $wrapperClass = isset($wrapperOptions['class']) ? $wrapperOptions['class'] : '';
        $blockCssY = isset($attributes['blockCssY']) ? $attributes['blockCssY'] : [];
        $postGridCssY[] = isset($blockCssY['items']) ? $blockCssY['items'] : [];
        // //* Visible condition
        $visible = isset($attributes['visible']) ? $attributes['visible'] : [];
        if (!empty($visible['rules'])) {
            $isVisible = post_grid_visible_parse($visible);
            if (!$isVisible) return;
        }
        // //* Visible condition
        ob_start();
        if (!empty($wrapperTag)) :
?>
            <<?php echo pg_tag_escape($wrapperTag); ?> class="<?php echo esc_attr($blockAlign); ?> <?php echo esc_attr($blockId); ?> <?php echo esc_attr($wrapperClass); ?>">
                <?php
                $args = array(
                    'delimiter' => '/',
                    'before' => ''
                );
                woocommerce_breadcrumb($args);
                echo do_shortcode('[related_products limit="12"]');
                ?>
            </<?php echo pg_tag_escape($wrapperTag); ?>>
        <?php
        endif;
        ?>
<?php
        $html = ob_get_clean();
        $cleanedHtml = post_grid_clean_html($html);
        return $cleanedHtml;
    }
}
$PGBlockWooBreadcrumb = new PGBlockWooBreadcrumb();
