<template>
    <div>
        <input type="text" class="form-control" placeholder="Найти" v-model="searchString" @input="search">
        <br>
        <select class="form-control" :name="name" size="5" >
            <option selected :value="value">Сейчас: {{valuename}}</option>
            <option v-for="option in options" :value="option.id">{{option.name}}</option>
        </select>
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

</style>
