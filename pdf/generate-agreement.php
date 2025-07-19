<?php

include '../inc/_connect.php';


$ID    = $_GET['id'];
$query = $db->prepare( "SELECT * FROM invoice WHERE id={$ID}" );
$query->execute();
$row = $query->fetch();

$baslangicTarihi = new DateTime( $row['rental_start'] );
$bitisTarihi     = new DateTime( $row['rental_end'] );
$day             = $baslangicTarihi->diff( $bitisTarihi )->days;

$carName  = idbyRequest( 'cars', $row['car'], 'name' );
$carModel = idbyRequest( 'cars', $row['car'], 'model' );
$carGear  = idbyRequest( 'cars', $row['car'], 'gear' );
$carFuel  = idbyRequest( 'cars', $row['car'], 'fuel' );
$carColor = idbyRequest( 'cars', $row['car'], 'color' );

$carFullName = $carName . ' - ' . $carModel . ' - ' . idbyRequest( 'fuel_type', $carFuel, 'name' ) . ' - ' . idbyRequest( 'gear_type', $carGear, 'name' ) . ' - ' . idbyRequest( 'colors', $carColor, 'name' );

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sözleşme</title>
</head>
<body>
    <style>
        @page {
            margin: 0 !important;
            padding: 0 !important;
        }

        @font-face {
            font-family: calibri;
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url("<?php echo $root; ?>/assets/fonts/calibri.ttf") format("truetype");
        }

        @font-face {
            font-family: calibri;
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url("<?php echo $root; ?>/assets/fonts/calibri-bold.ttf") format("truetype");
        }

        body {
            font-family: calibri, sans-serif;
            background-color: #fff;
        }

        * {
            padding: 0;
            margin: 0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            font-family: calibri, sans-serif;
        }

        html {
            font-family: calibri, sans-serif;
            scroll-behavior: smooth;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        .page-break {
            page-break-before: always;
        }

        .clearfix {
            float: none;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .page img {
            width: 100%;
        }

        .agreementDeail {
            margin-top: 50px;
            margin-left: 150px;
        }

        .agreementLogos {
            margin-top: -240px;
            float: right;
            margin-right: 130px;
        }

        .agreementItem {
            font-size: 25px;
            font-weight: 700;
            color: #717171;
        }

        .agreementItem .ai1 {
            display: block;
            width: 300px;
            float: left;
            position: relative;
            text-transform: uppercase;
        }

        .agreementItem .ai11 {
            width: 100%;
            height: 2px;
            background-color: #717171;
            width: 300px;
        }

        .agreementItem .ai2 {
            float: left;
            text-transform: uppercase;
        }

        .red {
            color: red;
        }

        .agreementTable {
            margin-top: 60px;
            margin-left: 150px;
            border-left: 1px solid #000;
            border-top: 1px solid #000;
            width: 1400px;
        }

        .tables1 {
            width: 340px;
            float: left;
            padding: 2px 2px 5px 7px;
            font-size: 17px;
            font-weight: 700;
            color: #7B7B7B;
            border-bottom: 1px solid #000;
            border-right: 1px solid #000;
            margin-top: -2px;
        }

        .tables2 {
            width: 1040px;
            font-size: 17px;
            float: left;
            padding: 2px 2px 5px 7px;
            color: #7B7B7B;
            margin-top: -2px;
            border-bottom: 1px solid #000;
            border-right: 1px solid #000;
        }

        .bgBlack {
            background-color: #000;
            color: #666666;
        }

        .bgRed {
            background-color: RED;
            color: #fff;
        }

        .tupper {
            text-transform: uppercase;
        }
    </style>
    <section class="page">
        <img src="<?php echo $root; ?>/assets/img/agreement/page1-top.jpg">
        <div class="agreementDeail">
            <div class="agreementItem">
                <div class="ai1">KİRALAYAN </div>
                <div class="ai2">: Avis Araç Kiralama Hizmetleri</div>
                <div class="clearfix"></div>
                <div class="ai11"></div>
            </div>
            <div class="clearfix"></div>
            <div class="agreementItem">
                <div class="ai1">SÖZLEŞME TARİHİ</div>
                <div class="ai2">
                    <?php echo ': ' . $row['created_date']; ?>
                </div>
                <div class="clearfix"></div>
                <div class="ai11"></div>
            </div>
            <div class="clearfix"></div>
            <div class="agreementItem">
                <div class="ai1">SÖZLEŞME NO</div>
                <div class="ai2">: <span class="red">AV85910035</span></div>
                <div class="clearfix"></div>
                <div class="ai11"></div>
            </div>
            <div class="clearfix"></div>
            <div class="agreementItem">
                <div class="ai1">MERSİS </div>
                <div class="ai2">: 0649019353100258</div>
                <div class="clearfix"></div>
                <div class="ai11"></div>
            </div>
            <div class="clearfix"></div>
            <div class="agreementItem">
                <div class="ai1">VERGİ DAİRESİ VE NO</div>
                <div class="ai2">: 6490193531 / Büyük Mükellefler V.D</div>
                <div class="clearfix"></div>
                <div class="ai11"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="agreementLogos">
            <img src="<?php echo $root; ?>/assets/img/agreement/agreement-logo.png">
        </div>
        <div class="agreementTable">
            <div class="tables">
                <div class="tables1 bgBlack tupper">KİRACI ADI SOYADI</div>
                <div class="tables1">
                    <?php echo $row['name_surname']; ?>
                </div>
                <div class="tables1 bgBlack tupper">T.C KİMLİK NO</div>
                <div class="tables1">
                    <?php echo $row['tc']; ?>
                </div>
                <div class="clearfix"></div>
                <div class="tables1 bgBlack tupper">İLETİŞİM NUMARASI</div>
                <div class="tables1">
                    <?php echo $row['phone']; ?>
                </div>
                <div class="tables1 bgBlack tupper">EHLİYET SERİ NO</div>
                <div class="tables1">
                    <?php echo $row['license'] == true ? $row['license'] : "0"; ?>
                </div>
                <div class="clearfix"></div>
                <div class="tables1 bgBlack tupper">ADRES</div>
                <div class="tables2">
                    <?php echo $row['address']; ?>
                </div>
                <div class="clearfix"></div>
                <div class="tables1 bgBlack tupper">ÖZEL ŞARTLAR</div>
                <div class="tables1">YOK</div>
                <div class="tables1 bgBlack tupper">KİRALAMA SÜRESİ</div>
                <div class="tables1">
                    <?php echo $day . ' Gün'; ?>
                </div>
                <div class="clearfix"></div>
                <div class="tables1 bgBlack tupper">YOL HAKKI</div>
                <div class="tables1">
                    <?php echo $row['way'] . ' KM'; ?>
                </div>
                <div class="tables1 bgBlack tupper">ARAÇ TESLİM TARİHİ</div>
                <div class="tables1">
                    <?php echo $row['rental_end']; ?>
                </div>
                <div class="clearfix"></div>
                <div class="tables1 bgBlack tupper">KASKO POLİÇESİ</div>
                <div class="tables1">AXA FULL RENT KASKO</div>
                <div class="tables1">(TAM KAPSAMLI KIRALAMA KASKOSU)</div>
                <div class="tables1">Poliçe No :
                    <?php echo '37-' . str_pad( $row['id'], 5, "0", STR_PAD_LEFT ); ?>
                </div>
                <div class="clearfix"></div>
                <div class="tables1 bgBlack tupper">ARAÇ MARKO MODELİ</div>
                <div class="tables2">
                    <?php echo $carFullName; ?>
                </div>
                <div class="clearfix"></div>
                <div class="tables1 bgBlack tupper">ÖDEME TUTARI</div>
                <div class="tables1">
                    <?php echo (($day * $row['daily_fee']) + ($row['deposit'])) . ' ₺ (İndirimli)'; ?>
                </div>
                <div class="tables1">
                    <?php echo number_format( $row['deposit'], 2, '.', '' ) . ' ₺ (Provizyon)'; ?>
                </div>
                <div class="tables1 bgRed">(ÖDENMEDİ)</div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <img src="<?php echo $root; ?>/assets/img/agreement/page1-bottom.jpg">
    </section>
    <section class="page">
        <img src="<?php echo $root; ?>/assets/img/agreement/page2.jpg">
    </section>
    <section class="page">
        <img src="<?php echo $root; ?>/assets/img/agreement/page3.jpg">
    </section>
    <section class="page">
        <img src="<?php echo $root; ?>/assets/img/agreement/page4.jpg">
    </section>
    <section class="page">
        <img src="<?php echo $root; ?>/assets/img/agreement/page5.jpg">
    </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script>
      $(function(){
            window.print();

      })
      </script>
</body>
</html>