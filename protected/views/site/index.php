
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'                     => 'request-form',
        'enableClientValidation' => true,
        'clientOptions'          => array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

        <div class="input-group keyword-form">
        <?php
            echo $form->textField($model,'keyword', array(
                    'class'       => 'form-control',
                    'placeholder' => $model->getAttributeLabel('keyword'),
                ));
            echo '<span class="input-group-btn">';
            echo CHtml::submitButton('Go!', array(
                    'class' => 'btn btn-default',
                ));
            echo '</span>';
        ?>
        </div>

    <?php $this->endWidget(); ?>

    <div id="metrics">
      <canvas id="canvas" class="canvas"></canvas>
    </div> <!-- /metrics -->

    <div class="footer">
      <p>Enter search keyword and press "Go!". <b><?php echo $rates['remaining']; ?> Twitter API requests left.</b></p>
      <p><a href="https://github.com/yegortokmakov/TwiWordsCloud-Yii" target="_blank"><?php echo CHtml::encode(Yii::app()->name); ?></a></p>
    </div>

  <script>
  jQuery(function ($) {
    validateKeyword = function (event) {
      var keyword = $('#RequestForm_keyword').val();
      if(/^[a-zA-Z0-9]+$/.test(keyword)) {
        $('.keyword-form').removeClass('has-error');
        return true;
      }else{
        $('.keyword-form').addClass('has-error');
        return false;
      }
    };

    $('#request-form').submit(validateKeyword);
    $('#RequestForm_keyword').blur(validateKeyword);

    var $canvas = $('#canvas');
    var devicePixelRatio = 1;
    var options = {};

    options.gridSize = Math.round(16 * $('#canvas').width() / 1024);
    options.weightFactor = function (size) {
      return Math.pow(size, 2) * $('#canvas').width() / 1024;
    };

    if (('devicePixelRatio' in window) &&
        window.devicePixelRatio !== 1) {
      devicePixelRatio = parseFloat(window.devicePixelRatio);
    }

    var width = Math.floor($('#metrics').width() * 0.7);
    var height = Math.floor(width * 0.6);
    var pixelWidth = width;
    var pixelHeight = height;

    if (devicePixelRatio !== 1) {
      $canvas.css({'width': width + 'px', 'height': height + 'px'});

      pixelWidth *= devicePixelRatio;
      pixelHeight *= devicePixelRatio;
    } else {
      $canvas.css({'width': '', 'height': '' });
    }

    $canvas.attr('width', pixelWidth);
    $canvas.attr('height', pixelHeight);

    if (devicePixelRatio !== 1) {
      if (!('gridSize' in options)) {
        options.gridSize = 8;
      }
      options.gridSize *= devicePixelRatio;

      if (options.origin) {
        if (typeof options.origin[0] == 'number')
          options.origin[0] *= devicePixelRatio;
        if (typeof options.origin[1] == 'number')
          options.origin[1] *= devicePixelRatio;
      }

      if (!('weightFactor' in options)) {
        options.weightFactor = 1;
      }
      if (typeof options.weightFactor == 'function') {
        var origWeightFactor = options.weightFactor;
        options.weightFactor =
          function weightFactorDevicePixelRatioWrap() {
            return origWeightFactor.apply(this, arguments) * devicePixelRatio;
          };
      } else {
        options.weightFactor *= devicePixelRatio;
      }
    }

    options.list = JSON.parse('<?php echo D3::formCloudData($data); ?>');
    WordCloud(document.getElementById('canvas'), options);
  });
  </script>
