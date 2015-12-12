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
    $('#city').removeAttr("disabled");
    $('#country').removeAttr("disabled");
    $('#address').removeAttr("disabled");
    $('#address2').removeAttr("disabled");
    var c=$('#country').val();
    $.ajax({
            type: "POST",
            url: "http://localhost:8080/bd/db_connection/get_country.php",
            dataType: "json",
            error: function () {
                alert("Error with AJAX!");
            },
            success: function (data) {
                $('#country').empty();
                for ( var i = 0; i < data.length; i++ ) {

                    $( '#country' ).append( '<option value="' + data[i].country_id + '">' + data[i].country + '</option>' );

                }
                $('#country').val(c);
                $.ajax({
                        type: "POST",
                        url: "http://localhost:8080/bd/db_connection/get_city.php",
                        dataType: "json",
                        //data: "country_id="+c,
                        error: function () {
                            alert("Error with AJAX!");
                        },
                        success: function (data) {
                            c=$( '#city').val();
                            $( '#city').empty();
                            for ( var i = 0; i < data.length; i++ ) {
                                $( '#city' ).append( '<option value="' + data[i].city_id + '">' + data[i].city + '</option>' );
                            }
                            $( '#city').val(c);

                        }
                    }
                )


            }
        }
    )


}
