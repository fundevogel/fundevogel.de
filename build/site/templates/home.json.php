<?php

$html = '';

foreach($posts as $post) {
  $html .= snippet('partials/post', compact('post', 'last'), true);
}

$data['html'] = $html;
$data['more'] = $more;
echo json_encode($data);
