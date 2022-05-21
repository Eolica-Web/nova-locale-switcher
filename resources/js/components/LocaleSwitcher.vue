<template>
    <Dropdown placement="bottom-end">
        <DropdownTrigger :show-arrow="false"
                         class="h-10 w-10 hover:text-primary-500">
            <Icon type="globe-alt" />
        </DropdownTrigger>

        <template #menu>
            <DropdownMenu>
                <div class="flex flex-col py-1">
                    <DropdownMenuItem v-for="(name, locale) in localesWithoutCurrent"
                                      :key="locale"
                                      as="button"
                                      @click.prevent="switchLocale(locale)"
                                      class="flex hover:bg-gray-100 py-1">
                        {{ name }}
                    </DropdownMenuItem>
                </div>
            </DropdownMenu>
        </template>
    </Dropdown>
</template>

<script>
  import _ from 'lodash'
  import { mapGetters } from 'vuex'

  export default {
    data: () => ({
      locales: []
    }),

    mounted() {
      this.getLocales()
    },

    computed: {
      ...mapGetters(['currentUser']),

      currentLocale() {
        if (this.currentUser) {
          return this.currentUser.locale
        }
        return Nova.config('locale') ? Nova.config('locale') : 'en'
      },

      localesWithoutCurrent() {
        return _.omit(this.locales, this.currentLocale)
      }
    },

    methods: {
      switchLocale(locale) {
        Nova.request()
          .post('/nova-vendor/locale-switcher/switch-locale', {
            locale: locale
          })
          .then(() => window.location.reload())
      },

      async getLocales() {
          Nova.request()
            .get('/nova-vendor/locale-switcher/locales')
            .then(response => this.locales = response.data.locales)
      }
    }
  }
</script>
