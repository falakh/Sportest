<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url("/Asset/")?>style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("/Asset/")?>semanticUI/semantic.min.css">
    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>
    <script src="<?php echo base_url("/Asset/")?>semanticUI/semantic.min.js"></script>
    <title>Sportest - Sign Up</title>
  </head>
  <body>
    <!-- Menu Bar -->
     <?php include 'menu.php';?>
        
    <!-- Sign Up Form -->
    <div class="ui four column centered grid" >
      <div class="column">
        <div class="ui container">
          <div class="ui equal width form" id="loginForm">
            <div class="field">
              <label for="nama">Nama</label>
              <input type="text" name="userName" placeholder="Nama" v-model="nama">
            </div>
            <div class="field">
              <label for="email">Email</label>
              <input type="text" name="email" placeholder="Email"v-model="email">
            </div>
            <div class="field">
              <label for="password">Password</label>
              <input type="password" name="password" placeholder="Password" v-model="password">
            </div>
            <center><button type="button" class="ui primary button" v-on:click="register">Sign Up</button>
            <br><br>Sudah memiliki akun? <a href="login.php">Login</a></center></center>
          </div>
        </div>
      </div>
  </body>
  <script>
    $('.ui.pointing.dropdown.link.item')
      .dropdown({
        action: 'select'
      });
    new Vue({
      el: "#loginForm",
      data:{
        email:"",
        password:"",
        nama:""
      },methods:{
        register: function(){
          $.post("<?php echo base_url();?>api/register",
          {
              userName:this.nama,
              email:this.email,
              password:this.password
          },function(data,status){
            alert("Register sukses")
            console.log(data);
          }
        )
        }
      }
    })

  </script>
</html>
