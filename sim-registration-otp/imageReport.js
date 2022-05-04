const reportForm = document.querySelector('form')

reportForm.addEventListener('submit', e => {
  e.preventDefault()

  const imageFile = document.querySelector('input#exampleFormControlFile1')
  const formData = new FormData()
  formData.append('image', imageFile)
  const config = {
      headers: {
          "Content-Type" : "multipart/form-data"
      }
  }
  axios.post('https://testcode-wendell.herokuapp.com/api/upload', formData, config)
    .then(response => {
      console.log(response)
      if (response.status === 200) {
        window.location.href = response.data.imageUrl
      } 
    })
    .catch(reason => {
        alert('Invalid OTP : ' + reason.message)
        console.log(reason)
    })
})
