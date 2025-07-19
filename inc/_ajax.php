<?php
$db['default']['db_debug'] = TRUE;

include '_connect.php';

# Login

if ( hash_equals( $_SESSION['token'], $_POST['token'] ) ) :

    if ( isset($_POST['process']) && $_POST['process'] == 'login' ) :

        $email    = $_POST['email'];
        $password = md5( $_POST['password'] );

        $query = "SELECT * FROM user WHERE email = :email AND password = :password";
        $stmt  = $db->prepare( $query );
        $stmt->bindParam( ':email', $email );
        $stmt->bindParam( ':password', $password );
        $stmt->execute();

        $user = $stmt->fetch( PDO::FETCH_ASSOC );

        if ( $user ) {

            $response = array(
                "status"     => "success",
                "title"      => "Success",
                "message"    => "Login successful.",
                "redirected" => $root . '/admin'
            );

            $_SESSION['user'] = $user;

            $userID = $user['id'];
            $data   = array( "last_login" => date( 'Y-m-d H:i:s' ) );
            $query  = $db->prepare( "UPDATE user SET last_login = :last_login WHERE id = {$userID}" );
            $query->execute( $data );

        } else {

            $response = array(
                "status"     => "error",
                "title"      => "Error",
                "message"    => "email or password is wrong.",
                "redirected" => $root . '/login'
            );

        }

    endif;

else :

    $response = array(
        "status"     => "error",
        "title"      => "Error",
        "message"    => "Token Error.",
        "redirected" => $root . '/login'
    );

endif;


# Cars Table

if ( hash_equals( $_SESSION['token'], $_POST['token'] ) ) :

    if ( isset($_POST['process']) && $_POST['process'] == 'cars-table' ) :

        $query = "SELECT * FROM cars WHERE 1 ";

        if ( isset($_POST["search"]["value"]) ) {
            $query .= ' AND (name LIKE "%' . $_POST["search"]["value"] . '%")';
        }

        $query .= ' ORDER BY id DESC ';

        $query1 = '';

        if ( isset($_POST["length"]) && $_POST["length"] != -1 ) {
            $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $statement = $db->prepare( $query );

        $statement->execute();

        $number_filter_row = $statement->rowCount();

        $result = $db->query( $query . $query1 );

        $data = array();

        foreach ( $result as $row ) {

            $sub_array = array();

            $sub_array[] = $row['name'];
            $sub_array[] = $row['model'];
            $sub_array[] = idbyRequest( 'fuel_type', $row['fuel'], 'name' );
            $sub_array[] = idbyRequest( 'gear_type', $row['gear'], 'name' );
            $sub_array[] = idbyRequest( 'colors', $row['color'], 'name' );
            $sub_array[] = $row['daily_fee'] . ' ₺';
            $sub_array[] = '<div class="tableActions"><a href="' . $root . '/cars/edit/' . $row['id'] . '"><i class="fa-solid fa-pen-to-square"></i></a><a class="deleteTable" data-id="' . $row['id'] . '" data-table="cars"><i class="fa-solid fa-trash"></i></a></a>';
            $data[]      = $sub_array;

        }

        function countAllData( $db ) {

            $query     = "SELECT * FROM cars";
            $statement = $db->prepare( $query );
            $statement->execute();
            return $statement->rowCount();

        }

        $response = array(
            "draw"            => intval( $_POST["draw"] ),
            "recordsTotal"    => countAllData( $db ),
            "recordsFiltered" => $number_filter_row,
            "data"            => $data,
        );

    endif;

else :

    $response = array(
        "status"  => "error",
        "title"   => "Error",
        "message" => "Token Error.",
    );

endif;

# New Car

if ( hash_equals( $_SESSION['token'], $_POST['token'] ) ) :

    if ( isset($_POST['process']) && $_POST['process'] == 'newCar' ) :

        $data = array(
            "name"         => $_POST['name'],
            "model"        => $_POST['model'],
            "gear"         => $_POST['gear'],
            "fuel"         => $_POST['fuel'],
            "color"        => $_POST['color'],
            "daily_fee"    => str_replace( ",", "", $_POST['daily_fee'] ),
            "created_date" => date( 'Y-m-d H:i:s' ),
        );

        $id = insertData( 'cars', $data );

        if ( $id ) {

            $response = array(
                "status"     => "success",
                "title"      => "Success",
                "message"    => "Araç Başarıyla Kayıt Edildi",
                "redirected" => $root . '/cars'
            );

        }

    endif;

else :

    $response = array(
        "status"  => "error",
        "title"   => "Error",
        "message" => "Token Error.",
    );

endif;

# Edit Car #

if ( hash_equals( $_SESSION['token'], $_POST['token'] ) ) :

    if ( isset($_POST['process']) && $_POST['process'] == 'editCar' ) :

        $ID = $_POST['editID'];

        $data = array(
            "name"      => $_POST['name'],
            "model"     => $_POST['model'],
            "gear"      => $_POST['gear'],
            "fuel"      => $_POST['fuel'],
            "color"     => $_POST['color'],
            "daily_fee" => str_replace( ",", "", $_POST['daily_fee'] ),
        );

        $update = updateData( 'cars', $data, "id={$ID}" );

        if ( $update ) {

            $response = array(
                "status"     => "success",
                "title"      => "Success",
                "message"    => "Araç Başarıyla Güncellendi",
                "redirected" => $root . '/cars/edit/' . $ID
            );

        }

    endif;

else :

    $response = array(
        "status"  => "error",
        "title"   => "Error",
        "message" => "Token Error.",
    );

endif;

# Invoice Table

if ( hash_equals( $_SESSION['token'], $_POST['token'] ) ) :

    if ( isset($_POST['process']) && $_POST['process'] == 'invoice-table' ) :

        $query = "SELECT * FROM invoice WHERE 1 ";

        if ( isset($_POST["search"]["value"]) ) {
            $query .= ' AND (name_surname LIKE "%' . $_POST["search"]["value"] . '%")';
        }

        $query .= ' ORDER BY id DESC ';

        $query1 = '';

        if ( isset($_POST["length"]) && $_POST["length"] != -1 ) {
            $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $statement = $db->prepare( $query );

        $statement->execute();

        $number_filter_row = $statement->rowCount();

        $result = $db->query( $query . $query1 );

        $data = array();

        foreach ( $result as $row ) {

            $baslangicTarihi = new DateTime( $row['rental_start'] );
            $bitisTarihi     = new DateTime( $row['rental_end'] );
            $day             = $baslangicTarihi->diff( $bitisTarihi )->days;

            $carName  = idbyRequest( 'cars', $row['car'], 'name' );
            $carModel = idbyRequest( 'cars', $row['car'], 'model' );
            $carGear  = idbyRequest( 'cars', $row['car'], 'gear' );
            $carFuel  = idbyRequest( 'cars', $row['car'], 'fuel' );
            $carColor = idbyRequest( 'cars', $row['car'], 'color' );

            $carFullName = $carName . ' - ' . $carModel . ' - ' . idbyRequest( 'fuel_type', $carFuel, 'name' ) . ' - ' . idbyRequest( 'gear_type', $carGear, 'name' ) . ' - ' . idbyRequest( 'colors', $carColor, 'name' );

            $sub_array = array();

            $sub_array[] = $row['name_surname'];
            $sub_array[] = $row['phone'];
            $sub_array[] = idbyRequest( 'payment_type', $row['payment_type'], 'name' );
            $sub_array[] = $carFullName;
            $sub_array[] = $row['rental_start'];
            $sub_array[] = $row['rental_end'];
            $sub_array[] = $day;
            $sub_array[] = $row['way'] . ' KM';
            $sub_array[] = $row['daily_fee'] . ' ₺';
            $sub_array[] = $row['deposit'] . ' ₺';
            $sub_array[] = number_format( ($row['daily_fee'] - ($row['daily_fee'] / 1.20)), 2, '.', '' ) . ' ₺';
            $sub_array[] = (($day * $row['daily_fee']) + ($row['deposit'])) . ' ₺';
            $sub_array[] = '<div class="tableLink"><a target="_blank" href="https://faturapanelhizmetimiz.tr/pdf/generate-proforma.php?id='.$row["id"].'">Proforma</a></div><div class="tableLink"><a target="_blank" href="https://faturapanelhizmetimiz.tr/pdf/generate-agreement.php?id='.$row["id"].'">Sözleşme</a></div>
         
            <form action="' . $root . '/f.php?id=' . $row['id']. '" method="get"><input type="hidden" name="id" value="'.$row['id'].'" /><input type="number" name="fiyat" placeholder="depozito" style="width:100px" /><input type="text" name="depo" style="width:100px" value="depozito" /><input type="submit" value="Fatura"></form>';
            $sub_array[] = '<div class="tableActions"><a href="' . $root . '/invoice/edit/' . $row['id'] . '"><i class="fa-solid fa-pen-to-square"></i></a><a class="deleteTable" data-id="' . $row['id'] . '" data-table="invoice"><i class="fa-solid fa-trash"></i></a></a>';
            $data[]      = $sub_array;

        }

        function countAllData( $db ) {

            $query     = "SELECT * FROM invoice";
            $statement = $db->prepare( $query );
            $statement->execute();
            return $statement->rowCount();

        }

        $response = array(
            "draw"            => intval( $_POST["draw"] ),
            "recordsTotal"    => countAllData( $db ),
            "recordsFiltered" => $number_filter_row,
            "data"            => $data,
        );

    endif;

else :

    $response = array(
        "status"  => "error",
        "title"   => "Error",
        "message" => "Token Error.",
    );

endif;

# New Invoice

if ( hash_equals( $_SESSION['token'], $_POST['token'] ) ) :

    if ( isset($_POST['process']) && $_POST['process'] == 'newInvoice' ) :

        $data = array(
            "name_surname" => $_POST['name_surname'],
            "phone"        => $_POST['phone'],
            "tc"           => $_POST['tc'],
            "license"      => $_POST['license'],
            "car"          => $_POST['car'],
            "rental_start" => $_POST['rental_start'],
            "rental_end"   => $_POST['rental_end'],
            "way"          => $_POST['way'],
            "payment_type" => $_POST['payment_type'],
            "address"      => $_POST['address'],
            "daily_fee"    => str_replace( ",", "", $_POST['daily_fee'] ),
            "deposit"      => str_replace( ",", "", $_POST['deposit'] ),
            "created_date" => date( 'Y-m-d H:i:s' ),
        );

        $id = insertData( 'invoice', $data );

        if ( $id ) {

            $generateProforma  = $root . '/pdf/_proforma.php?id=' . $id;
            $generateAgreement = $root . '/pdf/_agreement.php?id=' . $id;

            file_get_contents( $generateProforma );
            file_get_contents( $generateAgreement );

            $response = array(
                "status"     => "success",
                "title"      => "Success",
                "message"    => "Fatura Başarıyla Oluşturuldu",
                "redirected" => $root . '/invoice'
            );

        }

    endif;

else :

    $response = array(
        "status"  => "error",
        "title"   => "Error",
        "message" => "Token Error.",
    );

endif;


if ( hash_equals( $_SESSION['token'], $_POST['token'] ) ) :

    if ( isset($_POST['process']) && $_POST['process'] == 'selectCar' ) :

        $ID    = $_POST['id'];
        $query = $db->prepare( "SELECT * FROM cars WHERE id={$ID}" );
        $query->execute();
        $result = $query->fetch();

        $response = array(
            "daily_fee" => $result['daily_fee'],
        );

    endif;

else :

    $response = array(
        "status"  => "error",
        "title"   => "Error",
        "message" => "Token Error.",
    );

endif;

# Edit Invoice #

if ( hash_equals( $_SESSION['token'], $_POST['token'] ) ) :

    if ( isset($_POST['process']) && $_POST['process'] == 'editInvoice' ) :

        $ID = $_POST['editID'];

        $data = array(
            "name_surname" => $_POST['name_surname'],
            "phone"        => $_POST['phone'],
            "tc"           => $_POST['tc'],
            "license"      => $_POST['license'],
            "car"          => $_POST['car'],
            "rental_start" => $_POST['rental_start'],
            "rental_end"   => $_POST['rental_end'],
            "way"          => $_POST['way'],
            "payment_type" => $_POST['payment_type'],
            "address"      => $_POST['address'],
            "daily_fee"    => str_replace( ",", "", $_POST['daily_fee'] ),
            "deposit"      => str_replace( ",", "", $_POST['deposit'] ),
        );

        $update = updateData( 'invoice', $data, "id={$ID}" );

        if ( $update ) {

            $generateProforma  = $root . '/pdf/_proforma.php?id=' . $ID;
            $generateAgreement = $root . '/pdf/_agreement.php?id=' . $ID;

            file_get_contents( $generateProforma );
            file_get_contents( $generateAgreement );

            $response = array(
                "status"     => "success",
                "title"      => "Success",
                "message"    => "Fatura Başarıyla Güncellendi",
                "redirected" => $root . '/invoice/edit/' . $ID
            );

        }

    endif;

else :

    $response = array(
        "status"  => "error",
        "title"   => "Error",
        "message" => "Token Error.",
    );

endif;


# Delete Table # 

if ( hash_equals( $_SESSION['token'], $_POST['token'] ) ) :

    if ( isset($_POST['process']) && $_POST['process'] == 'deleteTable' ) :

        $id    = $_POST['id'];
        $table = $_POST['table'];

        $query = $db->prepare( "DELETE FROM $table WHERE id = :id" );

        $delete = $query->execute( array(
            'id' => $id,
        ) );

        if ( $delete ) {

            $response = array(
                "status" => "success",
                "title"  => "Success",
            );

        }

    endif;

else :

    $response = array(
        "status"  => "error",
        "title"   => "Error",
        "message" => "Token Error.",
    );

endif;

echo json_encode( $response, true );