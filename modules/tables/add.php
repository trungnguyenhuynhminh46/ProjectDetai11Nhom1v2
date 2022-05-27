<?php getHeader();
if(isset($_POST['btn-submit'])){
//    Validation
    $table_name_pattern = "/^[\w.-]{3,255}$/";
    $key_pattern = "/^.{1,255}$$/";
    global $errors, $alerts, $table_name, $partition_key, $sort_key;
    if(!empty($_POST['table-name'])){
        $tmp = trim($_POST['table-name']);
        $tmp = convert_string_to_non_utf8($tmp);
        if(!check_by_pattern($table_name_pattern, $tmp)){
            $errors['not-table-name'] = "Tên bảng đúng định dạng phải có từ 3 đến 255 ký tự, chỉ được phép chứa chữ cái, số, (_), (-), (.). ";
        }
        else{
            if(in_array($tmp,$_SESSION['tables-name'])){
                $errors['table-name-existed'] = "Tên bảng đã tồn tại mời kiểm tra lại";
            }
            else {
                $table_name = $tmp;
            }
        }
    }
    else{
        $errors['no-table-name'] = "Bạn phải nhập tên bảng bạn muốn tạo";
    }
    if(!empty($_POST['partition-key'])){
        if(!check_by_pattern($key_pattern, $_POST['partition-key'])){
            $errors['not-partition-key'] = "Tên partition key đúng định dạng là một chuỗi gồm từ 1 đến 255 ký tự bất kỳ";
        }
        else{
            $partition_key = $_POST['partition-key'];
            $tmp = trim($_POST['sort-key']);
            if(!empty($tmp)){
                if(!check_by_pattern($key_pattern, $_POST['sort-key'])){
                    $errors['not-sort-key'] = "Tên sort key đúng định dạng là một chuỗi gồm từ 1 đến 255 ký tự bất kỳ";
                }
                else{
                    if($partition_key == $tmp){
                        $errors['equal-partition'] = "Tên sort key không được trùng với tên partition key";
                    }
                    $sort_key = $tmp;
                }
            }
        }
    }
    else{
        $errors['no-partition-key'] = "Bạn buộc phải nhập partition key";
    }
//    Create Table
    if(empty($errors)){
        $inp = [
                "TableName" => $table_name,
                "HashKeyName" => $partition_key,
                "HashKeyType" => $_POST['partition-type'],
                "ReadCapacityUnits" => intval($_POST['read-capacity']),
                "WriteCapacityUnits" => intval($_POST['write-capacity']),
        ];
        if(!empty($sort_key)){
            $inp['RangeKeyName'] = $sort_key;
            $inp['RangeKeyType'] = $_POST['sort-type'];
        }
        createTable($inp);
        $_SESSION['tables-name'][] = $table_name;
        redirectTo("?mod=tables&act=main");
    }
}
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm bảng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" accept-charset="utf-8">
                        <label for="table-name">Tên bảng</label>
                        <input type="text" name="table-name" id="table-name">
                        <?php echo return_error('no-table-name'); ?>
                        <?php echo return_error('not-table-name'); ?>
                        <?php echo return_error('table-name-existed'); ?>
                        <label for="table-name">Partition key</label>
                        <input type="text" name="partition-key" id="partition-key">
                        <?php echo return_error('not-partition-key'); ?>
                        <?php echo return_error('no-partition-key'); ?>
                        <select name="partition-type" id="partition-type">
                            <option value="S" selected = "selected">String</option>
                            <option value="N">Number</option>
                            <option value="B">Binary</option>
                        </select>
                        <label for="sort-key">Sort key</label>
                        <input type="text" name="sort-key" id="sort-key">
                        <?php echo return_error('not-sort-key'); ?>
                        <?php echo return_error('equal-partition'); ?>
                        <select name="sort-type" id="sort-type">
                            <option value="S" selected = "selected">String</option>
                            <option value="N">Number</option>
                            <option value="B">Binary</option>
                        </select>
                        <label for="read-capacity">Số đơn vị cho phép đọc</label>
                        <input type="number" name="read-capacity" id="read-capacity" value="1" min="1" max="1000">
                        <label for="write-capacity">Số đơn vị cho phép ghi</label>
                        <input type="number" name="write-capacity" id="write-capacity" value="1" min="1" max="1000">
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php getFooter(); ?>
