<?php

include '../../header.php';

?>
<div class="main">
    <div class="mainLeft">
        <?php include '../../menu.php'; ?>
    </div>
    <div class="mainCenter">
        <div class="mainCenterBackground">
            <div class="mainBarTitle">Araçlar</div>
            <div class="customTable">
                <table id="cars" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Araba Bilgisi</th>
                            <th>Model</th>
                            <th>Yakıt Tipi</th>
                            <th>Vites</th>
                            <th>Renk</th>
                            <th>Günlük Ücret</th>
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