<?php

include '../../header.php';

?>
<div class="main">
    <div class="mainLeft">
        <?php include '../../menu.php'; ?>
    </div>
    <div class="mainCenter">
        <div class="mainCenterBackground">
            <div class="mainBarTitle">Yeni Fatura Oluştur</div>
            <div class="customForm">
                <form id="newInvoice" enctype="multipart/form-data">
                    <div class="row row-5-gutter">
                        <div class="col-md-3">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Kiralayan Adı Soyadı</div>
                                <input type="text" name="name_surname" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Kiralayan Telefon Numarası</div>
                                <input type="text" name="phone" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Kiralayan T.C Kimlik No</div>
                                <input type="text" name="tc" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Ehliyet Seri No</div>
                                <input type="text" name="license">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Araç Seçimi</div>
                                <select name="car" class="select-car" required>
                                    <option value="">-- Seçim Yok --</option>
                                    <?php foreach ( viewResult( 'cars' ) as $car ) { ?>
                                        <option value="<?php echo $car['id']; ?>">
                                            <?php echo $car['name'] . ' - ' . $car['model'] . ' - ' . idbyRequest( 'gear_type', $car['gear'], 'name' ) . ' - ' . idbyRequest( 'fuel_type', $car['fuel'], 'name' ) . ' - ' . idbyRequest( 'colors', $car['color'], 'name' ); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Günlük Fiyat (₺)</div>
                                <input type="text" name="daily_fee" class="price daily_fee" placeholder="Araç Fiyatı" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Depozito / Provizyon (₺)</div>
                                <input type="text" name="deposit" class="price" placeholder="Depozito" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Kiralama Başlangıç Tarihi</div>
                                <input type="date" name="rental_start" class="rental_start" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Kiralama Bitiş Tarihi</div>
                                <input type="date" name="rental_end" class="rental_end" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Yol Hakkı (km)</div>
                                <input type="number" name="way" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Ödeme Yöntemi</div>
                                <select name="payment_type" required>
                                    <?php foreach ( viewResult( 'payment_type' ) as $payment ) { ?>
                                        <option value="<?php echo $payment['id']; ?>">
                                            <?php echo $payment['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">Açık Adres</div>
                                <textarea name="address" placeholder="Açık Adres"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="customFormSubmit">
                                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
                                <button type="submit"><i class="fa-regular fa-hourglass"></i> Fatura Oluştur <span class="loadingForm"><i class="fas fa-spinner fa-spin"></i></span></button>
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