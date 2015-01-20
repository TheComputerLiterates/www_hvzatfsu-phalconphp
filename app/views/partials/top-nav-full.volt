<!-- nav bar: responsive-->
<header class="navbar navbar-inverse navbar-static" role="banner">
  <div class="container">

    <!-- Things that will be displayed whetehr collapsed or not-->
    <div class="navbar-header">

      <!-- Button for collapse-->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      {{ link_to("index",image("img/homeBtn.png", "alt":"Home", "class":"navbar-brand")) }}
      {{ link_to("https://www.facebook.com/hvzatfsu",image("img/FB-f-Logo__blue_29.png", "alt":"Facebook", "class":"navbar-brand")) }}
    </div>

    <!-- Items that will be collapsed (hidden) when on mobile -->
    <nav class="collapse navbar-collapse" id="main-navbar-collapse" role="navigation" >
      <!-- All Header Menu options now being handled in ~/app/library/Elements.php -->
      {{ elements.getHeaderMenu() }}
    </nav>

  </div>
</header>
<!-- End nav bar -->
