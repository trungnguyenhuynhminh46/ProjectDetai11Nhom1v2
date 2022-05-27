<?php getHeader();
$table_name = $_GET['table_name'];
$table_info = $_SESSION['tables'][$table_name];
$partition_key = $table_info['PartitionKey'];
$sort_key = $table_info['SortKey'];
if(isset($_POST['submit-btn'])){
//    Validation
    global $errors, $partition_key_value, $sort_key_value;
    if(trim($_POST['partition-key'])!=''){
        $partition_key_value = trim($_POST['partition-key']);
    }
    else{
        $errors['no-partition-key'] = "Bạn không được để trống partition key";
    }
    if(!empty($sort_key)){
        if(!empty(trim($_POST['sort-key']))){
            $sort_key_value = trim($_POST['sort-key']);
        }
        else{
            $errors['no-partition-key'] = "Bạn không được để trống sort key";
        }
    }
    if(empty($errors)){
        //    Attributes' values
        $msg = [];
        $msg['TableName'] = $table_name;
        $msg[$partition_key] = $partition_key_value;
        if(!empty($sort_key)){
            $msg[$sort_key] = $sort_key_value;
        }
        $num_of_field = count($_POST['name']);
        if($num_of_field > 1){
            for($i=0; $i<$num_of_field; $i++){
                $name = $_POST['name'][$i];
                $value = $_POST['value'][$i];
                $name_not_null = trim($name) != "";
                $value_not_null = trim($value) != "";
                if($name_not_null && $value_not_null){
                    $msg[$name] = $value;
                }
            }
        }
//        show_array($msg);
        createItem($msg);
        redirectTo("?mod=tables&act=detail&name=".$table_name);
    }
}
?>
<div id="main-content-wp" class="add-item-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm item cho table <?php echo $table_name; ?></h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form action = "" method="POST" accept-charset="utf-8">
                        <div id="static-field">
                            <label for="partition-key">Partition key: <?php echo $partition_key; ?></label>
                            <input type="text" name="partition-key" id="partition-key">
                            <label for="sort-key">Sort key: <?php echo $sort_key; ?></label>
                            <input type="text" name="sort-key" id="sort-key" <?php if(empty($sort_key)) echo 'readonly'; ?>>
                        </div>
                        <?php echo return_error('no-partition-key'); ?>
                        <div id="dynamic-field">
                            <div id="item1">
                                <label>Key</label>
                                <input type="text" name="name[]">
                                <label>Value</label>
                                <input type="text" name="value[]">
                                <input type="button" name="add-btn" id="add-btn" value="Add">
                            </div>
                        </div>
                        <input type="submit" name="submit-btn" id="submit-btn" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var i = 1;
        $('#add-btn').click(function(){
            i++;
            $('#dynamic-field').append('<div id="item'+i+'">\n' +
                '                                <label>Key</label>\n' +
                '                                <input type="text" name="name[]">\n' +
                '                                <label>Value</label>\n' +
                '                                <input type="text" name="value[]">\n' +
                '                                <input type="button" name="delete-btn'+i+'" id="'+i+'"class="delete-btn" value="Delete">\n' +
                '                            </div>')
        });
        $(document).on('click','.delete-btn', function(){
            var button_id = $(this).attr("id");
            $('#item'+button_id+'').remove();
        })
    })
</script>
<?php getFooter(); ?>
