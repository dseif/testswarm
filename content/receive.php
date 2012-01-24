<?php
  try
  {
    // Decode the payload json string
    $payload = json_decode($_REQUEST['payload']);
  }
  catch(Exception $e)
  {
    exit;
  }

  if( $payload->ref === 'refs/heads/testswarm2') {

 
    $url = str_replace('https://', 'git://', $payload->repository->url);
 
    `sh build.sh {$url} {$payload->commits[0]->id} > /dev/null 2>&1 &`;
    $response = http_post_data("http://96.126.109.151:1337/github", $_REQUEST['payload']);
  }
?>
