<template>
    <div>

        <div> 
            <input type="text">
            <button type="button" @click="add">Add Component</button>
            <button type="button" @click="remove">hapus</button>
        </div>
        <component v-for="(component, index) in components" :key="index" :is="component" />

    </div>
</template>

<script>
const Comp = {
    template: `<div>
    <input type="text">
    <br>
    </div>`
}
export default {

    data() {
        return {
            components: [Comp],
        }
    },

    methods: {
        add() {
            
            this.components.push(Comp);
            this.$swal({
                title:'Komponen Berhasil Dibuat!!',
                icon:'success'
                });
            
        },
        remove(){
            this.components.splice(this.components.length-1,1)
            this.$swal({
                title:'Komponen Berhasil Dihapus!!',
                icon:'success'
                });
        }
    }
}
</script>

