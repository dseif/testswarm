<?php
  try {
    // Make sure this is originating from the botio URL
    if ( $_SERVER['REMOTE_ADDR'] === '50.116.54.231' ) {
      $url = $_REQUEST['url'];
      $commit = $_REQUEST['commitId'];
      $branch = $_REQUEST['branch'];

      // Get Project name from repo URL
      $parts = mb_split( "/", $url );
      $parts = $parts[ 4 ];
      $project =  mb_split( "\.", $parts );
      $project = $project[ 0 ];

      if ( $project === "popcorn-js" ) {
        // check if this commit has had tests run already
        if ( file_exists( 'clones/{$commit}' ) ) {
          echo( 'Commit has already been submitted to the swarm. http://norway.proximity.on.ca/user/popcornjs' );
        } else {
          `bash build.sh {$url} {$commit} {$project} {$branch} &`;
          echo('Your job has been submitted to the swarm! see http://norway.proximity.on.ca/user/popcornjs');
        }
      } elseif ( $project === "butter" ) {
        if ( file_exists( 'clones/{$commit}' ) ) {
          echo( 'Commit has already been submitted to the swarm. http://norway.proximity.on.ca/user/butter' );
        } else {
          `bash build.sh {$url} {$commit} {$project} ${branch} &`;
          echo( 'Your job has been submitted to the swarm! see http://norway.proximity.on.ca/user/butter');
        }
      }
    }
  } catch (Exception $e) {
    exit;
  }

?>
