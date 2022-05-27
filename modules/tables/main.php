<?php getHeader();
$tables = getAllTablesDetail();
$_SESSION['tables'] = $tables;
$_SESSION['tables-name'] = array_keys($tables);
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php getSidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách các bảng</h3>
                    <a href="?mod=tables&act=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                            <tr>
                                <td><span class="thead-text">Tên bảng</span></td>
                                <td><span class="thead-text">Status</span></td>
                                <td><span class="thead-text">Partition Key</span></td>
                                <td><span class="thead-text">Sort Key</span></td>
                                <td><span class="thead-text">#</span></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($tables as $table_name => $table){
                                    ?>
                                    <tr>
                                        <td class="table-name">
                                            <a href="?mod=tables&act=detail&name=<?php echo $table_name; ?>"><?php echo $table_name; ?></a>
                                        </td>
                                        <td class="table-name">
                                            <span><?php echo $table['Status']; ?></span>
                                        </td>
                                        <td>
                                            <span><?php echo $table['PartitionKey']; ?></span>
                                        </td>
                                        <td>
                                            <span><?php echo $table['SortKey']; ?></span>
                                        </td>
                                        <td>
                                            <a href="?mod=tables&act=delete&name=<?php echo $table_name; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>
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
