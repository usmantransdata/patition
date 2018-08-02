<!DOCTYPE html>
<html>
@include('frontend.layout.header')
<!--END OF NAVBAR-->
<link rel="stylesheet" type="text/css" href="{{asset('/')}}public/dist/css/progress.css">
<!--PARALAX SECTION-->
<br>
<div class="container" style="max-height: 1200px;min-height: 700px;">

  <div class="row">
      <div class="row">
        <div class="col s12">
          <h3>Create a Petition</h3>
          <p>Create a powerful online petition in just minutes. Our system is flexible, customizable, and easy to use. Best of all, it's free!
          Start by filling out this form, and in a few minutes you'll be ready to collect thousands of signatures.</p>
        </div>
      </div>
    <!-- multistep form -->
<form id="msform" class="col s12" style="width: 600px">
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Account Setup</li>
    <li>Social Profiles</li>
    <li>Personal Details</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Petition Title & <br/>You Message</h2>

      <div class="row">
              <div class="input-field col s10">
                 <i class="material-icons prefix">mode_edit</i> 
                <input name="title" required="required" id="icon_prefix" type="text" class="validate">
                <label for="icon_prefix" style="font-size: 17px">Petition Title</label>
              </div>
       </div>
       	  <div class="row">
              <div class="input-field col s10">
                <i class="material-icons prefix">sms</i>
               
                 <textarea name="description" id="textarea1" class="materialize-textarea validate" ></textarea>
                <label for="textarea1" style="font-size: 17px">Message</label>
              </div>
            </div>



           <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Chose Decision Maker &<br>Category</h2>
   
      <div class="row">
              <div class="input-field col s1">
                <i class="material-icons prefix">wc</i>
              </div>
                 <div class="input-field col s5" style="position: relative;right: 20px">
                <select  rows="1" class="selectpicker" style="outline: none" id="tag_list" name="tag_list[]" multiple></select> 
                 </div>
        </div>
  
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Personal Details</h2>
    <h3 class="fs-subtitle">We will never sell it</h3>
    <input type="text" name="fname" placeholder="First Name" />
    <input type="text" name="lname" placeholder="Last Name" />
    <input type="text" name="phone" placeholder="Phone" />
    <textarea name="address" placeholder="Address"></textarea>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="submit" name="submit" class="submit action-button" value="Submit" />
  </fieldset>
</form>
  </div>
</div>

<!--FOOTER-->
<!-- footer -->
 @include('frontend.layout.footer')
<!-- js here -->
  <script type="text/javascript" src="{{asset('/')}}public/dist/js/progress.js"></script>
</body>
</html>