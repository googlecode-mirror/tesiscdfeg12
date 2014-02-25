<?php use_helper('I18N'); ?>
<ul>
    <?php foreach ($celulas as $key => $celula) : ?>
        <li>
            <?php echo $celula->getId() . " " . $celula->getPorcentajeAssitencias(); ?>
        </li>
    <?php endforeach; ?>
</ul>
<table>
    <tr>
        <td>
            <div id="tipos" class="chart-container"></div>
        </td>
        <td>
            <div id="segimiento" class="chart-container"></div>
        </td>
    </tr>
</table>

<div class="clear"></div>
<script type="text/javascript">
    $(document).ready(function() {
    var line1 = [ <?php foreach ($countDiscipulos as $key => $total): ?> ['<?php echo $key ?>', <?php echo $total->getRaw(0)['numero'] ?>], <?php endforeach; ?> ];
            $('#tipos').jqplot([line1], {
    title: 'Estadística de número de personas',
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
<?php for ($i = 4; $i <= 6; $i++) : ?>
        var s<?php echo $i ?> = [ <?php foreach ($fechas as $key => $fecha) : ?> <?php foreach (Doctrine_Core::getTable('Seguimiento')->countActividadesFecha($fecha->getRaw('month'), $fecha->getRaw('year')) as $key1 => $value) : ?> <?php if ($value['actividad_seguimiento_id'] == $i) : ?> <?php echo $value['numero'] ?>, <?php else: ?> 0, <?php endif; ?> <?php endforeach; ?> <?php endforeach; ?> ];
<?php endfor; ?>
    var ticks = [
<?php foreach ($fechas as $key => $fecha) : ?>
        '<?php echo __($fecha->getRaw('month')) . " " . $fecha->getRaw('year') ?>',
<?php endforeach; ?>
    ];
            plot2 = $.jqplot('segimiento', [ <?php for ($i = 4; $i <= 6; $i++) : ?> s<?php echo $i ?>, <?php endfor; ?> ], {
            title: 'Estadística de consolidación',
                    seriesDefaults: {
                    renderer: $.jqplot.BarRenderer,
                            pointLabels: {show: true},
                    },
                    legend:{
                    renderer: $.jqplot.EnhancedLegendRenderer,
                            show:true,
                    },
                    series: [<?php foreach ($actividades as $actividad) : ?>{label: '<?php echo $actividad->getNombre(); ?>'}, <?php endforeach; ?>],
                    axes: {
                    xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                            ticks: ticks,
                            tickOptions: {
                            angle: - 30,
                            },
                    },
                    }
            });
            $('#segimiento').bind('jqplotDataHighlight', function(ev, seriesIndex, pointIndex, data) {
    $('#info2').html('serie: ' + seriesIndex + ', punto ' + pointIndex + ', info: ' + data);
    }
    );
            $('#segimiento').bind('jqplotDataUnhighlight',
            function(ev) {
            $('#info2').html('Nothing');
            }
    );
    });
</script>