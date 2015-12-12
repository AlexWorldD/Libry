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
            }
        }
    )
}
