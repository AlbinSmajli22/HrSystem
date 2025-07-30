document.addEventListener("DOMContentLoaded", () => {
    const selectedCountryFromDB = window.appSettings.selectedCountry;
    const selectedTimezoneFromDB = window.appSettings.selectedTimezone;

    // Populate timezone select
    const timezoneSelect = document.getElementById("timezone");
    const timezones = Intl.supportedValuesOf('timeZone');
    let tzOutput = '<option disabled>Select Timezone</option>';
    timezones.forEach(tz => {
        const isSelected = (tz === selectedTimezoneFromDB) ? 'selected' : '';
        tzOutput += `<option value="${tz}" ${isSelected}>${tz}</option>`;
    });
    timezoneSelect.innerHTML = tzOutput;

    // Populate country select
    const countrySelect = document.getElementById("country");
    fetch('https://restcountries.com/v2/all?fields=name')
        .then(res => res.json())
        .then(data => {
            let countryOutput = '<option disabled>Select Country</option>';
            data.forEach(country => {
                const isSelected = (country.name === selectedCountryFromDB) ? 'selected' : '';
                countryOutput += `<option value="${country.name}" ${isSelected}>${country.name}</option>`;
            });
            countrySelect.innerHTML = countryOutput;
        })
        .catch(err => console.error("Failed to load countries:", err));
});
