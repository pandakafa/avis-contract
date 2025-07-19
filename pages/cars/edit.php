<?php

include '../../header.php';

$ID    = $_GET['id'];
$query = $db->prepare( "SELECT * FROM cars WHERE id={$ID}" );
$query->execute();
$result = $query->fetch();
?>
<div class="main">
    <div class="mainLeft">
        <?php include '../../menu.php'; ?>
    </div>
    <div class="mainCenter">
        <div class="mainCenterBackground">
            <div class="mainBarTitle">Aracı Düzenle</div>
            <div class="customForm">
                <form id="editCar" enctype="multipart/form-data">
                    <div class="row row-5-gutter">
                        <div class="col-md-8">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Araç Bilgileri</div>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" placeholder="Araç Bilgileri" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Fiyat</div>
                                <input type="text" name="daily_fee" class="price" value="<?php echo $result['daily_fee']; ?>" placeholder="Araç Fiyatı" required>
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

                                        if ( $model == $result['model'] ) {

                                            echo '<option value="' . $model . '" selected>' . $model . '</option>';


                                        } else {

                                            echo '<option value="' . $model . '">' . $model . '</option>';

                                        }

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
                                        <?php

                                        $selected = '';

                                        if ( $gear['id'] == $result['gear'] ) :

                                            $selected = 'selected';

                                        endif;

                                        ?>
                                        <option value="<?php echo $gear['id']; ?>" <?php echo $selected; ?>>
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
                                        <?php

                                        $selected = '';

                                        if ( $fuel['id'] == $result['fuel'] ) :

                                            $selected = 'selected';

                                        endif;

                                        ?>
                                        <option value="<?php echo $fuel['id']; ?>" <?php echo $selected; ?>>
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
                                        <?php

                                        $selected = '';

                                        if ( $color['id'] == $result['color'] ) :

                                            $selected = 'selected';

                                        endif;

                                        ?>
                                        <option value="<?php echo $color['id']; ?>" <?php echo $selected; ?>>
                                            <?php echo $color['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="customFormSubmit">
                                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
                                <input type="hidden" name="editID" value="<?php echo $_GET['id']; ?>" />
                                <button type="submit"><i class="fa-regular fa-hourglass"></i> Aracı Düzenle</button>
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