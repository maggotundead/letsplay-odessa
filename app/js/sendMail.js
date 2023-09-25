const emailRegex = /^\S+@\S+\.\S+$/
const form = document.getElementById('email-form')
const emailInput = form.querySelector('input[name="email"]')
const errorsEl= document.getElementById('errors')
const successEl = document.getElementsByClassName('subscribe-success')
const againButton = document.getElementById('againBtn')

function validateEmail() {
  errorsEl.innerText = ''
  const email = emailInput.value.trim()
  if (!emailRegex.test(email)) {
    emailInput.classList.add('is-invalid')
    return false
  } else {
    emailInput.classList.remove('is-invalid')
    return true
  }
}

emailInput.addEventListener('input', validateEmail)
againButton.addEventListener('click', function() {
  successEl[0].style.display = 'none'
  form.parentElement.style.display = 'block'
})
form.addEventListener('submit', (event) => {
  event.preventDefault()
  if (validateEmail()) {
    fetch('https://dev.persec.ai/applications', {
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      method: 'POST',
      body: JSON.stringify({
        email: emailInput.value
      })
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok')
      }
      return response.json()
    })
    .then(() => {
      form.parentElement.style.display = 'none'
      successEl[0].style.display = 'flex'
    })
    .catch(error => {
      errorsEl.innerText = 'Oops something went wrong, please try again later'
    })
  }
})