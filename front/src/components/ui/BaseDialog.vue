<template>
    <section>
        <button
        @click.stop="dialog = true"
        >
            <slot name="buttonAction"> </slot>
        </button>

        <v-dialog
        v-model="dialog"
        max-width="700"
        >
        <v-card>
            <v-card-title class="text-h5 white--text primary lighten-2">
                <slot name="dialogTitle"> </slot>
            </v-card-title>

            <v-card-text>
                <slot name="dialogBody"> </slot>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                
                <button @click="dialog = modal" class="mr-3">
                    <slot name="btnClose"> </slot>
                </button>
                    
                <button @click="dialog = modal" >
                    <slot name="btnSubmit"> </slot>
                </button>
                
            </v-card-actions>
        </v-card>
        </v-dialog>
    </section>
</template>

<script>
export default {
    props: ["modal"],
    data() {
        return {
            dialog: false,
        }
    },
    methods: {
        onClick() {
            console.log("Hello")
        }
    },
}
</script>

<style>

</style>