<!DOCTYPE html>
<html lang="en">
<head>
  <title>Compression Bear</title>
  <meta charset="utf-8">
  <meta name="description" content="Compress your images by up to 90% with a bear">
  <meta name="author" content="Tristan White">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/assets/img/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/apple-touch-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon-180x180.png">
  <link rel="icon" type="image/png" href="/assets/img/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/assets/img/android-chrome-192x192.png" sizes="192x192">
  <link rel="icon" type="image/png" href="/assets/img/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="/assets/img/manifest.json">
  <link rel="shortcut icon" href="/assets/img/favicon.ico">
  <meta name="apple-mobile-web-app-title" content="Compression Bear">
  <meta name="application-name" content="Compression Bear">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/assets/img/mstile-144x144.png">
  <meta name="msapplication-config" content="/assets/img/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
</head>
<body>

  <section class="upload">
    <div class="container">
      <div class="row">
        <div class="tiny-12 small-10 small-offset-1 medium-8 medium-offset-2 large-6 large-offset-3">

          <div class="beta">Beta</div>

          <h1 class="upload__title">Compression Bear</h1>
          <h2 class="upload__subtitle">Compress your images with a bear</h2>

          <form action="/compress.php" id="dropzone" class="dropzone" method="POST" enctype="multipart/form-data"></form>

          <div class="progress">
            <b class="progress__bar">
              <span class="progress__text">
                Compressing: <strong>0%</strong>
              </span>
            </b>
          </div>

          <div class="result">
            <span class=result__info></span>

            <a class="back" href="/">Compress another image</a>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="example">
    <div class="container center-tiny">
      <div class="row">
        <div class="tiny-12">
          <h2>Can you tell the difference?</h2>
        </div>
      </div>
      <div class="row">
        <div class="small-6">
          <img src="/assets/img/example.jpg" alt="Uncompressed example image" />
          <h3>Original</h3>
          <p>
            File size: <span>246 KB</span>
          </p>
        </div>
        <div class="small-6">
          <img src="/assets/img/example_compressed.jpg" alt="Compressed example image" />
          <h3>Compressed</h3>
          <p>
            File size: <span>53 KB</span>
          </p>
        </div>
      </div>
    </div>
  </section>


  <section class="about">
    <div class="container">
      <div class="row">
        <div class="tiny-offset-2 tiny-8 center-tiny">

          <h2>How does it work?</h2>
          <p>Great question! It’s really quite simple. One of our compression bears will sit on your images for a few seconds to make them as small as they can, all while retaining the quality. Once the bear is done, you can safely download your compressed image</p>

          <h2>Know bugs</h2>
          <p>Our bears can’t properly compress transparent .png files yet.</p>
          <p>Our bears get tired, which leads to images sometimes not compressing. Don’t worry though, just try again and we’ll have another bear sit on your image!</p>
          <p>Occasionally our bears won’t sit on your image, when we tell them to (They are bears afterall). This results in your image getting bigger!! We’re working hard on training our bears</p>

        </div>
      </div>
    </div>
  </section>

  <footer>

    <p class="author">Made by: <a href="https://tristanwhite.info" target="_blank">Tristan White</a></p>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="/assets/js/vendor/min/dropzone-min.js"></script>
    <script src="/assets/js/min/functions-min.js"></script>
    <script>

    $(".dropzone").dropzone({
      // accept: function(file, done) {
      //   console.log(file);
      //   if (file.type != "image/jpeg" && file.type != "image/png") {
      //     done("Error! Files of this type are not accepted");
      //   }
      //     else { done(); }
      //   }
      // }
      success: function(file, response) {
        console.log(response);
        var info = $('.result__info');
        info.append(response);
      }
    });
    </script>

  </footer>

</body>

</html>
