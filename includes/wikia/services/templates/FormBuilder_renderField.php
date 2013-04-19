<? if ($data['type'] !== 'hidden'): ?>
	<div class="input-group
		<?= (isset($data['class']))? ' '.$data['class'] : '' ?>
	">
<? endif ?>

<? if (!empty($data['label'])): ?>
    <label for="<?=$data['name']?>" <?= (isset($data['labelclass']))? ' '. 'class="' . $data['labelclass'] . '" ' : '' ?> >
		<? if (!empty($data['icon'])): ?>
        	<img src="<?= $data['wg']->blankImgUrl ?>" class="input-icon" />
		<? endif ?>
		<?=$data['label']?>
    </label>
<? endif ?>

<?	switch ($data['type']):
		case 'text':
		case 'hidden': ?>
			<input name="<?= $data['name'] ?>" type="<?= $data['type'] ?>" <?= $data['attributes'] ?> value="<?= htmlspecialchars($data['value'])?>"/>
			<? break; ?>
	<?	case 'textarea': ?>
			<textarea name="<?= $data['name'] ?>" <?= $data['attributes'] ?> ><?= htmlspecialchars($data['value'])?></textarea><? break ?>
<?	endswitch ?>

<? if (!empty($data['errorMessage'])): ?>
    <p class="error error-msg"><?=$data['errorMessage']?></p>
<? endif ?>

<? if ($data['type'] !== 'hidden'): ?>
	</div>
<? endif ?>
