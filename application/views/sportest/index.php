<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <!-- vue js -->

    <!-- semantic -->
    <link rel="stylesheet" href="<?php echo base_url()?>Asset/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>Asset/semanticUI/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url()?>Asset/js/vue.js"></script>
    <script src="<?php echo base_url()?>Asset/semanticUI/semantic.min.js"></script>
    <!-- <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet" type="text/css"></link> -->
    <!-- <script src="https://unpkg.com/vue/dist/vue.js"></script> -->
    <!-- <script src="https://unpkg.com/vuetify/dist/vuetify.js"></script> -->
    <title>Sportest - Home</title>
</head>

<body>
    <?php include 'menu.php';?>
    <!-- Otomatis -->
    <span id="lomba">
        <div class="ui container divided items">
                <div class="item" v-for="data in lomba">
                        <div class="ui medium image">
                        <img v-bind:src="data.gambar">
                        </div>
                <div class="content">
                        <a class="header">{{data.judul}}</a>
                        <div class="description">
                            <p class="pDescription" v-html="data.post"></p>
                        </div>
                        <br>
                        <button type="button" class="ui tiny primary button" v-on:click="link(data.idPost)">Read More</button>
                    </div>
                </div>
    
        </div> 
    </span>
    <!-- Otomatis ENd-->

</body>
<script>
    var loli = new Vue({
        el: "#lomba",
        data: {
            lomba: <?php echo $hasil?>,
        },
        created() {
            this.lomba.reverse()
        },
        methods: {
            link: function(id) {
                window.open("<?php echo base_url()?>/post/" + id, "_self");
            }
        }
    });
</script>


</html>