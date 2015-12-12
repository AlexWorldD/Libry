/**
 * Created by Алексей on 12.12.2015.
 */
function loadcity(it)
{
    $.ajax({
            type: "POST",
            url: "http://localhost:8080/bd/db_connection/get_city.php",
            dataType: "json",
            data: "country_id="+it,
            error: function () {
                alert("Error with AJAX!");
            },
            success: function (data) {
                $.parseJSON
                $('#city').combobox({
                    valueField: 'city_id',
                    textField: 'city',
                    loadData: data
                });
            }
        }
    )
}
