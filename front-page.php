<?php get_header();?>
<div class="d-flex align-items-center h-100">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-8 col-sm-9 col-12">
                <form class="text-center form-floating mb-3" method="get" action="/tweets">
                    <h1 class="mb-4 text-black home_title"><?= get_field('home_title') ?></h1>
                    <p class="">Lookup twitter tweets and users to see what people are talking about!</p>
                    <div class="d-flex">
                    <input type="text" placeholder="Zoeken" class="form-control" name="search" id="floatingInput">
                    </div>
                    <input class="mt-4 mx-4 px-5 py-1 btn btn-outline-dark" value="Zoek" type="submit">
                    <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0"><button class="mt-4 mx-4 px-5 py-1 btn btn-outline-secondary">Meme</button></a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>