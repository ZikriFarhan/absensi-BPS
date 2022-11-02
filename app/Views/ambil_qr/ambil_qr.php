<div class="container-fluid">
<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1 class="m-0">Ambil QR</h1>
            </div><!-- /.col -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <!-- Default box -->
                        <div class="card card-primary card-outline">
                                <div class="card-body table-responsive">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">
                                            Some quick example text to build on the card title and make up the bulk of the card's
                                            content.
                                        </p>

                                        <a href="#" class="card-link">Card link</a>
                                        <a href="#" class="card-link">Another link</a>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                        </div>
                            <!-- /.card -->
                    </div>
                    <div class="col-6">
                        <!-- Default box -->
                        <div class="card card-primary card-outline">
                                <div class="card-body table-responsive">
                                    <div class="card-body">
                                        <h5 class="card-title ml-auto mb-0">QR information <i class="fa fa-qrcode"></i></h5>
                                    </br>
                                    <?php 
                                    use Endroid\QrCode\Color\Color;
                                    use Endroid\QrCode\Encoding\Encoding;
                                    use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
                                    use Endroid\QrCode\QrCode;
                                    use Endroid\QrCode\Label\Label;
                                    use Endroid\QrCode\Logo\Logo;
                                    use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
                                    use Endroid\QrCode\Writer\PngWriter;
                                       $writer = new PngWriter();
                                        // Create QR code
                                        $qrCode = QrCode::create('BPSJateng')
                                            ->setEncoding(new Encoding('UTF-8'))
                                            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                                            ->setSize(100)
                                            ->setMargin(0, 2, 2, 2)
                                            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                                            ->setForegroundColor(new Color(0, 0, 0))
                                            ->setBackgroundColor(new Color(255, 255, 255));
                                
                                        // Create generic logo
                                        $logo = Logo::create( FCPATH .'/logo.png')
                                            ->setResizeToWidth(150);
                                
                                        // Create generic label
                                        $label = Label::create('')
                                            ->setTextColor(new Color(255, 0, 0));
                                
                                        $result = $writer->write($qrCode, null, $label);
                                        
                                        $dataUri = $result->getDataUri();
                                        // Save it to a file
                                        // $result->saveToFile( FCPATH.'/qrcode.png');
                                        echo '<img src="'.$dataUri.'" alt="Sobatcoding.com">';
                                        $result->saveToFile( FCPATH .'qr/qrcode.png'); 
                                ?>
                                        <div class="card-text ">
                                        <img src="<?= base_url(FCPATH .'qr/qrcode.png')?>" alt="">
                                       </div>
                                    </div>
                                    
                                </div>
                                <!-- /.card-body -->
                        </div>
                            <!-- /.card -->
                    </div>
                </div>
            
                <div class="row">

                </div>
            <?php
            
            ?>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
    

<!-- <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ini Home Page</h1>
          </div>
    </div> -->
<!-- </div> -->
