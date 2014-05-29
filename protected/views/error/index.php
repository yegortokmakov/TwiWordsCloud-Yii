<?php $this->pageTitle = Yii::app()->name . ' - Error'; ?>

<h1>Error <?= $code; ?></h1>
<div class="b_section error">
    <div class="text">
        <p><?= CHtml::encode($message) ?></p>
        <?php if(isset($file) && !empty($file)): ?>
            <p><b>File:</b><?= CHtml::encode($file) ?></p>
        <?php endif; ?>
        <?php if(isset($line) && !empty($line)): ?>
            <p><b>Line:</b><?= CHtml::encode($line) ?></p>
        <?php endif; ?>
        <?php if(isset($errorsMessagesStack) && !empty($errorsMessagesStack)): ?>
            <p>
                <b>Stack of errors messages:</b><br>
                <p>
                    <?php foreach($errorsMessagesStack as $curErrorMessageFromStack): ?>
                        <?= CHtml::encode($curErrorMessageFromStack) ?><br>
                    <?php endforeach; ?>
                </p>
            </p>
        <?php endif; ?>
        <?php if(isset($trace) && !empty($trace)): ?>
            <p>
                <b>Trace:</b><br>
                <pre><?= CHtml::encode($trace) ?></pre>
            </p>
        <?php endif; ?>
    </div>
</div>
