<?php
require 'common.php';

$where ='';

if (i($QUERY,'tags')) {
  $tags = explode(',',trim($QUERY['tags']));
  $tags = array_map('trim', $tags);
  $tags = array_filter($tags, function($tag) {
    return !empty($tag);
  });
  $tags = array_unique($tags);
  $tags = implode("','", $tags);
  $where = "AND T.name IN ('$tags')";
}

$question = iapp('db')->getAssoc("SELECT Q.question, GROUP_CONCAT(T.name SEPARATOR ',') AS tags
  FROM Question Q
  LEFT JOIN QuestionTag QT ON QT.question_id=Q.id
  INNER JOIN Tag T ON T.id=QT.tag_id
  WHERE Q.status='1' $where
  GROUP BY Q.id
  ORDER BY RAND() LIMIT 1");

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
echo json_encode([
  'status' => 'success',
  'data' => $question ?? 'No question found.'
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
