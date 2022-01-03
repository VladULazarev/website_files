<?php
/**
 * 'View' for the Blog page
 *
 * @link https://domainename.com/blog
 *
 * Contains all data we see on the Blog page between <main></main> html tags
 */
 
 include("app/includes/if-user-signed-in.inc.php");
 ?>
 <!-- Register -->
 <div class="content">

       <h1><?= $pageData->link_h1; ?></h1>

       <ul class="register-note">
         <li>
           Please, fill in all the required fields.
        </li>
        <li>
        The length of the password must be between 6 and 16 characters.
       </li>
      </ul>

  <div class="row">

     <div class="col-lg-4">

       <form class="register">

         <div class="form-row">
           <div class="col">
             <div class="form-group">
               <label for="user-login">Login</label>
               <input type="text" class="form-control" id="user-login" maxlength="50" placeholder="Your login" autocomplete="off">
               <span class="user-login-alert">Wrong symbol or empty!</span>
               <span class="user-login-asterisk">*</span>
             </div>
           </div>
         </div>

         <div class="form-row">
           <div class="col">
             <div class="form-group">
               <label for="user-name">Name</label>
               <input type="text" class="form-control" id="user-name" maxlength="50" placeholder="Name" autocomplete="off">
               <span class="user-name-alert">Wrong symbol or empty!</span>
               <span class="user-name-asterisk">*</span>
             </div>
           </div>
         </div>

         <div class="form-row">
           <div class="col">
             <div class="form-group">
               <label for="user-last-name">Last name</label>
               <input type="text" class="form-control" id="user-last-name" maxlength="50" placeholder="Last name" autocomplete="off">
               <span class="user-last-name-alert">Wrong symbol or empty!</span>
               <span class="user-last-name-asterisk">*</span>
             </div>
           </div>
         </div>

         <div class="form-row">
           <div class="col">
             <div class="form-group">
               <label for="user-email">Email</label>
               <input type="email" class="form-control" id="user-email" maxlength="50" placeholder="Email" autocomplete="off">
               <span class="user-email-alert">Wrong symbol or empty!</span>
               <span class="user-email-asterisk">*</span>
             </div>
           </div>
         </div>

         <div class="form-row">
           <div class="col">
             <div class="form-group">
               <label for="user-pw">Password</label>
               <input type="password"
                class="form-control"
                id="user-pw"
                maxlength="16"
                placeholder="Password"
                autocomplete="off">
               <span class="user-pw-alert">Wrong symbol or empty!</span>
               <span class="user-pw-asterisk">*</span>
               <span class="eye-icon-pw" data-input-id="user-pw"><i class='fa fa-eye fa-fw'></i></span>
             </div>
           </div>
         </div>

         <div class="btn-container mt-3">
             <button class="btn btn-default btn-register">Register</button>
         </div>

         <div class="register-form-messages form-messages"></div>
         <div class="register-form-pop-up"></div>

       </form>

     </div>

     <div class="col-lg-8"></div>

   </div>
 </div>
