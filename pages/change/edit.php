<?php

include '../../header.php';

?>
<div class="main">
    <div class="mainLeft">
        <?php include '../../menu.php'; ?>
    </div>
    <div class="mainCenter">
        <div class="mainCenterBackground">
            <?php

            if ( isset($_POST['password']) && $_POST['password'] ) {

                $ID = $_GET['id'];

                $data = array(
                    "password" => md5( $_POST['password'] ),
                );

                $update = updateData( 'user', $data, "id={$ID}" );

                if ( $update ) {

                    echo '<div class="alert alert-success">Başarılı</div>';

                    session_start();
                    session_destroy();
                    header( "location:{$root}/login" );
                    exit();

                }
            }

            ?>
            <div class="mainBarTitle">Yeni Şifre Oluştur</div>
            <div class="customForm">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row row-5-gutter">
                        <div class="col-md-12">
                            <div class="customFormItem">
                                <div class="customFormItemLabel">New Password</div>
                                <input type="text" name="password">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="customFormSubmit">
                                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
                                <button type="submit"><i class="fa-regular fa-hourglass"></i> Şifreyi Değiştir</button>
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