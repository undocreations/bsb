$(function () {
    $('.js-sweetalert button').on('click', function () {
        var type = $(this).data('type');
        if (type === 'basic') {
            showBasicMessage();
        }
        else if (type === 'with-title') {
            showWithTitleMessage();
        }
        else if (type === 'success') {
            showSuccessMessage();
        }
        else if (type === 'confirm') {
            showConfirmMessage();
        }
        else if (type === 'cancel') {
            showCancelMessage();
        }
        else if (type === 'with-custom-icon') {
            showWithCustomIconMessage();
        }
        else if (type === 'html-message') {
            showHtmlMessage();
        }
        else if (type === 'autoclose-timer') {
            showAutoCloseTimerMessage();
        }
        else if (type === 'prompt') {
            showPromptMessage();
        }
        else if (type === 'ajax-loader') {
            showAjaxLoaderMessage();
        }
    });
});

//These codes takes from http://t4t5.github.io/sweetalert/
function showBasicMessage() {
    swal("Here's a message!");
}

function showWithTitleMessage() {
    swal("Here's a message!", "It's pretty, isn't it?");
}


function showSuccessMessage() {
    swal("Good job!", "You clicked the button!", "success");
}

function showConfirmMessage() {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        swal("Deleted!", "Your imaginary file has been deleted.", "success");
    });
}

function showCancelMessage() {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
}

function showWithCustomIconMessage() {
    swal({
        title: "Sweet!",
        text: "Here's a custom image.",
        imageUrl: "../../images/thumbs-up.png"
    });
}

function showHtmlMessage() {
    swal({
        title: "HTML <small>Title</small>!",
        text: "A custom <span style=\"color: #CC0000\">html<span> message.",
        html: true
    });
}

function showAutoCloseTimerMessage() {
    swal({
        title: "Auto close alert!",
        text: "I will close in 2 seconds.",
        timer: 2000,
        showConfirmButton: false
    });
}

function showPromptMessage() {
    swal({
        title: "An input!",
        text: "Write something interesting:",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "Write something"
    }, function (inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") {
            swal.showInputError("You need to write something!"); return false
        }
        swal("Nice!", "You wrote: " + inputValue, "success");
    });
}

function showAjaxLoaderMessage() {
    swal({
        title: "Ajax request example",
        text: "Submit to run ajax request",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, function () {
        setTimeout(function () {
            swal("Ajax request finished!");
        }, 2000);
    });
}

/* Customers_add.php */
$(document).ready(function(){

    $('#customers_add').submit(function(e) {
        e.preventDefault();
      //  var url = '{!! url() !!}/follow/{!! $profile->user->id !!}';
          var brand_name = $("#brand_name").val();
          var name = $("#name").val();
          var lastname = $("#lastname").val();
          var afm = $("#afm").val();
          var doy = $("#doy").val();
          var phone = $("#phone").val();
          var mobilephone = $("#mobilephone").val();
          
          if (brand_name == '' || name == '' || lastname == '' || afm == '' || doy == '' || phone == '' || mobilephone == '') {
            swal({
               title: "Υπάρχουν λάθη κατά την καταχώρηση.",
               text:  "Θα παραμείνετε στη σελίδα για να διορθώσετε τα λάθη.",
               type: "warning",
               //timer: 6000,
               button: "Επιστροφή"
               });
          } else {
        $.ajax({
            type: "POST",
            url: 'customers_add.php',
            data: $(this).serialize(),
            cache: false,
            success: function(){
                    swal({
                        title: "Επιτυχής Καταχώρηση!",
                        text:  "Θα παραμείνετε στη σελίδα για να καταχωρήσετε νέο πελάτη.",
                        type: "success",
                        timer: 6000,
                        showConfirmButton: false
                    });
                window.setTimeout(function(){ 
                location.reload();
                } ,6000);

            }

        });
    }
        return false;
    });

});
/* #END# Customers_add.php */

/* Customers_upd.php */
$(document).ready(function(){

    $('#customers_edit').submit(function(e) {
        e.preventDefault();
      //  var url = '{!! url() !!}/follow/{!! $profile->user->id !!}';
      var brand_name = $("#brand_name").val();
      var name = $("#name").val();
      var lastname = $("#lastname").val();
      var afm = $("#afm").val();
      var doy = $("#doy").val();
      var phone = $("#phone").val();
      var mobilephone = $("#mobilephone").val();
      
      if (brand_name == '' || name == '' || lastname == '' || afm == '' || doy == '' || phone == '' || mobilephone == '') {
        swal({
           title: "Υπάρχουν λάθη κατά την καταχώρηση.",
           text:  "Θα παραμείνετε στη σελίδα για να διορθώσετε τα λάθη.",
           type: "warning",
           //timer: 6000,
           button: "Επιστροφή"
           });
      } else {
        $.ajax({
            type: "POST",
            url: 'customers_upd.php',
            data: $(this).serialize(),
            cache: false,
            success: function(){
                    swal({
                        title: "Επιτυχής Επεξεργασία!",
                        text:  "Θα μεταφερθείτε στην σελίδα επεξεργασίας Πελατών.",
                        type: "success",
                        timer: 6000,
                        showConfirmButton: false
                    });
                window.setTimeout(function(){ 
                //location.reload();
                window.location.href = 'customers_edit.php';
                } ,6000);

            }

        });
    }
        return false;
    });

});
/* #END# customers_upd.php */

/* ExtinguisherHeads_add.php */
$(document).ready(function(){

    $('#ExtinguisherHeads_add').submit(function(e) {
        e.preventDefault();
      //  var url = '{!! url() !!}/follow/{!! $profile->user->id !!}';
      var ext_head_brandname = $("#ext_head_brandname").val();
            
      if (ext_head_brandname == '' ) {
        swal({
           title: "Υπάρχουν λάθη κατά την καταχώρηση.",
           text:  "Θα παραμείνετε στη σελίδα για να διορθώσετε τα λάθη.",
           type: "warning",
           //timer: 6000,
           button: "Επιστροφή"
           });
      } else {
        $.ajax({
            type: "POST",
            url: 'ExtinguisherHeads_add.php',
            data: $(this).serialize(),
            cache: false,
            success: function(){
                    swal({
                        title: "Επιτυχής Καταχώρηση!",
                        text:  "Θα παραμείνετε στη σελίδα για να καταχωρήσετε νέο Κατασκευαστή Κεφαλής.",
                        type: "success",
                        timer: 6000,
                        showConfirmButton: false
                    });
                window.setTimeout(function(){ 
                location.reload();
                } ,6000);

            }

        });
    }
        return false;
    });

});
/* #END# - ExtinguisherHeads_add.php */

/* ExtinguisherHeads_upd.php */
$(document).ready(function(){

    $('#extinguisherheads_upd').submit(function(e) {
        e.preventDefault();
      //  var url = '{!! url() !!}/follow/{!! $profile->user->id !!}';
      var ext_head_brandname = $("#ext_head_brandname").val();

      if (ext_head_brandname == '' ) {
        swal({
           title: "Υπάρχουν λάθη κατά την καταχώρηση.",
           text:  "Θα παραμείνετε στη σελίδα για να διορθώσετε τα λάθη.",
           type: "warning",
           //timer: 6000,
           button: "Επιστροφή"
           });
      } else {
        $.ajax({
            type: "POST",
            url: 'extinguisherheads_upd.php',
            data: $(this).serialize(),
            cache: false,
            success: function(){
                    swal({
                        title: "Επιτυχής Επεξεργασία!",
                        text:  "Θα μεταφερθείτε στη σελίδα επεξεργασίας Κατασκευαστή Κεφαλών.",
                        type: "success",
                        timer: 6000,
                        showConfirmButton: false
                    });
                window.setTimeout(function(){ 
                //location.reload();
                window.location.href = 'extinguisherheads_edit.php'
                } ,6000);

            }

        });
    }
        return false;
    });

});
/* #END# - ExtinguisherHeads_upd.php */

/* manufacturersfext_add.php */

$(document).ready(function(){

    $('#manufacturersfext_add').submit(function(e) {
        e.preventDefault();
      //  var url = '{!! url() !!}/follow/{!! $profile->user->id !!}';
      var manufacturers_fext_brandname = $("#manufacturers_fext_brandname").val();

      if (manufacturers_fext_brandname == '' ) {
        swal({
           title: "Υπάρχουν λάθη κατά την καταχώρηση.",
           text:  "Θα παραμείνετε στη σελίδα για να διορθώσετε τα λάθη.",
           type: "warning",
           //timer: 6000,
           button: "Επιστροφή"
           });
      } else {
        $.ajax({
            type: "POST",
            url: 'manufacturersfext_add.php',
            data: $(this).serialize(),
            cache: false,
            success: function(){
                    swal({
                        title: "Επιτυχής Καταχώρηση!",
                        text:  "Θα παραμείνετε στη σελίδα για να καταχωρήσετε νέο Κατασκευαστή Πυροσβεστήρων.",
                        type: "success",
                        timer: 6000,
                        showConfirmButton: false
                    });
                window.setTimeout(function(){ 
                location.reload();
                } ,6000);

            }

        });
    }
        return false;
    });

});
/* #END# - manufacturersfext_add.php */

/* fexttype_add.php */
$(document).ready(function(){

    $('#fexttype_add').submit(function(e) {
        e.preventDefault();
      //  var url = '{!! url() !!}/follow/{!! $profile->user->id !!}';
      var fext_type = $("#fext_type").val();

      if (fext_type == '' ) {
        swal({
           title: "Υπάρχουν λάθη κατά την καταχώρηση.",
           text:  "Θα παραμείνετε στη σελίδα για να διορθώσετε τα λάθη.",
           type: "warning",
           //timer: 6000,
           button: "Επιστροφή"
           });
      } else {
        $.ajax({
            type: "POST",
            url: 'fexttype_add.php',
            data: $(this).serialize(),
            cache: false,
            success: function(){
                    swal({
                        title: "Επιτυχής Καταχώρηση!",
                        text:  "Θα παραμείνετε στη σελίδα για να καταχωρήσετε νέο Τύπο Πυροσβεστήρα.",
                        type: "success",
                        timer: 6000,
                        showConfirmButton: false
                    });
                window.setTimeout(function(){ 
                location.reload();
                } ,6000);

            }

        });
    }
        return false;
    });

});
/* #END# - fexttype_add.php */

/* fexttype_upd.php */
$(document).ready(function(){

    $('#fexttype_upd').submit(function(e) {
        e.preventDefault();
      //  var url = '{!! url() !!}/follow/{!! $profile->user->id !!}';
      var fext_type = $("#fext_type").val();

      if (fext_type == '' ) {
        swal({
           title: "Υπάρχουν λάθη κατά την καταχώρηση.",
           text:  "Θα παραμείνετε στη σελίδα για να διορθώσετε τα λάθη.",
           type: "warning",
           //timer: 6000,
           button: "Επιστροφή"
           });
      } else {

        $.ajax({
            type: "POST",
            url: 'fexttype_upd.php',
            data: $(this).serialize(),
            cache: false,
            success: function(){
                    swal({
                        title: "Επιτυχής Επεξεργασία!",
                        text:  "Θα μεταφερθείτε στη σελίδα επεξεργασίας Τύπου Πυροσβεστήρα.",
                        type: "success",
                        timer: 6000,
                        showConfirmButton: false
                    });
                window.setTimeout(function(){ 
                //location.reload();
                window.location.href = 'fexttype_edit.php';
                } ,6000);

            }

        });
    }
        return false;
    });

});
/* #END# - fexttype_upd.php */



/* manufacturersfext_upd.php */
$(document).ready(function(){

    $('#manufacturersfext_upd').submit(function(e) {
        e.preventDefault();
      //  var url = '{!! url() !!}/follow/{!! $profile->user->id !!}';

      var manufacturers_fext_brandname = $("#manufacturers_fext_brandname").val();

      if (manufacturers_fext_brandname == '' ) {
        swal({
           title: "Υπάρχουν λάθη κατά την καταχώρηση.",
           text:  "Θα παραμείνετε στη σελίδα για να διορθώσετε τα λάθη.",
           type: "warning",
           //timer: 6000,
           button: "Επιστροφή"
           });
      } else {
        $.ajax({
            type: "POST",
            url: 'manufacturersfext_upd.php',
            data: $(this).serialize(),
            cache: false,
            success: function(){
                    swal({
                        title: "Επιτυχής Επεξεργασία!",
                        text:  "Θα μεταφερθείτε στη σελίδα επεξεργασίας Κατασκευαστή Πυροσβεστήρων.",
                        type: "success",
                        timer: 6000,
                        showConfirmButton: false
                    });
                window.setTimeout(function(){ 
                //location.reload();
                window.location.href = 'manufacturersfext_edit.php'
                } ,6000);

            }

        });
    }
        return false;
    });

});
/* #END# - manufacturersfext_upd.php */

/* fireext_add.php */
$(document).ready(function(){

    $('#fireext_add').submit(function(e) {
        e.preventDefault();
      //  var url = '{!! url() !!}/follow/{!! $profile->user->id !!}';
      var serialnumber = $("#serialnumber").val();
      var year = $("#year").val();
      var installation_date = $("#installation_date").val();
            
      if (serialnumber == '' || year == '' || installation_date == '') {
        swal({
           title: "Υπάρχουν λάθη κατά την καταχώρηση.",
           text:  "Θα παραμείνετε στη σελίδα για να διορθώσετε τα λάθη.",
           type: "warning",
           //timer: 6000,
           button: "Επιστροφή"
           });
      } else {
        $.ajax({
            type: "POST",
            url: 'fireext_add.php',
            data: $(this).serialize(),
            cache: false,
            success: function(){
                    swal({
                        title: "Επιτυχής Επεξεργασία!",
                        text:  "Θα παραμείνετε στη σελίδα για να καταχωρήσετε νέο Πυροσβεστήρα.",
                        type: "success",
                        timer: 6000,
                        showConfirmButton: false
                    });
                window.setTimeout(function(){ 
                location.reload();
                } ,6000);

            }

        });
    }
        return false;
    });

});
/* #END# - fireext_add */

/* periodicinspection_add.php */
$(document).ready(function(){

    $('#periodicinspection_add').submit(function(e) {
        e.preventDefault();
      //  var url = '{!! url() !!}/follow/{!! $profile->user->id !!}';
      var date_useless = $("#date_useless").val();
      var date_add_check = $("#date_add_check").val();
      var date_next_check = $("#date_next_check").val();
            
      if (date_useless == '' || date_add_check == '' || date_next_check == '') {
        swal({
           title: "Υπάρχουν λάθη κατά την καταχώρηση.",
           text:  "Θα παραμείνετε στη σελίδα για να διορθώσετε τα λάθη.",
           type: "warning",
           //timer: 6000,
           button: "Επιστροφή"
           });
      } else {
        $.ajax({
            type: "POST",
            url: 'periodicinspection_add.php',
            data: $(this).serialize(),
            cache: false,
            success: function(){
                    swal({
                        title: "Επιτυχής Καταχώρηση!",
                        text:  "Θα παραμείνετε στη σελίδα για να καταχωρήσετε νέο Περιοδικό Έλεγχο.",
                        type: "success",
                        timer: 5000,
                        showConfirmButton: false
                    });
                window.setTimeout(function(){ 
                //location.reload();
                window.location.href = 'http://localhost/bsb/main/main.php';
                } ,6000);

            }

        });
    }
        return false;
    });

});
/* #END# - periodicinspection_add */

/*
$(document).ready(function(){
  $('#customers_add').on('submit',function(e) {  //Don't foget to change the id form
  $.ajax({
      url:'add.php', //===PHP file name====
      data:$(this).serialize(),
      type:'POST',
      success:function(data){
      console.log(data);
        //Success Message == 'Title', 'Message body', Last one leave as it is
	    swal("Good job!", "You clicked the button!", "success");
      },
      error:function(data){
        //Error Message == 'Title', 'Message body', Last one leave as it is
	    swal("Oops...", "Something went wrong :(", "error");
      }
    });
    e.preventDefault();
	 //This is to Avoid Page Refresh and Fire the Event "Click"
  });
});
*/