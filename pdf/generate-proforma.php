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
    <title>PROFORMA</title>
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

        .container {
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            height: 100vh;
        }

        .logo {
            margin-top: 75px;
            margin-left: 50px;
            height: 50px;
        }

        .reservation-number {
            margin-left: 50px;
            margin-top: 55px;
            font-size: 19px;
            color: #717171;
        }

        .reservation-number b {
            color: #111111;
        }

        .date {
            margin-left: 50px;
            margin-top: 10px;
            font-size: 19px;
            color: #717171;
        }

        .date b {
            color: #111111;
        }

        .line {
            margin-left: 50px;
            margin-right: 50px;
            width: 90%;
            height: 1px;
            background-color: #EAEAEA;
            margin-top: 30px;
        }

        .col1 {
            margin-left: 50px;
            float: left;
            margin-top: 25px;
        }

        .col2 {
            margin-left: 50px;
            float: left;
            margin-top: 25px;
        }

        .col3 {
            float: right;
            margin-top: 25px;
            margin-right: 55px;
        }

        .title1 {
            color: #111111;
            font-size: 24px;
            font-weight: 700;
        }

        .value1 {
            color: #717171;
            font-size: 22px;
            text-transform: uppercase;
        }

        .value2 {
            color: #717171;
            font-size: 22px;
        }

        .bold {
            font-weight: 700;
        }

        .w250px {
            width: 250px;
        }

        .title2 {
            margin-top: 30px;
            color: #111111;
            font-size: 24px;
            font-weight: 700;
        }

        .day {
            height: 200px;
            width: 200px;
            border: 1px solid #EAEAEA;
            border-radius: 15px;
        }

        .day-title1 {
            color: #717171;
            font-size: 25px;
            text-align: center;
            margin-top: 20px;
        }

        .day-title2 {
            font-size: 35px;
            color: red;
            text-align: center;
        }

        .rentalCar {
            border: 1px solid #EAEAEA;
            padding: 20px;
            margin-top: 50px;
            width: 90%;
            margin-left: 50px;
        }

        .rentalCarDetail {
            font-size: 30px;
            color: #111111;
        }

        .rentalCarName {
            color: #111111;
            font-size: 21px;
            margin-top: 10px;
        }

        .table {
            padding: 0px 20px;
            margin-top: 50px;
            width: 93.5%;
            margin-left: 30px;
        }

        .tableUst {
            background-color: #F6F6F6;
            width: 100%;
            height: 70px;
            padding-top: 35px;
            border: 1px solid #EAEAEA;
            -webkit-border-top-left-radius: 10px;
            -webkit-border-top-right-radius: 10px;
            -moz-border-radius-topleft: 10px;
            -moz-border-radius-topright: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .tablex2 {
            padding: 0px 20px;
            width: 93.5%;
            margin-left: 30px;
        }

        .tableUst2 {
            width: 100%;
            border-left: 1px solid #EAEAEA;
            border-right: 1px solid #EAEAEA;
            border-bottom: 1px solid #EAEAEA;
            -webkit-border-bottom-right-radius: 10px;
            -webkit-border-bottom-left-radius: 10px;
            -moz-border-radius-bottomright: 10px;
            -moz-border-radius-bottomleft: 10px;
            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 10px;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .table1 {
            width: 40%;
            float: left;
            padding-left: 20px;
            font-size: 17px;
        }

        .table2 {
            width: 20%;
            float: left;
            padding-left: 20px;
            font-size: 17px;
        }

        .table3 {
            width: 20%;
            float: left;
            padding-left: 20px;
            font-size: 17px;
        }

        .table4 {
            width: 20%;
            float: left;
            padding-left: 20px;
            font-size: 17px;
        }

        .primAryColor {
            color: #717171;
        }

        .payment {
            margin-top: 50px;
            margin-left: 50px;
        }

        .paymentMethod {
            float: left;
            width: 50%;
        }

        .paymentMethod1 {
            font-weight: 700;
            font-size: 25px;
            color: #111111;
        }

        .paymentMethod2 {
            color: #717171;
            font-size: 25px;
        }

        .totalMoney {
            float: right;
            width: 50%;
            text-align: right;
            margin-right: 50px;
            font-size: 30px;
            color: red;
            font-weight: 700;
        }

        .earsiv {
            float: right;
            margin-top: 55px;
            margin-right: 50px;
        }

        .earsiv img {
            height: 150px;
        }

        .earsivText {
            text-align: center;
            color: #717171;
            font-weight: 700;
            font-size: 25px;
        }

        .bottomImage {
            margin-left: 50px;
            margin-top: 40px;
        }

        .bottomImage img {
            height: 220px;
        }
    </style>
    <div class="container">
        <div class="earsiv">
            <img src="<?php echo $root; ?>/assets/img/e-arsiv.png">
            <div class="earsivText">E-Arşiv</div>
        </div>
        <div class="logo">
            <img src="<?php echo $root; ?>/assets/img/pdf-logo.png">
        </div>
        <div class="reservation-number"><b>Rezervasyon Numarası :</b>
            <?php echo '#' . str_pad( $row['id'], 5, "0", STR_PAD_LEFT ); ?>
        </div>
        <div class="date"><b>Tarih :</b>
            <?php echo $row['created_date']; ?>
        </div>
        <div class="line"></div>
        <div class="col1">
            <div class="title1">AVİS OTOMOTİV TİCARET ve <br> SANAYİ A.Ş. </div>
            <div class="value1 bold">TİCARET SİCİL NO</div>
            <div class="value1">459231</div>
            <div class="value1 bold">MERSİS</div>
            <div class="value1">0649019353100258</div>
            <div class="value1 bold">VERGİ NO</div>
            <div class="value1">459231</div>
        </div>
        <div class="col2">
            <div class="title1">
                <?php echo $row['name_surname']; ?>
            </div>
            <div class="value1 w250px">
                <?php echo $row['address']; ?>
            </div>
            <div class="title2">Kiralama Tarihleri</div>
            <div class="value2">Başlangıç : <b>
                    <?php echo $row['rental_start']; ?>
                </b></div>
            <div class="value2">Bitiş : <b>
                    <?php echo $row['rental_end']; ?>
                </b>
            </div>
        </div>
        <div class="col3">
            <div class="day">
                <div class="day-title1">Kiralama Gün <br> Sayısı</div>
                <div class="day-title2 bold">
                    <?php echo $day . ' Gün '; ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="rentalCar">
            <div class="rentalCarDetail bold">Kiralanan Araç Bilgisi</div>
            <div class="rentalCarName">
                <?php echo $carFullName; ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="table">
            <div class="tableUst">
                <div class="table1 bold">Araç Bilgisi</div>
                <div class="table2 bold">Depozito</div>
                <div class="table3 bold">KDV (%20)</div>
                <div class="table4 bold">Kiralama Ücreti</div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="tablex2">
            <div class="tableUst2">
                <div class="table1 primAryColor">
                    <?php echo $carFullName; ?>
                </div>
                <div class="table2 primAryColor">
                    <?php echo $row['deposit'] . ' ₺'; ?>
                </div>
                <div class="table3 primAryColor">
                    <?php
                    $sayi2 = ($row['daily_fee'] - ($row['daily_fee'] / 1.20));
                    echo number_format( $sayi2, 2, '.', '' ) . ' ₺';
                    ?>
                </div>
                <div class="table4 primAryColor">
                    <?php
                    $sayi3 = ($day * $row['daily_fee']);
                    echo number_format( $sayi3, 2, '.', '' ) . ' ₺';
                    ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="payment">
            <div class="paymentMethod">
                <div class="paymentMethod1">Ödeme Yöntemi</div>
                <div class="paymentMethod2">
                    <?php echo idbyRequest( 'payment_type', $row['payment_type'], 'name' ); ?>
                </div>
            </div>
            <div class="totalMoney">
                <div class="">Toplam :
                    <?php
                    $sayi4 = (($day * $row['daily_fee'])) + ($row['deposit']);
                    echo number_format( $sayi4, 2, '.', '' ) . ' ₺';
                    ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="bottomImage">
            <img src="<?php echo $root; ?>/assets/img/bottom.png">
        </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script>
      $(function(){
            window.print();

      })
      </script>
</body>
</html>