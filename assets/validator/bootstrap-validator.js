  $(document).ready(function() {
    $('#frm_reg').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                validators: {
                    notEmpty: {
                        message: 'The first name is required and cannot be empty'
                    }
                }
            },
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'The last name is required and cannot be empty'
                    }
                }
            }, 
         
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            password: {
                validators: {
                    minlength: {
                        message: 'Password should be atleast 5 character'
                    } 
                }
            },
            cpassword: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                        
                    },
                    minlength: {
                        message: 'Password should be atleast 5 character'
                    } 
                }
            } 
        }
        
    });


    $('#frm_change_password').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
             
            password: {
                validators: {
                    minlength: {
                        message: 'Password should be atleast 5 character'
                    } 
                }
            },
            cpassword: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                        
                    },
                    minlength: {
                        message: 'Password should be atleast 5 character'
                    } 
                }
            } 
        }
        
    });
});