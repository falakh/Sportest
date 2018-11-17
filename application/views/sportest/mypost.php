<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->


    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet" type="text/css">
    </link>

    <title>Document</title>
</head>

<body>
    <?php include 'menu.php'?>
    <div id=""></div>


    <div id="app">
        <v-app id="inspire">
            <div>
                <v-toolbar flat color="white">
                    <v-toolbar-title>My Post</v-toolbar-title>
                    <v-divider class="mx-2" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="1000px">
                        <v-btn slot="activator" color="primary" dark class="mb-2">New Post</v-btn>
                        <v-card>
                            <v-card-title>
                                <span class="headline">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-layout v-bind="binding">
                                        <v-flex xs12 sm6 md4>
                                            <v-text-field v-model="editedItem.judul" label="Judul"></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md4>
                                            <v-text-field v-model="editedItem.kategori" label="Kategori"></v-text-field>
                                        </v-flex>

                                        <v-flex xs12 sm6 md4>
                                            <v-label></v-label>
                                            <ckeditor :editor="editor" v-model="editedItem.post" :config="editorConfig"></ckeditor>
                                        </v-flex>
                                        <!-- upload image -->
                                        <form enctype="multipart/form-data" id="upload">
                                            <v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">
                                                <img :src="editedItem.gambar" height="150" v-if="imageUrl" />
                                                <v-text-field label="Select Image" @click='pickFile' v-model='imageName' prepend-icon='attach_file'></v-text-field>
                                                <input type="file" style="display: none" ref="image" accept="image/*" @change="onFilePicked" name="gambar" id="gambar">
                                            </v-flex>
                                        </form>

                                        <!-- image pick dialog -->

                                    </v-layout>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
                                <v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
                <v-data-table :headers="headers" :items="desserts" class="elevation-1">
                    <template slot="items" slot-scope="props">
                    <td>{{ props.item.idPost }}</td>
                    <td class="text-xs-left">{{ props.item.judul }}</td>
                    <td class="text-xs-left">{{ props.item.kategori }}</td>
                    <td class="text-xs-left "><span  v-html=props.item.post></span></td>
                    <td class="text-xs-left"><a v-bind:href=props.item.gambar>{{props.item.gambar}} </a></td>
                    <td class="justify-center layout px-0">
                        <v-icon small class="mr-2" @click="editItem(props.item)">
                            edit
                        </v-icon>
                       
                    </td>
                </template>

                </v-data-table>
            </div>
        </v-app>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
    <script src="<?php echo base_url()?>node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <script src="<?php echo base_url()?>node_modules/@ckeditor/ckeditor5-vue/dist/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
    <script>
        Vue.use(CKEditor);

        var dataTable = new Vue({
            el: '#app',
            data: () => ({
                // untuk gambar
                dialog: false,
                imageName: '',
                imageUrl: '',
                imageFile: '',
                //end gambar

                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                },
                dialog: false,
                headers: [{
                    text: 'id',
                    align: 'left',
                    sortable: false,
                    value: 'idPost'
                }, {
                    text: 'Judul',
                    value: 'Judul'
                }, {
                    text: 'Kategori',
                    value: 'Kategori'
                }, {
                    text: 'Post',
                    value: 'Post'
                }, {
                    text: 'Image',
                    value: 'Image'
                }, {
                    text: 'Actions',
                    value: 'name',
                    sortable: false
                }],
                desserts: <?php echo $data ?>,
                editedIndex: -1,
                editedItem: {
                    name: '',
                    calories: 0,
                    fat: 0,
                    carbs: 0,
                    protein: 0
                },
                defaultItem: {
                    name: '',
                    calories: 0,
                    fat: 0,
                    carbs: 0,
                    protein: 0
                }
            }),

            computed: {
                formTitle() {
                    return this.editedIndex === -1 ? 'New Post' : 'Edit Post'
                },
                binding() {
                    const binding = {}
                    if (this.$vuetify.breakpoint.mdAndUp) binding.column = true
                    return binding
                }

            },

            watch: {
                dialog(val) {
                    val || this.close()
                }
            },


            methods: {
                // upload image
                pickFile() {
                    this.$refs.image.click()
                },

                onFilePicked(e) {
                    const files = e.target.files
                    if (files[0] !== undefined) {
                        this.imageName = files[0].name
                        if (this.imageName.lastIndexOf('.') <= 0) {
                            return
                        }
                        const fr = new FileReader()
                        fr.readAsDataURL(files[0])
                        fr.addEventListener('load', () => {
                            this.imageUrl = fr.result
                            this.imageFile = files[0] // this is an image file that can be sent to server...
                        })
                    } else {
                        this.imageName = ''
                        this.imageFile = ''
                        this.imageUrl = ''
                    }
                },
                //end upload

                editItem(item) {
                    this.editedIndex = this.desserts.indexOf(item)
                    this.editedItem = Object.assign({}, item)
                    this.dialog = true
                },

                deleteItem(item) {
                    const index = this.desserts.indexOf(item)
                    confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
                },

                close() {
                    this.dialog = false
                    setTimeout(() => {
                        this.editedItem = Object.assign({}, this.defaultItem)
                        this.editedIndex = -1
                    }, 300)
                },

                save() {
                    if (this.editedIndex > -1) {
                        console.log(this.editedItem)
                        Object.assign(this.desserts[this.editedIndex], this.editedItem)
                        if (this.editedItem) {
                            console.log(this.editedItem);
                            $.post("<?php echo base_url()?>api/update", {
                                id: (this.editedItem.idPost),
                                post: (this.editedItem.post)
                            }, function(data, status) {
                                alert(status);
                            });
                        }

                    } else {
                        this.desserts.push(this.editedItem)
                        let formData = new FormData();
                        formData.append("gambar", this.imageFile)
                        formData.append("isi", this.editedItem.post)
                        formData.append("kategori", this.editedItem.kategori)
                        formData.append("judul", this.editedItem.judul)
                        axios.post("<?php echo base_url()?>AddPost", formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }).then(function() {
                                this.desserts.push(this.editedItem)
                                location.reload();
                                console.log('SUCCESS!!');
                            })
                            .catch(function() {
                                console.log('FAILURE!!');
                            });


                    }
                    this.close()
                }
            }
        })
    </script>
</body>

</html>