<table border="1">
	<tr>
	<?php foreach ($proposals[0] as $key => $value) : ?>
		<th><?php echo $key ?></th>
	<?php endforeach ?>
	</tr>

<?php foreach ($proposals as $idx => $proposal) : ?>
	<tr>
	<?php foreach ($proposal as $key => $value) : ?>
		<td><?php echo $value ?></td>
	<?php endforeach ?>
	</tr>
<?php endforeach ?>
</table>