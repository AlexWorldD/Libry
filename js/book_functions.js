/**
 * Created by Алексей on 14.12.2015.
 */
var writing_id;
var user_id = 0;
var res_t;
var res_a;
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
var s_r;
function add_book(id) {
    user_id = id;
    $('#add_success').attr("hidden", true);
    $('#add_fail').attr("hidden", true);
    $('#title').val('');
    $('#add_l_n').val('');
    $('#add_f_n').val('');
    $('#add_pat').val('');
    $('#a_desc').val('');
    $('#a_y_born').val('');
    $('#a_y_death').val('');
    $('#a_country').val('');
    $('#a_lang_orig').val('');
    $('#a_lang').val('');
    $('#a_page').val('');
    $('#a_year').val('');
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
$(function () {
    $('#search').devbridgeAutocomplete({
        serviceUrl: 'http://localhost:8080/bd/db_connection/get_title.php',
        preventBadQueries: true,
        showNoSuggestionNotice: true,
        onSelect: function (suggestion) {
            s_r=suggestion;
            $('#title_book').empty();

            $('#title_book').append(
                suggestion.value
            );
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/bd/db_connection/get_author.php",
                dataType: "json",
                data: "writing_id=" + suggestion.data,
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
                        data[0].last_name
                    );
                    $('#f_n').empty();
                    $('#f_n').append(
                        data[0].first_name
                    );
                    $('#pat').empty();
                    $('#pat').append(
                        data[0].patronymic
                    );
                }
            });
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/bd/db_connection/get_desc.php",
                dataType: "json",
                data: "writing_id=" + suggestion.data,
                error: function () {
                    alert("Error with second AJAX!");
                },
                success: function (data) {
                    $('#descrip_book').empty();
                    $('#descrip_book').append(
                        data[0].description
                    );
                }
            });

        }

    });
    if (s_r==null) {
        $('#title_book').empty();
        $('#release_y').empty();
        $('#l_n').empty();
        $('#f_n').empty();
        $('#pat').empty();
        $('#descrip_book').empty();


    }
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
                    $('#title').focus();
                }
            });
            res_a = suggestion;
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
    $('#a_country').devbridgeAutocomplete({
        serviceUrl: 'http://localhost:8080/bd/db_connection/get_country.php',
        preventBadQueries: true,
        onSelect: function (suggestion) {
        }
    });
});
function save_book(u_id) {
    // Adding book in Libry's already, count+1 only
    if (res_t != null) {
        $.ajax({
            type: "POST",
            url: "http://localhost:8080/bd/db_connection/add_book.php",
            dataType: "json",
            data: "in=1&user_id=" + u_id + "&writing_id=" + res_t.data + "&lang=" + $('#a_lang').val() + "&pages=" + $('#a_page').val(),
            error: function () {
                $('#add_fail').removeAttr("hidden");
            },
            success: function (data) {

                $('#add_success').removeAttr("hidden");
                $('#title').val('');
                $('#add_l_n').val('');
                $('#add_f_n').val('');
                $('#add_pat').val('');
                $('#a_desc').val('');
                $('#a_y_born').val('');
                $('#a_y_death').val('');
                $('#a_country').val('');
                $('#a_lang_orig').val('');
                $('#a_lang').val('');
                $('#a_page').val('');
                $('#a_year').val('');
            }
        });

    }
    else
    // TODO add validation for fields
    // Adding book NOT in Libry's...

    {
        //Look for author
        // Author in Libry already
        if (res_a != null) {
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/bd/db_connection/add_book.php",
                dataType: "json",
                data: "in=0&user_id=" + u_id +
                "&title=" + $('#title').val() +
                "&desc=" + $('#a_desc').val() +
                "&author_in=1" +
                "&author_id=" + res_a.data +
                "&lang_o=" + $('#a_lang_orig').val() +
                "&lang=" + $('#a_lang').val() +
                "&pages=" + $('#a_page').val() +
                "&release=" + $('#a_year').val(),
                error: function () {
                    $('#add_fail').removeAttr("hidden");
                },
                success: function (data) {

                    $('#add_success').removeAttr("hidden");
                    $('#title').val('');
                    $('#add_l_n').val('');
                    $('#add_f_n').val('');
                    $('#add_pat').val('');
                    $('#a_desc').val('');
                    $('#a_y_born').val('');
                    $('#a_y_death').val('');
                    $('#a_country').val('');
                    $('#a_lang_orig').val('');
                    $('#a_lang').val('');
                    $('#a_page').val('');
                    $('#a_year').val('');
                }
            });
        }
        // Require to add author to Libry
        else {
            if($('#title').val()==0)
            {
                $('#title').focus();
                return;
            }
            if($('#add_l_n').val()==0)
            {
                $('#add_l_n').focus();
                return;
            }
            if($('#add_f_n').val()==0)
            {
                $('#add_f_n').focus();
                return;
            }
            if($('#a_desc').val()==0)
            {
                $('#a_desc').focus();
                return;
            }
            if($('#a_country').val()==0)
            {
                $('#a_country').focus();
                return;
            }
            if($('#a_lang_orig').val()==0)
            {
                $('#a_lang_orig').focus();
                return;
            }

            $.ajax({
                type: "POST",
                url: "http://localhost:8080/bd/db_connection/add_book.php",
                dataType: "json",
                data: "in=0&user_id=" + u_id +
                "&title=" + $('#title').val() +
                "&desc=" + $('#a_desc').val() +
                "&author_in=0" +
                "&l_name=" + $('#add_l_n').val() +
                "&f_name=" + $('#add_f_n').val() +
                "&pat=" + $('#add_pat').val() +
                "&born=" + $('#a_y_born').val() +
                "&death=" + $('#a_y_death').val() +
                "&lang_o=" + $('#a_lang_orig').val() +
                "&lang=" + $('#a_lang').val() +
                "&pages=" + $('#a_page').val() +
                "&release=" + $('#a_year').val() +
                "&country=" + $('#a_country').val(),
                error: function () {
                    $('#add_fail').removeAttr("hidden");
                },
                success: function (data) {

                    $('#add_success').removeAttr("hidden");
                    $('#title').val('');
                    $('#add_l_n').val('');
                    $('#add_f_n').val('');
                    $('#add_pat').val('');
                    $('#a_desc').val('');
                    $('#a_y_born').val('');
                    $('#a_y_death').val('');
                    $('#a_country').val('');
                    $('#a_lang_orig').val('');
                    $('#a_lang').val('');
                    $('#a_page').val('');
                    $('#a_year').val('');
                }
            });

        }

    }

}
function cancel_book() {
    $("#add_book").modal('hide');
}
function del_book(u_id) {
    var del_row = $('#t_my_books').datagrid('getSelected');
    if (del_row) {
        $.ajax({
            type: "POST",
            url: "http://localhost:8080/bd/db_connection/delete.php",
            dataType: "json",
            data: "user_id="+u_id+"&book_id="+del_row.book_id,
            error: function () {
                //$('#add_fail').removeAttr("hidden");
            },
            success: function (data) {
                $('#t_my_books').datagrid('reload');
            }
        });
    }
}
function find_user() {
    $('#user_l').empty();
    $('#user_n').empty();
    $('#phone').empty();
    $('#email').empty();
    var sel = $('#t_my_books').datagrid('getSelected');
    $("#m_show_user").modal('show');
    if (sel) {
        $.ajax({
            type: "POST",
            url: "http://localhost:8080/bd/db_connection/find_user.php",
            dataType: "json",
            data: "writing_id="+sel.writing_id,
            error: function () {
                //$('#add_fail').removeAttr("hidden");
            },
            success: function (data) {
                $('#user_l').append(data[0].last_name);
                $('#user_n').append(data[0].first_name);
                $('#phone').append(data[0].phone);
                $('#email').append(data[0].email);
            }
        });
    }
}
function get_xml_m(u_id) {
    $.ajax({
        type: "POST",
        url: "http://localhost:8080/bd/db_connection/get_xml.php",
        dataType: "json",
        data: "user_id="+u_id+"&mode=my",
        error: function () {
            //$('#add_fail').removeAttr("hidden");
        },
        success: function (data) {

        }
    });
}