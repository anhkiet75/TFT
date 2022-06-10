<template>
  <div>

    <v-card elevation="16" class="mx-auto">
      <v-virtual-scroll
        :bench="benched"
        :items="items"
        item-height="64"
      >
        <template v-slot:default="{ item }">
          <v-list-item :key="item">
            <v-list-item-action>
              <v-btn fab small depressed color="primary">
                {{ item }}
              </v-btn>
            </v-list-item-action>

            <v-list-item-content>
              <v-list-item-title>
                User Database Record <strong>ID {{ item }}</strong>
              </v-list-item-title>
            </v-list-item-content>

            <v-list-item-action>
              <v-icon small> mdi-open-in-new </v-icon>
            </v-list-item-action>
          </v-list-item>

          <v-divider></v-divider>
        </template>
      </v-virtual-scroll>
    </v-card>
  </div>
</template>

<script>

  export default {
    name: 'User',
    data: () => ({
      benched: 0,
    }),
    computed: {
      items () {
        return Array.from({ length: this.length }, (k, v) => v + 1)
      },
      length () {
        return 10
      },
    },
  }

</script>