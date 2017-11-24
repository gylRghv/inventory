<?php require 'loginHeader.php' ?>
<?php require 'loginFooter.php' ?>
<div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h3>Contact Us</h3>
      </div>
      <div class="col-lg-6"></div>
    </div>
    <div class="row"> 
      <div class="col-lg-6">
         <div id="map"></div>
        <script>
          function initMap() {                    
            var option = {
              zoom: 10,
              center: {lat: 28.4595, lng: 77.0266} 
            };
            var map = new google.maps.Map(document.getElementById('map'), option); 
            var marker = new google.maps.Marker({
              position: {lat: 28.4595, lng: 77.0266},
              map: map
            });
          }
        </script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALWOWE1fVq5EkZMn1oB89zFZ_cT6_7Qeg&callback=initMap">
        </script>  
      </div>
      <div class="col-lg-6 well well-lg">
        <div class="row">
          <div class="col-sm-8">       
            <?php echo form_open('ajaxc/contact');?>         
             <div class="header">
               <h3>Quick Contact</h3>
             </div>         
              <h4>Contact us today, and get reply with in 24 hours!</h4>
              <div class="input-group">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-user"></i>
                <input placeholder="Your name" type="text" tabindex="1" required autofocus>
              </span>
              </div>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-envelope"></i>
                  <input placeholder="Your Email Address" type="email" tabindex="2" required>
                </span>
              </div>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-phone"></i>
                  <input placeholder="Your Phone Number" type="tel" tabindex="3" required>
                </span>
              </div>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-pencil"></i></span>
                <textarea placeholder="Type your Message Here...." tabindex="5" required></textarea>           
              </div>        
              
              <fieldset>
                <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
              </fieldset>        
            <?php echo form_close() ?>
          </div>
        </div>        
      </div>
    </div>       
  </div>      
</body>
</html>
