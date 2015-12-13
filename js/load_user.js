/**
 * Created by Алексей on 12.12.2015.
 */
function load_user(it) {
    $.ajax({
        type: "POST",
        url: "http://localhost:8080/bd/db_connection/get_user.php",
        dataType: "json",
        data: "user_id=" + it,
        error: function () {
            alert("Error with AJAX!");
        },
        success: function (data) {

            $('#f_name').val(data[0].first_name);
            $('#l_name').val(data[0].last_name);
            $('#age').val(data[0].age);
            $('#sex').val(data[0].sex);
            $('#email').val(data[0].email);
            $('#phone').val(data[0].phone);
            // Check address
            if (data[0].address_id) {
                $.ajax({
                    type: "POST",
                    url: "http://localhost:8080/bd/db_connection/get_user.php",
                    dataType: "json",
                    data: "address_id=" + data[0].address_id,
                    error: function () {
                        alert("Error with second AJAX!");
                    },
                    success: function (data) {
                        $('#country').append(
                            "<option value='" + data[0].country_id + "'>" + data[0].country + "</option>"
                        );
                        $('#country').val(data[0].country_id);
                        $('#city').append(
                            "<option value='" + data[0].city_id + "'>" + data[0].city + "</option>"
                        );
                        $('#city').val(data[0].city_id);
                        $('#address').val(data[0].address);
                        $('#address2').val(data[0].address2);

                    }
                })
            }

        }
    })
}

