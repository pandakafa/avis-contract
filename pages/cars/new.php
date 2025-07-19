<?php

include '../../header.php';


?>
<div class="main">
    <div class="mainLeft">
        <?php include '../../menu.php'; ?>
    </div>
    <div class="mainCenter">
        <div class="mainCenterBackground">
            <div class="mainBarTitle">Yeni Araç Ekle</div>
            <div class="customForm">
                <form id="newCar" enctype="multipart/form-data">
                    <div class="row row-5-gutter">
                        <div class="col-md-8">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Araç Bilgileri</div>
                                <input type="text" name="name" placeholder="Araç Bilgileri" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Fiyat</div>
                                <input type="text" name="daily_fee" class="price" placeholder="Araç Fiyatı" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Model</div>
                                <select name="model" required>
                                    <?php
                                    $start   = 2010;
                                    $current = date( "Y" );

                                    foreach ( range( $start, $current ) as $model ) {
                                        echo '<option value="' . $model . '">' . $model . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Vites</div>
                                <select name="gear" required>
                                    <?php foreach ( viewResult( 'gear_type' ) as $gear ) { ?>
                                        <option value="<?php echo $gear['id']; ?>">
                                            <?php echo $gear['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Yakıt Tipi</div>
                                <select name="fuel" required>
                                    <?php foreach ( viewResult( 'fuel_type' ) as $fuel ) { ?>
                                        <option value="<?php echo $fuel['id']; ?>">
                                            <?php echo $fuel['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Renk</div>
                                <select name="color" required>
                                    <?php foreach ( viewResult( 'colors' ) as $color ) { ?>
                                        <option value="<?php echo $color['id']; ?>">
                                            <?php echo $color['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="customFormSubmit">
                                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
                                <button type="submit"><i class="fa-regular fa-hourglass"></i> Aracı Kaydet</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

include '../../footer.php';