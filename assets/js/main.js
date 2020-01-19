$( document ).ready(function() {
    console.log( "ready!" );

    $('#datepicker').datetimepicker({
        uiLibrary: 'bootstrap4',
        footer: true, modal: true,
        format: 'yyyy-mm-dd HH:MM'
    });


    $("#register-form").submit(function(e){
        if(!isValidEmail($("#email").val().trim())){
            e.preventDefault();
            errorMessage('Enter correct email.')
            return
        }
        if($("#password").val().trim().length < 4) {
            e.preventDefault();
            errorMessage('The password must be at least 4 characters in length.')
            return
        }
        if($("#password").val().trim() !== $("#password2").val().trim()) {
            e.preventDefault();
            errorMessage('Your new password and confirmation password do not match. Please confirm and try again.')
            return
        }
    });

    $("#login-form").submit(function(e){
        if(!isValidEmail($("#email").val().trim())){
            e.preventDefault();
            errorMessage('Enter correct email.')
            return
        }
        if($("#password").val().trim().length < 4) {
            e.preventDefault();
            errorMessage('The password must be at least 4 characters in length.')
            return
        }
    });

    $("#task-form").submit(function(e){
        if($("#title").val().trim().length === 0 || $("#text").val().trim().length === 0 || $("#datepicker").val().trim().length === 0) {
            e.preventDefault();
            errorMessage('Please fill all the fields and try again.')
            return
        }

        if($("#datepicker").val().trim() < getDateStr()) {
            e.preventDefault();
            errorMessage('The date cannot be in past.')
            return
        }
    });

    function isValidEmail(email){
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase())
    }


    function errorMessage(message){
        $('#message-block').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
            '<span id="message"><strong>Error!</strong> '+message+'</span>'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
            '</button>'+
            '</div>')
    }

    function getDateStr(){
        const d = new Date();
        const curr_date = d.getDate();
        const curr_date_str = curr_date > 10 ? curr_date : '0'+ curr_date;
        const curr_month = d.getMonth() + 1;
        const curr_month_str = curr_month > 10 ? curr_month : '0'+ curr_month;
        const curr_year = d.getFullYear();
        const curr_hour = d.getHours();
        const curr_hour_str = curr_hour > 10 ? curr_hour : '0'+ curr_hour;
        const curr_min = d.getMinutes();
        const curr_min_str = curr_min > 10 ? curr_min : '0'+ curr_min;
        return curr_year + '-' + curr_month_str + '-' + curr_date_str + ' ' + curr_hour_str + ':' + curr_min_str;


    }



});