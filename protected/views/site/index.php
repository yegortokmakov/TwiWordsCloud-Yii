
      <div class="jumbotron">
        <h1>Twits words cloud</h1>
        <p class="lead">Enter search keyword in field below and press "Go!". Last 300 twits will be fetched and 
          placed in the cloud. <?php echo $rates['remaining']; ?> Twitter API requests left.
        </p>

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'                     => 'request-form',
            'enableClientValidation' => true,
            'clientOptions'          => array(
                'validateOnSubmit'=>true,
            ),
        )); ?>

            <div class="input-group input-group-lg">

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


      </div>


      <div class="row metrics" style="bsorder:1px solid #DEDEDE;">
    <script>
    //*
    width = parseInt(d3.select(".metrics").style("width"))

    var diameter = width,
        format = d3.format(",d"),
        color = d3.scale.category20c();

    var bubble = d3.layout.pack()
        .sort(null)
        .size([diameter, diameter])
        .padding(1.5);

    var svg = d3.select(".metrics").append("svg")
        .attr("width", diameter)
        .attr("height", diameter)
        .attr("class", "bubble");

    var twiData = JSON.parse('<?php echo D3::formGraphData($data); ?>');
    run(twiData);

    function run(root) {
      var node = svg.selectAll(".node")
          .data(bubble.nodes(classes(root))
          .filter(function(d) { return !d.children; }))
        .enter().append("g")
          .attr("class", "node")
          .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

      node.append("title")
          .text(function(d) { return d.className + ": " + format(d.value); });

      node.append("circle")
          .attr("r", function(d) { return d.r; })
          .style("fill", function(d) { return color(d.packageName); });

      node.append("text")
          .attr("dy", ".3em")
          .style("text-anchor", "middle")
          .text(function(d) { return d.className.substring(0, d.r / 3); });
    }

    // Returns a flattened hierarchy containing all leaf nodes under the root.
    function classes(root) {
      var classes = [];

      function recurse(name, node) {
        if (node.children) node.children.forEach(function(child) { recurse(node.name, child); });
        else classes.push({packageName: name, className: node.name, value: node.size});
      }

      recurse(null, root);
      return {children: classes};
    }

    d3.select(self.frameElement).style("height", diameter + "px");
    </script>
      </div>
