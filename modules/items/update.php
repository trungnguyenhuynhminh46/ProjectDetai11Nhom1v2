<?php getHeader();
$key = json_decode($_GET['key'],true);
$partition_key = trim($_GET['partition_key']);
$sort_key = trim($_GET['sort_key']);
$item = $_GET['item'];
$table_name = $_GET['table_name'];
if(isset($_POST['submit-btn'])){
//    Validation
    global $errors;
    if(empty($errors)){
        //    Attributes' values
        $msg = [];
        $msg['TableName'] = $table_name;
        $old_partition_key_value = $key['Key'][$partition_key];
        $new_partition_key_value = trim($_POST['partition-key']);
        $msg[$partition_key] = $new_partition_key_value;
        if(!empty($sort_key)){
            $new_sort_key_value = trim($_POST['sort-key']);
            $msg[$sort_key] = $new_sort_key_value;
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
        show_array($msg);
        $key_not_change = $old_partition_key_value == $new_partition_key_value;
        if($key_not_change){
//         Thêm đè lên item cũ
            createItem($msg);
            redirectTo("?mod=tables&act=detail&name=".$table_name);
        }else{
//         Xóa item cũ
            $delete_msg = [];
            $delete_msg['TableName'] = $table_name;
            $delete_msg['Key'] = $key['Key'];
            deleteItem($delete_msg);
//         Thêm item với key mới
            createItem($msg);
            redirectTo("?mod=tables&act=detail&name=".$table_name);
        }
    }
    else{
        show_array($errors);
    }
}
?>
<div id="main-content-wp" class="add-item-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhật item cho table <?php echo $table_name; ?></h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form action = "" method="POST" accept-charset="utf-8">
                        <div id="static-field">
                            <label for="partition-key">Partition key: <?php echo $partition_key; ?></label>
                            <input type="text" name="partition-key" id="partition-key" value="<?= $item[$partition_key]; ?>">
                            <label for="sort-key">Sort key: <?php echo $sort_key; ?></label>
                            <input type="text" name="sort-key" id="sort-key" readonly>
                        </div>
                        <div id="dynamic-field">
                            <?php
                            $i = 0;
                            foreach($item as $key => $value){
                                $is_not_key = !(trim($key) == trim($partition_key)) and !(trim($key)== trim($sort_key));
                                if($is_not_key) {
                                    if($i==0){
                                        $html=
                                            '<div id="item'.$i.'">
                                        <label>Key</label>
                                        <input type="text" name="name[]" value="'.$key.'">
                                        <label>Value</label>
                                        <input type="text" name="value[]" value="'.$value.'">
                                        <input type="button" name="add-btn" id="add-btn" value="Add">
                                        </div>';
                                        echo $html;
                                        $i++; //Đảm bảo không thêm Add nữa
                                    }
                                    else{
                                        $html=
                                            '<div id="item'.$i.'">
                                        <label>Key</label>
                                        <input type="text" name="name[]" value="'.$key.'">
                                        <label>Value</label>
                                        <input type="text" name="value[]" value="'.$value.'">
                                        <input type="button" name="delete-btn'.$i.'" id="'.$i.'" class="delete-btn" value="Delete">
                                        </div>';
                                        echo $html;
                                    }
                                }
                            }
                            ?>
<!--                            <div id="item1">-->
<!--                                <label>Key</label>-->
<!--                                <input type="text" name="name[]">-->
<!--                                <label>Value</label>-->
<!--                                <input type="text" name="value[]">-->
<!--                                <input type="button" name="add-btn" id="add-btn" value="Add">-->
<!--                            </div>-->
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
        var i = <?= $i ?>;
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

