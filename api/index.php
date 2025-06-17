<?php
require 'common.php';

$question = iapp('db')->getAssoc("SELECT Q.question, GROUP_CONCAT(T.name SEPARATOR ',') AS tags
  FROM Question Q
  LEFT JOIN QuestionTag QT ON QT.question_id=Q.id
  INNER JOIN Tag T ON T.id=QT.tag_id
  WHERE Q.status='1' 
  GROUP BY Q.id
  ORDER BY RAND() LIMIT 1");

echo json_encode([
  'status' => 'success',
  'data' => $question ?? 'No question found.'
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
