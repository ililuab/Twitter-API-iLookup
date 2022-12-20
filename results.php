<?php  
get_header();
/* Template Name: tweets */
?>
<?php if (!empty($_GET['search'])):
    $search = $_GET['search'];
else: echo'Typ a something to search.';
endif;
?>
<?php
$BEARER_TOKEN = "BEARER_TOKEN";
$tweets  = wp_remote_get('https://api.twitter.com/2/tweets/search/recent?query='.$search.'&tweet.fields=attachments,author_id,created_at,possibly_sensitive,text', [
    'headers' => ['Authorization'=> 'Bearer BEARER_TOKEN'],
]);
$body = wp_remote_retrieve_body( $tweets );
$response = json_decode($body);
?>
<?php
if($response):
$items = $response->data;
else: echo '';
endif;
if($items):?>
<div class="mb-5 container-fluid main_result_container"><?php   
foreach($items as $item ):
?>
<?php $id = $item->author_id;?>
<?php
$users  = wp_remote_get('https://api.twitter.com/2/users/'.$id.'?user.fields=description,id,name,profile_image_url,username,verified', [
    'headers' => ['Authorization'=> 'Bearer BEARER_TOKEN'],
 ]);
 $body = wp_remote_retrieve_body( $users );
 $user_response = json_decode($body);
//  print_r($user_response);
 ?>
<div class="card d-block mx-3 mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="<?=  str_replace('_normal', '', $user_response->data->profile_image_url) ?>" class="rounded-start img-fluid user_img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= $user_response->data->name ?> 
        <?php if($user_response->data->verified === true):?>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1d9bf0" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
            </svg>
            <?php endif;?>
        </h5>
        <a href="https://twitter.com/<?= $user_response->data->username ?>"><p class="card-text"><small class="text-muted">Author username: @<?= $user_response->data->username ?></small></p></a>
        <p class="card-text"><?= $item->text; ?></p>
        <p class="card-text"><small class="text-muted">Tweet created at: <?= $item->created_at ?></small></p>
        <?php if($user_response->data->description): ?>
        <p class="card-text"><small class="text-muted">Bio: <?= $user_response->data->description ?></small></p>
        <a href="https://www.tiktok.com/nl-NL/">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
          <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3V0Z"/>
        </svg>
        </a>
        <a href="https://www.facebook.com/">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
          <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
        </svg>
        </a>
        <a href="https://www.instagram.com/">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
          <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
        </svg>
        </a>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
<?php endif; ?>
<?php
$account  = wp_remote_get('https://api.twitter.com/2/users/by/username/'.$search.'?user.fields=created_at,description,id,name,profile_image_url,url,username,verified', [
    'headers' => ['Authorization'=> 'Bearer BEARER_TOKEN'],
 ]);
 $body = wp_remote_retrieve_body( $account );
 $account_response = json_decode($body);
//  print_r($account_response);
 ?>
<?php if( $account_response && $account_response->data->username):?>
<div class="card mb-5" style="width: 18rem;">
  <img src="<?= str_replace('_normal', '', !empty($account_response->data->profile_image_url) ? $account_response->data->profile_image_url : false  ) ?>" class="card-img-top" alt="Profile picture">
  <div class="card-body">
    <h5 class="card-title"><?= !empty($account_response->data->name) ? $account_response->data->name : false;?>
    <?php if($account_response->data->verified):?> 
        <svg style="margin-bottom: 2px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#1d9bf0" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
            <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
        </svg>
    <?php endif;?>
</h5>
    <a href="https://twitter.com/<?= !empty($account_response->data->username) ? $account_response->data->username : false ?>"><p class="card-text"><small class="text-muted">@<?= $account_response->data->username ?></small></p></a>
    <p class="card-text mb-1"><small class="text-muted" >Created at: <?= !empty($account_response->data->created_at) ? $account_response->data->created_at : false ?></small></p>
    <p class="card-text"><?= !empty($account_response->data->description) ? $account_response->data->description : false ?></p>
  </div>
</div>
<?php else: echo ''; ?>
<?php endif;?>
</div>
<?php get_footer(); ?>
