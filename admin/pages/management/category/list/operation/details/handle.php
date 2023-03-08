<content>
<?php
    if (isset($_SESSION['StaffName'])) {
        require_once($_SERVER['DOCUMENT_ROOT'].'/vegetablestore/class/category.php');
        $classCat = new category();
?>
<div class="container-fluid">
<h3><span class="text-primary" style="font-weight: bold">Category Details</span></h3>

    <?php 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $classCat->getByID($id);
            foreach ($result as $categoryName) { 
    ?>
    <table class="table table-hover table-bordered" style="text-align: center">
        <thead>
            <tr>
                <th>VegetableID</th>
                <th>VegetableName</th>
                <th>Picture</th>
             </tr>
        </thead>
        <tbody>
            <?php 
                if (isset($_GET['id'])){
                    $categoryID = $_GET['id'];
                    $result = $classCat->getAllVegetableByID($categoryID);  
                foreach ($result as $category):
            ?>
            <tr>
                <td><?php echo $category['VegetableID'] ?></td>
                <td><?php echo $category['VegetableName'] ?></td>
                <td><img src="<?php echo $server_root.'/'.$category['Image'] ?>"  class="img-fluid" width="150px" alt="Responsive image" ></td>
            </tr>
            <?php endforeach; } } } ?>
        </tbody>
    </table>
</div>

<?php 
    } else {
        $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore/system/index.php';
        echo "<script>window.location = '$server_root' </script>";
    }
?>
</content>