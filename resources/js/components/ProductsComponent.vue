<template>
    <div class="page" id="products">
        <h1>Продукты</h1>
        <button class="btn btn-primary" @click="">Добавить продукт</button>
        <button class="btn btn-primary">Добавить группу</button>
        <div class="table-responsive mt-3">
            <h3>МЯСО</h3>
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Связано</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Баранья мякоть</td>
                    <td></td>
                    <td>изменить</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Говяжий жир</td>
                    <td><b>Альбатрос</b> Говяжий жир 944 руб./шт.</td>
                    <td>изменить</td>
                </tr>
                </tbody>
            </table>
            <h3>ПТИЦА</h3>
            <h3>РЫБА И МОРЕПРОДУКТЫ</h3>
        </div>
        <EditProduct :id="idEdit"></EditProduct>
    </div>
</template>

<script>
    import ProductEditComponent from "./ProductEditComponent";
    export default {
        components: {
            EditProduct: ProductEditComponent
        },
        data:()=>{
            return {
                idEdit: "editProduct"
            }
        },
        methods: {
            calEditModal: () => {
                $('#'.this.idEdit).modal('show');
            }
        },
        name: "ProductsComponent",
    }
</script>

<style scoped>

</style>
