$(document).on('submit' , '#frmLogin' , function(e){
e.preventDefault();

    $.ajax({
        type : 'POST',
        url  : base_url + 'login',
        data : $('#frmLogin').serialize(),
        dataType : 'json',
        cache : false,

        beforeSend : function(){
            $('.ajax-response').hide();
            $('#btnLogin').attr('disabled', true);
            $('#btnLogin').text('LOGGING IN...');
        },
        complete : function(){
        },
        success : function(data){

            if(data.status){
                window.location.href = base_url +  'cms/account-setting';
            }else{

                $('#btnLogin').attr('disabled', false);
                $('#btnLogin').text('LOGIN');

                $('.ajax-response').show();
                $('.ajax-message').html(data.message);

                setTimeout(function(){
                    $('.ajax-response').fadeOut();
                },3000);

            }
        },
        error : function(){
            $('#btnLogin').attr('disabled', false);
            $('#btnLogin').text('LOGIN');
            alert("Unable to connect to server. Please reload your page.");
        }
        
    });
             
    return false;
    
});
