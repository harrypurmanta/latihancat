<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Latihan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
 
</head>
<body class="hold-transition layout-top-nav">

  <div class="wrapper">
  <div id="bgamerika" style="background-image: url(images/bg/home.jpg);background-size: cover;height: 100%;left: 0;top: 0;background-position: center center !important;z-index: 1;width: 100%;background-repeat: no-repeat;">
  <!-- Navbar -->
  <?= $this->include('front/navbar') ?>


  <!-- Content Wrapper. Contains page content -->
  <div id="contentwrapper" class="content-wrapper" style="background-color: #00000052;">

    <!-- Main content -->
    <div class="content" style="padding-top: 30px;">
      <div class="container" style="padding:0px;min-width: 90%;">
        <div class="row">
          <div class="col-lg-12">
            <div id="card" class="card" style="background-color: #00000052;">
              <div class="card-body">
              <span id="countdown" style='float:right;font-size:40px;color:#000000;'></span>
                <div id="cardbody"><!-- END ID CARDBODY -->
                <div class="row" style="min-height:400px;">
                <div class="col-lg-12" style="text-align:center;">
                <h1 style="margin:10px;text-decoration:underline;font-weight:bold;color:#ffffff;"> LATIHAN </h1>
                </div>
                <div class="col-lg-12 row" style="text-align:center;" id="dv_content">
                
                  <?php
                  $this->session = \Config\Services::session();
                      foreach ($materiSK as $key) {
                        $used = 0;
                        $materi_id = $key->materi_id;
                        $user_id = $this->session->user_id;
                        $db = db_connect();
                        $query = $db->query("SELECT * FROM respon WHERE materi = $materi_id AND created_user_id = $user_id")->getResultArray();

                        if (count($query)>0) {
                          $used = $query[0]['used'] + 1;
                        } else {
                          $used = $used + 1;
                        }
                        
                        $stylebox = "width:100%;text-align:center;border:2px solid black;line-height: 100px;margin:10px;border-radius:5px;cursor:pointer;font-size: 20px;font-weight: bold;";
                        $click = "onclick=\"showsk_grp()\"";
                        
                  ?>
                    <div class="col-lg-3" style="cursor:pointer;display:inline-block;width:120px;height:120px;margin-left:10px;margin-right:10px;margin-top:30px;text-align:center;">
                      <div <?= $click ?> id="materi_<?= $key->materi_id ?>"><img style='heigth:200px;width:150px;' src="images/bg/materi.png"></div>
                      <label style="color:#ffffff;font-size:20px;"><?= $key->materi_nm ?></label>
                    </div>
                  <?php
                      }
                  ?>
                

                    <div class="col-lg-3" style="cursor:pointer;margin-top:30px;text-align:center;">
                          <div onclick='latihanmateri()' id="materi_"><img style='heigth:200px;width:150px;' src="images/bg/materi.png"></div>
                          <label style="color:#ffffff;font-size:20px;">Materi</label>
                    </div>
                
                    <div class="col-lg-3" style="cursor:pointer;margin-top:30px;text-align:center;">
                          <div onclick='latihanpetunjuk()' id="materi_"><img style='heigth:200px;width:150px;' src="images/bg/materi.png"></div>
                          <label style="color:#ffffff;font-size:20px;">Petunjuk</label>
                    </div>
                </div>
                </div><!-- END ID row -->
                </div><!-- END ID CARDBODY -->
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <div class="d-none" id='loader-wrapper'>
        <div class="loader">Mohon menunggu</div>
      </div>
  <!-- Main Footer -->
</div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/plugins/chart.js/Chart.min.js"></script>
<script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
<script>
  var timers;
  var bgamerika = $("#bgamerika");
  var navbar = $("#navbar");
  var contentwrapper = $("#contentwrapper");
  var card = $("#card");

  function latihanmateri() {
    $.ajax({
            url: "<?= base_url('latihan/latihanmateri') ?>",
            type: "post",
            success: function(data) {
                // console.log(data);
                $("#dv_content").html(data);
            },
            error: function() {
                alert("error ajax");
            }
        });
  }

  function latihansubmateri() {
    $.ajax({
            url: "<?= base_url('latihan/latihansubmateri') ?>",
            type: "post",
            success: function(data) {
                // console.log(data);
                $("#dv_content").html(data);
            },
            error: function() {
                alert("error ajax");
            }
        });
  }

  function latihanpetunjuk() {
    bgamerika.removeAttr("style");
    navbar.css("background-color", "#344e41");
    contentwrapper.css("background-color", "#588157");
    card.css("background-color", "#dad7cd");
    $.ajax({
            url: "<?= base_url('latihan/latihanpetunjuk') ?>",
            type: "post",
            dataType: "json",
            
            success: function(data) {
                // console.log(data);
                $("#cardbody").html(data);
            },
            error: function() {
                alert("error ajax");
            }
        });
  }

  function showresult(jenis_id) {
    bgamerika.removeAttr("style");
    navbar.css("background-color", "#344e41");
    contentwrapper.css("background-color", "#588157");
    card.css("background-color", "#dad7cd");
    $("#bgamerika").removeAttr("style");
    $("#countdown").text("");
    $.ajax({
            url: "<?= base_url('latihan/showresult') ?>",
            type: "post",
            dataType: "json",
            data: {
                "jenis_id": jenis_id
            },
            success: function(data) {
                // console.log(data);
                $("#cardbody").html(data.html);
            },
            error: function() {
                alert("error ajax");
            }
        });
  }

  function showsk_grp() {
    $.ajax({
      url: "<?= base_url('latihan/showsk_grp') ?>",
      type: "post",
      dataType: "json",
      success: function(data) {
        $("#cardbody").html(data);
      },
      error: function() {
          alert("error ajax");
      }
    });
  }

  function petunjuksoalsk(class_soal,kolom_id,used,sk_group_id) {
    bgamerika.removeAttr("style");
    navbar.css("background-color", "#344e41");
    contentwrapper.css("background-color", "#588157");
    card.css("background-color", "#dad7cd");
    
    $.ajax({
            url: "<?= base_url('sikapkerja/petunjuksoal') ?>",
            type: "post",
            dataType: "json",
            data: {
                "class_soal" : class_soal,
                "sk_group_id" : sk_group_id
            },
            success: function(data) {
                // console.log(data);
                $("#cardbody").html(data);
            },
            error: function() {
                alert("error ajax");
            }
        });
  }

  function countdownsk(detik,text,kolom_id,used) {
      var secondss=detik;
      timers = window.setInterval(function() { 
            myFunction();
          }, 1000); // every second

     function myFunction() {
        secondss--;
        $("#countdown").text(convertSeconds(secondss));
        if (secondss === 0) {
          if (text == "rehatsk") {
            window.clearInterval(timers);
            startujiansk("start",1,kolom_id+1,used);
          } else {
            window.clearInterval(timers);
            startujiansk("rehatsk",1,kolom_id,used);
          }
            
        } else {
            //Do nothing
        }
      }
  }

  function startujiansk(class_soal,no_soal,kolom_id,used,jawaban_id,pilihan_nm) {
    bgamerika.removeAttr("style");
    navbar.css("background-color", "#344e41");
    contentwrapper.css("background-color", "#588157");
    card.css("background-color", "#dad7cd");
    var soal_id = $("#soal_id").val();
    if (class_soal == "start" || class_soal == "petunjuk") {
        no_soal = no_soal;
        countdownsk(60,class_soal,kolom_id,used)
    } else if (class_soal == "nextsoal") {
      no_soal = no_soal + 1;
    } 
      $.ajax({
              url: "<?= base_url('sikapkerja/startujian') ?>",
              type: "post",
              dataType: "json",
              data: {
                  "class_soal": class_soal,
                  "no_soal": no_soal,
                  "jawaban_id": jawaban_id,
                  "pilihan_nm": pilihan_nm,
                  "kolom_id": kolom_id,
                  "used": used,
                  'soal_id' : soal_id
              },
              success: function(data) {
                if (data == "jawabankosong") {
                    alert("Jawaban belum dipilih");
                } else {
                    if (data.class_soal == "finish") {
                      window.clearInterval(timers);
                      $("#countdown").text("");
                    } else if (data.class_soal == "rehatsk") {
                      window.clearInterval(timers);
                      countdownsk(3,"rehatsk",kolom_id,used);
                    }

                    $("#cardbody").html(data.html);
                }
                
              },
              error: function() {
                  alert("Error system");
              }
          });
    
  }

  function petunjuksoal(jenis_id) {
    bgamerika.removeAttr("style");
    navbar.css("background-color", "#344e41");
    contentwrapper.css("background-color", "#588157");
    card.css("background-color", "#dad7cd");
    $.ajax({
            url: "<?= base_url('latihan/petunjuksoal') ?>",
            type: "post",
            dataType: "json",
            data: {
                "jenis_id": jenis_id

            },
            success: function(data) {
                // console.log(data);
                $("#cardbody").html(data);
            },
            error: function() {
                alert("error ajax");
            }
        });
  }


  function startlatihan(class_soal,materi,no_soal,jenis_id,jawaban_id,pilihan_nm) {
    bgamerika.removeAttr("style");
    navbar.css("background-color", "#344e41");
    contentwrapper.css("background-color", "#588157");
    card.css("background-color", "#dad7cd");
    var soal_id = $("#soal_id").val();
    if (class_soal == "nextsoal") {
        no_soal = no_soal + 1;
        if (jawaban_id == "radio") {
          jawaban_id = $("input[type='radio'][name='jawaban']:checked").val();
          pilihan_nm = $("input[type='radio'][name='jawaban']:checked").data("pilihan");
        } else {
          jawaban_id = jawaban_id;
          pilihan_nm = pilihan_nm;
        }
    } 
    
      $.ajax({
              url: "<?= base_url('latihan/startlatihan') ?>",
              type: "post",
              dataType: "json",
              data: {
                  "class_soal" : class_soal,
                  "materi" : materi,
                  "no_soal" : no_soal,
                  "jenis_id" : jenis_id,
                  "jawaban_id" : jawaban_id,
                  "pilihan_nm" : pilihan_nm,
                  "soal_id" : soal_id
              },
              beforeSend: function() {
                $("#loader-wrapper").removeClass("d-none");
              },
              success: function(data) {
                $("#loader-wrapper").addClass("d-none");
                if (data == "jawabankosong") {
                  alert("Jawaban belum dipilih");
                } else if (data.html == "belumadasoal") {
                  alert("Tidak ada soal");
                } else if (data.html == "finish") {
                  $("#loader-wrapper").removeClass("d-none");
                  setTimeout(showresult(jenis_id), 3000);
                } else {
                  if (class_soal == "start") {
                      window.clearInterval(timers);
                      countdown(1200,"Passhand",materi,jenis_id);
                  }
                  $("#cardbody").html(data.html);
                    if (data.class_soal == "finish") {
                      window.clearInterval(timers);
                      $("#countdown").text("");
                    }
                }
              },
              error: function() {
                  alert("Error system");
              }
          });
    
  }

  function petunjuksoalmateri(class_soal,materi,used) {
    bgamerika.removeAttr("style");
    navbar.css("background-color", "#344e41");
    contentwrapper.css("background-color", "#588157");
    card.css("background-color", "#dad7cd");
    $.ajax({
            url: "<?= base_url('latihan/petunjuksoalmateri') ?>",
            type: "post",
            dataType: "json",
            data: {
                "class_soal": class_soal,
                "materi": materi,
                "used": used,

            },
            success: function(data) {
                // console.log(data);
                $("#cardbody").html(data);
            },
            error: function() {
                alert("error ajax");
            }
        });
  }

  function startujianlatihanmateri(class_soal,materi,no_soal,group_id,jawaban_id,pilihan_nm,kolom_id,used) {
    bgamerika.removeAttr("style");
    navbar.css("background-color", "#344e41");
    contentwrapper.css("background-color", "#588157");
    card.css("background-color", "#dad7cd");
    var soal_id = $("#soal_id").val();
    if (class_soal == "nextsoal") {
        no_soal = no_soal + 1;
        if (jawaban_id == "radio") {
          jawaban_id = $("input[type='radio'][name='jawaban']:checked").val();
          pilihan_nm = $("input[type='radio'][name='jawaban']:checked").data("pilihan");
        } else {
          jawaban_id = jawaban_id;
          pilihan_nm = pilihan_nm;
        }
        if (group_id == 4) {
          class_soal = "Sikap Kerja";
        } else {
          class_soal = class_soal;
        }
        
    } else if (class_soal == "prevsoal") {
        no_soal = no_soal;
    }

      $.ajax({
              url: "<?= base_url('latihan/startujianlatihanmateri') ?>",
              type: "post",
              dataType: "json",
              data: {
                  "class_soal" : class_soal,
                  "materi" : materi,
                  "no_soal" : no_soal,
                  "group_id" : group_id,
                  "jawaban_id" : jawaban_id,
                  "pilihan_nm" : pilihan_nm,
                  "kolom_id" : kolom_id,
                  "used" : used,
                  "soal_id" : soal_id
              },
              beforeSend: function() {
                $("#loader-wrapper").removeClass("d-none")
              },
              success: function(data) {
                $("#loader-wrapper").addClass("d-none");
                if (data == "jawabankosong") {
                  alert("Jawaban belum dipilih");
                } else {
                  if (data.group_id == 1 && data.no_soal == 1 && class_soal == "petunjukpasshand") {
                    window.clearInterval(timers);
                    countdown(2700,"Passhand",materi,group_id,used);
                  } else if (data.group_id == 2 && data.no_soal == 1 && class_soal == "petunjukkecerdasan") {
                    window.clearInterval(timers);
                    countdown(2700,"Kecerdasan",materi,group_id,used);
                  } else if (data.group_id == 3 && data.no_soal == 1 && class_soal == "petunjukkepribadian") {
                    window.clearInterval(timers);
                    countdown(2700,"Kepribadian",materi,group_id,used);
                  } else if (data.group_id == 4 && data.no_soal == 1 && class_soal == "petunjuksikapkerja") {
                    window.clearInterval(timers);
                    countdown(60,"Sikap Kerja",materi,group_id,kolom_id);
                  } else if (data.group_id == 4 && data.no_soal == 1 && class_soal == "Sikap Kerja") {
                    window.clearInterval(timers);
                    countdown(60,"Sikap Kerja",materi,group_id,kolom_id);
                  } else if (data.class_soal == "rehatsk") {
                    window.clearInterval(timers);
                    countdown(4,"rehatsk",materi,group_id,kolom_id);
                  } else if (data.class_soal == "petunjuksoal") {
                    $("#countdown").text("");
                    window.clearInterval(timers);
                  } 

                  $("#navbar").empty();
                  $("#cardbody").html(data.html);
                    
                    if (data.class_soal == "finish") {
                      window.clearInterval(timers);
                      $("#countdown").text("");
                    }
                }
              },
              error: function() {
                  alert("Error system");
              }
          });
    
  }
  
  function convertSeconds(s){
    var min = Math.floor(s / 60);
    var sec = s % 60;
    return min + ":" + sec;
  }


  function countdown(detik,text,materi,group_id,used) {
      var secondss=detik;
      timers = window.setInterval(function() { 
            myFunction();
          }, 1000); // every second

     function myFunction() {
        secondss--;
        $("#countdown").text(convertSeconds(secondss));
        if (secondss === 0) {
            window.clearInterval(timers);
            console.log(group_id);
            if (group_id == 2) {
              petunjuksoalmateri("petunjukkepribadian",3,used);
            } else if (text == "Kepribadian") {
              startujianlatihanmateri("finish",materi,1,2,null,null,null,null)
            }
        } else {
            //Do nothing
        }

      }
  }

  
</script>
</body>
</html>