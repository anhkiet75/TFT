<template>
    <v-app>
        <!-- <v-app-bar app></v-app-bar> -->
        <v-main>
            <v-container fluid>
                <v-row>
                    <v-col cols="4">
                        <User/>
                    </v-col>
                     <v-col cols="8">
                         <Message/>
                    </v-col>
                </v-row>

            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import User from './User.vue'
import Message from './Message.vue'
export default {
   components: {
       User, Message
   }
}
</script>