<?php
if (!defined('ABSPATH')) exit;  // if direct access

add_action('post_grid_builder_testimonialSlider', 'post_grid_builder_testimonialSlider', 5, 2);

function post_grid_builder_testimonialSlider($post_id, $PostGridData)
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

    wp_enqueue_style('splide_core');
    wp_enqueue_script('splide.min');
    wp_enqueue_script('testimonial-slider-front');

    $reponsiveCss = isset($PostGridData["reponsiveCss"]) ? $PostGridData["reponsiveCss"] : "";
    $sliderOptions = isset($PostGridData['sliderOptions']) ? $PostGridData['sliderOptions'] : [];
    $sliderOptionsRes = isset($PostGridData['sliderOptionsRes']) ? $PostGridData['sliderOptionsRes'] : [];

    //var_dump($reponsiveCss);

    $PostGridBuilderCss .= $reponsiveCss;



    $loopLayout = isset($PostGridData["loopLayout"]) ? $PostGridData["loopLayout"] : [];

    $loopLayouts = $loopLayout[0]['children'];
    $wrapper = isset($PostGridData["wrapper"]) ? $PostGridData["wrapper"] : [];
    $wrapperOptions = isset($wrapper["options"]) ? $wrapper["options"] : [];
    $wrapperTag = !empty($wrapperOptions["tag"]) ? $wrapperOptions["tag"] : "div";
    $wrapperClass = isset($wrapperOptions["class"]) ? $wrapperOptions["class"] : "";

    $sliderOptionsResNew = [];
    foreach ($sliderOptionsRes as $id => $arg) {
        foreach ($arg as $view => $value) {
            if ($view == 'Desktop') {
                $viewNum = '1280';
            }
            if ($view == 'Tablet') {
                $viewNum = '991';
            }
            if ($view == 'Mobile') {
                $viewNum = '767';
            }
            $sliderOptionsResNew[$viewNum][$id] = $value;
        }
    }
    $sliderOptions['breakpoints'] = $sliderOptionsResNew;


    $blockId = "testimonial-" . $post_id;

    //echo "<pre>" . var_export($loopLayouts, true) . "</pre>";


    $PostGridDataAttr = [
        "id" => $blockId,
        "lazyLoad" => $lazyLoad,
    ];

    $prevIconPosition = '';
    $prevIconHtml = 'Prev';
    $prevText = 'Prev';
    $nextIconPosition = '';
    $nextIconHtml = 'Next';
    $nextText = 'Next';



?>
    <div id="<?php echo esc_attr($blockId); ?>" class="splide  " data-splide="<?php echo esc_attr(json_encode($sliderOptions)) ?>" style="<?php echo ($lazyLoad) ? "display: none;" : ""; ?>">
        <div class="splide__arrows">
            <div class='prev splide__arrow splide__arrow--prev'>
                <?php if ($prevIconPosition == 'before') : ?>
                    <span class='icon'>
                        <?php echo wp_kses_post($prevIconHtml); ?>
                    </span>
                <?php endif; ?>
                <?php if (!empty($prevText)) : ?>
                    <span>
                        <?php echo esc_attr($prevText); ?>
                    </span>
                <?php endif; ?>
                <?php if ($prevIconPosition == 'after') : ?>
                    <span class='icon'>
                        <?php echo wp_kses_post($prevIconHtml); ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class='next splide__arrow splide__arrow--next'>
                <?php if ($nextIconPosition == 'before') : ?>
                    <span class='icon'>
                        <?php echo wp_kses_post($nextIconHtml); ?>
                    </span>
                <?php endif; ?>
                <?php if (!empty($nextText)) : ?>
                    <span>
                        <?php echo esc_attr($nextText); ?>
                    </span>
                <?php endif; ?>
                <?php if ($nextIconPosition == 'after') : ?>
                    <span class='icon'>
                        <?php echo wp_kses_post($nextIconHtml); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="splide__track">
            <ul class="splide__list items">
                <?php
                $count = 0;
                foreach ($items as $index => $item) {


                ?>

                    <li class="item splide__slide">
                        <?php
                        echo generateLayoutsHTML($loopLayouts, $item);
                        ?>
                    </li>



                <?php
                    $count++;
                }
                ?>
            </ul>
        </div>

        <ul class="splide__pagination "></ul>

    </div>


<?php
}
