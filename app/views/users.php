<table>
	<thead>
		<tr>
			<?php foreach (current($users)->getAttributes() as $key): ?>
				<th><?php echo $key ?></th>
			<?php endforeach ?>
		</tr>
	</thead>
	<thead>
		<tr>
			<?php foreach ($users as $user): ?>
				<tr><td><?php echo implode('</td><td>', $user->asArray()) ?></td></tr>
			<?php endforeach ?>
		</tr>
	</thead>
</table>