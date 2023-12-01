const priceSlider = document.getElementById('price-slider')
const kmSlider = document.getElementById('km-slider')
const yearSlider = document.getElementById('year-slider')

const submitBtn = document.getElementById('submit-filter')
const resetBtn = document.getElementById('reset-filter')

const filtersForm = document.getElementById('filters')

const content = document.querySelector('#car-content')

// Dynamic search on submit
filtersForm.addEventListener('submit', (e) => {
  e.preventDefault()

  // Get the form data
  const form = new FormData(filtersForm)

  // Create a query string
  const params = new URLSearchParams()

  form.forEach((value, key) => {
    params.append(key, value)
  })

  // Get the current url
  const url = new URL(window.location.href)

  fetch(url.pathname + '?' + params.toString() + '&ajax=1', {
    headers: {
      'X-Requested-with': 'XMLHttpRequest'
    }
  }).then(response =>
    response.json()
  ).then(data => {
    // Switch the content with active filters
    content.innerHTML = data.content
  }).catch(e => alert(e))

})

function resetFilters() {
  filtersForm.addEventListener('reset', (e) => {
    e.preventDefault()

    priceSlider.noUiSlider.reset()
    kmSlider.noUiSlider.reset()
    yearSlider.noUiSlider.reset()

    // Reset input values on filters
    document.querySelectorAll('#filters input').forEach(input => {
      input.value = ''
    })

    const form = new FormData(filtersForm)

    const params = new URLSearchParams()

    form.forEach((value, key) => {
      params.append(key, value = '')
    })

    const url = new URL(window.location.href)

    fetch(url.pathname + '?' + params.toString() + '&ajax=1', {
      headers: {
        'X-Requested-with': 'XMLHttpRequest'
      }
    }).then(response =>
      response.json()
    ).then(data => {
      content.innerHTML = data.content
    }).catch(e => alert(e))

  })
}


if (priceSlider) {
  const minPrice = document.querySelector('#minPrice')
  const maxPrice = document.querySelector('#maxPrice')

  // Create the slider
  const priceRange = noUiSlider.create(priceSlider, {
    start: [minPrice.value || parseInt(priceSlider.dataset.minprice, 10), maxPrice.value || parseInt(priceSlider.dataset.maxprice, 10)],
    connect: true,
    step: 100,
    range: {
      'min': parseInt(priceSlider.dataset.minprice, 10),
      'max': parseInt(priceSlider.dataset.maxprice, 10)
    }
  });

  priceRange.on('slide', function (values, handle) {
    if (handle === 0) {
      minPrice.value = Math.round(values[0])
    }

    if (handle === 1) {
      maxPrice.value = Math.round(values[1])
    }

  })

  resetFilters()
}

if (kmSlider) {
  const minKm = document.querySelector('#minKm')
  const maxKm = document.querySelector('#maxKm')

  const kmRange = noUiSlider.create(kmSlider, {
    start: [minKm.value || parseInt(kmSlider.dataset.minkm, 10), maxKm.value || parseInt(kmSlider.dataset.maxkm, 10)],
    connect: true,
    step: 1000,
    range: {
      'min': parseInt(kmSlider.dataset.minkm, 10),
      'max': parseInt(kmSlider.dataset.maxkm, 10)
    }
  });

  kmRange.on('slide', function (values, handle) {
    if (handle === 0) {
      minKm.value = Math.round(values[0])
    }

    if (handle === 1) {
      maxKm.value = Math.round(values[1])
    }
  })
}

if (yearSlider) {
  const minYear = document.querySelector('#minYear')
  const maxYear = document.querySelector('#maxYear')

  const yearRange = noUiSlider.create(yearSlider, {
    start: [minYear.value || parseInt(yearSlider.dataset.minyear, 10), maxYear.value || parseInt(yearSlider.dataset.maxyear, 10)],
    connect: true,
    step: 1,
    range: {
      'min': parseInt(yearSlider.dataset.minyear, 10),
      'max': parseInt(yearSlider.dataset.maxyear, 10)
    }
  });

  yearRange.on('slide', function (values, handle) {
    if (handle === 0) {
      minYear.value = Math.round(values[0])
    }

    if (handle === 1) {
      maxYear.value = Math.round(values[1])
    }
  })
}
