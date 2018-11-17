    <link rel="stylesheet" href="<?php echo base_url()?>Asset/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("Asset/")?>semanticUI/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url("Asset/")?>js/vue.js"></script>
    <script src="<?php echo base_url("Asset/")?>semanticUI/semantic.min.js"></script>

<span id="menu">
    <div class="ui container secondary pointing menu">
        <a href="index.php">
            <img src="<?php echo base_url()?>Asset/image/logoSportest.png" alt="logo" id="logo">
        </a>
        <div class="right menu">
            <div class="ui active item">
                <a href="<?php echo base_url("")?>"><i class="home icon"></i>Home</a>
            </div>
            <div class="ui pointing dropdown link item">
                <span class="text">Kategori</span>
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a href="<?php echo base_url();?>Kategori/Running">  <div class="item">Running</div></a>
                     <a href="<?php echo base_url();?>Kategori/Baseball"> <div class="item">Baseball</div></a>
                     <a href="<?php echo base_url();?>Kategori/Ranang"> <div class="item">Renang</div></a>
                     <a href="<?php echo base_url();?>Kategori/Badminton"> <div class="item">Badminton</div></a>
                     <a href="<?php echo base_url();?>Kategori/Basket"> <div class="item">Basket</div></a>
                     <a href="<?php echo base_url();?>Kategori/Futsal"> <div class="item">Futsal</div></a>
                </div>
            </div>
            <div class = "ui item"v-if="isLogin">
                <a href="<?php echo base_url("api/user/post") ?>">Post</a>
            </div>
            <div class="ui item" v-if="!isLogin">
                    <a href="<?php echo base_url("login") ?>">Login</a>
            </div>
              <div class = "ui item" v-if="isLogin">
                         <a href="#" v-on:click="logout">Logout</a>
            </div>
        </div>
    </div>
</span>
<script>
 

        var app = new Vue({
        el: '#menu',
        data: {
            isLogin: false,
            page : window.location.pathname
        },
        methods : {
            logout : function(event){
                $.ajax({    //create an ajax request to display.php
                type: "GET",
                dataType: "json", 
                url: "<?php echo base_url("logout")?>",             
                success: function(response){
                    if(response.hasil=="fail"){
                        app.isLogin = false;
                       location.replace("<?php echo base_url();?>");
                    }else{
                        app.isLogin = true;
                    }
                }

            });
            }
        }
        })

    $(document).ready(function() {
           $('.ui.pointing.dropdown.link.item').dropdown({
            action: 'select'
        });
        $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "<?php echo base_url("cUser/isLogin")?>",             
        dataType: "json",   //expect html to be returned                
        success: function(response){
            if(window.location.pathname=="/Spoertest/")  {
                
            }                  
            if(response.hasil=="fail"){
                app.isLogin = false;
            }else{
                app.isLogin = true;
            }
            
        }

    });
    });
</script>