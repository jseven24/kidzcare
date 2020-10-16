<style>
    [v-cloak]{
        display:none;
    }
</style>
<template>
  <div class="container">
     <table v-if="account_holder" class="table">
        <tr>
            <th>{{ account_holder.first_name + ' ' + account_holder.last_name }}</th>
            <th>Balance</th>
        </tr>
        <tr>
            <td>
                <p>{{ account_holder.address }}</p>
                <p>{{ account_holder.phone }}</p>
                <p>{{ account_holder.email }}</p>
            </td>
            <td>
                <p>{{'$' + (account_holder.account.balance/100).toFixed(2) }}</p>
                <button class="btn btn-primary">Pay Now</button>
            </td>
        </tr>
    </table>

    <linked-children-list-component  v-bind:children="children"></linked-children-list-component>

    <form @submit="linkChild">
        <div class="form-group">
            <label>Child's code (given to you by the care facility)</label>
            <input type="text" v-model="code" class="form-control">
        </div>
        <div class="form-group">
            <label>Child's first name</label>
            <input type="text" v-model="first_name" class="form-control">
        </div>
        <div class="form-group">
            <label>Child's last name</label>
            <input type="text" v-model="last_name" class="form-control">
        </div>
        <div class="form-group">
            <label>Child's date of birth</label>
            <input type="text" v-model="dob" class="form-control">
        </div>
        <button class="btn btn-success">Submit</button>
    </form>

    <strong>Output:</strong>
    <pre>{{output}}</pre>

    <!-- <div>{{test}}
        <form v-show="!submitted" method="post">
            <input name="count" :value="count" />
            <input name="count2" v-model="count" />
            <input name="email" v-model="email" />
            <input type="submit" value="click me" v-on:click.prevent="alertMe">
            <input type="submit" value="click me" @click.prevent="alertMe">
        </form>
        <h5 v-show="submitted" v-cloak >Form was submitted</h5>
    </div> -->
   </div>
</template>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    export default {
        props: ['initialChildren', 'accountHolder'],
        data: function(){
            return {
                //test: 'hello',
                //count: 1,
                //email: '',
                //submitted: false,
                children: _.cloneDeep(this.initialChildren),
                account_holder: this.accountHolder[0],
                code: '',
                first_name: '',
                last_name: '',
                dob: '',
                output: '',
            }
        },
        created: function(){
            //this.displayChildren();
            // axios.post('api/home/testing').then(resp => {
            //     console.log(resp.data);
            // });
        },
        methods: {
            linkChild(e) {
                e.preventDefault();
                let currentObj = this;
                axios.post('/home/link-child', {
                    code: this.code,
                    first_name: this.first_name,
                    last_name: this.last_name,
                    dob: this.dob
                 })
                .then(function (response) {
                    if(response.data['success']){
                        currentObj.children.push(response.data['child'][0]);
                    }
                    //currentObj.output = response.data['child'][0];
                    //currentObj.output = currentObj.children;
                    currentObj.output = response.data['msg'];
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            },

            alertMe: function(event) {
                //event.preventDefault();
                //alert(this.email);
                this.submitted = true;
            },
            displayChildren: function(){
                console.log('Children');
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
    }

</script>
