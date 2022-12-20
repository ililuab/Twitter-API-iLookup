<?php  
get_header();
/* Template Name: spaces-results */
?>
<?php if (!empty($_GET['search-space'])):
    $search_space = $_GET['search-space'];
else: echo'Typ a something to search.';
endif;?>



<div class="mb-5 container-fluid main_result_container"><?php

$spaces  = wp_remote_get('https://api.twitter.com/2/spaces/search?query='.$search_space.'&space.fields=created_at,creator_id,ended_at,host_ids,id,invited_user_ids,is_ticketed,lang,participant_count,scheduled_start,speaker_ids,started_at,state,subscriber_count,title,topic_ids,updated_at&user.fields=created_at,description,entities,id,location,name,pinned_tweet_id,profile_image_url,protected,url,username,verified,withheld', [
    'headers' => ['Authorization'=> 'Bearer BEARER_TOKEN'],
]);
$body = wp_remote_retrieve_body( $spaces );
$response = json_decode($body);
// print_r($response);



$items = $response->data;
if($items):
    foreach($items as $item):

        $space_ID = $item->id;

    $spaces_users  = wp_remote_get('https://api.twitter.com/2/users/'.implode(',', $item->host_ids).'?user.fields=created_at,description,entities,id,location,name,pinned_tweet_id,profile_image_url,protected,url,username,verified,withheld', [
    'headers' => ['Authorization'=> 'Bearer BEARER_TOKEN'],
]);
$body = wp_remote_retrieve_body( $spaces_users );
$response_user = json_decode($body);
// print_r($response_user);?>

<?php $host_images = $response_user->data->profile_image_url ?> 


<div class="card d-block mx-3 mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="<?=  str_replace('_normal', '', $host_images) ?>" class="rounded-start img-fluid user_img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= $item->title ?> </h5>
        <a href="https://twitter.com/<?= $response_user->data->username ?>"><p class="mb-3 card-text"><small class="text-muted">Host: <?= $response_user->data->username ?></small></p></a>
        <?php if($item->participant_count): ?>
        <p class="card-text"><small class="text-muted">Live viewers: <?= $item->participant_count ?></small></p>
        <?php else: echo "<p><small>Space starting soon!</small></p>" ?>
        <?php endif; ?>
        <?php if($response_user->data->verified === true):?>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1d9bf0" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
            </svg>
            <?php endif;?>
        <p class="card-text">  <?= $response_user->data->description; ?></p>
        <p class="card-text"><small class="text-muted">Space created at: <?= $item->created_at ?><span class="badge bg-secondary"> <?= $item->state ?></span></small></p>
        <a href="https://twitter.com/i/spaces/<?= $space_ID ?>"><button class="btn btn-outline-primary">Go to space</button></a>
      </div>
    </div>
  </div>
</div>
    <?php endforeach;
else: '';
endif;?>
</div>
<?php get_footer();?>
