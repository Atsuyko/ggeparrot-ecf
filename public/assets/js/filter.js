const priceSlider = document.getElementById('price-slider');
const kmSlider = document.getElementById('km-slider');
const yearSlider = document.getElementById('year-slider');

if (priceSlider) {
  const minPrice = document.querySelector('#minPrice')
  const maxPrice = document.querySelector('#maxPrice')

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
