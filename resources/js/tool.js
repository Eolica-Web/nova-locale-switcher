import NovaThemeDropdown from "./components/NovaThemeDropdown"

Nova.booting((app, store) => {
    app.component('ThemeDropdown', NovaThemeDropdown)
    // app.component('HelpText', {
    //     template: `<p class="help-text cursor-pointer" @click="displayWarning"><slot /></p>`,
    //     methods: {
    //         displayWarning() {
    //             window.alert('HelpText alert')
    //         }
    //     }
    // })
})
