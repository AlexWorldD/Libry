/**
 * Created by Алексей on 14.12.2015.
 */
var writing_id;
var user_id = 0;
$(document).ready(function () {
    $('#t_books').datagrid({
        onDblClickRow: function (index, row) {


            $('#title_book').empty();
            $('#title_book').append(
                "<b>" + row.title + "</b>"
            );
            writing_id = row.writing_id;
            // AJAX for additional info about selected book
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/bd/db_connection/book_info.php",
                dataType: "json",
                data: "writing_id=" + row.writing_id + "&user_id=" + user_id,
                error: function () {
                    alert("Error with second AJAX!");
                },
                success: function (data) {
                    $('#release_y').empty();
                    $('#release_y').append(
                        data[0].release_year
                    );
                    $('#descrip_book').empty();
                    $('#descrip_book').append(
                        data[0].description
                    );


                }
            });
            $('#b_msg_war').attr("hidden", true);
            $('#b_msg').attr("hidden", true);
            $('#fav_star').empty();
            $('#fav_star').append("<span class='glyphicon glyphicon-star-empty text-muted' disabled>");
            $('#b_msg').attr("hidden", true);
            $("#m_show_book").modal('show');

        }
    });

});
// Add to Favorites
function add_fav(user_id) {
    $.ajax({
        type: "POST",
        url: "http://localhost:8080/bd/db_connection/add_favorite.php",
        dataType: "json",
        data: "writing_id=" + writing_id + "&user_id=" + user_id,
        error: function () {
            alert("Error with second AJAX!");
        },
        success: function (data) {
            if (!data.OK) {
                $('#b_msg_war').removeAttr("hidden");
            }
            else {
                // Change Star on header
                $('#fav_star').empty();
                $('#fav_star').append("<span class='glyphicon glyphicon-star text-muted' disabled>");
                $('#b_msg').removeAttr("hidden");
            }


        }
    });
}
// Function for show my books
$(document).ready(function () {
    $('#t_my_books').datagrid({
        onDblClickRow: function (index, row) {


            $('#title_book').empty();
            $('#title_book').append(
                "<b>" + row.title + "</b>"
            );
            writing_id = row.writing_id;
            // AJAX for additional info about selected book
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/bd/db_connection/book_info.php",
                dataType: "json",
                data: "writing_id=" + row.writing_id + "&user_id=" + user_id,
                error: function () {
                    alert("Error with second AJAX!");
                },
                success: function (data) {
                    $('#release_y').empty();
                    $('#release_y').append(
                        data[0].release_year
                    );
                    $('#l_n').empty();
                    $('#l_n').append(
                        row.last_name
                    );
                    $('#f_n').empty();
                    $('#f_n').append(
                        row.first_name
                    );
                    $('#pat').empty();
                    $('#pat').append(
                        row.patronymic
                    );
                    $('#descrip_book').empty();
                    $('#descrip_book').append(
                        data[0].description
                    );


                }
            });
            $('#b_msg_war').attr("hidden", true);
            $('#b_msg').attr("hidden", true);
            $('#fav_star').empty();
            $('#fav_star').append("<span class='glyphicon glyphicon-star-empty text-muted' disabled>");
            $('#b_msg').attr("hidden", true);
            $("#m_show_book").modal('show');

        }
    });

});
function add_book(user_id) {
    $("#add_book").modal('show');
}
