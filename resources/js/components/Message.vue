<template>
   <div>
      
          <v-list-item v-for="(item,index) in items" :key="index"
          class="d-flex"
          >
          

            <v-list-item-content class="justify-start">
              <v-card
              min-width="120px"
              max-width="40%"
              min-height="50px"
              rounded="lg"
              >
              
                    <v-list-item-title  class="my-3 ml-3" >
                        User Database Record <strong>ID {{ item }}</strong>
                    </v-list-item-title>
            
              </v-card>
            </v-list-item-content>

            
          </v-list-item>

          <v-divider></v-divider>
      
   </div>

</template>

<script>
import axios from 'axios'


 export default {
    name: 'Message',
    data: () => ({
      benched: 0,
      items: {}
    }),
    computed: {
      length () {
        return 10
      },
    },
    created() {
        const json = {
            conversation_id : 3
        }
        let token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2NTQ4NTY3OTEsImV4cCI6MTY1NDg2MDM5MSwibmJmIjoxNjU0ODU2NzkxLCJqdGkiOiI2WGJtRkh2VzNrcENLdU9GIiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.cWaoVOEEU2f8un2NInN8Ax713Mr9rJGqaZvkxMOy9p8"
        axios.get(`/api/mess/message/${json.conversation_id}`,
        { 
            headers: {"Authorization" : `Bearer ${token}`} ,
        }   
        )
        .then(res => {
            console.log(res.data)
            this.items = res.data
        })
    }
  }
</script>