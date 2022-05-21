import NovaThemeDropdown from "./components/NovaThemeDropdown"

Nova.booting((app, store) => {
    app.component('ThemeDropdown', NovaThemeDropdown)
})
