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
    let output = "<option selected disabled>Select Country</option>";
    data.forEach(country => {
      output += `<option value="${country.name}"> ${country.name}</option>`;
    });
    select.innerHTML = output;
  })
  .catch(err => {
    console.error("Error loading countries:", err);
  });
});

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[id^="editLocationModal"]').forEach(modal => {
    modal.addEventListener('shown.bs.modal', () => {
      const select = modal.querySelector('.country-select');
      const selectedCountryName = modal.dataset.selectedCountry?.trim().toLowerCase();

      if (!select || select.options.length > 1) return; // already loaded

      fetch('https://restcountries.com/v2/all?fields=name,alpha2Code')
        .then(res => res.json())
        .then(data => {
          let options = '<option disabled>Select Country</option>';
          data.sort((a, b) => a.name.localeCompare(b.name));

          data.forEach(country => {
            const isSelected = country.name.toLowerCase() === selectedCountryName ? 'selected' : '';
            options += `<option value="${country.alpha2Code}" ${isSelected}>${country.name}</option>`;
          });

          select.innerHTML = options;
        })
        .catch(err => {
          console.error("Error loading countries:", err);
          select.innerHTML = '<option>Error loading countries</option>';
        });
    });
  });
});
document.addEventListener('DOMContentLoaded', () => {
  // Find all edit modals
  document.querySelectorAll('[id^="editLocationModal"]').forEach(modal => {
    // When the modal is shown
    modal.addEventListener('shown.bs.modal', () => {
      const selectedTimezone = modal.dataset.selectedTimezone?.trim();
      const select = modal.querySelector('.timezone-select');

      if (!select) {
        console.warn('No timezone select found in modal:', modal.id);
        return;
      }

      // Avoid reloading if already populated
      if (select.options.length > 1) return;

      const timezones = Intl.supportedValuesOf('timeZone');

      // Add default option
      const defaultOption = document.createElement('option');
      defaultOption.textContent = 'Select Timezone';
      defaultOption.disabled = true;
      if (!selectedTimezone) defaultOption.selected = true;
      select.appendChild(defaultOption);

      // Add all timezones
      timezones.forEach(tz => {
        const option = document.createElement('option');
        option.value = tz;
        option.textContent = tz;
        if (tz === selectedTimezone) {
          option.selected = true;
        }
        select.appendChild(option);
      });
    });
  });
});



