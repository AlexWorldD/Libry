/**
 * Created by Алексей on 12.12.2015.
 */
function load_user(it)
{
    $.ajax({
            type: "POST",
            url: "http://localhost:8080/bd/db_connection/get_user.php",
            dataType: "json",
            data: "user_id="+it,
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
                $('#country').combobox('select',data[0].country_id );
                $('#city').combobox('setValue',data[0].city );
                $('#user_address').val(data[0].address);
                $('#address').html('');
                $('#address').append(
                    '<br><strong>'+data[0].country+'</strong>,  '+data[0].city+'<br>'+
                    data[0].address+'<br>'+data[0].address2
                );

            }
        }
    )
}
