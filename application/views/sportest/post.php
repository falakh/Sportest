<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url()?>/Asset/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>Asset/semanticUI/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url()?>Asset/semanticUI/semantic.min.js"></script>
    <title>The Indonesian National Armed Forces International Marathon 2018</title>
</head>

<body>
    <!-- Menu Bar -->
    <?php include "menu.php"?>
    <!-- Post -->
    <div class="ui container" id="post">
        <img class="ui centered large image" v-bind:src=gambar>
        <div class="ui container">
            <p class="pDescription">{{post}} </p>
        </div>
    </div>
    <!-- copy link -->
    <div class="ui container" id="copylink">
        <div class="ui equal width form">
            <h3 class="ui centered dividing header">Share</h3>
            <div class="inline field">
                <input type="text" name="link" v-bind:value="link" disabled style="width: 75%" id="link">
                <div class="ui blue labeled submit icon button" v-on:click="copy">
                    <i class="share square icon"></i> Copy Link
                </div>
            </div>
        </div>
    </div>
    <!-- Comment -->
    <div class="ui container" style="margin: 0 auto">
        <div class="ui segment" id="komentar">
            <div class="ui threaded comments" style="margin: 0 auto">
                <h3 class="ui centered dividing header">Komentar</h3>

                <div class="comment" v-for="data in listkomentar" :key="data.idKomentar">
                    <a class=" avatar ">
                        <img src="<?php echo base_url()?>Asset/image/boy.png">
                    </a>
                    <div class="content centered">
                        <a class="author">{{data.nama}}</a>
                        <div class="metadata">
                            <span class="date">{{data.waktu}}</span>
                        </div>
                        <div class="text">
                            {{data.komentar}}
                        </div>
                    </div>
                </div>
                <form class="ui reply form">
                    <div class="field">
                        <textarea v-model="komentaruser">
                            </textarea>
                    </div>
                    <div class="ui blue labeled submit icon button" v-on:click="sendKomentar">
                        <i class="icon edit"></i> Tambahkan Komentar
                    </div>
                </form>

                <!-- end komentar -->
            </div>

        </div>
    </div>
</body>
<script>
    $('.ui.pointing.dropdown.link.item')
        .dropdown({
            action: 'select'
        });

    var post = new Vue({
        el: "#copylink",
        data: {
            link: window.location.href
        },

        methods: {
            copy: function() {

                // alert()
            },
            copy: function(str) {
                // Create new element
                var el = document.createElement('textarea');
                // Set value (string to be copied)
                el.value = this.link;
                // Set non-editable to avoid focus and move outside of view
                el.setAttribute('readonly', '');
                el.style = {
                    position: 'absolute',
                    left: '-9999px'
                };
                document.body.appendChild(el);
                // Select text inside element
                el.select();
                // Copy text to clipboard
                document.execCommand('copy');
                // Remove temporary element
                document.body.removeChild(el);
            }
        }
    });

    var post = new Vue({
        el: "#post",
        data: {
            judul: JSON.parse('<?php echo $hasil?>').hasil[0].judul,
            post: JSON.parse('<?php echo $hasil?>').hasil[0].judul,
            gambar: JSON.parse('<?php echo $hasil?>').hasil[0].gambar
        },
        methods: {

        }
    });

    var komentar = new Vue({
        el: "#komentar",
        data: {
            komentaruser: null,
            listkomentar: JSON.parse('<?php echo $hasil?>').komentar,
        },
        methods: {
            sendKomentar: function() {
                console.log(this.komentaruser);
                if (this.komentaruser) {

                    $.post("<?php echo base_url()?>addKomentar", {
                            id: JSON.parse('<?php echo $hasil?>').id,
                            komentar: this.komentaruser
                        },
                        function(result, status) {
                            var sebelum = komentar.listkomentar.length
                            console.log(sebelum)
                            var parse = JSON.parse(result);
                            console.log(parse);
                            var after = parse.data.length
                            console.log(komentar.listkomentar);
                            // console.log
                            for (let index = 0; index < after; index++) {
                                komentar.listkomentar.push({
                                    nama: parse.data[sebelum + index].nama,
                                    waktu: parse.data[sebelum + index].waktu,
                                    komentar: parse.data[sebelum + index].komentar
                                })
                            }

                            // listkomentar = parse.data;
                        });
                } else {
                    alert("komentar masih kosong")
                }

            },
        },
        computed: {

        }
    });
</script>


</html>;