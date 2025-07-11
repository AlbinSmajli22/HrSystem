 // Get all timezones supported by browser
        const timezones = Intl.supportedValuesOf('timeZone'); // Supported in modern browsers

        const select = document.getElementById('timezone');

        timezones.forEach(tz => {
            const option = document.createElement('option');
            option.value = tz;
            option.textContent = tz;
            select.appendChild(option);
        });

document.addEventListener('DOMContentLoaded', () => {
  const selectDrop = document.querySelector('#country');

  fetch('https://restcountries.com/v2/all?fields=name,alpha2Code')
  .then(res => res.json())
  .then(data => {
    const select = document.getElementById('country');
    let output = "<option selected disabled>Country</option>";
    data.forEach(country => {
      output += `<option value="${country.name}">(${country.alpha2Code}) ${country.name}</option>`;
    });
    select.innerHTML = output;
  })
  .catch(err => {
    console.error("Error loading countries:", err);
  });
});
