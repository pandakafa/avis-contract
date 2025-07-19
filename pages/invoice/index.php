<?php

include '../../header.php';

?>
<div class="main">
    <div class="mainLeft">
        <?php include '../../menu.php'; ?>
    </div>
    <div class="mainCenter">
        <div class="mainCenterBackground">
            <div class="mainBarTitle">Faturalar</div>
            <div class="customTable">
                <table id="invoice" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Adı Soyadı</th>
                            <th>Telefon</th>
                            <th>Ödeme Tipi</th>
                            <th>Araç</th>
                            <th>Başlangıç Tarihi</th>
                            <th>Bitiş Tarihi</th>
                            <th>Gün</th>
                            <th>Yol Hakkı</th>
                            <th>Günlük Ücret</th>
                            <th>Depozito</th>
                            <th>KDV (%20)</th>
                            <th>Toplam Ödeme</th>
                            <th>Belgeler</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php

include '../../footer.php';