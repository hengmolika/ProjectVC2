<template>
  
        <tr>
            <td>
                <v-list-item-avatar>
                    <v-image
                        :src="student.profile !== '' ? url + student.profile : url + 'profile.png'"
                    >
                    </v-image>
                </v-list-item-avatar>
            </td>
            <td>{{student.first_name}}</td>
            <td>{{student.last_name}}</td>
            <td>{{student.gender}}</td>
            <td>{{student.class_name}}</td>
            <td>{{student.phone}}</td>
        </tr>
     
</template>

<script>

export default {
    props: ["student"],
    data(){
        return {
            url: "http://localhost:8000/storage/images/",

        }
    },
    method: {

    }

}

</script>