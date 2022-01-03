<?php
/**
 * 'View' for the 'Contact Us' page.
 * @link https://domainename.com/contact-us
 *
 * Contains all data we see on the 'Contact Us' page between <main></main> html tags
 */
 ?>

<!-- Contact Us -->
<div class="content m-top">

    <h1 class="contact-h1"><?= $pageData->link_h1; ?></h1>

  <div class="row contact-page-content">

    <div class="col-lg-6 contact-block">

        <h3>Send Message</h3>

      <form>

        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="contact-name">Name</label>
              <input type="text"
                class="form-control"
                id="contact-name" maxlength="50"
                placeholder="Name"
                autocomplete="off">
              <span class="contact-name-alert">Wrong symbol or empty!</span>
              <span class="contact-name-asterisk">*</span>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="contact-email">Email address</label>
              <input type="email"
                class="form-control"
                id="contact-email"
                maxlength="50"
                placeholder="johndoe@example.com"
                autocomplete="off">
              <span class="contact-email-alert">Wrong symbol or empty!</span>
              <span class="contact-email-asterisk">*</span>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="contact-message">Message</label>
              <textarea class="form-control contact-text"
                id="contact-message"
                maxlength="300"
                placeholder="Message"
                cols="10"
                autocomplete="off"></textarea>
              <span class="contact-message-alert">Wrong symbol or too long message!</span>
              <span class="contact-message-asterisk">*</span>
            </div>
          </div>
        </div>

        <div class="btn-container mt-3">
            <button class="btn btn-default btn-send-contact">Send</button>
        </div>

        <div class="privacy-alert">By pressing the Send button you agree to our <a class="privacy-link" href="/privacy-policy">Privacy Policy</a></div>
        <div class="contact-form-messages form-messages"></div>
        <div class="contact-form-pop-up"></div>
      </form>

    </div>

    <div class="col-lg-6 contact-block">

      <address>
          <h3>Get In Touch</h3>
          <table>
              <tr>
                  <td><p class="address-p">Phone: </p></td>
                  <td><p><a class="address-link" href="tel: +7 987 123 45 78"> +7 987 123 45 78</a></p></td>
              </tr>
              <tr>
                  <td><p class="address-p">Email: </p></td>
                  <td><p><a class="address-link" href="mailto:youremail@mail.com">youremail@mail.com</a></p></td>
              </tr>
              <tr>
                  <td><p class="address-p">Address: </p></td>
                  <td><p> 99th Street, Your City, 123456 COUNTRY</p></td>
              </tr>
          </table>
      </address>

      <h3>Find Us On Map</h3>
          <div class="map">
              <div id="embedded-map-display">
                  <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.1508548292804!2d2.35758981594651!3d48.87440067928909!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e0d1c40afe3%3A0x5ea7d4b5c67d7b0e!2zMjUgUnVlIGRlcyBSw6ljb2xsZXRzLCA3NTAxMCBQYXJpcywg0KTRgNCw0L3RhtC40Y8!5e0!3m2!1sru!2sru!4v1508947505797" allowfullscreen></iframe>
              </div>
          </div>
    </div>
  </div>
</div>
