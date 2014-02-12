<?php use_helper('I18N'); ?>
<h1 class="titulo">C&eacute;lulas</h1>
<?php slot('menu') ?>
<li class="tool_item menu_agregar"><?php echo link_to(image_tag('/images/toolbar/t_new.png').__('New'), 'celulas/new'); ?></li>
<?php end_slot(); ?>
<table class="datatables">
    <thead>
        <tr>
            <th style="min-width: 100px;">Fecha inicio</th>
            <th style="min-width: 100px;">Disc&iacute;pulo l&iacute;der</th>
            <th style="min-width: 100px;">D&iacute;a c&eacute;lula</th>
            <th style="min-width: 100px;">Hora c&eacute;lula</th>
        </tr> 
    </thead>
    <tbody>
        <?php foreach ($celulas as $celula): ?>
            <tr>
                <td><?php echo $celula->getFecha() ?></td>
                <td><a href="<?php echo url_for('celulas/show?id=' . $celula->getId()) ?>"><?php echo $celula->getLider() ?></a></td>
                <td><?php echo $celula->getDiasCelula() ?></td>
                <td><?php echo $celula->getHorarioCelula() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function(){
        $("div.dataTables_filter").children('label').children('input').keyup( function () {
            /* Filter on the column (the index) of this element */
            oTable.fnFilter( this.value, 1, false, false );
        });
    });
    
</script>