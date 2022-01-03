<div class="container-fluid">

    <!-- Navigation -->
    <div class="nav-wrap">
      <div class="row nav-bar">

        <!-- Menu button -->
        <div class="menu-btn">
          <span>
            <em></em>
            <em></em>
            <em></em>
          </span>
        </div>

        <!-- Company logo-->
        <div class="col-lg-3 col-sm-6 col-5">
          <div class="logo">
            <!-- <a href="/"><img height="63" src="/app/resources/images/company-logo.jpg"></a> -->
            <a href="/">Company Name</a>
          </div>
        </div>

        <nav class="col-lg-6 col-sm-1 col-1">

          <ul class="nav-ul">
            <li><a class="main-link" href="/">home</a></li>
            <li><a class="main-link" href="/blog">blog</a></li>
            <li><a class="main-link" href=/contact-us>contact us</a></li>
          </ul>

        </nav>

        <div class="col-lg-3 col-sm-5 col-6">
          <ul class="nav-ul-account">

          <?php if ($_SESSION['user'][1] === NULL) {

                echo "
                    <li><a class='account-link sign-in' href='/sign-in'>Sign in</a></li>
                ";
            } else {
                echo "<li class='account-link current-user'>
                        <i class='fa fa-angle-down fa-fw'></i>
                          Hi, " . $_SESSION['user'][1] . "

                            <ul class='account-popup'>
                                <li class='account-popup-link'><a href='/account'>Account</a></li>
                                <li class='account-popup-link log-out'>Log Out</li>
                            </ul>

                      </li>";
            }
          ?>

          </ul>
        </div>
      </div>
    </div>

    <?php // if (ROUTE[0] == 'home') { include("app/includes/top-image.inc.php"); } ?>
  </div>
