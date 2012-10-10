<table border="1">
	<tr>
	<?php foreach ($mls[0] as $key => $value) : ?>
		<th><?php echo $key ?></th>
	<?php endforeach ?>
	</tr>

<?php foreach ($mls as $idx => $ml) : ?>
	<tr>
	<?php foreach ($ml as $key => $value) : ?>
		<td><?php echo $value ?></td>
	<?php endforeach ?>
	</tr>
<?php endforeach ?>
</table>