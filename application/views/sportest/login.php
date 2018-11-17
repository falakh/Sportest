<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url("/Asset/")?>style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("/Asset/")?>semanticUI/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url("/Asset/")?>semanticUI/semantic.min.js"></script>
    <title>Sportest - Login</title>
</head>

<body>
    <!-- Menu Bar -->
    <?php include 'menu.php';?>
    <!-- Login Form -->
    <div class="ui four column centered grid">
        <div class="column">
            <div class="ui container">
                <div class="ui equal width form">
                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" type="text" name="email" placeholder="Email">
                    </div>
                    <div class="field">
                        <label  for="password">Password</label>
                        <input id="password"type="password" name="password" placeholder="Password">
                    </div>
                    <center><button id="login" type="button" class="ui primary button">Login</button>
                        <br><br>Belum memiliki akun? <a href="<?php echo base_url("cRegister/register") ?>">Sign up</a></center>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $('.ui.pointing.dropdown.link.item')
        .dropdown({
            action: 'select'
        });

    $("#login").click(function() {
        $.post("<?php echo base_url("/api/login")?>", {
                userName: document.getElementById("email").value,
                password: document.getElementById("password").value
            },
            function(data, status) {
                console.log(data);
               var result = JSON.parse(data);
               if(result.status=="sukses"){
                   alert("login berhasil")
                    window.location.replace("<?php echo base_url()?>")
               }else{
                   alert("login gagal")
               }
            });
    });
</script>

</html>