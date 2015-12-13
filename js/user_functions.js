/**
 * Created by Алексей on 13.12.2015.
 */
function user_cancel(id) {
    $('#f_name').attr('disabled', true);
    $('#l_name').attr('disabled', true);
    $('#age').attr('disabled', true);
    $('#sex').attr('disabled', true);
    $('#email').attr('disabled', true);
    $('#phone').attr('disabled', true);
    $('#address').attr('disabled', true);
    $('#address2').attr('disabled', true);
    $('#city').attr('disabled', true);
    $('#country').attr('disabled', true);
    $('#bts').attr('disabled', true);
    $('#btc').attr('disabled', true);
    load_user(id);
}
function user_save(id) {
var up_req="user_id="+id+"&first_name="+$('#f_name').val()+"&last_name="+$('#l_name').val()+"&age="+$('#age').val()+
        "&sex="+$('#sex').val()+"&email="+$('#email').val()+"&phone="+$('#phone').val()+"&address="+$('#address').val()+
    "&address2="+$('#address2').val()+"&city_id="+$('#city').val()+"&country_id="+$('#country').val();
    up_req=encodeURI(up_req);
    $.ajax({
            type: "POST",
            url: "http://localhost:8080/bd/db_connection/update_user.php",
            dataType: "json",
            data: up_req,
            error: function () {
                alert("Error with AJAX!");
            },
            success: function (data) {
                alert("Correct update!");
            }
        }
    )
}
