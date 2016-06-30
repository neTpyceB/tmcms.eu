<?php

use TMCms\Modules\ModuleManager;
use TMCms\Modules\Wiki\Entity\WikiEntity;

ModuleManager::requireModule('wiki');

header('Content-Type: application/json');

$data['error'] = true;

if (!empty($_POST['id'])) {
	preg_match_all('!\d+!', $_POST['id'], $matches);
	$wiki_id = implode(' ', $matches[0]);

	$wiki = new WikiEntity($wiki_id);
	$wiki_text = $wiki->getText();

	$data['error'] = false;
	$data['html'] = $wiki_text;

}

echo json_encode($data);