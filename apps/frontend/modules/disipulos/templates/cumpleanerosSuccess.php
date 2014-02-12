<?php use_helper('I18N'); ?>
<h1 class="titulo">Cumplea&ntilde;eros</h1>
<table class="datatables">
	<thead>
		<tr>
			<th>Discipulo</th>
			<th>Fecha</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($miembros as $miembro): ?>
		<?php $fecha = explode('-',$miembro->getDiscipulo()->getFechaNac())?>
		<?php if ($fecha[1] == date('n')):?>
		<tr>
			<td style="width: 200px;"><a
				href="<?php echo url_for('@monitor?id_discipulo=' . $miembro->getDiscipulo()->getId()) ?>">
					<?php echo $miembro->getDiscipulo() ?>
			</a>
			</td>
			<td>
			<?php echo $miembro->getDiscipulo()->getFechaNac(); ?>
			</td>
		</tr>
		<?php endif; ?>
		<?php endforeach; ?>
	</tbody>
</table>
