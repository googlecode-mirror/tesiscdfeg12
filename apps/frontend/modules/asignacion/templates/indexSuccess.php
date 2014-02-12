<?php use_helper('I18N'); ?>
<h1 class="titulo">Asignaci&oacute;n</h1>

<ul class="css-tabs">
    <li><a href="#">Nuevos</a></li>
    <li><a href="#">L&iacute;deres</a></li>
    <li><a href="#">Asignar</a></li>
</ul>
<div class="css-panes">
    <div>
        <table class="datatables">
            <thead>
                <tr>
                    <th style="min-width: 40px;">&nbsp;</th>
                    <th style="min-width: 170px;">Nombre</th>
                    <th style="min-width: 60px;">Edad</th>
                    <th style="min-width: 90px;">E. civil</th>
                    <th style="min-width: 220px;">Direccion</th>
                    <th style="min-width: 80px;">Telefono</th>
                    <th style="min-width: 80px;">Movil</th>
                    <th style="min-width: 80px;">Sector</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nuevos as $nuevo): ?>
                    <tr>
                        <td class="select_check"><input type="checkbox" class="chbox_elemento" name="nuevo" value="<?php echo $nuevo->getId() ?>" /></td>
                        <td>
                            <a href="<?php echo url_for('@monitor?id_discipulo=' . $nuevo->getId()) ?>" class="lnk_nuevo<?php echo $nuevo->getId() ?>">
                                <?php echo $nuevo->getFirstName() . " " . $nuevo->getLastName() ?>
                            </a>
                        </td>
                        <td><?php echo $nuevo->calculaEdad() ?></td>
                        <td style="text-align: center;"><?php echo $nuevo->getEstCivil() ?></td>
                        <td><?php echo $nuevo->getDireccion() ?></td>
                        <td><?php echo $nuevo->getTelefono() ?></td>
                        <td><?php echo $nuevo->getMovil() ?></td>
                        <td><?php echo $nuevo->getSectorCiudad() ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div>
        <table class="datatables">
            <thead>
                <tr>
                    <th style="min-width: 80px;">&nbsp;</th>
                    <th style="min-width: 150px;">Nombre</th>
                    <th style="min-width: 60px;">Edad</th>
                    <th style="min-width: 60px;">E. civil</th>
                    <th style="min-width: 80px;">Codigo</th>
                    <th style="min-width: 90px;">Tipo</th>
                    <th style="min-width: 100px;">Direccion</th>
                    <th style="min-width: 80px;">Telefono</th>
                    <th>Movil</th>
                    <th>Sector</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lideres as $lider): ?>
                    <tr>
                        <td class="select_check"><input type="radio" class="radio_elemento" name="lider" value="<?php echo $lider->getId() ?>"/></td>
                        <td>
                            <a href="<?php echo url_for('@monitor?id_discipulo=' . $lider->getId()) ?>" class="lnk_lider<?php echo $lider->getId() ?>">
                                <?php echo $lider; ?>
                            </a>
                        </td>
                        <td><?php echo $lider->calculaEdad() ?></td>
                        <td style="text-align: center;"><?php echo $lider->getEstCivil() ?></td>
                        <td><?php echo $lider->getCodigoLiderCdfe() ?></td>
                        <td><?php echo $tipos_id[$lider->getTipoDiscipulo()] ?></td>
                        <td><?php echo $lider->getDireccion() ?></td>
                        <td><?php echo $lider->getTelefono() ?></td>
                        <td><?php echo $lider->getMovil() ?></td>
                        <td><?php echo $lider->getSectorCiudad() ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div>
        <input type="submit" id="btn_asignar" value="Asignar" />
        <div>
            <h3>Resumen</h3>
            <p>
                La siguiente lista de nuevos Disc&iacute;pulos será asignada a <span id="nombre_lider_selected"></span>
            </p>
            <ul id="nombre_nuevo_selected">
            </ul>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                var id_lider;
                var ids_nuevos = new Array();
                /**
                 * Generador de Tabs
                 */
                $('ul.css-tabs').tabs('div.css-panes > div', function(event, index){
                    switch (index) {
                        case 1:
                            if(ids_nuevos.length <=0) {
                                apprise('Seleccione al menos un Discípulo nuevo de la lista', {textOk: 'Aceptar'});
                                return false;
                            }
                            break;
                        case 2:
                            if(!id_lider) {
                                apprise('Seleccione al menos un Líder de la lista', {textOk: 'Aceptar'});
                                return false;
                            }
                            break;
                    }

                });
                $('.chbox_elemento').live('change',function(){
                    var id = $(this).attr('value');
                    if($(this).attr('checked') == 'checked'){
                        $('#nombre_nuevo_selected').append('<li class="nuevo_selected' + id + '">' + $('.lnk_nuevo' + id).text() + '</li>');
                        ids_nuevos.push(id);
                    } else {
                        $('.nuevo_selected' + id).remove();
                        for(i=0;i < ids_nuevos.length;i++){
                            if(ids_nuevos[i] == id){
                                ids_nuevos.splice(i, 1);
                            }
                        }
                    }
                });
                $('.radio_elemento').live('click',function(){
                    var id = $(this).attr('value');
                    $('#nombre_lider_selected').text($('.lnk_lider' + id).text());
                    id_lider = id;
                });
                $('#btn_asignar').live('click',function(){
                    if(id_lider && ids_nuevos.length > 0){
                        query_nuevos = ids_nuevos.join('-');
                        appConfirma('Está seguro de asignar', '<?php echo url_for('@asignar_nuevos?cadena_ids=') ?>' + id_lider +'|' + query_nuevos);
                    } else {
                        apprise('Seleccione Nuevos y un Líder para asignar',{'animate':true});
                    }
                });
            });
        </script>
    </div>
</div>

