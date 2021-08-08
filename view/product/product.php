<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <table class="table table-striped table-hover dt-datatable">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th class="no-sort"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($products as $product) {
                        ?>
                        <tr>
                            <td><? echo $product->getProductName()?></td>
                            <td><? echo $product->getProductImg()?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>