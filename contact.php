<?php  
get_header();
/* Template Name: Contact */
?>
<body <?php body_class(); ?>>
<body>
    <!-- Contact page (OpenAI) -->
    <div class="page">
      <h1 class="page__title">Contact Us</h1>
      <form class="page__form">
        <div class="page__form-row">
          <label class="page__form-label" for="name">Name:</label>
          <input class="page__form-input" type="text" id="name" />
        </div>
        <div class="page__form-row">
          <label class="page__form-label" for="email">Email:</label>
          <input class="page__form-input" type="email" id="email" />
        </div>
        <div class="page__form-row">
          <label class="page__form-label" for="message">Message:</label>
          <textarea class="page__form-textarea" id="message"></textarea>
        </div>
        <div class="page__form-row">
          <input class="page__form-submit" type="submit" value="Send" />
        </div>
      </form>
    </div>
  </body>

  </body>
  <?php get_footer(); ?>