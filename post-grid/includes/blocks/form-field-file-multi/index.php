<?php
if (!defined('ABSPATH'))
  exit();
class PGBlockFormFieldFileMulti
{
  function __construct()
  {
    add_action('init', array($this, 'register_scripts'));
  }
  // loading src files in the gutenberg editor screen
  function register_scripts()
  {
    register_block_type(
      post_grid_plugin_dir . 'build/blocks/form-field-file-multi/block.json',
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
    $the_post = get_post($post_ID);
    $text = '';
    $blockId = isset($attributes['blockId']) ? $attributes['blockId'] : '';
    $blockAlign = isset($attributes['align']) ? 'align' . $attributes['align'] : '';
    $wrapper = isset($attributes['wrapper']) ? $attributes['wrapper'] : [];
    $wrapperOptions = isset($wrapper['options']) ? $wrapper['options'] : [];
    $wrapperClass = isset($wrapperOptions['class']) ? $wrapperOptions['class'] : '';
    $labelWrap = isset($attributes['labelWrap']) ? $attributes['labelWrap'] : [];
    $labelWrapOptions = isset($labelWrap['options']) ? $labelWrap['options'] : [];
    $input = isset($attributes['file']) ? $attributes['file'] : [];
    $inputOptions = isset($input['options']) ? $input['options'] : [];
    $inputType = isset($inputOptions['type']) ? $inputOptions['type'] : 'text';
    $inputPlaceholder = isset($inputOptions['placeholder']) ? $inputOptions['placeholder'] : '';
    $inputValue = isset($inputOptions['value']) ? $inputOptions['value'] : '';
    $inputMaxCount = isset($inputOptions['maxCount']) ? (int) $inputOptions['maxCount'] : 3;
    $inputName = isset($inputOptions['name']) ? $inputOptions['name'] : $blockId;
    $inputRequired = isset($inputOptions['required']) ? $inputOptions['required'] : false;
    $inputDisabled = isset($inputOptions['disabled']) ? $inputOptions['disabled'] : false;
    $inputReadonly = isset($inputOptions['readonly']) ? $inputOptions['readonly'] : false;
    $inputName = $inputName . '[]';
    $inputWrap = isset($attributes['inputWrap']) ? $attributes['inputWrap'] : [];
    $inputWrapOptions = isset($inputWrap['options']) ? $inputWrap['options'] : [];
    $label = isset($attributes['label']) ? $attributes['label'] : [];
    $labelOptions = isset($label['options']) ? $label['options'] : [];
    $labelEnable = isset($labelOptions['enable']) ? $labelOptions['enable'] : true;
    $labelText = isset($labelOptions['text']) ? $labelOptions['text'] : '';
    $errorWrap = isset($attributes['errorWrap']) ? $attributes['errorWrap'] : [];
    $errorWrapOptions = isset($errorWrap['options']) ? $errorWrap['options'] : [];
    $errorWrapPosition = isset($errorWrapOptions['position']) ? $errorWrapOptions['position'] : '';
    $errorWrapText = isset($errorWrapOptions['text']) ? $errorWrapOptions['text'] : '';
    $addItem = isset($attributes['addItem']) ? $attributes['addItem'] : [];
    $addItemOptions = isset($addItem['options']) ? $addItem['options'] : [];
    $addItemPosition = isset($addItemOptions['position']) ? $addItemOptions['position'] : '';
    $addItemText = isset($addItemOptions['text']) ? $addItemOptions['text'] : '';
    $blockCssY = isset($attributes['blockCssY']) ? $attributes['blockCssY'] : [];
    $postGridCssY[] = isset($blockCssY['items']) ? $blockCssY['items'] : [];
    $obj['id'] = $post_ID;
    $obj['type'] = 'post';
    $wrapperClass = post_grid_parse_css_class($wrapperClass, $obj);
    ob_start();
?>
    <div class="<?php echo esc_attr($blockId); ?> <?php echo esc_attr($wrapperClass); ?> ">
      <div class='label-wrap'>
        <?php if ($labelEnable): ?>
          <label for="" class="font-medium text-slate-900 ">
            <?php echo wp_kses_post($labelText); ?>
          </label>
        <?php endif; ?>
        <?php if ($addItemPosition == 'afterLabel'): ?>
          <div class='add-item'>
            <?php echo wp_kses_post($addItemText); ?>
          </div>
        <?php endif; ?>
        <?php if ($errorWrapPosition == 'afterLabel'): ?>
          <div class='error-wrap'>
            <?php echo wp_kses_post($errorWrapText); ?>
          </div>
        <?php endif; ?>
      </div>
      <div class='input-wrap'>
        <?php if ($addItemPosition == 'beforeFiles'): ?>
          <div class='add-item'>
            <?php echo wp_kses_post($addItemText); ?>
          </div>
        <?php endif; ?>
        <?php
        for ($i = 0; $i < $inputMaxCount; $i++) {
        ?>
          <div class="item">
            <input type="file" placeholder="<?php echo esc_attr($inputPlaceholder); ?>"
              value="<?php echo esc_attr($inputValue); ?>" name="<?php echo esc_attr($inputName); ?>"
              <?php if ($inputRequired): ?> required <?php endif; ?> <?php if ($inputDisabled): ?> disabled <?php endif; ?>
              <?php if ($inputReadonly): ?> readonly <?php endif; ?> />
          </div>
        <?php
        }
        ?>
        <?php if ($addItemPosition == 'afterFiles'): ?>
          <div class='add-item'>
            <?php echo wp_kses_post($addItemText); ?>
          </div>
        <?php endif; ?>
        <?php if ($errorWrapPosition == 'afterInput'): ?>
          <div class='error-wrap'>
            <?php echo wp_kses_post($errorWrapText); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
<?php
    $html = ob_get_clean();
    $cleanedHtml = post_grid_clean_html($html);
    return $cleanedHtml;
  }
}
$PGBlockFormFieldFileMulti = new PGBlockFormFieldFileMulti();
