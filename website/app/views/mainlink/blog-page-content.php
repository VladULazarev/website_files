<?php
/**
 * 'View' for the Blog page
 *
 * @link https://domainename.com/blog
 *
 * Contains all data we see on the Blog page between <main></main> html tags
 */
 include("app/includes/if-user-not-signed-in.inc.php");
 ?>

 <!-- Welcome post -->
 <div class="row content">

     <div class="col-lg-4 post-header">
         <h1><?= $pageData->link_h1; ?></h1>
     </div>

     <div class="col-lg-8 post-text">

        <p>
          <span class="fl">B</span>log lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae esse
          rem nesciunt quos, porro ratione reprehenderit unde fuga commodi incidunt
          fugiat iure omnis eaque autem animi nemo explicabo cum earum.
        </p>

        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae esse
          rem nesciunt quos, porro ratione reprehenderit unde fuga commodi incidunt
          fugiat iure omnis eaque autem animi nemo explicabo cum earum.
        </p>

     </div>

 </div>
