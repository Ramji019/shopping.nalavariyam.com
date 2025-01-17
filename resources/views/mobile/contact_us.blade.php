@extends('mobile/layouts.other_app')
@section('mobile/content')

  <!-- Setting Popup Overlay -->
  <div id="setting-popup-overlay"></div>

  <!-- Setting Popup Card -->
  <div class="card setting-popup-card shadow-lg" id="settingCard">
    <div class="card-body">
      <div class="container">
        <div class="setting-heading d-flex align-items-center justify-content-between mb-3">
          <p class="mb-0">Settings</p>
          <div class="btn-close" id="settingCardClose"></div>
        </div>

        <div class="single-setting-panel">
          <div class="form-check form-switch mb-2">
            <input class="form-check-input" type="checkbox" id="availabilityStatus" checked>
            <label class="form-check-label" for="availabilityStatus">Availability status</label>
          </div>
        </div>

        <div class="single-setting-panel">
          <div class="form-check form-switch mb-2">
            <input class="form-check-input" type="checkbox" id="sendMeNotifications" checked>
            <label class="form-check-label" for="sendMeNotifications">Send me notifications</label>
          </div>
        </div>

        <div class="single-setting-panel">
          <div class="form-check form-switch mb-2">
            <input class="form-check-input" type="checkbox" id="darkSwitch">
            <label class="form-check-label" for="darkSwitch">Dark mode</label>
          </div>
        </div>

        <div class="single-setting-panel">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="rtlSwitch">
            <label class="form-check-label" for="rtlSwitch">RTL mode</label>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Header Area -->


  
    <section style="background-color: white">
      
        <div class="container" >
        
          <!-- row Start -->
         <center><h3 style="margin-top:50px"><i>Contact Us</i></h3></center> 
          <div class="row">
          <form method="post" action="{{url('addcontactus')}}">
            {{csrf_field()}}
            <div class="col-lg-7 col-md-7">
              
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <div class="form-group" >
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control simple">
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control simple" name="email" id="email">
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label>Subject</label>
                <input type="text" class="form-control simple" name="subject" id="subject">
              </div>
              
              <div class="form-group">
                <label>Message</label>
                <textarea class="form-control simple" name="message" id="message"></textarea>
              </div>
              
              <div class="form-group">
                <button class="btn btn-primary rounded" type="submit">Submit Request</button>
              </div>
                      
            </div>
            </form>
            <div class="col-lg-5 col-md-5">
              <div class="contact-info">
                
                <h2>Get In Touch</h2>
                <p>Feel free to get in touch if you need any further assistance or have any inquiries.</p>
                
                
                <div class="cn-info-detail">
                  <div class="cn-info-icon">
                    <i class="ti-home"></i>
                  </div>
                  <div class="cn-info-content">
                    <h4 class="cn-info-title">Reach Us</h4>
                    Asaripallam Rd, <br>Weavers Colony,NesamonyNagar<br>TamilNadu 629001
                  </div>
                </div>
                
                <div class="cn-info-detail">
                  <div class="cn-info-icon">
                    <i class="ti-email"></i>
                  </div>
                  <div class="cn-info-content">
                    <h4 class="cn-info-title">Drop A Mail</h4>
                    kumaritimes@gmail.com
                  </div>
                </div>
                
                <div class="cn-info-detail">
                  <div class="cn-info-icon">
                    <i class="ti-mobile"></i>
                  </div>
                  <div class="cn-info-content">
                    <h4 class="cn-info-title">Call Us</h4>
                    +91 6380375996
                  </div>
                </div>
                
              </div>
            </div>
            
          </div>
          <!-- /row -->   
          
       </div>
            
      </section>

    <div class="container">
      <!-- Google Maps -->
      <div class="card">
        <div class="card-body">
          <div class="google-maps">
            <h5 class="mb-3">Our office location</h5>
            <iframe class="w-100"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d37902.096510377676!2d101.6393079588335!3d3.103387873464772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc49c701efeae7%3A0xf4d98e5b2f1c287d!2sKuala%20Lumpur%2C%20Federal%20Territory%20of%20Kuala%20Lumpur%2C%20Malaysia!5e0!3m2!1sen!2sbd!4v1591684973931!5m2!1sen!2sbd"
              allowfullscreen="" aria-hidden="false" tabindex="0" style="margin-bottom:50px ;"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection





