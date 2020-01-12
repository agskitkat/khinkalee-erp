<template>
    <div class="inputTable">
        <h3>Список продуктов в заказе</h3>
        <input
            type="text"
            class="form-control"
            placeholder="Найти продукт"
            v-model="searchString"
            @input="search">
        <br>
        <select class="form-control" :name="name" size="5" >
            <option v-for="option in options" :value="option.id">{{option.name}}</option>
        </select>
        <br>
        <div class="form-group row">
            <div class="col-6">
                <div class="btn btn-light">Добавить товар</div>
            </div>
            <div class="col-6">
                <in>
            </div>
        </div>
        <br>
        <table class="table">
            <tr>
                <th>Продукт</th>
                <th>Количество кг.</th>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data: ()=> {
            return {
                searchString: "",
                options: [],
                selected: 0
            }
        },
        props: ['csrf', "url", "placeholder", "type", "name", "value", 'valuename'],
        methods: {
            search: function() {
                if(this.searchString.length > 2) {
                    axios.post(this.url, {
                        _token: this.csrf,
                        string: this.searchString
                    })
                        .then( (response) => {
                            this.options = response.data;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            }
        }
    }
</script>

<style scoped>
    .inputTable {
        padding-bottom: 30px;
    }
</style>
