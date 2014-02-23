
<div id="tipos" style="min-width: 20em; max-width: 40em;"></div>

<script type="text/javascript">
    $(document).ready(function() {
        var line1 = [
<?php foreach ($countDiscipulos as $key => $total): ?>
                ['<?php echo $key ?>', <?php echo $total->getRaw(0)['numero'] ?>],
<?php endforeach; ?>
        ];
//        setTimeout(function() {
            $('#tipos').jqplot([line1], {
                title: 'Estadistica de número de personas',
                seriesDefaults: {
                    renderer: $.jqplot.BarRenderer,
                    rendererOptions: {
                        // Set the varyBarColor option to true to use different colors for each bar.
                        // The default series colors are used.
                        varyBarColor: true
                    }
                },
                axes: {
                    xaxis: {
                        renderer: $.jqplot.CategoryAxisRenderer
                    }
                }
            });
//        }, 500);
    });
</script>