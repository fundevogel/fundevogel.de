<?php

$html = '';

foreach($posts as $post) {
  $html .= snippet('post', compact('post'), true);
}

$data['html'] = $html;
$data['more'] = $more;
echo json_encode($data);
