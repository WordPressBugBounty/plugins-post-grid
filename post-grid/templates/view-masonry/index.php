<?php
if (!defined('ABSPATH')) exit;  // if direct access

add_action('post_grid_builder_testimonialMasonry', 'post_grid_builder_testimonialMasonry', 5, 2);

function post_grid_builder_testimonialMasonry($post_id, $PostGridData)
{

    global $PostGridBuilderCss;


    $globalOptions = isset($PostGridData["globalOptions"]) ? $PostGridData["globalOptions"] : [];
    $lazyLoad = isset($globalOptions["lazyLoad"]) ? $globalOptions["lazyLoad"] : false;
    $itemSource = isset($globalOptions["itemSource"]) ? $globalOptions["itemSource"] : "topToBottom";

    //var_dump($globalOptions);



    $items = isset($PostGridData["items"]) ? $PostGridData["items"] : [];
    $itemQueryArgs = isset($PostGridData["itemQueryArgs"]) ? $PostGridData["itemQueryArgs"] : [];


    // if ($itemSource == "posts") {
    //     $items = post_grid_builder_post_query_items($itemQueryArgs);
    // }
    // if ($itemSource == "terms") {
    //     $items = testimonial_terms_query_item($itemQueryArgs);
    // }
    // if ($itemSource == "easyAccordion") {
    //     $items = testimonial_easy_accordion_query_item($itemQueryArgs);
    // }



    $reponsiveCss = isset($PostGridData["reponsiveCss"]) ? $PostGridData["reponsiveCss"] : "";

    //var_dump($reponsiveCss);

    $PostGridBuilderCss .= $reponsiveCss;



    $loopLayout = isset($PostGridData["loopLayout"]) ? $PostGridData["loopLayout"] : [];

    $loopLayouts = $loopLayout[0]['children'];
    $wrapper = isset($PostGridData["wrapper"]) ? $PostGridData["wrapper"] : [];
    $wrapperOptions = isset($wrapper["options"]) ? $wrapper["options"] : [];
    $wrapperTag = !empty($wrapperOptions["tag"]) ? $wrapperOptions["tag"] : "div";
    $wrapperClass = isset($wrapperOptions["class"]) ? $wrapperOptions["class"] : "";

    $masonryOptions = isset($PostGridData['masonryOptions']) ? $PostGridData['masonryOptions'] : [];



    $blockId = "testimonial-" . $post_id;

    //echo "<pre>" . var_export($masonryOptions, true) . "</pre>";


    $PostGridDataAttr = [
        "id" => $blockId,
        "lazyLoad" => $lazyLoad,
    ];

    $dataBlockId = [
        "blockId" => 'abc123',
    ];

    wp_enqueue_script('jquery');
    wp_enqueue_script('imagesloaded');
    wp_enqueue_script('masonry');
    wp_enqueue_script('masonry.min');
    wp_enqueue_script('testimonial-masonry-front');

?>
    <div id="<?php echo esc_attr($blockId); ?>" class="  " style="<?php echo ($lazyLoad) ? "display: none;" : ""; ?>">


        <div class="items" data-masonry="<?php echo esc_attr(json_encode($masonryOptions)) ?>" data-block-id="<?php echo esc_attr(json_encode($dataBlockId)) ?>">
            <?php
            $count = 0;
            foreach ($items as $index => $item) {


            ?>

                <div class="item testimonial-item">
                    <?php
                    echo generateLayoutsHTML($loopLayouts, $item);
                    ?>
                </div>



            <?php
                $count++;
            }
            ?>
        </div>

    </div>


<?php
}
