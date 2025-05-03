<?php
if (!defined('ABSPATH')) exit;  // if direct access

add_action('post_grid_builder_viewGrid', 'post_grid_builder_viewGrid', 5, 2);

function post_grid_builder_viewGrid($post_id, $PostGridData)
{

    global $PostGridBuilderCss;


    $globalOptions = isset($PostGridData["globalOptions"]) ? $PostGridData["globalOptions"] : [];
    $lazyLoad = isset($globalOptions["lazyLoad"]) ? $globalOptions["lazyLoad"] : false;
    $itemSource = isset($globalOptions["itemSource"]) ? $globalOptions["itemSource"] : "topToBottom";




    $items = isset($PostGridData["items"]) ? $PostGridData["items"] : [];
    $itemQueryArgs = isset($PostGridData["itemQueryArgs"]) ? $PostGridData["itemQueryArgs"] : [];








    $reponsiveCss = isset($PostGridData["reponsiveCss"]) ? $PostGridData["reponsiveCss"] : "";


    $PostGridBuilderCss .= $reponsiveCss;

    // var_dump($reponsiveCss);

    $loopLayout = isset($PostGridData["loopLayout"]) ? $PostGridData["loopLayout"] : [];

    $loopLayouts = $loopLayout[0]['children'];
    $wrapper = isset($PostGridData["wrapper"]) ? $PostGridData["wrapper"] : [];
    $wrapperOptions = isset($wrapper["options"]) ? $wrapper["options"] : [];
    $wrapperTag = !empty($wrapperOptions["tag"]) ? $wrapperOptions["tag"] : "div";
    $wrapperClass = isset($wrapperOptions["class"]) ? $wrapperOptions["class"] : "";


    if ($itemSource == "posts") {
        $items = post_grid_builder_post_query_items($itemQueryArgs, $loopLayouts);
    }
    // if ($itemSource == "terms") {
    //     $items = testimonial_terms_query_item($itemQueryArgs);
    // }
    // if ($itemSource == "easyAccordion") {
    //     $items = testimonial_easy_accordion_query_item($itemQueryArgs);
    // }

    $blockId = "post-grid-" . $post_id;

    //echo "<pre>" . var_export($loopLayouts, true) . "</pre>";


    $PostGridDataAttr = [
        "id" => $blockId,
        "lazyLoad" => $lazyLoad,
    ];



?>
    <div id="<?php echo esc_attr($blockId); ?>" class="pg-accordion-nested  " data-accordionBuilder=<?php echo esc_attr(json_encode($PostGridDataAttr)) ?> role="tablist" style="<?php echo ($lazyLoad) ? "display: none;" : ""; ?>">


        <div class="items">
            <?php

            echo $items;




            ?>
        </div>

    </div>


<?php
}
