<template>
    <section>
        <base-dialog
        > 
        
            <template v-slot:buttonAction>
                <v-btn color="primary">Student +</v-btn>
            </template>

        </base-dialog>

    </section>
      
</template>

<script>
import BaseDialog from "../ui/BaseDialog.vue";
export default {
    
    components: {
        'base-dialog': BaseDialog,
    },
}
</script>

<style>

</style>