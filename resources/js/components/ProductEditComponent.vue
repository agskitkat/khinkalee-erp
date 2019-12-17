<template>
    <div class="edit-product-form">
        <div class="modal fade" v-bind:id="id" tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductEditComponent",
        mounted() {
            console.log('Component mounted.')
        },
        data:()=>{
            return {
                id: "editProduct"
            }
        },
        methods: {
            saveProduct: () => {
                axios.post('/user', {
                    firstName: '1',
                    lastName: 'Flintstone'
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            closeModal: () => {
                $('#'.this.id).modal('hide');
            }
        }
    }
</script>

<style scoped>

</style>
