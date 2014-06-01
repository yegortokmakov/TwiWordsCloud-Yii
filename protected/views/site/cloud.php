
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

        </div><!-- /input-group -->

    <?php $this->endWidget(); ?>

    <div id="metrics">
      <canvas id="canvas" class="canvas"></canvas>
    </div>

    <div class="footer">
      <p>Enter search keyword and press "Go!". Last 300 twits will be fetched and 
          placed in the cloud. <b><?php echo $rates['remaining']; ?> Twitter API requests left.</b></p>
      <p><?php echo CHtml::encode(Yii::app()->name); ?> &copy; Company 2014</p>
    </div>

  <script>
  jQuery(function ($) {
    var $canvas = $('#canvas');
    var devicePixelRatio = 1;
    var options = {};

    options.gridSize = Math.round(16 * $('#canvas').width() / 1024);
    options.weightFactor = function (size) {
      return Math.pow(size, 2) * $('#canvas').width() / 1024;
    };

    // Update the default value if we are running in a hdppx device
    if (('devicePixelRatio' in window) &&
        window.devicePixelRatio !== 1) {
      devicePixelRatio = parseFloat(window.devicePixelRatio);
    }

    // Set the width and height
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

    // Set devicePixelRatio options
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
