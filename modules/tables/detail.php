<?php
$table_name = $_GET['name'];
$items = getAllItemsByTableName($table_name)['Items'];
$table_info = $_SESSION['tables'][$table_name];
$partition_key = $table_info['PartitionKey'];
$sort_key = $table_info['SortKey'];
?>
<?php getHeader(); ?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php getSidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách các items của table <?php echo $table_name ?></h3>
                    <a href="?mod=items&act=insert&table_name=<?php echo $table_name;?>" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                            <tr>
                                <td><span class="thead-text">Partition Key: <?php echo $partition_key;?></span></td>
                                <td><span class="thead-text">Sort Key: <?php echo $sort_key;?></span></td>
                                <td><span class="thead-text">Detail</span></td>
                                <td><span class="thead-text">Actions</span></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($items as $item) {
                                $item_key = [
                                        "Key" => [$partition_key => $item[$partition_key]]
                                ];
                                if(!empty($sort_key)){
                                    $item_key['Key'][$sort_key] = $item[$sort_key];
                                }
                                $json_item_key = json_encode($item_key);
//                                echo $json_item_key;
                                ?>
                                <tr>
                                    <td><?php echo $item[$partition_key]; ?></td>
                                    <td><?php if(!empty($sort_key)) echo $item[$sort_key]; ?></td>
                                    <td><?php
                                        show_array($item);
                                        $qs = http_build_query(array("item"=>$item));
                                        ?></td>
                                    <td>
                                        <a href='?mod=items&act=update&table_name=<?php echo $table_name; ?>&partition_key=<?php echo $partition_key; ?> &sort_key=<?php echo $sort_key; ?>&key=<?php echo $json_item_key;?>&<?php echo $qs; ?>'>Sửa</a>|<a href='?mod=items&act=delete&table_name=<?php echo $table_name; ?>&key=<?php echo $json_item_key;?>'>Xóa</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="" title=""><</a>
                        </li>
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                        <li>
                            <a href="" title="">></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php getFooter(); ?>

