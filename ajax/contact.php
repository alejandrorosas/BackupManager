<div id="contact_form" class="row">
  <div class="col-12 col-sm-12 col-lg-12">
    <h2>Tell Us What You Think...</h2>
    <p>We appreciate any feedback about your overall experience on our site or how to make it even better.  Please fill in the below form with any comments and we will get back to you.</p>
    <form role="form" id="feedbackForm">
      <div class="form-group">
        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
        <span class="help-block" style="display: none;">Please enter your name.</span>
      </div>
      <div class="form-group">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
        <span class="help-block" style="display: none;">Please enter a valid e-mail address.</span>
      </div>
      <div class="form-group">
        <textarea rows="10" cols="100" class="form-control" id="message" name="message" placeholder="Message"></textarea>
        <span class="help-block" style="display: none;">Please enter a message.</span>
      </div>
      <button type="submit" id="feedbackSubmit" class="btn btn-primary btn-lg" style="display: block; margin-top: 10px;">Send Feedback</button>
    </form>
  </div><!--/span-->
</div><!--/row-->

<script>
  $(document).ready(function() {
  $("#feedbackSubmit").click(function() {
    //clear any errors
    contactForm.clearErrors();
 
    //do a little client-side validation -- check that each field has a value and e-mail field is in proper format
    var hasErrors = false;
    $('#feedbackForm input,textarea').each(function() {
      if (!$(this).val()) {
        hasErrors = true;
        contactForm.addError($(this));
      }
    });
    var $email = $('#email');
    if (!contactForm.isValidEmail($email.val())) {
      hasErrors = true;
      contactForm.addError($email);
    }
 
    //if there are any errors return without sending e-mail
    if (hasErrors) {
      return false;
    }
 
    //send the feedback e-mail
    $.ajax({
      type: "POST",
      url: "functions/sendmail.php",
      data: $("#feedbackForm").serialize(),
      success: function(data)
      {
        contactForm.addAjaxMessage(data.message, false);
      },
      error: function(response)
      {
        contactForm.addAjaxMessage(response.responseJSON.message, true);
      }
   });
    return false;
  }); 
});
 
//namespace as not to pollute global namespace
var contactForm = {
  isValidEmail: function (email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  },
  clearErrors: function () {
    $('#emailAlert').remove();
    $('#feedbackForm .help-block').hide();
    $('#feedbackForm .form-group').removeClass('has-error');
  },
  addError: function ($input) {
    $input.siblings('.help-block').show();
    $input.parent('.form-group').addClass('has-error');
  },
  addAjaxMessage: function(msg, isError) {
    $("#feedbackSubmit").after('<div id="emailAlert" class="alert alert-' + (isError ? 'danger' : 'success') + '" style="margin-top: 5px;">' + $('<div/>').text(msg).html() + '</div>');
  }
};
</script>