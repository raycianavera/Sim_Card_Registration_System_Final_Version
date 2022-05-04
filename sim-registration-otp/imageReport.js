const reportForm = document.querySelector('form#form')

reportForm.addEventListener('submit', e => {
  e.preventDefault()

  console.log(reportForm)
  const imageFile = document.querySelector('input#exampleFormControlFile1')
  console.log(imageFile)
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


// <form class='' id='form' action='UserprofileBackEnd/Back_End_User_Profile.php' method='POST'>
