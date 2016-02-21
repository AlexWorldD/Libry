/**
 * Created by Алексей on 12.12.2015.
 */
function edit_user() {

    var c=$('#country').val();
    var c2=$( '#city').val();
    $(function () {
        $('#country').devbridgeAutocomplete({
            serviceUrl: 'http://188.166.145.173/db_connection/get_country.php',
            preventBadQueries: true,
            onSelect: function (suggestion) {

                    $('#city').devbridgeAutocomplete({
                        serviceUrl: 'http://188.166.145.173/db_connection/get_city.php?country_id='+suggestion.data,
                        preventBadQueries: true,
                        onSelect: function (suggestion) {

                        }
                    });

            }
        });
    });


    //$('#country').empty();
    //$('#country').val(c);

    /*
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
    */
    $('#country').empty();
    $('#country').val(c);
    $('#f_name').removeAttr("disabled");
    $('#l_name').removeAttr("disabled");
    $('#age').removeAttr("disabled");
    $('#sex').removeAttr("disabled");
    $('#email').removeAttr("disabled");
    $('#phone').removeAttr("disabled");
    $('#address').removeAttr("disabled");
    $('#address2').removeAttr("disabled");
    $( '#city').empty();
    $( '#city').val(c2);
    $('#city').removeAttr("disabled");
    $('#country').removeAttr("disabled");
    $('#bts').removeAttr("disabled");
    $('#btc').removeAttr("disabled");


}
$(function () {
    $('#country').devbridgeAutocomplete({
        serviceUrl: 'http://188.166.145.173/db_connection/get_country.php',
        preventBadQueries: true,
        onSelect: function (suggestion) {

        }
    });
});
