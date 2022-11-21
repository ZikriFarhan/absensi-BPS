<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light bg-gradient-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <!-- <script>
          ################## JQuery (use API) #################   
          $(document).ready(function(){
          function getdate(){
                var today = new Date();
                var h = today.getHours();
                var m = today.getMinutes();
                var s = today.getSeconds();
                  if(s<10){
                    s = "0"+s;
                 }
                  if (m < 10) {
                m = "0" + m;
                }
            $("h1").text(h+" : "+m+" : "+s);
             setTimeout(function(){getdate()}, 500);
            }

        $("button").click(getdate);
    });

################## HTML ###################
<button>start clock</button>
<h1></h1>
        </script> -->
            <a class="nav-link" href="#" role="button">
                <i class="fas fa-calendar-alt"></i> <?php echo format_indo(date('Y-m-d')); ?>
                <span> <?php echo date('h:i A'); ?></span>
            </a>
           
        </li>
    </ul>
  </nav>
  <!-- /.sidebar-left -->

  