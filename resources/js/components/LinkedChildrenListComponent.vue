<style scoped>

</style>
<template>
  <div class="d-flex flex-wrap justify-content-between">
        <div  v-for="child in children" v-bind:key="child.id" class="child-card" >
            <div class="img-wrap">
                <img v-if="child.picture" :src= " ` storage${child.picture.replace('public','')} ` " class="img-fluid" />
                <img v-else-if="child.gender == 'M' " src= "storage/boy.jpg" class="img-fluid" />
                <img v-else src= "storage/girl.jpg" class="img-fluid" />
            </div>
            <div class="body">
                <h3 class="title">
                    {{ child.first_name + ' ' + child.last_name }}
                    <svg height="20" width="20">
                        <circle v-if="child.is_active" cx="10" cy="10" r="5" fill="#6edaa1" />
                        <circle v-else cx="10" cy="10" r="5" fill="#e84b02" />
                    </svg>
                </h3>
                <table class="table">
                    <tr>
                        <th>Group</th>
                        <td>{{ child.group.name }}</td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td>{{ getAge(child.dob) }}</td>
                    </tr>
                    <tr>
                        <th>DOB</th>
                        <td>{{ child.dob }}</td>
                    </tr>
                 </table>
                 <a :href=" ` children/${child.id} ` " class="btn btn-primary">View</a>
            </div>
        </div>
  </div>
</template>

<script>

    export default {
        name: "LinkedChildrenListComponent",
        props: ["children"],
        data: function(){
            return{
                age: '',
            }
        },
        methods: {
            getAge(dateString){
               var today = new Date();
               var birthDate = new Date(dateString);
               var age = today.getFullYear() - birthDate.getFullYear();
               var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                 age--;
            }
             return this.age = age;
            }
        }
    }

</script>
