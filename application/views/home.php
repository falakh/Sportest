<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selamat datang di soprtTest</title>
    <script src="<?= base_url('/Asset/js/Vue.js')?>"> 
    </script>
    <script src="<?= base_url('/Asset/js/Vue_route.js')?>"></script>

</head>
<body>
    <div id="app">
    <p>
       <router-link to="/user/10/zul">10</router-link>
    <router-link to="/user/11/zul">11</router-link>
    </p> 
    <router-view></router-view>
    </div>

    <script>

        const body = {
            props: ['id','name'],
            template: '<div> your id is {{id}} and name {{name}}</div>'
        }
         const router = new VueRouter({
            routes: [
                {path:'/user/:id/:name',component : body,props:true},
            ]
        })
        const app = new Vue({
            router
            computed : {
            updated() {
                console.log("i crated")
  
                } ,
            }
        }).$mount('#app')
    </script>
</body>
</html>