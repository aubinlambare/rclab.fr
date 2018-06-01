// $( "form" ).submit(function( event ) {
//         var lastName = $("#form-last-name");
//         var firstName = $("#form-first-name");
//         var email = $("#form-email");
//         var username = $("#form-user-name");
//         var password = $("#form-password");
//         var passwordConfirmed = $("#form-password-confirmed");
//
//         var check = true;
//
//         $( ".test" ).text( "Not valid!" ).show();
//
//             if($(lastName).val() === ''){
//                 showValidate(lastName);
//
//                 check=false;
//             }
//
//             if($(firstName).val().trim() === ''){
//                 showValidate(firstName);
//                 check=false;
//             }
//
//
//             if($(email).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
//                 showValidate(email);
//                 check=false;
//             }
//
//             if($(username).val().trim() === ''){
//                 showValidate(username);
//                 check=false;
//             }
//
//             if($(password).val().trim() === ''){
//                 showValidate(password);
//                 check=false;
//             }
//
//             if($(passwordConfirmed).val().trim() === ''){
//                 showValidate(passwordConfirmed);
//                 check=false;
//             }
//
//             return check;
//         });
//
//
//         $('.registration-form .form-control').each(function(){
//             $(this).focus(function(){
//                 hideValidate(this);
//             });
//     });
//
//     function showValidate(input) {
//         var thisAlert = $(input).parent();
//
//         $(thisAlert).addClass('alert-validate');
//     }
//
//     function hideValidate(input) {
//         var thisAlert = $(input).parent();
//
//         $(thisAlert).removeClass('alert-validate');
//     }
//
//
// });
