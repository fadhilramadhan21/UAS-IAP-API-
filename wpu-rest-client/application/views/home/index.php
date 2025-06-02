<?php

function get_CURL($url) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec($curl);
  curl_close($curl);
  
  return json_decode($result, true); // <--- ini yang penting
}

// <-------------- YOUTUBE API --------------->
$result = get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCQ83MUbHsN_5gyJI3xHBfFA&key=AIzaSyB8SJLFoSa9znfMh0MFmZSVWHBP7g2LxQk');

$youtubeProfilePic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
$channelName = $result['items'][0]['snippet']['title'];
$subscriber = $result['items'][0]['statistics']['subscriberCount'];

// latest video
$urlLatestVideo = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyB8SJLFoSa9znfMh0MFmZSVWHBP7g2LxQk&channelId=UCQ83MUbHsN_5gyJI3xHBfFA&maxResults=1&order=date&part=snippet';
$result = get_CURL($urlLatestVideo) ; 
$latestVideoID = $result['items'][0]['id']['videoId'];

// <-------------- IG API --------------->

// Instagram API
$instagramResult = get_CURL('https://graph.instagram.com/me?fields=username,profile_picture_url,followers_count&access_token=IGAAjx0ZB5JZBJlBZAE4zazBNZAWttT2U3bFRzMXhycXVsWFYyMGpPYUhPZADRfeDBYZAWhWWVN6VTNRczB0dTRhX01RTDFaeTAtZAXlTQ0xwcm9CR3pkQUE0ZA1pRX1hlYXhLZA3lOZAHZA0SDZAER1VWcmh1QVRob0pnVVRIa1I0eXZAHUVpOOAZDZD');

$igUsername = $instagramResult['username'];
$igProfilePic = $instagramResult['profile_picture_url'];
$igFollowers = $instagramResult['followers_count'];

$mediaResult = get_CURL('https://graph.instagram.com/me/media?fields=id,caption,media_url,permalink,thumbnail_url,media_type,timestamp&access_token=IGAAjx0ZB5JZBJlBZAE4zazBNZAWttT2U3bFRzMXhycXVsWFYyMGpPYUhPZADRfeDBYZAWhWWVN6VTNRczB0dTRhX01RTDFaeTAtZAXlTQ0xwcm9CR3pkQUE0ZA1pRX1hlYXhLZA3lOZAHZA0SDZAER1VWcmh1QVRob0pnVVRIa1I0eXZAHUVpOOAZDZD');

$igMedia = array_slice($mediaResult['data'], 0, 3);
?>

<div class="jumbotron" id="home">
      <div class="container">
        <div class="text-center">
          <img src="<?=base_url();?>/assets/img/foto aja.jpg" class="rounded-circle img-thumbnail">
          <h1 class="display-4">Ahmad Fadhil Ramadhan</h1>
          <h3 class="lead">Traveller| Programmer | Youtuber</h3>
        </div>
      </div>
    </div>


    <!-- About -->
    <section class="about" id="about">
      <div class="container">
        <div class="row mb-4">
          <div class="col text-center">
            <h2>About</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-5">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus, molestiae sunt doloribus error ullam expedita cumque blanditiis quas vero, qui, consectetur modi possimus. Consequuntur optio ad quae possimus, debitis earum.</p>
          </div>
          <div class="col-md-5">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus, molestiae sunt doloribus error ullam expedita cumque blanditiis quas vero, qui, consectetur modi possimus. Consequuntur optio ad quae possimus, debitis earum.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Social Media  Youtube & IG-->
    <sectiion class="social bg-light" id="sosial">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2> Social Media</h2>
          </div>
        </div>

        <!-- Social Media  Youtube -->
        <div class="row justify-content-center">
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-4">
              <img src="<?= $youtubeProfilePic; ?>" width="200" class="rounded-circle img-thumbnail">
              </div>
              <div class="col-md-8">
                <h5><?= $channelName; ?></h5>
                <p><?= $subscriber; ?> Subscribers.</p>
                <div class="g-ytsubscribe" data-channelid="UCPVa-wmpy_r5LSjeXicfnGA" data-layout="default" data-count="default"></div>
              </div>
            </div>

            <div class="row mt-3 pb-3">
              <div class="col">
                <div class="ratio ratio-16x10">
                  <iframe src="https://www.youtube.com/embed/<?= $latestVideoID; ?>?rel=0" title="YouTube video" allowfullscreen></iframe>
                </div>
              </div>
            </div>
          </div>

            <!-- Social Media Instagram -->
          <div class="col-md-5">
            <div class="row">
              <div class="col-md-4">
                  <img src="<?=$igProfilePic;?>" width="200" class="rounded-circle img-thumbnail">
              </div>
              <div class="col-md-8">
                  <h5><?=$igUsername;?></h5>
                  <p><?=$igFollowers;?> Followers</p>
              </div>
            </div>
            <div class="row pt-3 mb-3">
              <div class="col">
                <?php foreach($igMedia as $media): ?>
                  <div class="ig-thumbnail" style="display:inline-block; margin-right:10px;">
                    <a href="<?=$media['permalink'];?>" target="_blank">
                    <img src="<?=$media['media_url'];?>" width="100">
                    </a>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          </div>
        </div>

      </div>
    </sectiion>


    <!-- Portfolio -->
    <section class="portfolio " id="portfolio">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Portfolio</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/1.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/2.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/3.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>   
        </div>

        <div class="row">
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/4.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div> 
          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/5.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md mb-4">
            <div class="card">
              <img class="card-img-top" src="img/thumbs/6.png" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Contact -->
    <section class="contact bg-light" id="contact">
      <div class="container">
        <div class="row pt-4 mb-4">
          <div class="col text-center">
            <h2>Contact</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="card bg-primary text-white mb-4 text-center">
              <div class="card-body">
                <h5 class="card-title">Contact Me</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
            
            <ul class="list-group mb-4">
              <li class="list-group-item"><h3>Location</h3></li>
              <li class="list-group-item">My Office</li>
              <li class="list-group-item">Jl. Setiabudhi No. 193, Bandung</li>
              <li class="list-group-item">West Java, Indonesia</li>
            </ul>
          </div>

          <div class="col-lg-6">
            
            <form>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email">
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone">
              </div>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3"></textarea>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-primary">Send Message</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>


    <!-- footer -->
    <footer class="bg-dark text-white mt-5">
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <p>Copyright &copy; 2018.</p>
          </div>
        </div>
      </div>
    </footer>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="https://apis.google.com/js/platform.js"></script>

  </body>
</html>