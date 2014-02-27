<?php use_helper('I18N'); ?>
<?php /* ?>
<ul>
    <?php foreach ($celulas as $key => $celula) : ?>
        <li>
            <ul>
                <?php foreach ($celula->getMiembros() as $key => $miembro) : ?>
                    <li>
                        <?php echo $miembro->getDiscipulo() . " " . $miembro->getPorcentajeAsistencia(); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </li>
</ul>
<?php /**/ ?>

<table>
    <tr>
        <td>
            <div id="tipos" class="chart-container"></div>
        </td>
    </tr>
    <tr>
        <td>
            <div id="segimiento" style="width: 800px;"></div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="asistencia-celulas"></div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="asistencia-discipulos"></div>
        </td>
    </tr>
</table>

<div class="clear"></div>
<script type="text/javascript">
    /**
     * Reporte de numero de personas
     */
    $(document).ready(function() {
    var line1 = [ <?php foreach ($countDiscipulos as $key => $total): ?> ['<?php echo $key ?>', <?php echo $total->getRaw(0)['numero'] ?>], <?php endforeach; ?> ];
            $('#tipos').jqplot([line1], {
    title: 'Estadística de número de personas',
            animate: !$.jqplot.use_excanvas,
            seriesDefaults: {
            renderer: $.jqplot.BarRenderer,
                    rendererOptions: {
                    // Set the varyBarColor option to true to use different colors for each bar.
                    // The default series colors are used.
                    varyBarColor: true
                    },
                    pointLabels: {show: true},
            },
            axes: {
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                label: 'Tipos de discípulos',
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    angle: -30,
                    fontFamily: 'Courier New',
                    fontSize: '8pt'
                }
            },
            }
    });
            /**
             * Reporte de estadistica de consolidacion.
             */
<?php for ($i = 4; $i <= 6; $i++) : ?>
        var s<?php echo $i ?> = [ <?php foreach ($fechas as $key => $fecha) :  ?> <?php foreach (Doctrine_Core::getTable('Seguimiento')->countActividadesFecha($fecha->getRaw(0)['month'], $fecha->getRaw(0)['year']) as $key1 => $value) : ?> <?php if ($value['actividad_seguimiento_id'] == $i) : ?> <?php echo $value['numero'] ?>, <?php else: ?> 0, <?php endif; ?> <?php endforeach; ?> <?php endforeach; ?> ];
<?php endfor; ?>
    var ticks = [
<?php foreach ($fechas as $key => $fecha) : ?>
        '<?php echo __($fecha->getRaw(0)['month']) . " " . $fecha->getRaw(0)['year'] ?>',
<?php endforeach; ?>
    ];
            plot2 = $.jqplot('segimiento', [ <?php for ($i = 4; $i <= 6; $i++) : ?> s<?php echo $i ?>, <?php endfor; ?> ], {
            title: 'Estadística de consolidación',
                    animate: !$.jqplot.use_excanvas,
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
                        ticks: ticks,
                renderer: $.jqplot.CategoryAxisRenderer,
                label: 'Fechas',
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    angle: -30,
                    fontFamily: 'Courier New',
                    fontSize: '8pt'
                }
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
            /**
             * Reporte de asistencias a celulas
             */

            var line1 = [ <?php foreach ($celulas as $key => $celula) : ?> ['<?php echo $celula ?>', <?php echo $celula->getPorcentajeAssitencias() ?>], <?php endforeach; ?> ];
            $('#asistencia-celulas').jqplot([line1], {
    title: 'Asistencias por celula',
            animate: !$.jqplot.use_excanvas,
            seriesDefaults: {
            renderer: $.jqplot.BarRenderer,
                    rendererOptions: {
                    // Set the varyBarColor option to true to use different colors for each bar.
                    // The default series colors are used.
                    varyBarColor: true
                    },
                    pointLabels: {show: true},
            },
            axes: {
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                label: 'Líderes de célula',
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    angle: -30,
                    fontFamily: 'Courier New',
                    fontSize: '8pt'
                }
            },
            },
            highlighter: { show: false }
    });
            /**
             * Reporte de asistencias a celulas
             */
            var line1 = [ <?php foreach ($celulas as $key => $celula) : foreach ($celula->getMiembros() as $key => $miembro) : ?> ['<?php echo $miembro->getDiscipulo() ?>', <?php echo $miembro->getPorcentajeAsistencia() ?>], <?php endforeach; endforeach; ?> ];
            $('#asistencia-discipulos').jqplot([line1], {
    title: 'Asistencias por discípulo',
            animate: !$.jqplot.use_excanvas,
            seriesDefaults: {
            renderer: $.jqplot.BarRenderer,
                    rendererOptions: {
                    // Set the varyBarColor option to true to use different colors for each bar.
                    // The default series colors are used.
                    varyBarColor: true
                    },
                    pointLabels: {show: true},
            },
            axes: {
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                label: 'Discípulos',
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    angle: -30,
                    fontFamily: 'Courier New',
                    fontSize: '8pt'
                }
            },
            },
            highlighter: { show: false }
    });
    });
</script>