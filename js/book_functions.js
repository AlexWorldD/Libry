/**
 * Created by Алексей on 14.12.2015.
 */
function show_book(){
    var row = $('#t_bools').datagrid('getSelected');
    if (row){
        $('#staffdlg').dialog('open').dialog('setTitle','Информация о сотруднике');
        $('#stafffm').form('load',row);
        url = 'setPayment.php?position='+row.position_name+'&id='+row.id;
    }
}
