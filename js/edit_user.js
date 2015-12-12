/**
 * Created by Алексей on 12.12.2015.
 */
function edit_user() {
    $('#f_name').removeAttr("disabled");
    $('#l_name').removeAttr("disabled");
    $('#age').removeAttr("disabled");
    $('#sex').removeAttr("disabled");
    $('#email').removeAttr("disabled");
    $('#phone').removeAttr("disabled");
    $('#user_address').removeAttr("disabled");
    $('#user_ad').html('');
    $('#user_ad_ed').css('z-index', 1)
}
