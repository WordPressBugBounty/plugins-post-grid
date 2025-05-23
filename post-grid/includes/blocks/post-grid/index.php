<?php
if (!defined('ABSPATH'))
  exit();
class PGBlockPostGrid
{
  function __construct()
  {
    add_action('init', array($this, 'register_scripts'));
  }
  // loading src files in the gutenberg editor screen
  function register_scripts()
  {
    register_block_type(
      post_grid_plugin_dir . 'build/blocks/post-grid/block.json',
      array(
        'title' => "Post Grid",
        'render_callback' => array($this, 'theHTML'),
      )
    );
  }
  // front-end output from the gutenberg editor 
  function theHTML($attributes, $content, $block)
  {
    //wp_register_script('pg_block_scripts_post_grid', post_grid_plugin_url . 'includes/blocks/post-grid/front-scripts.js', [], '', ['in_footer' => true, 'strategy' => 'defer']);

    global $postGridCssY;
    global $postGridScriptData;
    global $postGridPrams;



    $post_ID = isset($block->context['postId']) ? $block->context['postId'] : '';
    $post_url = get_the_permalink($post_ID);
    $the_post = get_post($post_ID);
    $post_excerpt = '';
    $blockId = isset($attributes['blockId']) ? $attributes['blockId'] : '';
    $blockAlign = isset($attributes['align']) ? 'align' . $attributes['align'] : '';
    $container = isset($attributes['container']) ? $attributes['container'] : [];
    $containerOptions = isset($container['options']) ? $container['options'] : [];
    $containerClass = isset($containerOptions['class']) ? $containerOptions['class'] : '';
    $itemsWrap = isset($attributes['itemsWrap']) ? $attributes['itemsWrap'] : [];
    $itemsWrapOptions = isset($itemsWrap['options']) ? $itemsWrap['options'] : [];
    /*#######itemWrap######*/
    $itemWrap = isset($attributes['itemWrap']) ? $attributes['itemWrap'] : [];
    $itemWrapOptions = isset($itemWrap['options']) ? $itemWrap['options'] : [];
    /*#########$noPostsWrap#########*/
    $noPostsWrap = isset($attributes['noPostsWrap']) ? $attributes['noPostsWrap'] : [];
    $noPostsWrapOptions = isset($noPostsWrap['options']) ? $noPostsWrap['options'] : [];
    $spinnerWrap = isset($attributes['spinnerWrap']) ? $attributes['spinnerWrap'] : [];
    $spinnerWrapOptions = isset($spinnerWrap['options']) ? $spinnerWrap['options'] : [];
    $grid = isset($attributes['grid']) ? $attributes['grid'] : [];
    $gridOptions = isset($grid['options']) ? $grid['options'] : [];
    $gridOptionsItemCss = isset($gridOptions['itemCss']) ? $gridOptions['itemCss'] : [];
    /*#######pagination######*/
    $pagination = isset($attributes['pagination']) ? $attributes['pagination'] : [];
    $paginationOptions = isset($pagination['options']) ? $pagination['options'] : [];
    $paginationType = isset($paginationOptions['type']) ? $paginationOptions['type'] : 'none';
    $loadMoreText = isset($paginationOptions['loadMoreText']) ? $paginationOptions['loadMoreText'] : __('Load More', 'post-grid');
    $loadingText = isset($paginationOptions['loadingText']) ? $paginationOptions['loadingText'] : __('Loading...', 'post-grid');
    $noMorePosts = isset($paginationOptions['noMorePosts']) ? $paginationOptions['noMorePosts'] : __('No More Posts', 'post-grid');
    $loadingIcon = isset($paginationOptions['loadingIcon']) ? $paginationOptions['loadingIcon'] : [];
    $loadingIconLibrary = isset($loadingIcon['library']) ? $loadingIcon['library'] : "fontAwesome";
    $loadingIconSrc = isset($loadingIcon['iconSrc']) ? $loadingIcon['iconSrc'] : "fas fa-spinner";
    $loadingIconSrcType = isset($loadingIcon['srcType']) ? $loadingIcon['srcType'] : "class";
    $prevText = isset($paginationOptions['prevText']) ? $paginationOptions['prevText'] : __('Previous', 'post-grid');
    $nextText = isset($paginationOptions['nextText']) ? $paginationOptions['nextText'] : __('Previous', 'post-grid');
    $maxPageNum = isset($paginationOptions['maxPageNum']) ? $paginationOptions['maxPageNum'] : 0;
    /*#########$paginationItem############*/
    $paginationItem = isset($attributes['paginationItem']) ? $attributes['paginationItem'] : [];
    $paginationItemOptions = isset($paginationItem['options']) ? $paginationItem['options'] : [];
    $search = isset($attributes['search']) ? $attributes['search'] : [];
    $searchOptions = isset($search['options']) ? $search['options'] : [];
    $lazyLoad = isset($attributes['lazyLoad']) ? $attributes['lazyLoad'] : [];
    $lazyLoadOptions = isset($lazyLoad['options']) ? $lazyLoad['options'] : [];
    $lazyLoadEnable = isset($lazyLoadOptions['enable']) ? $lazyLoadOptions['enable'] : 'no';
    $lazyLoadIcon = isset($lazyLoadOptions['icon']) ? $lazyLoadOptions['icon'] : [];
    $lazyLoadIconLibrary = isset($lazyLoadIcon['library']) ? $lazyLoadIcon['library'] : 'fontAwesome';
    $lazyLoadIconSrc = isset($lazyLoadIcon['iconSrc']) ? $lazyLoadIcon['iconSrc'] : 'fas fa-spinner fa-spin';
    $lazyLoadIconSrcType = isset($lazyLoadIcon['srcType']) ? $lazyLoadIcon['srcType'] : 'class';
    $lazyLoadsrcUrl = isset($lazyLoadOptions['srcUrl']) ? $lazyLoadOptions['srcUrl'] : '';
    $lazyLoadsrcId = isset($lazyLoadOptions['srcId']) ? $lazyLoadOptions['srcId'] : '';
    $layout = isset($attributes['layout']) ? $attributes['layout'] : [];
    $queryArgs = isset($attributes['queryArgs']) ? $attributes['queryArgs'] : [];
    $scripts = isset($attributes['scripts']) ? $attributes['scripts'] : [];
    $blockCssY = isset($attributes['blockCssY']) ? $attributes['blockCssY'] : ['items' => []];
    $blockId = isset($attributes['blockId']) ? $attributes['blockId'] : '';
    $blockAlign = isset($attributes['align']) ? 'align' . $attributes['align'] : '';
    $itemCssArr = [];
    if (!empty($gridOptionsItemCss)) {
      foreach ($gridOptionsItemCss as $device => $args) {
        foreach ($args as $index => $items) {
          foreach ($items as $attr => $val) {
            $nth = $index + 1;
            $itemCssArr[".$blockId .item:nth-child($nth)"][$attr][$device] = $val;
          }
        }
      }
    }
    $postGridCssY[] = array_merge($blockCssY['items'], $itemCssArr);
    $postGridScriptData['lazyLoad']['enable'] = $lazyLoadEnable;
    $postGridScriptData['_wpnonce'] = wp_create_nonce('wp_rest');

    $postGridPrams[$blockId]['lazyLoad']['enable'] = $lazyLoadEnable;
    $postGridPrams[$blockId]['_wpnonce'] = wp_create_nonce('wp_rest');
    $postGridPrams[$blockId]['siteUrl'] = get_bloginfo('url');


    $obj['id'] = $post_ID;
    $obj['type'] = 'post';
    $containerClass = post_grid_parse_css_class($containerClass, $obj);
    // //* Visible condition
    $visible = isset($attributes['visible']) ? $attributes['visible'] : [];
    if (!empty($visible['rules'])) {
      $isVisible = post_grid_visible_parse($visible);
      if (!$isVisible) return;
    }
    // //* Visible condition



    if (has_block('post-grid/post-grid')) {
      wp_enqueue_style('pg_block_styles');
      ////wp_enqueue_script('pg_block_scripts');
      //wp_localize_script('pg_block_scripts', 'post_grid_vars_' . $blockId, $postGridScriptData);
      wp_localize_script('pg_block_scripts', 'post_grid_prams', $postGridPrams);

      wp_enqueue_style('font-awesome-5');
    }





    ob_start();
?>
    <div class="pg-post-grid <?php echo esc_attr($containerClass); ?> <?php echo esc_attr($blockId); ?>  <?php echo esc_attr($blockAlign); ?>">
      <?php echo ($content) ?>
    </div>
<?php
    $html = ob_get_clean();
    $cleanedHtml = post_grid_clean_html($html);
    return $cleanedHtml;
  }
}
$BlockPostGrid = new PGBlockPostGrid();
