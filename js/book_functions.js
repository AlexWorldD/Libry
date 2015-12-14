/**
 * Created by Алексей on 14.12.2015.
 */
/*
 function show_book() {
 alert("Work!");
 row = $('#t_books').datagrid('getSelected');
 $('#bo_modal').dialog('open').dialog('setTitle', 'Информация о сотруднике');
 $('#bo_form').form('load', row);
 //url = 'setPayment.php?position=' + row.position_name + '&id=' + row.id;
 }
 */
$(document).ready(function () {
    $('#t_books').datagrid({
        onDblClickRow: function (index, row) {


            $('#title_book').empty();
            $('#title_book').append(
                "<b>" + row.title + "</b>"
            );

            // AJAX for additional info about selected book
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/bd/db_connection/book_info.php",
                dataType: "json",
                data: "writing_id=" + row.writing_id,
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
            $("#m_show_book").modal('show');

        }
    });

});
