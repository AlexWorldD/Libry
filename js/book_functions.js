/**
 * Created by Алексей on 14.12.2015.
 */
var writing_id;
var user_id = 0;
var res_t;
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
        /*
         onDblClickCell: function(index, field, value) {
         if (value!=0) {
         alert('hi');
         }
         else {
         alert('bb');
         }
         },
         */
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
function add_book(id) {
    user_id = id;
    $('#title').val('');
    $('#add_l_n').val('');
    $('#add_f_n').val('');
    $('#add_pat').val('');
    $("#add_book").modal('show');
}
$(function () {
    $('#title').devbridgeAutocomplete({
        serviceUrl: 'http://localhost:8080/bd/db_connection/get_title.php',
        preventBadQueries: true,
        showNoSuggestionNotice: true,
        onSelect: function (suggestion) {
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/bd/db_connection/get_author.php",
                dataType: "json",
                data: "writing_id=" + suggestion.data,
                error: function () {
                    alert("Error with second AJAX!");
                },
                success: function (data) {
                    $('#add_l_n').val(data[0].last_name);
                    $('#add_f_n').val(data[0].first_name);
                    $('#add_pat').val(data[0].patronymic);
                    $('#a_y_born').val(data[0].year_born);
                    $('#a_y_death').val(data[0].year_death);
                    $('#a_lang_orig').val(data[0].lang);
                    $('#a_year').val(data[0].release_year);
                }
            });
            res_t = suggestion;
        }

    });
});
/*
 $(document).ready(function () {
 if ($('#title').val() !="" && !res_t) {
 alert("check");
 }
 })
 */
$(function () {
    $('#add_l_n').devbridgeAutocomplete({
        serviceUrl: 'http://localhost:8080/bd/db_connection/get_author.php',
        preventBadQueries: true,
        onSelect: function (suggestion) {
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/bd/db_connection/get_author.php",
                dataType: "json",
                data: "author_id=" + suggestion.data,
                error: function () {
                    alert("Error with second AJAX!");
                },
                success: function (data) {

                    $('#add_f_n').val(data[0].first_name);
                    $('#add_pat').val(data[0].patronymic);
                    $('#a_y_born').val(data[0].year_born);
                    $('#a_y_death').val(data[0].year_death);
                    $('#title').val('');
                }
            });
        }
    });
});
$(function () {
    $('#a_lang_orig').devbridgeAutocomplete({
        serviceUrl: 'http://localhost:8080/bd/db_connection/get_lang.php',
        preventBadQueries: true,
        onSelect: function (suggestion) {
        }
    });
    $('#a_lang').devbridgeAutocomplete({
        serviceUrl: 'http://localhost:8080/bd/db_connection/get_lang.php',
        preventBadQueries: true,
        onSelect: function (suggestion) {
        }
    });
});
function save_book(u_id) {
    // Adding book in Libry's already, count+1 only
    if ($('#title').val() == res_t.value) {
        $.ajax({
            type: "POST",
            url: "http://localhost:8080/bd/db_connection/add_book.php",
            dataType: "json",
            data: "in=1&user_id=" + u_id + "&writing_id=" + res_t.data + "&lang=" + $('#a_lang').val() + "&pages=" + $('#a_page').val(),
            error: function () {
                alert("Error with second AJAX!");
            },
            success: function (data) {

                $('#add_f_n').val(data[0].first_name);
                $('#add_pat').val(data[0].patronymic);
                $('#a_y_born').val(data[0].year_born);
                $('#a_y_death').val(data[0].year_death);
                $('#title').val('');
            }
        });
        /*
         if(jQuery.inArray($('#title').val(), res_t)==-1 && jQuery.inArray($('#title').val(), res_t)!=0) {
         alert("hi");
         }
         */


    }
}